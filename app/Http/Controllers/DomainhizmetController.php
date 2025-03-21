<?php

namespace App\Http\Controllers;

use App\Models\Domaintakip;
use App\Models\Domaintakipdata;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DomainhizmetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function domainhizmet($id)
    {
        $domaintakip = Domaintakip::find($id);
        $domaintakipdata = Domaintakipdata::where('domaintakip_id',$domaintakip->id)->get();
        return view('admin.contents.domaintakip.domainhizmetekle',compact('domaintakipdata','domaintakip'));
    }
    public function index()
    {
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
        $domaintakipdata = new Domaintakipdata();
        $domaintakipdata->islem_yapan = Auth::user()->id;
        $domaintakipdata->islem_tarihi = Carbon::now();
        $domaintakipdata->domaintakip_id = $request->domaintakip_id;
        $domaintakipdata->tarih = $request->tarih;
        $domaintakipdata->domain_suresi = $request->domain_suresi;

        $baslangicTarihi = Carbon::parse($request->tarih);
        $bitisTarihi = $baslangicTarihi->addYears($request->domain_suresi);

        $domaintakipdata->bitis_tarihi = $bitisTarihi;

        $domaintakipdata->hizmet_turu = $request->hizmet_turu;
        $domaintakipdata->tutar = $request->tutar;
        $domaintakipdata->aciklama = $request->aciklama;
        $domaintakipdata->hosting_platform = $request->hosting_platform;
        $domaintakipdata->hosting_platform_iki = $request->hosting_platform_iki;
        $domaintakipdata->mail_adet = $request->mail_adet;
        $domaintakipdata->mail_platform = $request->mail_platform;

        if ($request->hasFile('resim')) {
            $fileExtension = $request->resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $domaintakipdata->dokuman_adi) . $domaintakipdata->domain_adi . '.' . $fileExtension;
            $request->resim->move(public_path('/domaintakip'), $imageName);
            $domaintakipdata->resim = '/domaintakip/' . $imageName;
        }

        $domaintakipdata->save();
        return redirect()->route('domainhizmet', ['id' => $domaintakipdata->domaintakip_id])->with('success', 'Ekleme Başarılı');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
