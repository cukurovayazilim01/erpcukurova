<?php

namespace App\Http\Controllers;

use App\Models\Kargotakip;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KargotakipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kargotakip = Kargotakip::all();
        $user = User::all();
        return view('admin.contents.kargotakip.kargotakip',compact('kargotakip','user'));
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
        $kargotakip = new Kargotakip();
        $kargotakip->islem_yapan = Auth::user()->id;
        $kargotakip->islem_tarihi = Carbon::now();
        $kargotakip->gonderen_ad = $request-> gonderen_ad;
        $kargotakip->gonderi_tipi = $request-> gonderi_tipi;
        $kargotakip->gonderi_tarihi = $request-> gonderi_tarihi;
        $kargotakip->kargo_takip_no = $request-> kargo_takip_no;
        $kargotakip->hangi_kargo = $request-> hangi_kargo;
        $kargotakip->aciklama = $request-> aciklama;
        $kargotakip->save();
        return redirect('kargotakip')->with('success','Ekleme Başarılı');
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
        $kargotakip = Kargotakip::find($id);
        $kargotakip->islem_yapan = Auth::user()->id;
        $kargotakip->islem_tarihi = Carbon::now();
        $kargotakip->gonderen_ad = $request-> gonderen_ad;
        $kargotakip->gonderi_tipi = $request-> gonderi_tipi;
        $kargotakip->gonderi_tarihi = $request-> gonderi_tarihi;
        $kargotakip->kargo_takip_no = $request-> kargo_takip_no;
        $kargotakip->hangi_kargo = $request-> hangi_kargo;
        $kargotakip->aciklama = $request-> aciklama;
        $kargotakip->kargoyu_alan = $request-> kargoyu_alan;
        $kargotakip->alinan_tarih = $request-> alinan_tarih;
        $kargotakip->kargo_durum = $request-> kargo_durum;
        $kargotakip->save();
        return redirect('kargotakip')->with('success','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kargotakip = Kargotakip::find($id);
        $kargotakip->delete();
        return redirect('kargotakip')->with('success','Silme Başarılı');
    }
}
