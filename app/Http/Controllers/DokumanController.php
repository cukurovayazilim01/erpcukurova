<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Dokuman;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DokumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function dokumanEkle(Request $request)
     {
        $dokuman = new Dokuman();
        $dokuman->islem_yapan = Auth::user()->id;
        $dokuman->islem_tarihi = Carbon::now();
        $dokuman->cari_id = $request->cari_id;
        $dokuman->dosya_adi = $request->dosya_adi;
        if ($request->hasFile('dosya_yolu')) {
            $fileExtension = $request->dosya_yolu->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $dokuman->dosya_adi) . '.' . $fileExtension;
            $request->dosya_yolu->move(public_path('/caridokuman'), $imageName);
            $dokuman->dosya_yolu = '/caridokuman/' . $imageName;
        }
        $dokuman->aciklama = $request->aciklama;
        $dokuman->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $dokuman->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $dokuman->dosya_adi . ' adında Doküman Eklendi.';
        $log->save();

        return redirect()->route('cariler.show', ['cariler' => $request->cari_id])->with('success', 'Ekleme Başarılı');
     }
    public function index()
    {
        //
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
        $dokuman = new Dokuman();
        $dokuman->islem_yapan = Auth::user()->id;
        $dokuman->islem_tarihi = Carbon::now();
        $dokuman->cari_id = $request->cari_id;
        $dokuman->dosya_adi = $request->dosya_adi;
        if ($request->hasFile('dosya_yolu')) {
            $fileExtension = $request->dosya_yolu->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $dokuman->dosya_adi) . '.' . $fileExtension;
            $request->dosya_yolu->move(public_path('/caridokuman'), $imageName);
            $dokuman->dosya_yolu = '/caridokuman/' . $imageName;
        }
        $dokuman->aciklama = $request->aciklama;
        $dokuman->save();
        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $dokuman->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $dokuman->dosya_adi . ' adında Doküman Eklendi.';
        $log->save();
        return redirect()->route('cariler.show', ['cariler' => $request->cari_id])->with('success', 'Ekleme Başarılı');

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
