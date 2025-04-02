<?php

namespace App\Http\Controllers;

use App\Models\Degerlemekriters;
use App\Models\Personel;
use App\Models\Personeldegerlemeformu;
use App\Models\Personeldegerlemeformudata;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerformanDegerlemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function degerlendirmekriterleri()
    {
        $degerlemekriter = Degerlemekriters::all();

        return view("admin.contents.performansdegerleme.kriterler",compact('degerlemekriter'));
    }
    public function degerlemeformu($id)
    {
        $personel = Personel::find($id);
        $degerlemekriter = Degerlemekriters::where('durum','Aktif')->get();

        return view("admin.contents.performansdegerleme.performansdegerleme-formu", compact('personel','degerlemekriter'));
    }

    public function degerlemeformuPOST(Request $request)
    {
        $degerlemeformu = new Personeldegerlemeformu();
        $degerlemeformu->islem_yapan = Auth::user()->id;
        $degerlemeformu->islem_tarihi = Carbon::now();
        $degerlemeformu->personel_id = $request->personel_id;
        $degerlemeformu->konu = $request->konu;
        $degerlemeformu->aciklama = $request->aciklama;
        $degerlemeformu->toplam = $request->toplam;
        $degerlemeformu->signature_data = $request->signature_data;
        $degerlemeformu->save();

        $inputs = $request->input('inputs');

        foreach ($inputs as $input) {
            $degerlemeformudata = new Personeldegerlemeformudata();
            $degerlemeformudata->personeldegerlemeform_id = $degerlemeformu->id;
            $degerlemeformudata->kriter = $input['kriter'];
            $degerlemeformudata->rating = $input['rating'];


            $degerlemeformudata->save();
        }
        return redirect()->route('performansdegerleme.index')->with('success','Değerleme Başarılı');
    }

    public function degerlemeformuSHOW(Request $request,$id)
{

    $form_id = $request->input('form_id');

        // Eğer form_id varsa, sadece o formu getirin, yoksa tüm formlar listelensin
        $degerlemeformlari = Personeldegerlemeformu::when($form_id, function ($query) use ($form_id) {
            return $query->where('id', $form_id);
        })->get();
    $personel = Personel::find($id);

    // Personelin tüm değerlendirme formlarını getiriyoruz
    $degerlemeformlari = Personeldegerlemeformu::where('personel_id', $personel->id)->get();

    // Tüm formlara bağlı kriterleri getiriyoruz
    $kriterler = Personeldegerlemeformudata::whereIn('personeldegerlemeform_id', $degerlemeformlari->pluck('id'))->get();

    return view('admin.contents.performansdegerleme.performansdegerleme-formu-show', compact('degerlemeformlari', 'personel', 'kriterler'));
}




    public function index()
    {
        $personel = Personel::all();
        return view('admin.contents.performansdegerleme.performansdegerleme', compact( 'personel'));
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
        $inputs = $request->input('inputs');

        foreach ($inputs as $input) {
            $degerlemekriter = new Degerlemekriters();
            $degerlemekriter->islem_yapan = Auth::user()->id;
            $degerlemekriter->islem_tarihi = Carbon::now();
            $degerlemekriter->kriter = $input['kriter'];
            $degerlemekriter->durum = $input['durum'];
            $degerlemekriter->save();
        }
        return redirect()->route('degerlendirmekriterleri')->with('success', 'Ekleme Başarılı');
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
        $degerlemekriter = Degerlemekriters::find($id);
        $degerlemekriter -> islem_yapan = Auth::user()->id;
        $degerlemekriter -> islem_tarihi = Carbon::now();
        $degerlemekriter -> kriter = $request -> kriter;
        $degerlemekriter -> durum = $request -> durum;
        $degerlemekriter -> save();
        return redirect()->route('degerlendirmekriterleri')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $degerlemekriter = Degerlemekriters::find($id);

        $degerlemekriter -> delete();
        return redirect()->route('degerlendirmekriterleri')->with('success','Silme Başarılı');
    }


}
