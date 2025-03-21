<?php

namespace App\Http\Controllers;

use App\Models\Yillikizinhakki;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class YillikizinhakkiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIzinHakki(Request $request)
    {
        $personel_id = $request->personel_id;
        $yili = $request->yili;

        // İlgili personelin ve yılın izin hakkını getiriyoruz
        $izinHakki = Yillikizinhakki::where('personel_id', $personel_id)
            ->where('yili', $yili)
            ->first();

        if ($izinHakki) {
            return response()->json([
                'yillik_izin_hakki' => $izinHakki->yillik_izin_hakki,
                'kalan_izin_hakki' => $izinHakki->kalan_izin_hakki
            ]);
        } else {
            return response()->json([
                'yillik_izin_hakki' => '',
                'kalan_izin_hakki' => ''
            ]);
        }
    }

    public function izinhakkipost(Request $request)
    {
        // Aynı personel_id ve yili ile kayıt var mı kontrol et
        $existingRecord = Yillikizinhakki::where('personel_id', $request->personel_id)
            ->where('yili', $request->yili)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Bu personel için bu yılda zaten kayıt mevcut!');
        }

        // Yeni kayıt oluştur
        $yillikizinhakki = new Yillikizinhakki();
        $yillikizinhakki->islem_yapan = Auth::user()->id;
        $yillikizinhakki->islem_tarihi = Carbon::now();
        $yillikizinhakki->personel_id = $request->personel_id;
        $yillikizinhakki->yillik_izin_hakki = $request->yillik_izin_hakki;
        $yillikizinhakki->kalan_izin_hakki = $request->kalan_izin_hakki;
        $yillikizinhakki->yili = $request->yili;
        $yillikizinhakki->durum = $request->durum;
        $yillikizinhakki->save();

        return redirect('yillikizin')->with('success', 'Ekleme Başarılı');
    }
    public function index()
    {

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
