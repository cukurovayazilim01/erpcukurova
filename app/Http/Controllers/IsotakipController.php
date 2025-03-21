<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Isotakip;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IsotakipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function isotakipfiltre(Request $request)
    {
        $perPage = $request->input('entries', 20);
        $currentPage = $request->input('page', 1);

        $cari_id = $request->input('cari_id_3');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $satis_temsilcisi = $request->input('satis_temsilcisi');
        $sehir = $request->input('sehir');
        $akreditasyon_kurulusu = $request->input('akreditasyon_kurulusu');
        $hizmet_adi = $request->input('hizmet_adi');
        $belgelendirme_kurulusu = $request->input('belgelendirme_kurulusu');
        $islem_tarihi = Carbon::now();
        $user = User::all();


        $query = Isotakip::query();

        if ($cari_id) {
            $query->where('cari_id', $cari_id);
        }
        if ($satis_temsilcisi) {
            $query->where('satis_temsilcisi', $satis_temsilcisi);
        }
        if ($akreditasyon_kurulusu) {
            $query->where('akreditasyon_kurulusu', $akreditasyon_kurulusu);
        }
        if ($hizmet_adi) {
            $query->where('hizmet_adi', $hizmet_adi);
        }
        if ($belgelendirme_kurulusu) {
            $query->where('belgelendirme_kurulusu', $belgelendirme_kurulusu);
        }
        if ($sehir) {
            $query->where('il', $sehir);
        }

        if ($ilk_tarih || $son_tarih) {
            $baslangic = $ilk_tarih ? Carbon::parse($ilk_tarih)->startOfDay() : null;
            $son = $son_tarih ? Carbon::parse($son_tarih)->endOfDay() : null;

            if ($baslangic && $son) {
                $query->whereBetween('basvuru_tarihi', [$baslangic, $son]);
            } elseif ($baslangic) {
                $query->where('basvuru_tarihi', '>=', $baslangic);
            } elseif ($son) {
                $query->where('basvuru_tarihi', '<=', $son);
            }
        } else {
            $query->whereNotNull('basvuru_tarihi');
        }

        // Sayfalama ve veri çekme
        $isotakip = $query->paginate($perPage);

        // Sayfa ve sıralama başlangıç numarasını hesapla
        $startNumber = $isotakip->total() - (($currentPage - 1) * $perPage);

        return view('admin.contents.isotakip.isotakip-filtre', compact('belgelendirme_kurulusu','hizmet_adi','akreditasyon_kurulusu','perPage','isotakip','ilk_tarih','son_tarih','islem_tarihi','cari_id','startNumber','user','sehir'));
    }

     public function isotakipsearch(Request $request)
     {
         $isotakipsearch = $request->input('isotakipsearch');

         // Eğer arama yapılmışsa
         if ($isotakipsearch) {
             $isotakip = Isotakip::orderByDesc('id')
                 ->whereHas('firmaadi',function($query) use ($isotakipsearch) {
                     $query->where('firma_unvan', 'like', '%' . $isotakipsearch . '%');
                 })
                 ->paginate(50);

             // Sayfa numarasını hesapla
             $page = $request->query('page', 1);
             $perPage = 50;
             $startNumber = $isotakip->total() - (($page - 1) * $perPage);

             $user = User::all();

             // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
             if ($request->ajax()) {
                 return view('admin.contents.isotakip.isotakip-search', compact('isotakip', 'startNumber', 'user'));
             }

             // Normal sayfa için arama sonucu döndür
             return view('admin.contents.isotakip.isotakip', compact('isotakip', 'startNumber', 'user'));
         }

         // Arama yapılmamışsa ana sayfayı döndür
         return view('admin.contents.isotakip.isotakip');
     }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        $isotakip = Isotakip::orderByDesc('id')->paginate($perPage);
        $page = $isotakip->currentPage();
        $startNumber = $isotakip->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.isotakip.isotakip',compact('isotakip', 'startNumber', 'user', 'perPage'));
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

        // Hizmetler array'ini al
        $inputs = $request->input('inputs');

        // Hizmetlere göre yeni kayıtları ekleyelim
        foreach ($inputs as $input) {
            // Her bir hizmet için yeni bir Isotakip kaydı oluşturuluyor
            $isotakip = new Isotakip();
            $isotakip -> islem_yapan = Auth::user()->id;
            $isotakip -> islem_tarihi = Carbon::now();
            $isotakip->cari_id = $request->cari_id;
            $isotakip->musteri_temsilcisi = $request->musteri_temsilcisi;
            $isotakip->satis_temsilcisi = $request->satis_temsilcisi;
            $isotakip->il = $request->il;
            $isotakip->basvuru_tarihi = $request->basvuru_tarihi;
            $isotakip->belge_tarihi = $request->belge_tarihi;
            $isotakip->belge_bitis_tarihi = $request->belge_bitis_tarihi;
            $isotakip->ara_denetim_tarihi = $request->ara_denetim_tarihi;
            $isotakip->basvuru_referans_no = $request->basvuru_referans_no;
            $isotakip->hizmet_turu = $request->hizmet_turu;
            $isotakip->akreditasyon_kurulusu = $request->akreditasyon_kurulusu;
            $isotakip->belgelendirme_kurulusu = $request->belgelendirme_kurulusu;
            $isotakip->kapsam = $request->kapsam;
            $isotakip->yenileme_durumu = 'Aktif';

            // Her bir hizmet için hizmet adını kaydediyoruz
            $isotakip->hizmet_adi = $input['hizmet_adi'];

            // Veritabanına kaydediyoruz
            $isotakip->save();
        }

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $isotakip->firmaadi->firma_unvan . ' ' . 'Carisine iso belgesi kaydı eklendi' ;
        $log->save();

        return redirect('isotakipp')->with('success', 'Ekleme Başarılı');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $isotakip = Isotakip::find($id);

        $eskiVeriler = $isotakip->getOriginal();

        $isotakip -> islem_yapan = Auth::user()->id;
        $isotakip -> islem_tarihi = Carbon::now();
        $isotakip->cari_id = $request->cari_id;
        $isotakip->musteri_temsilcisi = $request->musteri_temsilcisi;
        $isotakip->satis_temsilcisi = $request->satis_temsilcisi;
        $isotakip->il = $request->il;
        $isotakip->basvuru_tarihi = $request->basvuru_tarihi;
        $isotakip->belge_tarihi = $request->belge_tarihi;
        $isotakip->belge_bitis_tarihi = $request->belge_bitis_tarihi;
        $isotakip->ara_denetim_tarihi = $request->ara_denetim_tarihi;
        $isotakip->basvuru_referans_no = $request->basvuru_referans_no;
        $isotakip->hizmet_turu = $request->hizmet_turu;
        $isotakip->akreditasyon_kurulusu = $request->akreditasyon_kurulusu;
        $isotakip->belgelendirme_kurulusu = $request->belgelendirme_kurulusu;
        $isotakip->kapsam = $request->kapsam;
        $isotakip->hizmet_adi = $request->hizmet_adi;
        $isotakip->yenileme_durumu = $request->yenileme_durumu;

        if ($request->hasFile('belge')) {
            $fileExtension = $request->belge->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $isotakip->firmaadi->firma_unvan) . '.' . $fileExtension;
            $request->belge->move(public_path('/isotakip'), $imageName);
            $isotakip->belge = '/isotakip/' . $imageName;
        }

        $isotakip -> save();

        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            if (isset($isotakip->$alan) && $isotakip->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $isotakip->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // Değişiklikleri HTML formatında birleştir
            $degisenAlanlarText = '<br><ul>' . implode(' ', $degisenAlanlar) . '</ul>';

            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $isotakip->firmaadi->firma_unvan . ' Carisinin'. ' '. $isotakip->basvuru_referans_no.' '. 'nolu iso belgesi güncellendi.',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }
        return redirect('isotakipp')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isotakip = Isotakip::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $isotakip->firmaadi->firma_unvan . ' ' . 'Carisine kayıtlı olan iso belgesi kaydı Silindi' ;
        $log->save();
        $isotakip -> delete();
        return redirect('isotakipp')->with('success','Silme Başarılı');
    }
}
