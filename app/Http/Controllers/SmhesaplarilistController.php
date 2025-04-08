<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use App\Models\Smhesaplarilist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmhesaplarilistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $smhesaplarilist = Smhesaplarilist::all();
        $personel = Personel::all();

        return view("admin.contents.smhesaplarilist.smhesaplarilist", compact("smhesaplarilist",'personel'));
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
        $smhesaplarilist = new Smhesaplarilist();
        $smhesaplarilist->islem_yapan   = Auth::user()->id;
        $smhesaplarilist->islem_tarihi  = Carbon::now();
        $smhesaplarilist->acilis_tarihi = $request->acilis_tarihi;
        $smhesaplarilist->hesap_adi = $request->hesap_adi;
        $smhesaplarilist->platform = $request->platform;
        $smhesaplarilist->mail = $request->mail;
        $smhesaplarilist->telefon = $request->telefon;
        $smhesaplarilist->personel_id = $request->personel_id;
        $smhesaplarilist->save();
        return redirect()->route("smhesaplarilist.index")->with("success","Ekleme Başarılı");
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
        $smhesaplarilist = Smhesaplarilist::find($id);
        $smhesaplarilist->islem_yapan   = Auth::user()->id;
        $smhesaplarilist->islem_tarihi  = Carbon::now();
        $smhesaplarilist->acilis_tarihi = $request->acilis_tarihi;
        $smhesaplarilist->hesap_adi = $request->hesap_adi;
        $smhesaplarilist->platform = $request->platform;
        $smhesaplarilist->mail = $request->mail;
        $smhesaplarilist->telefon = $request->telefon;
        $smhesaplarilist->personel_id = $request->personel_id;
        $smhesaplarilist->save();
        return redirect()->route("smhesaplarilist.index")->with("success","Güncelleme Başarılı");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $smhesaplarilist = Smhesaplarilist::find($id);
        $smhesaplarilist->delete();
        return redirect()->route("smhesaplarilist.index")->with("success","Silme Başarılı");
    }
}
