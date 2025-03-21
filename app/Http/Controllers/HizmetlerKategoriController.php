<?php

namespace App\Http\Controllers;

use App\Models\Hizmetlerkategori;
use App\Models\User;
use Illuminate\Http\Request;

class HizmetlerKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hizmetlerkategori = Hizmetlerkategori::all();
        $user = User::all();
        return view('admin.contents.hizmetler.hizmetlerkategori.hizmetlerkategori',compact('hizmetlerkategori','user'));
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
        $hizmetlerkategori = new Hizmetlerkategori();
        $hizmetlerkategori -> kategori_ad = $request -> kategori_ad;
        $hizmetlerkategori -> durum = $request -> durum;
        $hizmetlerkategori -> teklife_ekle = $request -> teklife_ekle;

        $hizmetlerkategori ->save();
        return redirect('hizmetlerkategori')->with('success','Ekleme Başarılı');
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
        $hizmetlerkategori = Hizmetlerkategori::find($id);
        $hizmetlerkategori -> kategori_ad = $request -> kategori_ad;
        $hizmetlerkategori -> durum = $request -> durum;
        $hizmetlerkategori -> teklife_ekle = $request -> teklife_ekle;

        $hizmetlerkategori ->save();
        return redirect('hizmetlerkategori')->with('success','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hizmetlerkategori = Hizmetlerkategori::find($id);
        if ($hizmetlerkategori->tekliflerdata()->count() > 0) {
            return redirect('hizmetlerkategori')->with('error', 'Bu kategoriye ait teklif olduğu için silinemez.');
        }
        if ($hizmetlerkategori->satislardata()->count() > 0) {
            return redirect('hizmetlerkategori')->with('error', 'Bu kategoriye ait satış faturası olduğu için silinemez.');
        }
        $hizmetlerkategori -> delete();
        return redirect('hizmetlerkategori')->with('success','Silme Başarılı');

    }
}
