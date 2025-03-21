<?php

namespace App\Http\Controllers;

use App\Models\Izinler;
use App\Models\Personel;
use App\Models\User;
use App\Models\Yillikizin;
use App\Models\Yillikizinhakki;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class YillikizinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function yillikizinhakkilist()
    {
        $yillikizin = Yillikizin::all();
        $user = User::all();
        $personel = Personel::all();
        $yillikizinhakki = Yillikizinhakki::all();
        return view('admin.contents.yillikizin.yillikizinhakkilist',compact('personel','yillikizin','user','yillikizinhakki'));
    }
    public function index()
    {
        $yillikizin = Yillikizin::all();
        $user = User::all();
        $personel = Personel::all();
        $yillikizinhakki = YillikIzinHakki::where('yili', date('Y'))->get();

        return view('admin.contents.yillikizin.yillikizin',compact('personel','yillikizin','user','yillikizinhakki'));
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
        $yillikizin = new Yillikizin();
        $yillikizin->islem_yapan = Auth::user()->id;
        $yillikizin->islem_tarihi = Carbon::now();
        $yillikizin->personel_id = $request->personel_id;
        $yillikizin->yillik_izin_hakki = $request->yillik_izin_hakki;
        $yillikizin->kalan_izin_hakki = $request->kalan_izin_hakki;
        $yillikizin->yili = $request->yili;
        $yillikizin->baslangic_tarihi = $request->baslangic_tarihi;
        $yillikizin->bitis_tarihi = $request->bitis_tarihi;
        $yillikizin->izin_gun = $request->izin_gun;
        $yillikizin->hangi_ay = $request->hangi_ay;
        $yillikizin->gecirilecek_adres = $request->gecirilecek_adres;
        $yillikizin->izin_aciklama = $request->izin_aciklama;
        $yillikizin->save();
        $yillikizinhakki = Yillikizinhakki::where('personel_id', $yillikizin->personel_id)
                                  ->where('yili', $yillikizin->yili)
                                  ->first();
        $yillikizinhakki -> kalan_izin_hakki = $yillikizinhakki -> kalan_izin_hakki - $yillikizin->izin_gun;
        $yillikizinhakki -> save();
        return redirect('yillikizin')->with('success','Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $izinler = Izinler::all();
        $user = User::all();
        $personel = Personel::all();
        $yillikizin = Yillikizin::all();
        $yillikizinhakki = Yillikizinhakki::all();
        return view('admin.contents.yillikizin.izinlerlist',compact('personel','yillikizinhakki','yillikizin','user','izinler'));
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
        $yillikizin = Yillikizin::find($id);
        $yillikizin->islem_yapan = Auth::user()->id;
        $yillikizin->islem_tarihi = Carbon::now();
        $yillikizin->personel_id = $request->personel_id;
        $yillikizin->baslangic_tarihi = $request->baslangic_tarihi;
        $yillikizin->bitis_tarihi = $request->bitis_tarihi;
        $yillikizin->izin_gun = $request->izin_gun;
        $yillikizin->hangi_ay = $request->hangi_ay;
        $yillikizin->izin_hakki = $request->izin_hakki;
        $yillikizin->izin_aciklama = $request->izin_aciklama;
        $yillikizin->save();
        return redirect('yillikizin')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $yillikizin = Yillikizin::find($id);
        $yillikizin->delete();
        return redirect('yillikizin')->with('success','Silme Başarılı');
    }
}
