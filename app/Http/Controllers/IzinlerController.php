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

class IzinlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $izinler = Izinler::all();
        $user = User::all();
        $personel = Personel::all();
        return view('admin.contents.izinler.izinler',compact('personel','izinler','user'));
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
        $izinler = new Izinler();
        $izinler->islem_yapan = Auth::user()->id;
        $izinler->islem_tarihi = Carbon::now();
        $izinler->personel_id = $request->personel_id;
        $izinler->baslangic_tarihi = $request->baslangic_tarihi;
        $izinler->bitis_tarihi = $request->bitis_tarihi;
        $izinler->izin_gun = $request->izin_gun;
        $izinler->izin_turu = $request->izin_turu;
        $izinler->izin_aciklama = $request->izin_aciklama;
        $izinler->save();



        return redirect('izinler')->with('success','Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $izinler = Izinler::find($id);
        return view('admin.contents.izinler.izinler-show',compact('izinler'));
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
        $izinler = Izinler::find($id);
        $izinler -> delete();
        return redirect('izinler')->with('success','Silme Başarılı');

    }
}
