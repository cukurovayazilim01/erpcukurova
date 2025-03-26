<?php

namespace App\Http\Controllers;

use App\Mail\ItiraztakipolusturmaMail;
use App\Models\Aktiflog;
use App\Models\Cariler;
use App\Models\Itiraztakip;
use App\Models\Markatakip;
use App\Models\Smsapi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ItirazTakipController extends Controller
{
    public function itiraztakipfiltre(Request $request)
    {
        $perPage = $request->input('entries', 20);
        $currentPage = $request->input('page', 1);

        $cari_id = $request->input('firma_adi');

        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $satis_temsilcisi = $request->input('satis_temsilcisi');
        $islem_tarihi = Carbon::now();
        $user = User::all();


        $query = Itiraztakip::query();

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
        $itiraztakip = $query->paginate($perPage);

        // Sayfa ve sıralama başlangıç numarasını hesapla
        $startNumber = $itiraztakip->total() - (($currentPage - 1) * $perPage);

        return view('admin.contents.itiraztakip.itiraztakip-filtre', compact('perPage','itiraztakip','ilk_tarih','son_tarih','islem_tarihi','cari_id','startNumber','user'));
    }

    public function itiraztakipsearch(Request $request)
    {
        $itiraztakipsearch = $request->input('itiraztakipsearch');

        // Eğer arama yapılmışsa
        if ($itiraztakipsearch) {
            $itiraztakip = Itiraztakip::orderByDesc('id')
            ->where('firma_adi', 'like', '%' . $itiraztakipsearch . '%')
            ->paginate(50);


            // Sayfa numarasını hesapla
            $page = $request->query('page', 1);
            $perPage = 50;
            $startNumber = $itiraztakip->total() - (($page - 1) * $perPage);

            $user = User::all();

            // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
            if ($request->ajax()) {
                return view('admin.contents.itiraztakip.itiraztakip-search', compact('itiraztakip', 'startNumber', 'user'));
            }

            // Normal sayfa için arama sonucu döndür
            return view('admin.contents.itiraztakip.itiraztakip', compact('itiraztakip', 'startNumber', 'user'));
        }

        // Arama yapılmamışsa ana sayfayı döndür
        return view('admin.contents.itiraztakip.itiraztakip');
    }
    public function getMarkabilgi($markaId)
    {
        $marka = Markatakip::find($markaId);
        return response()->json([
            'marka_adi' => $marka->marka_adi,
            'firma_adi' => $marka->firmaadi->firma_unvan,
            'referans_no' => $marka->referans_no,
            'musteri_temsilcisi' => $marka->musteri_temsilcisi,
            'satis_temsilcisi' => $marka->satistemsilcisi->ad_soyad,
        ]);
    }
    public function basvurunoSearch(Request $request)
    {
        $searchTerm = $request->get('q');  // Arama kelimesi
        $markatakip = Markatakip::where('basvuru_no', 'like', '%' . $searchTerm . '%')->get();
        return response()->json($markatakip);
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        $itiraztakip = Itiraztakip::orderByDesc('id')->paginate($perPage);

        $page = $itiraztakip->currentPage();
        $startNumber = $itiraztakip->total() - (($page - 1) * $perPage);
        $user = User::all();


        return view('admin.contents.itiraztakip.itiraztakip',compact('itiraztakip','perPage','startNumber','user'));
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
        $itiraztakip = new Itiraztakip();
        $itiraztakip->islem_yapan = Auth::user()->id;
        $itiraztakip->islem_tarihi = Carbon::now();
        $itiraztakip->markatakip_id = $request->markatakip_id;
        $itiraztakip->marka_adi = $request->marka_adi;
        $itiraztakip->firma_adi = $request->firma_adi;
        $itiraztakip->referans_no = $request->referans_no;
        $itiraztakip->musteri_temsilcisi = $request->musteri_temsilcisi;
        $itiraztakip->satis_temsilcisi = $request->satis_temsilcisi;
        $itiraztakip->teblig_tarihi = $request->teblig_tarihi;
        $itiraztakip->bakanlik_karari = $request->bakanlik_karari;
        $itiraztakip->itiraz_islem = $request->itiraz_islem;
        $itiraztakip->itiraz_durum = $request->itiraz_durum;
        $itiraztakip->teblig_bitis_tarihi = $request->teblig_bitis_tarihi;
        $itiraztakip->ucret = $request->ucret;
        $itiraztakip->itiraz_aciklama = $request->itiraz_aciklama;

        if ($request->hasFile('itiraz_dosya')) {
            $fileExtension = $request->itiraz_dosya->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $itiraztakip->marka_adi) . '.' . $fileExtension;
            $request->itiraz_dosya->move(public_path('/itiraztakip'), $imageName);
            $itiraztakip->itiraz_dosya = '/itiraztakip/' . $imageName;
        }
        $itiraztakip->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $itiraztakip->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $itiraztakip->referans_no . ' referans nolu itiraz eklendi.';
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
            // $mesaj1 = $itiraztakip->firma_adi .' Firmasına Tebliğ Tarihi' . ' '. Carbon::parse($itiraztakip->teblig_tarihi)->format('d.m.Y H:i').' '. 'Olan'.' '. $itiraztakip->marka_adi .' '. 'Markası' .' '. 'Teklif Oluşturulmuştur';
            $mesaj1 = "Sayın" . " " . $itiraztakip->referansno->firmaadi->yetkili_kisi . " Başvurusunu yapmış olduğunuz " . $itiraztakip->referansno->basvuru_no . "nolu markanıza" ." " . $itiraztakip->bakanlik_karari ." " . "gelmiştir. Çukurova Patent müşteri temsilcisine ulaşınız. Müşteri Temsilcisi: " . $itiraztakip->satis_temsilcisi . "," . $itiraztakip->referansno->satistemsilcisi->telefon . ".";
            $numara1 = $itiraztakip->referansno->firmaadi->yetkili_kisi_tel;

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
            return redirect('itiraztakipp')->with('error', 'Sms Entegrasyonu Bulunamadı !');
        }
        $emails = [$itiraztakip->referansno->firmaadi->eposta];
        Mail::to($emails)->send(new ItiraztakipolusturmaMail($itiraztakip));

        return redirect('itiraztakipp')->with('success','Ekleme Başarılı');
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
        $itiraztakip = Itiraztakip::find($id);
        $marka = Markatakip::find($itiraztakip->markatakip_id);

        return view('admin.contents.itiraztakip.itiraztakip-update',compact('itiraztakip','marka'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itiraztakip = Itiraztakip::find($id);
        $eskiVeriler = $itiraztakip->getOriginal();

        $itiraztakip->islem_yapan = Auth::user()->id;
        $itiraztakip->islem_tarihi = Carbon::now();
        $itiraztakip->markatakip_id = $request->markatakip_id;
        $itiraztakip->marka_adi = $request->marka_adi;
        $itiraztakip->firma_adi = $request->firma_adi;
        $itiraztakip->referans_no = $request->referans_no;
        $itiraztakip->musteri_temsilcisi = $request->musteri_temsilcisi;
        $itiraztakip->satis_temsilcisi = $request->satis_temsilcisi;
        $itiraztakip->teblig_tarihi = $request->teblig_tarihi;
        $itiraztakip->bakanlik_karari = $request->bakanlik_karari;
        $itiraztakip->itiraz_islem = $request->itiraz_islem;
        $itiraztakip->itiraz_durum = $request->itiraz_durum;
        $itiraztakip->teblig_bitis_tarihi = $request->teblig_bitis_tarihi;
        $itiraztakip->ucret = $request->ucret;
        $itiraztakip->itiraz_aciklama = $request->itiraz_aciklama;

        if ($request->hasFile('itiraz_dosya')) {
            $fileExtension = $request->itiraz_dosya->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $itiraztakip->marka_adi) . '.' . $fileExtension;
            $request->itiraz_dosya->move(public_path('/itiraztakip'), $imageName);
            $itiraztakip->itiraz_dosya = '/itiraztakip/' . $imageName;
        }
        $itiraztakip->save();

        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            if (isset($itiraztakip->$alan) && $itiraztakip->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $itiraztakip->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // Değişiklikleri HTML formatında birleştir
            $degisenAlanlarText = '<br><ul>' . implode(' ', $degisenAlanlar) . '</ul>';

            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $itiraztakip->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $itiraztakip->referans_no . ' referans nolu itirazı Güncellendi.',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }

        return redirect('itiraztakipp')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $itiraztakip = Itiraztakip::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $itiraztakip->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $itiraztakip->referans_no . ' referans nolu itirazı Silindi.';
        $log->save();
        $itiraztakip->delete();
        return redirect('itiraztakipp')->with('success','Silme Başarılı');

    }
}
