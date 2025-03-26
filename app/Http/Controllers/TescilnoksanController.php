<?php

namespace App\Http\Controllers;

use App\Mail\TescilnoksanolusturmaMail;
use App\Models\Aktiflog;
use App\Models\Markatakip;
use App\Models\Smsapi;
use App\Models\Tescilnoksan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TescilnoksanController extends Controller
{
    public function tescilnoksanfiltre(Request $request)
    {
        $perPage = $request->input('entries', 20);
        $currentPage = $request->input('page', 1);

        $cari_id = $request->input('firma_adi');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $satis_temsilcisi = $request->input('satis_temsilcisi');
        $islem_tarihi = Carbon::now();
        $user = User::all();


        $query = Tescilnoksan::query();

        if ($cari_id) {
            $query->where('firma_adi', $cari_id);
        }
        if ($satis_temsilcisi) {
            $query->where('satis_temsilcisi', $satis_temsilcisi);
        }


        if ($ilk_tarih || $son_tarih) {
            $baslangic = $ilk_tarih ? Carbon::parse($ilk_tarih)->startOfDay() : null;
            $son = $son_tarih ? Carbon::parse($son_tarih)->endOfDay() : null;

            if ($baslangic && $son) {
                $query->whereBetween('teblig_bitis_tarihi', [$baslangic, $son]);
            } elseif ($baslangic) {
                $query->where('teblig_bitis_tarihi', '>=', $baslangic);
            } elseif ($son) {
                $query->where('teblig_bitis_tarihi', '<=', $son);
            }
        } else {
            $query->whereNotNull('teblig_bitis_tarihi');
        }

        // Sayfalama ve veri çekme
        $tescilnoksan = $query->paginate($perPage);

        // Sayfa ve sıralama başlangıç numarasını hesapla
        $startNumber = $tescilnoksan->total() - (($currentPage - 1) * $perPage);

        return view('admin.contents.tescilnoksan.tescilnoksan-filtre', compact('perPage','tescilnoksan','ilk_tarih','son_tarih','islem_tarihi','cari_id','startNumber','user'));
    }

    public function tescilnoksansearch(Request $request)
    {
        $tescilnoksansearch = $request->input('tescilnoksansearch');

        // Eğer arama yapılmışsa
        if ($tescilnoksansearch) {
            $tescilnoksan = Tescilnoksan::orderByDesc('id')
            ->where('firma_adi', 'like', '%' . $tescilnoksansearch . '%')
            ->paginate(50);


            // Sayfa numarasını hesapla
            $page = $request->query('page', 1);
            $perPage = 50;
            $startNumber = $tescilnoksan->total() - (($page - 1) * $perPage);

            $user = User::all();

            // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
            if ($request->ajax()) {
                return view('admin.contents.tescilnoksan.tescilnoksan-search', compact('tescilnoksan', 'startNumber', 'user'));
            }

            // Normal sayfa için arama sonucu döndür
            return view('admin.contents.tescilnoksan.tescilnoksan', compact('tescilnoksan', 'startNumber', 'user'));
        }

        // Arama yapılmamışsa ana sayfayı döndür
        return view('admin.contents.tescilnoksan.tescilnoksan');
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        $tescilnoksan = Tescilnoksan::orderByDesc('id')->paginate($perPage);

        $page = $tescilnoksan->currentPage();
        $startNumber = $tescilnoksan->total() - (($page - 1) * $perPage);

        $user = User::all();
        return view('admin.contents.tescilnoksan.tescilnoksan',compact('tescilnoksan','perPage','startNumber','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tescilnoksan = new Tescilnoksan();
        $tescilnoksan->islem_yapan = Auth::user()->id;
        $tescilnoksan->islem_tarihi = Carbon::now();
        $tescilnoksan->markatakip_id = $request->markatakip_id;
        $tescilnoksan->marka_adi = $request->marka_adi;
        $tescilnoksan->firma_adi = $request->firma_adi;
        $tescilnoksan->referans_no = $request->referans_no;
        $tescilnoksan->musteri_temsilcisi = $request->musteri_temsilcisi;
        $tescilnoksan->satis_temsilcisi = $request->satis_temsilcisi;
        $tescilnoksan->teblig_tarihi = $request->teblig_tarihi;
        $tescilnoksan->teblig_bitis_tarihi = $request->teblig_bitis_tarihi;
        $tescilnoksan->tn_durum = $request->tn_durum;
        $tescilnoksan->tn_aciklama = $request->tn_aciklama;
        if ($request->hasFile('tn_dosya')) {
            $fileExtension = $request->tn_dosya->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $tescilnoksan->marka_adi) . '.' . $fileExtension;
            $request->tn_dosya->move(public_path('/tescilnoksan'), $imageName);
            $tescilnoksan->tn_dosya = '/tescilnoksan/' . $imageName;
        }
        $tescilnoksan->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $tescilnoksan->firma_adi . ' ' . 'Carisine' . ' ' . $tescilnoksan->referans_no . ' referans nolu tescilnoksan kaydı eklendi.';
        $log->save();

        $smsapi = Smsapi::first();

            if (!empty($smsapi->kullanici_no)) {
            header('Content-Type: text/html; charset=utf-8');
            $postUrl = 'http://www.ozteksms.com/panel/smsgonder1Npost.php';
            $KULLANICINO = $smsapi->kullanici_no;
            $KULLANICIADI = $smsapi->kullanici_adi;
            $SIFRE = $smsapi->sifre;
            $ORGINATOR = $smsapi->orginator;

            $TUR = 'Normal';  // Normal yada Turkce
            $ZAMAN = '2014-04-07 10:00:00';
            $ZAMANASIMI = '2014-04-07 17:00:00';
            // $mesaj1 = $tescilnoksan->firma_adi .' Firmasına Tebliğ Tarihi' . ' '. Carbon::parse($tescilnoksan->teblig_tarihi)->format('d.m.Y H:i').' '. 'Olan'.' '. $tescilnoksan->marka_adi .' '. 'Markası' .' '. 'Teklif Oluşturulmuştur';
            $mesaj1 = "Sayın" . " " . $tescilnoksan->referansno->firmaadi->yetkili_kisi . " Başvurusunu yapmış olduğunuz " . $tescilnoksan->referansno->basvuru_no . "başvuru numaralı markanıza TESCİL ÜCRET BİLDİRİMİ yapılmış olup belge ödemesinin 2 ay içerisinde yapılması gerekmektedir."  ." " . " Çukurova Patent müşteri temsilcisine ulaşınız. Müşteri Temsilcisi: " . $tescilnoksan->satis_temsilcisi . "," . $tescilnoksan->referansno->satistemsilcisi->telefon . ".";
            $numara1 = $tescilnoksan->referansno->firmaadi->yetkili_kisi_tel;

            $xmlString = 'data=<sms>
            <kno>' . $KULLANICINO . '</kno>
            <kulad>' . $KULLANICIADI . '</kulad>
            <sifre>' . $SIFRE . '</sifre>
            <gonderen>' .  $ORGINATOR . '</gonderen>
            <mesaj>' . $mesaj1 . '</mesaj>
            <numaralar>' . $numara1 . '</numaralar>
            <tur>' . $TUR . '</tur>
            </sms>';

            $Veriler =  $xmlString;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $postUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $Veriler);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }else {
            return redirect('tescilnoksan')->with('error', 'Sms Entegrasyonu Bulunamadı !');
        }
        $emails = [$tescilnoksan->referansno->firmaadi->eposta];
        Mail::to($emails)->send(new TescilnoksanolusturmaMail($tescilnoksan));
        return redirect('tescilnoksan')->with('success','Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tescilnoksan = Tescilnoksan::find($id);
        $marka = Markatakip::find($tescilnoksan->markatakip_id);

        return view('admin.contents.tescilnoksan.tescilnoksan-update',compact('tescilnoksan','marka'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tescilnoksan = Tescilnoksan::find($id);
        $tescilnoksan->islem_yapan = Auth::user()->id;
        $tescilnoksan->islem_tarihi = Carbon::now();
        $tescilnoksan->markatakip_id = $request->markatakip_id;
        $tescilnoksan->marka_adi = $request->marka_adi;
        $tescilnoksan->firma_adi = $request->firma_adi;
        $tescilnoksan->referans_no = $request->referans_no;
        $tescilnoksan->musteri_temsilcisi = $request->musteri_temsilcisi;
        $tescilnoksan->satis_temsilcisi = $request->satis_temsilcisi;
        $tescilnoksan->teblig_tarihi = $request->teblig_tarihi;
        $tescilnoksan->teblig_bitis_tarihi = $request->teblig_bitis_tarihi;
        $tescilnoksan->tn_durum = $request->tn_durum;
        $tescilnoksan->tn_aciklama = $request->tn_aciklama;
        if ($request->hasFile('tn_dosya')) {
            $fileExtension = $request->tn_dosya->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $tescilnoksan->marka_adi) . '.' . $fileExtension;
            $request->tn_dosya->move(public_path('/tescilnoksan'), $imageName);
            $tescilnoksan->tn_dosya = '/tescilnoksan/' . $imageName;
        }
        $tescilnoksan->save();
        return redirect('tescilnoksan')->with('success','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tescilnoksan = Tescilnoksan::find($id);
        $tescilnoksan->delete();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $tescilnoksan->firma_adi . ' ' . 'Carisine' . ' ' . $tescilnoksan->referans_no . ' referans nolu tescilnoksan kaydı Silindi.';
        $log->save();
        return redirect('tescilnoksan')->with('success','Silme Başarılı');

    }
}
