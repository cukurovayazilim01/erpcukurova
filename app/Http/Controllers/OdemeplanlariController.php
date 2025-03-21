<?php

namespace App\Http\Controllers;

use App\Models\Odemeplanlari;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OdemeplanlariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        $odemeplanlari = Odemeplanlari::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $odemeplanlari->currentPage();
        $startNumber = $odemeplanlari->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.odemeplanlari.odemeplanlari',compact('odemeplanlari','user','startNumber','perPage'));
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
        $odemeplanlari = new Odemeplanlari();
        $odemeplanlari -> islem_yapan = Auth::user()->id;
        $odemeplanlari -> islem_tarihi = Carbon::now();
        $odemeplanlari -> cari_id = $request -> cari_id;
        $odemeplanlari -> tarih = $request -> tarih;
        $odemeplanlari -> vade_tarih = $request -> vade_tarih;
        $odemeplanlari -> odeme_tutar = $request -> odeme_tutar;
        $odemeplanlari -> durum = $request -> durum;
        $odemeplanlari -> aciklama = $request -> aciklama;
        $odemeplanlari -> save();

        return redirect('odemeplanlari')->with('success','Ekleme Başarılı');
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
        $odemeplanlari = Odemeplanlari::find($id);
        $odemeplanlari -> islem_yapan = Auth::user()->id;
        $odemeplanlari -> islem_tarihi = Carbon::now();
        $odemeplanlari -> cari_id = $request -> cari_id;
        $odemeplanlari -> tarih = $request -> tarih;
        $odemeplanlari -> vade_tarih = $request -> vade_tarih;
        $odemeplanlari -> odeme_tutar = $request -> odeme_tutar;
        $odemeplanlari -> durum = $request -> durum;
        $odemeplanlari -> aciklama = $request -> aciklama;
        $odemeplanlari -> save();

        return redirect('odemeplanlari')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $odemeplanlari = Odemeplanlari::find($id);
        $odemeplanlari -> delete();
        return redirect('odemeplanlari')->with('success','Silme Başarılı');
    }
}
