<?php

namespace App\Http\Controllers;

use App\Models\Cariler;
use App\Models\Toplumail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Mail\ToplugonderMail;
use Illuminate\Support\Facades\Mail;

class ToplumailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toplumail = Toplumail::all();
        $user = User::all();
        return view('admin.contents.toplumail.toplumail', compact('toplumail', 'user'));
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
        $toplumail = new Toplumail();
        $toplumail->islem_yapan = Auth::user()->id;
        $toplumail->islem_tarihi = Carbon::now();
        $toplumail->konu = $request->konu;
        $toplumail->firma_sektor = $request->firma_sektor;
        $toplumail->mesaj = $request->mesaj;
        $toplumail->save();

        Artisan::call('toplumail:gonder');


        return redirect('toplumail')->with('success', 'Toplu Mail Gönderimi Başlatıldı.');
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
