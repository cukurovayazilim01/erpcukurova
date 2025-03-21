<?php

namespace App\Http\Controllers;

use App\Models\Efaturaapi;
use App\Models\Smsapi;
use Illuminate\Http\Request;

class EntegrasyonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function entegrasyonmenu()
    {
        return view('admin.contents.entegrasyonmenu.entegrasyonmenu');
    }

    public function smsapi()
    {
        $smsapi = Smsapi::first();
        return view('admin.contents.entegrasyonmenu.smsapi',compact('smsapi'));
    }
    public function smtp()
    {
        return view('admin.contents.entegrasyonmenu.smtp');
    }
    public function efaturaapi()
    {
        $efaturaapi = Efaturaapi::first();
        return view('admin.contents.entegrasyonmenu.efaturaapi',compact('efaturaapi'));
    }

    public function smsapiPUT(Request $request,$id)
    {
        $smsapi = Smsapi::find($id);
        $smsapi -> kullanici_no = $request -> kullanici_no;
        $smsapi -> kullanici_adi = $request -> kullanici_adi;
        $smsapi -> sifre = $request -> sifre;
        $smsapi -> orginator = $request -> orginator;
        $smsapi -> save();
        return redirect('smsapi');
    }
    public function efaturaapiPUT(Request $request,$id)
    {
        $efaturaapi = Efaturaapi::find($id);
        $efaturaapi -> rf_kullanici_adi = $request -> rf_kullanici_adi;
        $efaturaapi -> rf_sifre = $request -> rf_sifre;
        $efaturaapi -> rf_token = $request -> rf_token;
        $efaturaapi -> save();
        return redirect('efaturaapi');
    }
}
