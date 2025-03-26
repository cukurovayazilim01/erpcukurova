<?php

namespace App\Http\Controllers;

use App\Models\Giderkategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GiderKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $giderkategori = Giderkategori::all();
        $user = User::all();
        return view('admin.contents.giderler.giderkategori.giderkategori',compact('giderkategori','user'));
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
        $giderkategori = new Giderkategori();
        $giderkategori -> islem_yapan = Auth::user()->id;
        $giderkategori -> islem_tarihi = Carbon::now();
        $giderkategori -> gider_kategori_kodu = $request -> gider_kategori_kodu;
        $giderkategori -> gider_kategori_adi = $request -> gider_kategori_adi;
        $giderkategori -> durum = $request -> durum;

        $giderkategori -> save();
        return redirect('giderkategori')->with('success','Ekleme Başarılı');
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
        $giderkategori = Giderkategori::find($id);
        $giderkategori -> islem_yapan = Auth::user()->id;
        $giderkategori -> islem_tarihi = Carbon::now();
        $giderkategori -> gider_kategori_kodu = $request -> gider_kategori_kodu;
        $giderkategori -> gider_kategori_adi = $request -> gider_kategori_adi;
        $giderkategori -> durum = $request -> durum;

        $giderkategori -> save();
        return redirect('giderkategori')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $giderkategori = Giderkategori::find($id);
        if ($giderkategori->alislardata()->count() > 0) {
            return redirect('giderkategori')->with('error', 'Bu kategoriye ait alış faturası olduğu için silinemez.');
        }
        $giderkategori -> delete();
        return redirect('giderkategori')->with('success','Silme Başarılı');
    }
}
