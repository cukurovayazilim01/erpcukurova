<?php

namespace App\Http\Controllers;

use App\Models\Gider;
use App\Models\Giderkategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gider = Gider::all();
        $giderkategori = Giderkategori::where('durum','Aktif')->get();
        $user = User::all();
        return view('admin.contents.giderler.gider',compact('gider','user','giderkategori'));
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
        $gider = new Gider();
        $gider -> islem_yapan = Auth::user()->id;
        $gider -> islem_tarihi = Carbon::now();
        $gider -> giderkategori_id = $request -> giderkategori_id;
        $gider -> gider_kodu = $request -> gider_kodu;
        $gider -> gider_adi = $request -> gider_adi;
        $gider -> durum = $request -> durum;
        $gider -> save();
        return redirect('gider')->with('success','Ekleme Başarılı');
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
        $gider = Gider::find($id);
        $gider -> islem_yapan = Auth::user()->id;
        $gider -> islem_tarihi = Carbon::now();
        $gider -> giderkategori_id = $request -> giderkategori_id;
        $gider -> gider_kodu = $request -> gider_kodu;
        $gider -> gider_adi = $request -> gider_adi;
        $gider -> durum = $request -> durum;
        $gider -> save();
        return redirect('gider')->with('success','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gider = Gider::find($id);
        if ($gider->alislardata()->count() > 0) {
            return redirect('gider')->with('error', 'Bu gidere ait alış faturası olduğu için silinemez.');
        }
        $gider -> delete();
        return redirect('gider')->with('success','Silme Başarılı');

    }
}
