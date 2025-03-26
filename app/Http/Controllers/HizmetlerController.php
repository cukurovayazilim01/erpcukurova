<?php

namespace App\Http\Controllers;

use App\Models\Hizmetler;
use App\Models\Hizmetlerkategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HizmetlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $hizmetler = Hizmetler::all();
        $hizmetlerkategori = Hizmetlerkategori::where('durum','Aktif')->get();
        $user = User::all();
        return view('admin.contents.hizmetler.hizmetler',compact('hizmetler','hizmetlerkategori','user'));
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
        $hizmetler = new Hizmetler();
        $hizmetler -> islem_yapan = Auth::user()->id;
        $hizmetler -> islem_tarihi = Carbon::now();
        $hizmetler -> hizmetler_kategori_id = $request -> hizmetler_kategori_id;
        $hizmetler -> hizmet_ad = $request -> hizmet_ad;
        $hizmetler -> hizmet_maliyet = $request -> hizmet_maliyet;
        $hizmetler -> hizmet_satis_fiyati = $request -> hizmet_satis_fiyati;
        $hizmetler -> durum = $request -> durum;
        $hizmetler -> teklife_ekle = $request -> teklife_ekle;
        $hizmetler -> hizmet_aciklama = $request -> hizmet_aciklama;

        $hizmetler -> save();
        return redirect('hizmetler')->with('success','Ekleme Başarılı');
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
        $hizmetler = Hizmetler::find($id);

        $hizmetler -> islem_yapan = Auth::user()->id;
        $hizmetler -> islem_tarihi = Carbon::now();
        $hizmetler -> hizmetler_kategori_id = $request -> hizmetler_kategori_id;
        $hizmetler -> hizmet_ad = $request -> hizmet_ad;
        $hizmetler -> hizmet_maliyet = $request -> hizmet_maliyet;
        $hizmetler -> hizmet_satis_fiyati = $request -> hizmet_satis_fiyati;
        $hizmetler -> durum = $request -> durum;
        $hizmetler -> teklife_ekle = $request -> teklife_ekle;
        $hizmetler -> hizmet_aciklama = $request -> hizmet_aciklama;

        $hizmetler -> save();
        return redirect('hizmetler')->with('success','Ekleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hizmetler = Hizmetler::find($id);
        if ($hizmetler->tekliflerdata()->count() > 0) {
            return redirect('hizmetler')->with('error', 'Bu hizmete ait teklif olduğu için silinemez.');
        }
        if ($hizmetler->satislardata()->count() > 0) {
            return redirect('hizmetler')->with('error', 'Bu hizmete ait satış faturası olduğu için silinemez.');
        }
        $hizmetler -> delete();
        return redirect('hizmetler')->with('success','Silme Başarılı');
    }
}
