<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Gorevler;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GorevlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gorevler = Gorevler::all();
        $user = User::all();
        return view('admin.contents.gorevler.gorevler', compact('gorevler', 'user'));
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
        $gorevler = new Gorevler();
        $gorevler->islem_yapan = Auth::user()->id;
        $gorevler->islem_tarihi = Carbon::now();
        $gorevler->gorevlendirilen_id = $request->gorevlendirilen_id;
        $gorevler->cari_id = $request->cari_id;
        $gorevler->gorev_baslama_tarihi = $request->gorev_baslama_tarihi;
        $gorevler->gorev_bitis_tarihi = $request->gorev_bitis_tarihi;
        $gorevler->gorev_adi = $request->gorev_adi;
        $gorevler->gorev_tanimi = $request->gorev_tanimi;
        $gorevler->gorev_derecesi = $request->gorev_derecesi;
        $gorevler->gorev_durumu = $request->gorev_durumu;

        $gorevler->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $gorevler->gorevlendirilen->ad_soyad . ' ' . 'Kişine görev eklendi';
        $log->save();
        return redirect('gorevatama')->with('success', 'Ekleme Başarılı');
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
        $gorevler = Gorevler::find($id);

        $eskiVeriler = $gorevler->getOriginal();

        $gorevler->islem_tarihi = Carbon::now();
        $gorevler->gorevlendirilen_id = $request->gorevlendirilen_id;
        $gorevler->cari_id = $request->cari_id;
        $gorevler->gorev_baslama_tarihi = $request->gorev_baslama_tarihi;
        $gorevler->gorev_bitis_tarihi = $request->gorev_bitis_tarihi;
        $gorevler->gorev_adi = $request->gorev_adi;
        $gorevler->gorev_tanimi = $request->gorev_tanimi;
        $gorevler->gorev_derecesi = $request->gorev_derecesi;
        $gorevler->gorev_durumu = $request->gorev_durumu;
        $gorevler->aciklama = $request->aciklama;

        if ($gorevler->gorev_durumu == 'Yapıldı') {
            $gorevler->gorev_bitirme_tarihi = Carbon::now();
        } elseif ($gorevler->gorev_durumu == 'Yapılmadı' || $gorevler->gorev_durumu == 'Beklemede') {
            $gorevler->gorev_bitirme_tarihi = null;
        }

        // Eğer görev bitiş tarihi şu anki tarihten küçükse, görev durumu otomatik olarak 'Yapılmadı' olacak
        if (Carbon::parse($gorevler->gorev_bitis_tarihi)->lt(Carbon::now())) {
            $gorevler->gorev_durumu = 'Yapılmadı';
        }

        $gorevler->save();

        // **Değişen alanları belirle ve log kaydı oluştur**
        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            if (isset($gorevler->$alan) && $gorevler->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $gorevler->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // Değişiklikleri HTML formatında birleştir
            $degisenAlanlarText = '<br><ul>' . implode(' ', $degisenAlanlar) . '</ul>';

            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $gorevler->gorevlendirilen->ad_soyad . ' Kişisine verilen görev güncellendi',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }

        return redirect('gorevatama')->with('success', 'Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gorevler = Gorevler::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $gorevler->gorevlendirilen->ad_soyad . ' Kişisine verilen görev Silindi' ;
        $log->save();
        $gorevler->delete();
        return redirect('gorevatama')->with('success', 'Silme Başarılı');
    }
}
