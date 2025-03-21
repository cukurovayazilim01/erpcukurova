<?php

namespace App\Http\Controllers;

use App\Models\Kasalar;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasalarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kasalar = Kasalar::all();
        $user = User::all();
        return view('admin.contents.kasalar.kasalar',compact('kasalar','user'));
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
        $kasalar = new Kasalar();
        $kasalar -> islem_yapan = Auth::user()->id;
        $kasalar -> islem_tarihi = Carbon::now();
        $kasalar -> kasa_adi = $request -> kasa_adi;
        $kasalar -> acilis_bakiye = $request -> acilis_bakiye;
        $kasalar -> acilis_bakiye_tarih = $request -> acilis_bakiye_tarih;
        $kasalar -> bakiye = $request -> acilis_bakiye;
        $kasalar -> doviz = $request -> doviz;
        $kasalar -> durum = $request -> durum;

        $kasalar -> save();

        return redirect('kasalar')->with('success','Ekleme Başarılı');
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
        $kasalar = Kasalar::find($id);
        $kasalar -> islem_yapan = Auth::user()->id;
        $kasalar -> islem_tarihi = Carbon::now();
        $kasalar -> kasa_adi = $request -> kasa_adi;
        $kasalar -> acilis_bakiye = $request -> acilis_bakiye;
        $kasalar -> acilis_bakiye_tarih = $request -> acilis_bakiye_tarih;
        $kasalar -> bakiye = $request -> acilis_bakiye;
        $kasalar -> doviz = $request -> doviz;
        $kasalar -> durum = $request -> durum;

        $kasalar -> save();

        return redirect('kasalar')->with('success','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kasalar = Kasalar::find($id);
        if ($kasalar->odeme()->count() > 0) {
            return redirect('kasalar')->with('error', 'Bu kasaya ait ödeme olduğu için silinemez.');
        }
        if ($kasalar->tahsilat()->count() > 0) {
            return redirect('kasalar')->with('error', 'Bu kasaya ait tahsilat olduğu için silinemez.');
        }
        $kasalar -> delete();
        return redirect('kasalar')->with('success','Silme Başarılı');
    }
}
