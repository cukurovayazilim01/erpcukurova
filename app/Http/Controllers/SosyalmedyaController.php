<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use App\Models\Sosyalmedya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SosyalmedyaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sosyalmedya = Sosyalmedya::all();
        return view("admin.contents.sosyalmedya.sosyalmedya", compact("sosyalmedya"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.contents.sosyalmedya.sosyalmedya-create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sosyalmedya = new Sosyalmedya();
        $sosyalmedya->islem_yapan   = Auth::user()->id;
        $sosyalmedya->islem_tarihi  = Carbon::now();
        $sosyalmedya->gonderi_tipi  = $request->gonderi_tipi;
        $sosyalmedya->gonderi_zamani = $request->gonderi_zamani;
        $sosyalmedya->gonderi_adi   = $request->gonderi_adi;
        $sosyalmedya->gonderi_yeri  = $request->gonderi_yeri;
        $sosyalmedya->gonderi_boyutu = $request->gonderi_boyutu;

        $resimYollar = [];

        if ($request->hasFile('resim')) {
            foreach ($request->file('resim') as $index => $resim) {
                $uzanti = $resim->getClientOriginalExtension();
                $dosyaAdi = str_replace(' ', '-', $sosyalmedya->gonderi_adi) . '-' . time() . '-' . $index . '.' . $uzanti;
                $resim->move(public_path('/sosyalmedyalarimiz/resim'), $dosyaAdi);
                $resimYollar[] = '/sosyalmedyalarimiz/resim/' . $dosyaAdi;
            }
        }

        $sosyalmedya->resim = json_encode($resimYollar);

        $sosyalmedya->save();
        return redirect()->route('sosyalmedya.index')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sosyalmedya = Sosyalmedya::find($id);
        return view('admin.contents.sosyalmedya.sosyalmedya-show', compact('sosyalmedya'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sosyalmedya = Sosyalmedya::find($id);
        return view('admin.contents.sosyalmedya.sosyalmedya-update', compact('sosyalmedya'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sosyalmedya = Sosyalmedya::findOrFail($id);

    // Diğer alanları güncelle
    $sosyalmedya->gonderi_tipi = $request->gonderi_tipi;
    $sosyalmedya->gonderi_zamani = $request->gonderi_zamani;
    $sosyalmedya->gonderi_adi = $request->gonderi_adi;
    $sosyalmedya->gonderi_yeri = $request->gonderi_yeri;
    $sosyalmedya->gonderi_boyutu = $request->gonderi_boyutu;

    $mevcutResimler = json_decode($sosyalmedya->resim, true) ?? [];

    // Silinmesi istenenleri kaldır
    if ($request->has('silinecek_resimler')) {
        foreach ($request->silinecek_resimler as $silinecek) {
            // Dosyayı da silelim (isteğe bağlı)
            if (file_exists(public_path($silinecek))) {
                unlink(public_path($silinecek));
            }
            $mevcutResimler = array_filter($mevcutResimler, function ($resim) use ($silinecek) {
                return $resim !== $silinecek;
            });
        }
    }

    // Yeni eklenen resimleri ekle
    if ($request->hasFile('resim')) {
        foreach ($request->file('resim') as $index => $resim) {
            $uzanti = $resim->getClientOriginalExtension();
            $dosyaAdi = str_replace(' ', '-', $sosyalmedya->gonderi_adi) . '-' . time() . '-' . $index . '.' . $uzanti;
            $resim->move(public_path('/sosyalmedyalarimiz/resim'), $dosyaAdi);
            $mevcutResimler[] = '/sosyalmedyalarimiz/resim/' . $dosyaAdi;
        }
    }

    $sosyalmedya->resim = json_encode(array_values($mevcutResimler)); // indexleri sıfırla
    $sosyalmedya->save();

    return redirect()->route('sosyalmedya.index')->with('success', 'Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sosyalmedya = Sosyalmedya::find($id);

        // Resimleri dosyadan sil
        if ($sosyalmedya->resim) {
            foreach (json_decode($sosyalmedya->resim) as $resim) {
                if (file_exists(public_path($resim))) {
                    unlink(public_path($resim));
                }
            }
        }

        $sosyalmedya->delete();

        return redirect()->route('sosyalmedya.index')->with('success', 'Silme başarılı');
    }
}
