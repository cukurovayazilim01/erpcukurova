<?php

namespace App\Http\Controllers;

use App\Models\Cariler;
use App\Models\Domaintakip;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DomaintakipController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {

        $perPage = $request->input('entries', 5);
        $domaintakip = Domaintakip::orderByDesc('id')->paginate($perPage);
        $page = $domaintakip->currentPage();
        $startNumber = $domaintakip->total() - (($page - 1) * $perPage);

        $user = User::all();
        return view('admin.contents.domaintakip.domaintakip',compact('domaintakip','user','startNumber','perPage'));
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
        $domaintakip = new Domaintakip();
        $domaintakip->islem_yapan = Auth::user()->id;
        $domaintakip->islem_tarihi = Carbon::now();
        $domaintakip->cari_id = $request->cari_id;
        $domaintakip->musteri_temsilcisi = $request->musteri_temsilcisi;
        $domaintakip->satis_temsilcisi = $request->satis_temsilcisi;
        $domaintakip->domain_adi = $request->domain_adi;
        $domaintakip->tarih = $request->tarih;
        $domaintakip->telefon_no = $request->telefon_no;
        $domaintakip->tutar = $request->tutar;
        $domaintakip->hizmet_turu = $request->hizmet_turu;
        $domaintakip->aciklama = $request->aciklama;
        $domaintakip->hosting_platform = $request->hosting_platform;
        $domaintakip->mail_adet = $request->mail_adet;
        $domaintakip->mail_platform = $request->mail_platform;

        if ($request->hasFile('resim')) {
            $fileExtension = $request->resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $domaintakip->dokuman_adi) . $domaintakip->domain_adi . '.' . $fileExtension;
            $request->resim->move(public_path('/domaintakip'), $imageName);
            $domaintakip->resim = '/domaintakip/' . $imageName;
        }

        $domaintakip->save();
        return redirect('domaintakip')->with('success','Ekleme Başarılı');
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
