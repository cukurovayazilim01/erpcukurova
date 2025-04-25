<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Alislar;
use App\Models\Alislardata;
use App\Models\Cariler;
use App\Models\Firmahrkt;
use App\Models\Gider;
use App\Models\Giderkategori;
use App\Models\Odemeler;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlislarController extends Controller
{
    public function odemeyeaktar()
    {
        try {
            $alislar = Alislar::all();

            if ($alislar->isEmpty()) {
                return redirect()->route('alislar.index')->with('warning', 'Aktarılacak alış kaydı bulunamadı.');
            }

            $odemelerListesi = [];

            foreach ($alislar as $alis) {
                // toplam_tutar boşsa atla
                if (is_null($alis->toplam_tutar)) continue;

                $odemelerListesi[] = [
                    'tarih'          => $alis->fis_tarihi,
                    'odeme_kodu'     => $alis->alis_kodu,
                    'odeme_kodu_text'=> 'OF',
                    'odeme_turu'     => 'EFT',
                    'odeme_tipi'     => 'Banka',
                    'cari_id'        => $alis->cari_id,
                    'odemeyapan_id'  => Auth::id(),
                    'banka_id'       => 1,
                    'odeme_tutar'    => $alis->toplam_tutar,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }

            if (!empty($odemelerListesi)) {
                Odemeler::insert($odemelerListesi);
            }

            return redirect()->route('alislar.index')->with('success', 'Tüm alışlar ödemelere başarıyla aktarıldı.');

        } catch (\Exception $e) {
            return redirect()->route('alislar.index')->with('error', 'Aktarım sırasında hata oluştu: ' . $e->getMessage());
        }
    }


    public function firmahrktaktaralislar()
    {
        $alislar = Alislar::all(); // Tüm satışları al

        foreach ($alislar as $alis) {
            $firmahrkt = new Firmahrkt();
            $firmahrkt->tarih = Carbon::now();
            $firmahrkt->islem_tarihi = $alis->fis_tarihi;
            $firmahrkt->islem_yapan = Auth::user()->id;
            $firmahrkt->cari_id = $alis->cari_id;
            $firmahrkt->islem = 'Alış';
            $firmahrkt->alis_id = $alis->id;
            $firmahrkt->alacak = $alis->toplam_tutar;
            $firmahrkt->save();
        }

        return redirect('alislar')->with('success', 'Tüm Alışlar Firma Hareketlerine Aktarıldı');
    }
    public function cariSearchalislar(Request $request)
    {
        $searchTerm = $request->get('q');  // Arama kelimesi

        $cariler = Cariler::where('firma_unvan', 'like', '%' . $searchTerm . '%')
            ->where('firma_tipi', 'Tedarikçi') // Sadece firma_tipi "Tedarikçi" olanları getir
            ->get();

        return response()->json($cariler);
    }

    public function alislarsearch(Request $request)
    {
        $alislarsearch = $request->input('alislarsearch');

        // Eğer arama yapılmışsa
        if ($alislarsearch) {
            $alislar = Alislar::orderByDesc('fis_tarihi')
                ->whereHas('firmaadi', function ($query) use ($alislarsearch) {
                    $query->where('firma_unvan', 'like', '%' . $alislarsearch . '%');
                })
                ->paginate(50);

            // Sayfa numarasını hesapla
            $page = $request->query('page', 1);
            $perPage = 50;
            $startNumber = $alislar->total() - (($page - 1) * $perPage);

            $user = User::all();

            // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
            if ($request->ajax()) {
                return view('admin.contents.alislar.alislar-search', compact('alislar', 'startNumber', 'user'));
            }

            // Normal sayfa için arama sonucu döndür
            return view('admin.contents.alislar.alislar', compact('alislar', 'startNumber', 'user'));
        }

        // Arama yapılmamışsa ana sayfayı döndür
        return view('admin.contents.alislar.alislar');
    }


    public function getGiderlerByKategori($id)
    {
        // Belirtilen kategoriye ait giderleri getir
        $giderler = Gider::where('giderkategori_id', $id)->get();
        // JSON formatında geri döndür
        return response()->json($giderler);
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // $cariler = Cariler::all();
        $alislar = Alislar::orderBy('fis_tarihi', 'desc')->paginate($perPage);
        $page = $alislar->currentPage();
        $startNumber = $alislar->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.alislar.alislar', compact('alislar', 'startNumber', 'perPage', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alislar = Alislar::all();
        $user = User::all();
        $gider = Gider::all();
        $giderkategori = Giderkategori::all();
        return view('admin.contents.alislar.alislar-create', compact('alislar', 'user', 'gider', 'giderkategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alislar_max_no = Alislar::max('alis_kodu');

        $alislar = new Alislar();
        $alislar->alis_kodu = empty($alislar_max_no) ? 1 : $alislar_max_no + 1;
        $alislar->alis_kodu_text = 'AF';
        $alislar->islem_yapan = Auth::user()->id;
        $alislar->islem_tarihi = Carbon::now();
        $alislar->fis_tarihi = $request->fis_tarihi;
        $alislar->fis_no = $request->fis_no;
        $alislar->doviz = $request->doviz;
        $alislar->cari_id = $request->cari_id;
        $alislar->aciklama = $request->aciklama;

        $alislar->toplam_ara_toplam = $request->toplam_ara_toplam;
        $alislar->toplam_iskonto = $request->toplam_iskonto;
        $alislar->indirimli_tutar = $request->indirimli_tutar;
        $alislar->toplam_kdv_tutar = $request->toplam_kdv_tutar;
        $alislar->toplam_tutar = $request->toplam_tutar;

        $alislar->save();


        $inputs = $request->input('inputs');

        foreach ($inputs as $input) {
            $alislardata = new Alislardata();
            $alislardata->alis_id = $alislar->id;
            $alislardata->giderkategori_id = $input['giderkategori_id'];
            $alislardata->gider_id = $input['gider_id'];
            $alislardata->gider_adi = $input['gider_adi'];
            $alislardata->miktar = $input['miktar'];
            $alislardata->birim = $input['birim'];
            $alislardata->ara_toplam = $input['ara_toplam'];
            $alislardata->birim_fiyat = $input['birim_fiyat'];
            $alislardata->iskonto = $input['iskonto'];
            $alislardata->kdv_oran = $input['kdv_oran'];
            $alislardata->kdv_tutar = $input['kdv_tutar'];
            $alislardata->tutar = $input['tutar'];

            $alislardata->save();
        }

        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $alislar->fis_tarihi;
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id = $alislar->cari_id;
        $firmahrkt->islem = 'Alış';
        $firmahrkt->alis_id = $alislar->id;
        $firmahrkt->alacak = $alislar->toplam_tutar;
        $firmahrkt->save();


        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $alislar->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $alislar->toplam_tutar . ' ₺ Alış Eklendi.';
        $log->save();
        return redirect('alislar')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alislar = Alislar::find($id);
        $alislardata = Alislardata::where('alis_id', $id)->get();
        return view('admin.contents.alislar.alislar-show', compact('alislar', 'alislardata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alislar = Alislar::find($id);
        $user = User::all();
        $giderkategori = Giderkategori::all();
        $gider = Gider::all();
        $cariler = Cariler::find($alislar->cari_id);
        $alislardata = Alislardata::where('alis_id', $id)->get();
        // dd($alislardata);
        return view('admin.contents.alislar.alislar-update', compact('alislar', 'user', 'giderkategori', 'gider', 'alislardata', 'cariler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alislar = Alislar::find($id);
        // **Eski verileri al**
        $eskiVeriler = $alislar->getOriginal();

        $input = $request->input('inputs.0');

        $alislar->islem_yapan = Auth::user()->id;
        $alislar->islem_tarihi = Carbon::now();
        $alislar->fis_tarihi = $request->fis_tarihi;
        $alislar->fis_no = $request->fis_no;
        $alislar->doviz = $request->doviz;
        $alislar->cari_id = $request->cari_id;
        $alislar->aciklama = $request->aciklama;

        $alislar->toplam_ara_toplam = $request->toplam_ara_toplam;
        $alislar->toplam_iskonto = $request->toplam_iskonto;
        $alislar->indirimli_tutar = $request->indirimli_tutar;
        $alislar->toplam_kdv_tutar = $request->toplam_kdv_tutar;
        $alislar->toplam_tutar = $request->toplam_tutar;
        $alislar->save();

        $alislardata = Alislardata::where('alis_id', $alislar->id)->get();
        foreach ($alislardata as $silinecekveriler) {
            $silinecekveriler->delete();
        }

        $inputs = $request->input('inputs');

        $olansatiralislardata = $alislar->alislardata;

        foreach ($inputs as $key => $input) {
            if ($key < $olansatiralislardata->count()) {
                // VAR OLAN SATIRI GĞNCELER
                $alislardata = $olansatiralislardata[$key];
                $alislardata->giderkategori_id = $input['giderkategori_id'];
                $alislardata->gider_id = $input['gider_id'];
                $alislardata->gider_adi = $input['gider_adi'];
                $alislardata->miktar = $input['miktar'];
                $alislardata->birim = $input['birim'];
                $alislardata->ara_toplam = $input['ara_toplam'];
                $alislardata->birim_fiyat = $input['birim_fiyat'];
                $alislardata->iskonto = $input['iskonto'];
                $alislardata->kdv_oran = $input['kdv_oran'];
                $alislardata->kdv_tutar = $input['kdv_tutar'];
                $alislardata->tutar = $input['tutar'];
                $alislardata->save();
            } else {
                // burasıda yeni satır için
                $alislardata = new Alislardata();
                $alislardata->alis_id = $alislar->id;
                $alislardata->giderkategori_id = $input['giderkategori_id'];
                $alislardata->gider_id = $input['gider_id'];
                $alislardata->gider_adi = $input['gider_adi'];
                $alislardata->miktar = $input['miktar'];
                $alislardata->birim = $input['birim'];
                $alislardata->ara_toplam = $input['ara_toplam'];
                $alislardata->birim_fiyat = $input['birim_fiyat'];
                $alislardata->iskonto = $input['iskonto'];
                $alislardata->kdv_oran = $input['kdv_oran'];
                $alislardata->kdv_tutar = $input['kdv_tutar'];
                $alislardata->tutar = $input['tutar'];
                $alislardata->save();
            }
        }


        $firmahrkt = Firmahrkt::where('alis_id', $alislar->id)->first();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $alislar->fis_tarihi;
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id = $alislar->cari_id;
        $firmahrkt->islem = 'Alış';
        $firmahrkt->alis_id = $alislar->id;
        $firmahrkt->alacak = $alislar->toplam_tutar;
        $firmahrkt->save();

        // **Değişen alanları belirle ve log kaydı oluştur**
        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            if (isset($alislar->$alan) && $alislar->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $alislar->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // Değişiklikleri HTML formatında birleştir
            $degisenAlanlarText = '<br><ul>' . implode(' ', $degisenAlanlar) . '</ul>';

            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $alislar->firmaadi->firma_unvan . ' Carisinin'. ' '. $alislar->alis_kodu_text.'-'. $alislar->alis_kodu . ' kodlu alışı güncellendi.',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }

        return redirect('alislar')->with('success', 'Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alislar = Alislar::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $alislar->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' . $alislar->alis_kodu_text . '-' . $alislar->alis_kodu . ' ' . 'kodlu' . ' ' . $alislar->toplam_tutar . ' ' . ' ₺ Alışı Silindi. ';
        $log->save();

        foreach ($alislar->alislardata as $data) {

            $data->delete(); // Her bir ilişkiyi tek tek sil
        }
        $firmahrkt = Firmahrkt::where('alis_id', $alislar->id)->first();
        $firmahrkt->delete();

        $alislar->delete();
        return redirect('alislar')->with('success', 'Silme Başarılı');
    }
}
