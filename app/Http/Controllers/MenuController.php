<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function muhasebemenu()
    {
        return view('admin.contents.anamenu.muhasebemenu');
    }
    public function ikmenu()
    {
        return view('admin.contents.anamenu.ikmenu');
    }
    public function idariislermenu()
    {
        return view('admin.contents.anamenu.idariislermenu');
    }
    public function makinemenu()
    {
        return view('admin.contents.anamenu.makinemenu');
    }
    public function index()
    {
        return view('admin.contents.anamenu.anamenu');
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
        //
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
