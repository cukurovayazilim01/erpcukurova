<?php

namespace App\Http\Controllers;

use App\Models\Pyillikhedefler;
use App\Models\YillikHedefkonu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PyillikhedeflerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function yillikhedefkonu()
    {
        $yillikhedefkonu = YillikHedefkonu::all();
        return view("admin.contents.pyillikhedefler.hedefkonu.hedefkonu", compact("yillikhedefkonu"));
    }
    public function yillikhedefkonuPOST(Request $request)
    {
        $yillikhedefkonu = new YillikHedefkonu();
        $yillikhedefkonu -> islem_yapan = Auth::user()->id;
        $yillikhedefkonu -> islem_tarihi = Carbon::now();
        $yillikhedefkonu -> hedef_konu = $request -> hedef_konu;
        $yillikhedefkonu -> durum = $request -> durum;
        $yillikhedefkonu -> save();
        return redirect()->route('yillikhedefkonu')->with('success','Ekleme Başarılı');
    }
    public function index()
    {
        $pyillikhedefler = Pyillikhedefler::all();
        return view("admin.contents.pyillikhedefler.pyillikhedefler", compact("pyillikhedefler"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $yillikhedefkonu = YillikHedefkonu::all();
        return view("admin.contents.pyillikhedefler.pyillikhedefler-create", compact("yillikhedefkonu"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input('inputs');

        foreach ($inputs as $input) {
            $pyillikhedefler = new Pyillikhedefler();
            $pyillikhedefler -> islem_yapan = Auth::user()->id;
            $pyillikhedefler -> islem_tarihi = Carbon::now();
            $pyillikhedefler->personel_id = $input['personel_id'];
            $pyillikhedefler->hedef_konusu_id = $input['hedef_konusu_id'];
            $pyillikhedefler->hedef_yili = $input['hedef_yili'];
            $pyillikhedefler->hedef_mevcut_degeri = $input['hedef_mevcut_degeri'];
            $pyillikhedefler->hedeflenen_deger = $input['hedeflenen_deger'];
            $pyillikhedefler->hedef_hesaplama_yontemi = $input['hedef_hesaplama_yontemi'];
            $pyillikhedefler->hedef_aksiyonu = $input['hedef_aksiyonu'];
            $pyillikhedefler->hedef_termini = $input['hedef_termini'];
            $pyillikhedefler->hedef_kontrol_termini = $input['hedef_kontrol_termini'];
            $pyillikhedefler->save();
        }

        return redirect()->route("pyillikhedefler.index")->with("success","Ekleme Başarılı");
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
        $pyillikhedefler = Pyillikhedefler::find($id);
        $pyillikhedefler->yonetici_hedeflenen_deger = $request -> yonetici_hedeflenen_deger;
        $pyillikhedefler->kontrol_sonucu = $request -> kontrol_sonucu;
        $pyillikhedefler->save();
        return redirect()->route("pyillikhedefler.index")->with("success","Güncelleme Başarılı");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
