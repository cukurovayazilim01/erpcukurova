<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Cariler;
use App\Models\Firmahrkt;
use App\Models\Hizmetler;
use App\Models\Hizmetlerkategori;
use App\Models\Satislar;
use App\Models\Satislardata;
use App\Models\Smsapi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SatislarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function firmahrktaktarsatislar()
{
    $satislar = Satislar::all(); // Tüm satışları al

    foreach ($satislar as $satis) {
        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $satis->satis_tarihi;
        $firmahrkt->islem_yapan = $satis->user_id;
        $firmahrkt->cari_id = $satis->cari_id;
        $firmahrkt->islem = 'Satış';
        $firmahrkt->satis_id = $satis->id;
        $firmahrkt->borc = $satis->satis_kdvli_toplam;
        $firmahrkt->save();
    }

    return redirect('satislar')->with('success', 'Tüm Satışlar Firma Hareketlerine Aktarıldı');
}

public function cariSearchsatislar(Request $request)
    {
        $searchTerm = $request->get('q');  // Arama kelimesi

        $cariler = Cariler::where('firma_unvan', 'like', '%' . $searchTerm . '%')
                          ->where('firma_tipi', 'Müşteri') // Sadece firma_tipi "Tedarikçi" olanları getir
                          ->get();

        return response()->json($cariler);
    }

    public function satislarsearch(Request $request)
    {
        $satislarsearch = $request->input('satislarsearch');

        // Eğer arama yapılmışsa
        if ($satislarsearch) {
            $satislar = Satislar::orderByDesc('id')
                ->whereHas('firmaadi',function($query) use ($satislarsearch) {
                    $query->where('firma_unvan', 'like', '%' . $satislarsearch . '%');
                })
                ->paginate(50);

            // Sayfa numarasını hesapla
            $page = $request->query('page', 1);
            $perPage = 50;
            $startNumber = $satislar->total() - (($page - 1) * $perPage);

            $user = User::all();

            // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
            if ($request->ajax()) {
                return view('admin.contents.satislar.satislar-search', compact('satislar', 'startNumber', 'user'));
            }

            // Normal sayfa için arama sonucu döndür
            return view('admin.contents.satislar.satislar', compact('satislar', 'startNumber', 'user'));
        }

        // Arama yapılmamışsa ana sayfayı döndür
        return view('admin.contents.satislar.satislar');
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // $cariler = Cariler::all();
        $satislar = Satislar::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $satislar->currentPage();
        $startNumber = $satislar->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.satislar.satislar', compact('satislar', 'startNumber', 'perPage','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satislar = Satislar::all();
        $user = User::all();
        $hizmetlerkategori = Hizmetlerkategori::all();
        $hizmetler = Hizmetler::all();
        return view('admin.contents.satislar.satislar-create', compact('satislar', 'user', 'hizmetlerkategori', 'hizmetler'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $satislar_max_no = Satislar::max('satis_kodu');
        $satislar = new Satislar();
        $satislar->satis_kodu = empty($satislar_max_no) ? 1 : $satislar_max_no + 1;
        $satislar->satis_kodu_text = 'SF';
        $satislar->islem_yapan = Auth::user()->id;
        $satislar->islem_tarihi = Carbon::now();
        $satislar->satis_tarihi = $request->satis_tarihi;
        $satislar->cari_id = $request->cari_id;
        $satislar->user_id = $request->user_id;
        $satislar->tescil_tl = $request->tescil_tl;

        $satislar->durum = 0;
        $satislar->satis_konu = $request->satis_konu;
        $satislar->satis_aciklama = $request->satis_aciklama;
        $satislar->aciklama = $request->aciklama;


        $satislar->satis_iskonto_toplam = $request->satis_iskonto_toplam;
        $satislar->satis_kdv_toplam = $request->satis_kdv_toplam;
        $satislar->satis_ara_toplam = $request->satis_ara_toplam;
        $satislar->satis_kdvli_toplam = $request->satis_kdvli_toplam;
        $satislar->save();

        $inputs = $request->input('inputs');

        foreach ($inputs as $input) {
            $satislardata = new  Satislardata();
            $satislardata->satis_id = $satislar->id;
            $satislardata->hizmetlerkategori_id = $input['hizmetlerkategori_id'];
            $satislardata->hizmet_id = $input['hizmet_id'];
            $satislardata->satir_aciklama = $input['satir_aciklama'];
            $satislardata->satis_hizmet_miktar = $input['satis_hizmet_miktar'];
            $satislardata->satis_hizmet_birim = $input['satis_hizmet_birim'];
            $satislardata->hizmet_maliyet = $input['hizmet_maliyet'];
            $satislardata->maliyet_toplam_fiyat = $input['maliyet_toplam_fiyat'];
            $satislardata->satis_fiyat = $input['satis_fiyat'];
            $satislardata->satis_kdv_oran = $input['satis_kdv_oran'];
            $satislardata->satis_kdv_tutar = $input['satis_kdv_tutar'];
            $satislardata->satis_kdvsiz_fiyat = $input['satis_kdvsiz_fiyat'];
            $satislardata->satis_iskonto = $input['satis_iskonto'];
            $satislardata->satis_toplam_fiyat = $input['satis_toplam_fiyat'];

            $satislardata->save();
        }

        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $satislar->satis_tarihi;
        $firmahrkt->islem_yapan = $satislar->user_id;
        $firmahrkt->cari_id =  $satislar->cari_id;
        $firmahrkt->islem = 'Satış';
        $firmahrkt->satis_id = $satislar->id;
        $firmahrkt->borc = $satislar->satis_kdvli_toplam;
        $firmahrkt->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $satislar->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $satislar->satis_kodu_text.'-'.$satislar->satis_kodu . ' kodlu'. $satislar->satis_kdvli_toplam . ' ₺ Satış Eklendi.';
        $log->save();

    //     $smsapi = Smsapi::first();
    //     $firmaUnvani = Cariler::find($satislar->cari_id);


    //     if (!empty($smsapi->kullanici_no)) {
    //     header('Content-Type: text/html; charset=utf-8');
    //     $postUrl = 'http://www.ozteksms.com/panel/smsgonder1Npost.php';
    //     $KULLANICINO = $smsapi->kullanici_no;
    //     $KULLANICIADI = $smsapi->kullanici_adi;
    //     $SIFRE = $smsapi->sifre;
    //     $ORGINATOR = $smsapi->orginator;

    //     $TUR = 'Normal';  // Normal yada Turkce
    //     $ZAMAN = '2014-04-07 10:00:00';
    //     $ZAMANASIMI = '2014-04-07 17:00:00';
    //     $mesaj1 = 'Cari Hesaplarınız da Kayıtlı Bulunan'.' '. $firmaUnvani->firma_unvan .' Firmasına '. Carbon::parse($satislar->satis_tarihi)->format('d.m.Y H:i').' '. 'Tarihinde Oluşturulan Satış Tutarı'.' '. $satislar->satis_kdvli_toplam .' '. 'TL' .' '. 'Satış Oluşturulmuştur';

    //     $numara1 = '5333909033';

    //     $xmlString = 'data=<sms>
    //     <kno>' . $KULLANICINO . '</kno>
    //     <kulad>' . $KULLANICIADI . '</kulad>
    //     <sifre>' . $SIFRE . '</sifre>
    //     <gonderen>' .  $ORGINATOR . '</gonderen>
    //     <mesaj>' . $mesaj1 . '</mesaj>
    //     <numaralar>' . $numara1 . '</numaralar>
    //     <tur>' . $TUR . '</tur>
    //     </sms>';

    //     $Veriler =  $xmlString;
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $postUrl);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $Veriler);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     echo $response;
    // }else {
    //     return redirect('satislar')->with('error', 'Sms Entegrasyonu Bulunamadı !');
    // }
        return redirect('satislar')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $satislar = Satislar::find($id);
        $satislardata = Satislardata::where('satis_id',$id)->get();
        return view('admin.contents.satislar.satislar-show',compact('satislar','satislardata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $satislar = Satislar::find($id);
        $user = User::all();
        $hizmetlerkategori = Hizmetlerkategori::all();
        $hizmetler = Hizmetler::all();
        $cariler = Cariler::find($satislar->cari_id);
        $satislardata = Satislardata::where('satis_id',$id)->get();
        return view('admin.contents.satislar.satislar-update', compact('satislar', 'user', 'hizmetlerkategori', 'hizmetler', 'cariler', 'satislardata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $satislar = Satislar::find($id);
        $eskiVeriler = $satislar->getOriginal();


        $input = $request->input('inputs.0');

        $satislar->islem_yapan = Auth::user()->id;
        $satislar->islem_tarihi = Carbon::now();
        $satislar->satis_tarihi = $request->satis_tarihi;
        $satislar->cari_id = $request->cari_id;
        $satislar->user_id = $request->user_id;
        $satislar->tescil_tl = $request->tescil_tl;

        $satislar->satis_konu = $request->satis_konu;
        $satislar->satis_aciklama = $request->satis_aciklama;
        $satislar->aciklama = $request->aciklama;

        $satislar->satis_iskonto_toplam = $request->satis_iskonto_toplam;
        $satislar->satis_kdv_toplam = $request->satis_kdv_toplam;
        $satislar->satis_ara_toplam = $request->satis_ara_toplam;
        $satislar->satis_kdvli_toplam = $request->satis_kdvli_toplam;
        $satislar->save();

        $satislardata = Satislardata::where('satis_id',$satislar->id)->get();
        foreach ($satislardata as $silinecekveriler) {
            $silinecekveriler -> delete();
        }

        $inputs = $request->input('inputs');

        $olansatirsatislardata = $satislar->satislardata;

        foreach ($inputs as $key => $input) {
            if ($key < $olansatirsatislardata->count()) {
                // VAR OLAN SATIRI GĞNCELER
                $satislardata = $olansatirsatislardata[$key];
                $satislardata->hizmetlerkategori_id = $input['hizmetlerkategori_id'];
                $satislardata->hizmet_id = $input['hizmet_id'];
                $satislardata->satir_aciklama = $input['satir_aciklama'];
                $satislardata->satis_hizmet_miktar = $input['satis_hizmet_miktar'];
                $satislardata->satis_hizmet_birim = $input['satis_hizmet_birim'];
                $satislardata->hizmet_maliyet = $input['hizmet_maliyet'];
                $satislardata->maliyet_toplam_fiyat = $input['maliyet_toplam_fiyat'];
                $satislardata->satis_fiyat = $input['satis_fiyat'];
                $satislardata->satis_kdv_oran = $input['satis_kdv_oran'];
                $satislardata->satis_kdv_tutar = $input['satis_kdv_tutar'];
                $satislardata->satis_kdvsiz_fiyat = $input['satis_kdvsiz_fiyat'];
                $satislardata->satis_iskonto = $input['satis_iskonto'];
                $satislardata->satis_toplam_fiyat = $input['satis_toplam_fiyat'];
                $satislardata->save();
            } else {
                // burasıda yeni satır için
                $satislardata = new Satislardata();
                $satislardata->satis_id = $satislar->id;
                $satislardata->hizmetlerkategori_id = $input['hizmetlerkategori_id'];
                $satislardata->hizmet_id = $input['hizmet_id'];
                $satislardata->satir_aciklama = $input['satir_aciklama'];
                $satislardata->satis_hizmet_miktar = $input['satis_hizmet_miktar'];
                $satislardata->satis_hizmet_birim = $input['satis_hizmet_birim'];
                $satislardata->hizmet_maliyet = $input['hizmet_maliyet'];
                $satislardata->maliyet_toplam_fiyat = $input['maliyet_toplam_fiyat'];
                $satislardata->satis_fiyat = $input['satis_fiyat'];
                $satislardata->satis_kdv_oran = $input['satis_kdv_oran'];
                $satislardata->satis_kdv_tutar = $input['satis_kdv_tutar'];
                $satislardata->satis_kdvsiz_fiyat = $input['satis_kdvsiz_fiyat'];
                $satislardata->satis_iskonto = $input['satis_iskonto'];
                $satislardata->satis_toplam_fiyat = $input['satis_toplam_fiyat'];
                $satislardata->save();
            }

            $firmahrkt = Firmahrkt::where('satis_id',$satislar->id)->first();
            $firmahrkt->tarih = Carbon::now();
            $firmahrkt->islem_tarihi = $satislar->satis_tarihi;
            $firmahrkt->islem_yapan = $satislar->user_id;
            $firmahrkt->cari_id =  $satislar->cari_id;
            $firmahrkt->islem = 'Satış';
            $firmahrkt->satis_id = $satislar->id;
            $firmahrkt->borc = $satislar->satis_kdvli_toplam;
            $firmahrkt->save();
        }

        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            if (isset($satislar->$alan) && $satislar->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $satislar->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // Değişiklikleri HTML formatında birleştir
            $degisenAlanlarText = '<br><ul>' . implode(' ', $degisenAlanlar) . '</ul>';

            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $satislar->firmaadi->firma_unvan . ' Carisinin'. ' '. $satislar->alis_kodu_text.'-'. $satislar->alis_kodu . ' kodlu satisi güncellendi.',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }
        return redirect('satislar')->with('success', 'Güncelleme Başarılı');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $satislar = Satislar::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $satislar->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $satislar->satis_kodu_text.'-'.$satislar->satis_kodu . ' kodlu'. $satislar->satis_kdvli_toplam . ' ₺ Satış Silindi.';
        $log->save();

        foreach ($satislar->satislardata as $data) {
            // dd($data);
            $data->delete(); // Her bir ilişkiyi tek tek sil
        }
        $firmahrkt = Firmahrkt::where('satis_id',$satislar->id);
        $firmahrkt->delete();
        $satislar->delete();


        return redirect('satislar')->with('success', 'Silme Başarılı');
    }
}
