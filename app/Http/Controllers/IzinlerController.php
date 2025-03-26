<?php

namespace App\Http\Controllers;

use App\Models\Izinler;
use App\Models\Personel;
use App\Models\User;
use App\Models\Yillikizin;
use App\Models\Yillikizinhakki;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class IzinlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function izinlersearch(Request $request)
    {
        $izinlersearch = $request->input('izinlersearch');

        // Eğer arama yapılmışsa filtre uygula, yoksa tüm verileri çek
        $izinler = Izinler::orderByDesc('id')
        ->when(!empty($izinlersearch), function ($query) use ($izinlersearch) {
            $query->whereHas('personel', function ($subQuery) use ($izinlersearch) {
                $subQuery->where('ad_soyad', 'like', '%' . $izinlersearch . '%')->orwhere('izin_turu', 'like', '%' . $izinlersearch . '%');
            });
        })
        ->paginate(50);


        // Sayfa numarasını hesapla
        $page = $request->query('page', 1);
        $perPage = 50;
        $startNumber = $izinler->total() - (($page - 1) * $perPage);


        // AJAX isteği ise sadece arama sonuçlarını döndür
        if ($request->ajax()) {
            return view('admin.contents.izinler.izinler-search', compact('izinler', 'startNumber'));
        }

        // Normal sayfa için tüm veriyi döndür
        return view('admin.contents.izinler.izinler', compact('izinler', 'startNumber'));
    }

    public function index()
    {
        $izinler = Izinler::all();
        $user = User::all();
        $personel = Personel::all();
        return view('admin.contents.izinler.izinler',compact('personel','izinler','user'));
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
        $izinler = new Izinler();
        $izinler->islem_yapan = Auth::user()->id;
        $izinler->islem_tarihi = Carbon::now();
        $izinler->personel_id = $request->personel_id;
        $izinler->baslangic_tarihi = $request->baslangic_tarihi;
        $izinler->bitis_tarihi = $request->bitis_tarihi;
        $izinler->izin_gun = $request->izin_gun;
        $izinler->izin_turu = $request->izin_turu;
        $izinler->izin_aciklama = $request->izin_aciklama;
        $izinler->save();



        return redirect('izinler')->with('success','Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $izinler = Izinler::find($id);
        return view('admin.contents.izinler.izinler-show',compact('izinler'));
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
        $izinler = Izinler::find($id);
        $izinler -> delete();
        return redirect('izinler')->with('success','Silme Başarılı');

    }
}
