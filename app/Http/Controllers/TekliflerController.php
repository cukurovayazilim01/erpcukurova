<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Cariler;
use App\Models\Firmahrkt;
use App\Models\Hizmetler;
use App\Models\Hizmetlerkategori;
use App\Models\Odemeplan;
use App\Models\Satislar;
use App\Models\Satislardata;
use App\Models\Smsapi;
use App\Models\Teklifler;
use App\Models\Tekliflerdata;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TekliflerController extends Controller
{

    public function tekliflersearch(Request $request)
    {
        $tekliflersearch = $request->input('tekliflersearch');

        // Temel sorgu
        $tekliflerQuery = Teklifler::orderByDesc('id');
        if (request()->is('bekleyenteklifler')) {
            $tekliflerQuery->where('durum', 0); // Bekleyen teklifler için
        } elseif (request()->is('onaylananteklifler')) {
            $tekliflerQuery->where('durum', 1); // Onaylanan teklifler için
        }

        // Eğer arama yapılmışsa
        if ($tekliflersearch) {
            $tekliflerQuery->whereHas('firmaadi', function ($query) use ($tekliflersearch) {
                $query->where('firma_unvan', 'like', '%' . $tekliflersearch . '%');
            });
        }



        // Sorguyu tamamla ve sayfala
        $teklifler = $tekliflerQuery->paginate(50);

        // Sayfa numarasını hesapla
        $page = $request->query('page', 1);
        $perPage = 50;
        $startNumber = $teklifler->total() - (($page - 1) * $perPage);

        $user = User::all();

        // Eğer AJAX isteği ise arama sonucunu döndür
        if ($request->ajax()) {
            return view('admin.contents.teklifler.teklifler-search', compact('teklifler', 'startNumber', 'user'));
        }

        // Normal sayfa için arama sonucu döndür
        return view('admin.contents.teklifler.teklifler', compact('cariler', 'startNumber', 'user'));

    }
    public function satisafisineaktar($id)
    {
        $teklifler = Teklifler::find($id);
        $tekliflerdata = Tekliflerdata::where('teklif_id', $id)->get();

        return view('admin.contents.teklifler.satisfisineaktar', compact('teklifler', 'tekliflerdata'));
    }

    public function Postsatisfisineaktar(Request $request, $id)
    {
        $teklifler = Teklifler::find($id);

        if ($teklifler->satis_durum == '0') {
            $teklifler->satis_durum = '1';
        }
        $teklifler->save();
        $satislar_max_no = Satislar::max('satis_kodu');
        $satislar = new Satislar();
        $satislar->satis_kodu = empty($satislar_max_no) ? 1 : $satislar_max_no + 1;
        $satislar->satis_kodu_text = 'SF';
        $satislar->islem_yapan = $teklifler->user_id;
        $satislar->islem_tarihi = Carbon::now();
        $satislar->satis_tarihi = $teklifler->teklif_tarihi;
        $satislar->cari_id = $teklifler->cari_id;
        $satislar->user_id = $teklifler->user_id;
        $satislar->teklif_id = $teklifler->id;
        $satislar->durum = 0;

        $satislar->satis_konu = $teklifler->teklif_konu;
        $satislar->tescil_tl = $teklifler->tescil_tl;
        $satislar->satis_aciklama = $teklifler->teklif_aciklama;
        $satislar->aciklama = $teklifler->aciklama;

        $satislar->satis_iskonto_toplam = $teklifler->teklif_iskonto_toplam;
        $satislar->satis_kdv_toplam = $teklifler->teklif_kdv_toplam;
        $satislar->satis_ara_toplam = $teklifler->teklif_ara_toplam;
        $satislar->satis_kdvli_toplam = $teklifler->teklif_kdvli_toplam;
        $satislar->save();

        $tekliflerdata = Tekliflerdata::where('teklif_id', $id)->get();

        foreach ($tekliflerdata as $teklif) {
            $satislardata = new Satislardata();
            $satislardata->satis_id = $satislar->id; // Satış ID'sini ilişkilendir
            $satislardata->hizmetlerkategori_id = $teklif->hizmetlerkategori_id;
            $satislardata->hizmet_id = $teklif->hizmet_id;
            $satislardata->satir_aciklama = $teklif->satir_aciklama;
            $satislardata->satis_hizmet_miktar = $teklif->teklif_hizmet_miktar;
            $satislardata->satis_hizmet_birim = $teklif->teklif_hizmet_birim;
            $satislardata->satis_fiyat = $teklif->teklif_fiyat;
            $satislardata->hizmet_maliyet = $teklif->hizmet_maliyet;
            $satislardata->maliyet_toplam_fiyat = $teklif->maliyet_toplam_fiyat;
            $satislardata->satis_kdv_oran = $teklif->teklif_kdv_oran;
            $satislardata->satis_kdv_tutar = $teklif->teklif_kdv_tutar;
            $satislardata->satis_kdvsiz_fiyat = $teklif->teklif_kdvsiz_fiyat;
            $satislardata->satis_iskonto = $teklif->teklif_iskonto;
            $satislardata->satis_toplam_fiyat = $teklif->teklif_toplam_fiyat;

            $satislardata->save();
        }

        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $satislar->satis_tarihi;
        $firmahrkt->islem_yapan = $satislar->user_id;
        $firmahrkt->cari_id = $satislar->cari_id;
        $firmahrkt->islem = 'Satış';
        $firmahrkt->satis_id = $satislar->id;
        $firmahrkt->borc = $satislar->satis_kdvli_toplam;
        $firmahrkt->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $teklifler->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' .$teklifler->teklif_kodu_text.'-'.$teklifler->teklif_kodu. ' kodlu'. $teklifler->teklif_kdvli_toplam . ' ' . ' ₺ Teklifi Satışa Aktarıldı. ';

        $log->save();

        return redirect('satislar')->with('success', 'Ekleme Başarılı');

    }

    public function bekleyenteklifler(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // Eğer durum belirtilmişse ona göre filtrele
        $teklifler = Teklifler::where('durum', '0')->orderBy('created_at', 'desc')->paginate($perPage);

        $page = $teklifler->currentPage();
        $startNumber = $teklifler->total() - (($page - 1) * $perPage);
        $user = User::all();

        return view('admin.contents.teklifler.teklifler', compact('teklifler', 'startNumber', 'perPage', 'user'));
    }
    public function onaylananteklifler(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // Eğer durum belirtilmişse ona göre filtrele
        $teklifler = Teklifler::where('durum', '1')->orderBy('created_at', 'desc')->paginate($perPage);

        $page = $teklifler->currentPage();
        $startNumber = $teklifler->total() - (($page - 1) * $perPage);
        $user = User::all();

        return view('admin.contents.teklifler.teklifler', compact('teklifler', 'startNumber', 'perPage', 'user'));
    }
    public function onaylanmayanteklifler(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // Eğer durum belirtilmişse ona göre filtrele
        $teklifler = Teklifler::where('durum', '2')->orderBy('created_at', 'desc')->paginate($perPage);

        $page = $teklifler->currentPage();
        $startNumber = $teklifler->total() - (($page - 1) * $perPage);
        $user = User::all();

        return view('admin.contents.teklifler.teklifler', compact('teklifler', 'startNumber', 'perPage', 'user'));
    }

    public function onaylaTeklif($id)
    {
        $teklif = Teklifler::find($id);

        if ($teklif->durum == '0') {
            $teklif->durum = '1';
        } elseif ($teklif->durum == '2') {
            $teklif->durum = '1';
        } else {
            $teklif->durum = '0';
        }

        $teklif->save();

        return redirect('onaylananteklifler')->with('success', 'Teklif başarıyla onaylandı!');
    }
    public function reddetTeklif($id)
    {
        $teklif = Teklifler::find($id);

        if ($teklif->durum == '0') {
            $teklif->durum = '2';
        } elseif ($teklif->durum == '1') {
            $teklif->durum = '2';
        } else {
            $teklif->durum = '0';
        }

        $teklif->save();

        return redirect('onaylanmayanteklifler')->with('success', 'Teklif reddedildi!');
    }
    public function iptaletTeklif($id)
    {
        $teklif = Teklifler::find($id);

        if ($teklif->durum == '1') {
            $teklif->durum = '0';
        } elseif ($teklif->durum == '2') {
            $teklif->durum = '0';
        } else {
            $teklif->durum = '0';
        }

        $teklif->save();

        return redirect('bekleyenteklifler')->with('success', 'Teklif iptal edildi!');
    }


    public function getHizmetlerByKategori($id)
    {
        // Kategoriye ait hizmetleri getir
        $hizmetler = Hizmetler::where('hizmetler_kategori_id', $id)->get();

        // Hizmetleri JSON olarak döndür
        return response()->json($hizmetler);
    }
    public function getFiyat($hizmetId)
    {
        // İlgili hizmeti veritabanından bul
        $hizmetler = Hizmetler::find($hizmetId);

        // Hizmet bulunamazsa hata mesajı döndür
        if (!$hizmetler) {
            return response()->json(['error' => 'Hizmet bulunamadı'], 404);
        }

        // Hizmet fiyat ve maliyet bilgilerini JSON olarak döndür
        return response()->json([
            'hizmet_satis_fiyati' => $hizmetler->hizmet_satis_fiyati,
            'hizmet_maliyet' => $hizmetler->hizmet_maliyet
        ]);
    }

    public function cariSearch(Request $request)
    {
        $searchTerm = $request->get('q');  // Arama kelimesi
        $cariler = Cariler::where('firma_unvan', 'like', '%' . $searchTerm . '%')->get();
        return response()->json($cariler);
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // $cariler = Cariler::all();
        $teklifler = Teklifler::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $teklifler->currentPage();
        $startNumber = $teklifler->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.teklifler.teklifler', compact('teklifler', 'startNumber', 'perPage', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $teklifler = Teklifler::all();
        $user = User::all();
        $hizmetlerkategori = Hizmetlerkategori::all();
        $hizmetler = Hizmetler::all();
        $cari = null;
        if ($request->has('cari_id')) {
            $cari = Cariler::findOrFail($request->get('cari_id')); // Cariyi al
        }
        return view('admin.contents.teklifler.teklifler-create', compact('teklifler', 'user', 'hizmetlerkategori', 'hizmetler', 'cari'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teklifler_max_no = Teklifler::max('teklif_kodu');
        $teklifler = new Teklifler();
        $teklifler->teklif_kodu = empty($teklifler_max_no) ? 1 : $teklifler_max_no + 1;
        $teklifler->teklif_kodu_text = 'ÇT';
        $teklifler->islem_yapan = Auth::user()->id;
        $teklifler->islem_tarihi = Carbon::now();
        $teklifler->teklif_tarihi = $request->teklif_tarihi;
        $teklifler->cari_id = $request->cari_id;
        $teklifler->user_id = $request->user_id;
        $teklifler->tescil_tl = $request->tescil_tl;

        $teklifler->satis_durum = 0;
        $teklifler->durum = 0;
        $teklifler->teklif_konu = $request->teklif_konu;
        $teklifler->teklif_aciklama = $request->teklif_aciklama;
        $teklifler->aciklama = $request->aciklama;
        $teklifler->odemeplan_durum = $request->odemeplan_durum;

        $teklifler->teklif_iskonto_toplam = $request->teklif_iskonto_toplam;
        $teklifler->teklif_kdv_toplam = $request->teklif_kdv_toplam;
        $teklifler->teklif_ara_toplam = $request->teklif_ara_toplam;
        $teklifler->teklif_kdvli_toplam = $request->teklif_kdvli_toplam;
        $teklifler->save();

        $inputs = $request->input('inputs');

        foreach ($inputs as $input) {
            $tekliflerdata = new Tekliflerdata();
            $tekliflerdata->teklif_id = $teklifler->id;
            $tekliflerdata->hizmetlerkategori_id = $input['hizmetlerkategori_id'];
            $tekliflerdata->hizmet_id = $input['hizmet_id'];
            $tekliflerdata->teklif_hizmet_miktar = $input['teklif_hizmet_miktar'];
            $tekliflerdata->teklif_hizmet_birim = $input['teklif_hizmet_birim'];
            $tekliflerdata->satir_aciklama = $input['satir_aciklama'];

            $tekliflerdata->hizmet_maliyet = $input['hizmet_maliyet'];
            $tekliflerdata->maliyet_toplam_fiyat = $input['maliyet_toplam_fiyat'];
            $tekliflerdata->teklif_fiyat = $input['teklif_fiyat'];
            $tekliflerdata->teklif_kdv_oran = $input['teklif_kdv_oran'];
            $tekliflerdata->teklif_kdv_tutar = $input['teklif_kdv_tutar'];
            $tekliflerdata->teklif_kdvsiz_fiyat = $input['teklif_kdvsiz_fiyat'];
            $tekliflerdata->teklif_iskonto = $input['teklif_iskonto'];
            $tekliflerdata->teklif_toplam_fiyat = $input['teklif_toplam_fiyat'];

            $tekliflerdata->save();
        }
        $inputss = $request->input('inputss');

        if ($teklifler->odemeplan_durum == 'Var') {
            foreach ($inputss as $inputs) {
                $odemeplani = new Odemeplan();
                $odemeplani->teklif_id = $teklifler->id;
                $odemeplani->odeme_tarihi = $inputs['odeme_tarihi'];
                $odemeplani->tutar = $inputs['tutar'];
                $odemeplani->odeme_turu = $inputs['odeme_turu'];

                $odemeplani->save();
            }
        }


        //         $smsapi = Smsapi::first();
        //         $firmaUnvani = Cariler::find($teklifler->cari_id);


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
        //     $mesaj1 = 'Cari Hesaplarınız da Kayıtlı Bulunan'.' '. $firmaUnvani->firma_unvan .' Firmasına '. Carbon::parse($teklifler->teklif_tarihi)->format('d.m.Y H:i').' '. 'Tarihinde Oluşturulan Teklif Tutarı'.' '. $teklifler->teklif_kdvli_toplam .' '. 'TL' .' '. 'Teklif Oluşturulmuştur';

        //     $numara1 = '5436854151';

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
        //     return redirect('teklifler')->with('error', 'Sms Entegrasyonu Bulunamadı !');
        // }

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $teklifler->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' .$teklifler->teklif_kodu_text.'-'.$teklifler->teklif_kodu. ' kodlu'. $teklifler->teklif_kdvli_toplam . ' ' . ' ₺ Teklifi Eklendi. ';

        $log->save();


        return redirect('teklifler')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teklifler = Teklifler::find($id);
        $tekliflerdata = Tekliflerdata::where('teklif_id', $id)->get();
        $odemeplan = Odemeplan::where('teklif_id', $id)->get();
        return view('admin.contents.teklifler.teklifler-show', compact('teklifler', 'tekliflerdata', 'odemeplan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teklifler = Teklifler::find($id);
        $user = User::all();
        $hizmetlerkategori = Hizmetlerkategori::all();
        $hizmetler = Hizmetler::all();
        $cariler = Cariler::find($teklifler->cari_id);
        $tekliflerdata = Tekliflerdata::where('teklif_id', $id)->get();

        return view('admin.contents.teklifler.teklifler-update', compact('teklifler', 'user', 'hizmetlerkategori', 'hizmetler', 'cariler', 'tekliflerdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teklifler = Teklifler::find($id);

        if (!$teklifler) {
            return redirect('teklifler')->with('error', 'Teklif bulunamadı.');
        }



        // **Eski verileri al**
        $eskiVeriler = $teklifler->getOriginal();

        // **Teklifin yeni revizyonunu oluştur**
        $eskiTeklif = $teklifler->replicate(); // Teklif kopyalanır
        $teklif_kodu = $teklifler->teklif_kodu;
        $teklif_kodu_text = $teklifler->teklif_kodu_text;

        if (preg_match('/ÇT-\d+-REV(\d+)/', $teklif_kodu_text, $matches)) {
            $currentRev = (int) $matches[1];
            $newRev = $currentRev + 1;
        } else {
            $newRev = 1;
        }

        $eskiTeklif->teklif_kodu = $teklif_kodu;
        $eskiTeklif->teklif_kodu_text = 'ÇT-' . $teklif_kodu . '-REV' . $newRev;
        $eskiTeklif->islem_yapan = Auth::user()->id;
        $eskiTeklif->islem_tarihi = Carbon::now();
        $eskiTeklif->teklif_tarihi = $request->teklif_tarihi;
        $eskiTeklif->cari_id = $request->cari_id;
        $eskiTeklif->user_id = $request->user_id;
        $eskiTeklif->tescil_tl = $request->tescil_tl;
        $eskiTeklif->teklif_konu = $request->teklif_konu;
        $eskiTeklif->teklif_aciklama = $request->teklif_aciklama;
        $eskiTeklif->aciklama = $request->aciklama;
        $eskiTeklif->teklif_iskonto_toplam = $request->teklif_iskonto_toplam;
        $eskiTeklif->teklif_kdv_toplam = $request->teklif_kdv_toplam;
        $eskiTeklif->teklif_ara_toplam = $request->teklif_ara_toplam;
        $eskiTeklif->teklif_kdvli_toplam = $request->teklif_kdvli_toplam;
        $eskiTeklif->save();

        // **Eski teklif detaylarını sil**
        Tekliflerdata::where('teklif_id', $teklifler->id)->delete();

        // **Yeni teklif detaylarını kaydet**
        $inputs = $request->input('inputs');
        foreach ($inputs as $input) {
            $tekliflerdata = new Tekliflerdata();
            $tekliflerdata->teklif_id = $eskiTeklif->id;
            $tekliflerdata->hizmetlerkategori_id = $input['hizmetlerkategori_id'];
            $tekliflerdata->hizmet_id = $input['hizmet_id'];
            $tekliflerdata->satir_aciklama = $input['satir_aciklama'];
            $tekliflerdata->teklif_hizmet_miktar = $input['teklif_hizmet_miktar'];
            $tekliflerdata->teklif_hizmet_birim = $input['teklif_hizmet_birim'];
            $tekliflerdata->hizmet_maliyet = $input['hizmet_maliyet'];
            $tekliflerdata->maliyet_toplam_fiyat = $input['maliyet_toplam_fiyat'];
            $tekliflerdata->teklif_fiyat = $input['teklif_fiyat'];
            $tekliflerdata->teklif_kdv_oran = $input['teklif_kdv_oran'];
            $tekliflerdata->teklif_kdv_tutar = $input['teklif_kdv_tutar'];
            $tekliflerdata->teklif_kdvsiz_fiyat = $input['teklif_kdvsiz_fiyat'];
            $tekliflerdata->teklif_iskonto = $input['teklif_iskonto'];
            $tekliflerdata->teklif_toplam_fiyat = $input['teklif_toplam_fiyat'];
            $tekliflerdata->save();
        }

// **Değişen alanları belirle ve log kaydı oluştur**
$degisenAlanlar = [];
foreach ($eskiVeriler as $alan => $eskiDeger) {
    if (isset($eskiTeklif->$alan) && $eskiTeklif->$alan != $eskiDeger) {
        $degisenAlanlar[] = ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $eskiTeklif->$alan . '.';
    }
}

if (!empty($degisenAlanlar)) {
    // **Değişiklikleri tek bir metin olarak birleştir**
    $degisenAlanlarText = implode(' ', $degisenAlanlar);

    Aktiflog::create([
        'islem_tarihi' => Carbon::now(),
        'islemiyapan_id' => Auth::user()->id,
        'islem' => $teklifler->firmaadi->firma_unvan . ' Carisinin teklifi güncellendi.',
        'guncellenmis_islem' => $teklifler->firmaadi->firma_unvan . ' Carisine teklif güncellendi. Değişiklikler: ' . $degisenAlanlarText,
    ]);
}



        return redirect('teklifler')->with('success', 'Güncelleme Başarılı');
    }

    /**
     * Yeni teklif kodu oluşturma fonksiyonu
     */
    private function generateTeklifKodu($currentCode)
    {
        // Eğer mevcut kod boşsa, başlangıç olarak "ÇT-1" döner
        if (!$currentCode) {
            return 'ÇT-1';
        }

        // Kod formatı: ÇT-1-REV1
        preg_match('/^(ÇT-\d+)(?:-REV(\d+))?$/', $currentCode, $matches);
        if ($matches) {
            $mainCode = $matches[1]; // Ana kod (ÇT-1)
            $revisionNumber = isset($matches[2]) ? (int) $matches[2] + 1 : 1; // Revizyon numarasını artır
            return $mainCode . '-REV' . $revisionNumber; // Yeni teklif kodu
        }

        // Format hatalıysa varsayılan bir kod döner
        return 'ÇT-1';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teklifler = Teklifler::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $teklifler->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' .$teklifler->teklif_kodu_text.'-'.$teklifler->teklif_kodu. ' kodlu'. $teklifler->teklif_kdvli_toplam . ' ' . ' ₺ Teklifi Silindi. ';
        $log->save();

        foreach ($teklifler->tekliflerdata as $data) {
            // dd($data);
            $data->delete(); // Her bir ilişkiyi tek tek sil
        }
        if ($teklifler->satis_durum == '1') {
            return redirect('teklifler')->with('error', 'Bu teklif satışa aktarıldığı için silinemez.');
        }


        $teklifler->delete();
        return redirect('teklifler')->with('success', 'Silme Başarılı');
    }


}
