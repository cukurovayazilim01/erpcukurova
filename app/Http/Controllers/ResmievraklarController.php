<?php

namespace App\Http\Controllers;

use App\Models\Resmievraklar;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResmievraklarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $resmievraklar = Resmievraklar::orderBy('dokuman_yili')->get();

        return view('admin.contents.resmievraklar.resmievraklar', compact('resmievraklar', 'user'));

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
        $resmievraklar = new Resmievraklar();
        $resmievraklar -> islem_tarihi = Carbon::now();
        $resmievraklar -> islem_yapan = Auth::user()->id;
        $resmievraklar -> dokuman_adi = $request -> dokuman_adi;
        $resmievraklar -> dokuman_yili = $request -> dokuman_yili;
        $resmievraklar -> dokuman_alim_tarihi = $request -> dokuman_alim_tarihi;
        $resmievraklar -> dokuman_hatirlatma_tarihi = $request -> dokuman_hatirlatma_tarihi;
        $resmievraklar -> aciklama = $request -> aciklama;
        if ($request->hasFile('dokuman_yolu'))
        {
            $fileExtension = $request->dokuman_yolu->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', time() .'-'. $resmievraklar->dokuman_yili .'-'. $resmievraklar->dokuman_adi) . '.' . $fileExtension;
            $request->dokuman_yolu->move(public_path('/resmievraklar'), $imageName);
            $resmievraklar->dokuman_yolu='/resmievraklar/'.$imageName;
        }
        $resmievraklar -> status = $request -> status;
        $resmievraklar -> save();
        return redirect('resmievraklarr')->with('success','Ekleme Başarılı');

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
        $resmievraklar = Resmievraklar::find($id);

        $resmievraklar -> islem_tarihi = Carbon::now();
        $resmievraklar -> islem_yapan = Auth::user()->id;
        $resmievraklar -> dokuman_adi = $request -> dokuman_adi;
        $resmievraklar -> dokuman_yili = $request -> dokuman_yili;
        $resmievraklar -> dokuman_alim_tarihi = $request -> dokuman_alim_tarihi;
        $resmievraklar -> dokuman_hatirlatma_tarihi = $request -> dokuman_hatirlatma_tarihi;
        $resmievraklar -> aciklama = $request -> aciklama;
        if ($request->hasFile('dokuman_yolu'))
        {
            $fileExtension = $request->dokuman_yolu->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', time() .'-'. $resmievraklar->dokuman_yili .'-'. $resmievraklar->dokuman_adi) . '.' . $fileExtension;
            $request->dokuman_yolu->move(public_path('/resmievraklar'), $imageName);
            $resmievraklar->dokuman_yolu='/resmievraklar/'.$imageName;
        }
        $resmievraklar -> status = $request -> status;
        $resmievraklar -> save();

        return redirect('resmievraklarr')->with('success', 'Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resmievraklar = Resmievraklar::find($id);
        $resmievraklar->delete();
        return redirect('resmievraklarr')->with('success', 'Silme Başarılı');

    }
}
