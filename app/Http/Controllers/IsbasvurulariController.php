<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Isbasvurulari;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class IsbasvurulariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function isbasvurularilist()
    {
        $isbasvuru = Isbasvurulari::all();

        return view('admin.contents.isbasvurulari.isbasvurularilist',compact('isbasvuru'));
    }
    public function index()
    {
        $isbasvuru = Isbasvurulari::all();
        return view('admin.contents.isbasvurulari.isbasvurulari',compact('isbasvuru'));
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
        $isbasvuru = new Isbasvurulari();
        $isbasvuru -> islem_yapan = Auth::user()->id;
        $isbasvuru -> islem_tarihi = Carbon::now();
        $isbasvuru -> tarih = $request -> tarih;
        $isbasvuru -> ad_soyad = $request -> ad_soyad;
        $isbasvuru -> basvuru_pozisyon = $request -> basvuru_pozisyon;
        $isbasvuru -> telefon = $request -> telefon;
        $isbasvuru -> email = $request -> email;
        $isbasvuru -> mezuniyet = $request -> mezuniyet;
        $isbasvuru -> durum = $request -> durum;
        $isbasvuru -> gorusme_notu = $request -> gorusme_notu;
        if ($request->hasFile('dosya')) {
            $fileExtension = $request->dosya->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $isbasvuru->ad_soyad) . '.' . $fileExtension;
            $request->dosya->move(public_path('/isbasvuruevrak'), $imageName);
            $isbasvuru->dosya = '/isbasvuruevrak/' . $imageName;
        }
        $isbasvuru -> save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $isbasvuru->ad_soyad . ' ' .$isbasvuru -> tarih. ' tarihinde iş başvurusu kaydı eklendi';
        $log->save();
        return redirect('isbasvurulari')->with('success','Ekleme Başarılı');
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
        $isbasvuru = Isbasvurulari::find($id);

        $eskiVeriler = $isbasvuru->getOriginal();

        $isbasvuru -> islem_yapan = Auth::user()->id;
        $isbasvuru -> islem_tarihi = Carbon::now();
        $isbasvuru -> tarih = $request -> tarih;
        $isbasvuru -> ad_soyad = $request -> ad_soyad;
        $isbasvuru -> basvuru_pozisyon = $request -> basvuru_pozisyon;
        $isbasvuru -> telefon = $request -> telefon;
        $isbasvuru -> email = $request -> email;
        $isbasvuru -> mezuniyet = $request -> mezuniyet;
        $isbasvuru -> durum = $request -> durum;
        $isbasvuru -> gorusme_notu = $request -> gorusme_notu;
        if ($request->hasFile('dosya')) {
            $fileExtension = $request->dosya->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $isbasvuru->ad_soyad) . '.' . $fileExtension;
            $request->dosya->move(public_path('/isbasvuruevrak'), $imageName);
            $isbasvuru->dosya = '/isbasvuruevrak/' . $imageName;
        }
        $isbasvuru -> save();

        // **Değişen alanları belirle ve log kaydı oluştur**
        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            if (isset($isbasvuru->$alan) && $isbasvuru->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $isbasvuru->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // Değişiklikleri HTML formatında birleştir
            $degisenAlanlarText = '<br><ul>' . implode(' ', $degisenAlanlar) . '</ul>';

            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $isbasvuru->ad_soyad . ' ' .$isbasvuru -> tarih. ' tarihinde iş başvurusu kaydı Güncellendi.',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }
        return redirect('isbasvurulari')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isbasvuru = Isbasvurulari::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $isbasvuru->ad_soyad . ' ' .$isbasvuru -> tarih. ' tarihinde iş başvurusu kaydı Silindi';
        $log->save();
        $isbasvuru -> delete();
        return redirect('isbasvurulari')->with('success','Silme Başarılı');
    }
}
