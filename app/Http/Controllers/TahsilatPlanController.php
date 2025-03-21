<?php

namespace App\Http\Controllers;

use App\Models\Tahsilatplan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TahsilatPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        $tahsilatplan = Tahsilatplan::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $tahsilatplan->currentPage();
        $startNumber = $tahsilatplan->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.tahsilatplan.tahsilatplan',compact('tahsilatplan','user','startNumber','perPage'));
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
        $tahsilatplan = new Tahsilatplan();
        $tahsilatplan -> islem_yapan = Auth::user()->id;
        $tahsilatplan -> islem_tarihi = Carbon::now();
        $tahsilatplan -> cari_id = $request -> cari_id;
        $tahsilatplan -> tarih = $request -> tarih;
        $tahsilatplan -> vade_tarih = $request -> vade_tarih;
        $tahsilatplan -> tahsilat_tutar = $request -> tahsilat_tutar;
        $tahsilatplan -> durum = $request -> durum;
        $tahsilatplan -> aciklama = $request -> aciklama;
        $tahsilatplan -> save();

        return redirect('tahsilatplan')->with('success','Ekleme Başarılı');
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
        $tahsilatplan = Tahsilatplan::find($id);
        $tahsilatplan -> islem_yapan = Auth::user()->id;
        $tahsilatplan -> islem_tarihi = Carbon::now();
        $tahsilatplan -> cari_id = $request -> cari_id;
        $tahsilatplan -> tarih = $request -> tarih;
        $tahsilatplan -> vade_tarih = $request -> vade_tarih;
        $tahsilatplan -> tahsilat_tutar = $request -> tahsilat_tutar;
        $tahsilatplan -> durum = $request -> durum;
        $tahsilatplan -> aciklama = $request -> aciklama;
        $tahsilatplan -> save();

        return redirect('tahsilatplan')->with('success','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahsilatplan = Tahsilatplan::find($id);
        $tahsilatplan -> delete();
        return redirect('tahsilatplan')->with('success','Silme Başarılı');

    }
}
