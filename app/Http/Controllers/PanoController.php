<?php

namespace App\Http\Controllers;

use App\Models\Pano;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pano = Pano::where('islem_yapan',Auth::user()->id)->get();
        return view('admin.contents.pano.pano',compact('pano'));
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


        $liste = new Pano();
        $liste->liste_ad = $request->liste_ad;
        $liste->save();

        return redirect('pano')->with('success','Ekleme Başarılı');
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
