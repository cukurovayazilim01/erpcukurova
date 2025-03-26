<?php

namespace App\Http\Controllers;

use App\Models\Bankahrkt;
use App\Models\Bankalar;
use App\Models\Kasahrkt;
use App\Models\Kasalar;
use App\Models\User;
use App\Models\Virman;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VirmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // $cariler = Cariler::all();
        $virman = Virman::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $virman->currentPage();
        $startNumber = $virman->total() - (($page - 1) * $perPage);
        $user = User::all();
        $kasalar = Kasalar::all();
        $bankalar = Bankalar::all();

        return view('admin.contents.virman.virman', compact('virman', 'startNumber', 'perPage', 'user', 'kasalar', 'bankalar'));
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
        // dd($request->all());
        $virman = new Virman();
        $virman->islem_yapan = Auth::user()->id;
        $virman->islem_tarihi = Carbon::now();
        $virman->tarih = $request->tarih;
        $virman->virman_tutar = $request->virman_tutar;
        $virman->secimislemi = $request->secimislemi;
        $virman->birinci_kasa = $request->birinci_kasa;
        $virman->ikinci_kasa = $request->ikinci_kasa;
        $virman->birinci_banka = $request->birinci_banka;
        $virman->ikinci_banka = $request->ikinci_banka;
        $virman->save();

        if ($virman->secimislemi == 1) {

            $birinciKasa = Kasalar::find($virman->birinci_kasa);
            $birinciKasa->bakiye -= $virman->virman_tutar;
            $birinciKasa->save();

            $sonHareket = Kasahrkt::where('kasa_id', $virman->birinci_kasa)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $virman->birinciKasa->bakiye;

            $kasahrkt = new Kasahrkt();
            $kasahrkt->kasa_id = $virman->birinci_kasa;
            $kasahrkt->hareket_saati = Carbon::now();
            $kasahrkt->hareket_tipi = 'Virman';
            $kasahrkt->bakiye = $oncekiBakiye;
            $kasahrkt->eklenen_tutar = $virman->virman_tutar;
            $kasahrkt->guncel_bakiye = $kasahrkt->bakiye - $kasahrkt->eklenen_tutar;
            $kasahrkt->save();

            $ikinciKasa = Kasalar::find($virman->ikinci_kasa);
            $ikinciKasa->bakiye += $virman->virman_tutar;
            $ikinciKasa->save();

            $sonHareket = Kasahrkt::where('kasa_id', $virman->ikinci_kasa)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $virman->ikinci_kasa->bakiye;

            $kasahrkt = new Kasahrkt();
            $kasahrkt->kasa_id = $virman->ikinci_kasa;
            $kasahrkt->hareket_saati = Carbon::now();
            $kasahrkt->hareket_tipi = 'Virman';
            $kasahrkt->bakiye = $oncekiBakiye;
            $kasahrkt->eklenen_tutar = $virman->virman_tutar;
            $kasahrkt->guncel_bakiye = $kasahrkt->bakiye + $kasahrkt->eklenen_tutar;
            $kasahrkt->save();

        } elseif ($virman->secimislemi == 2) {
            $birinciBanka = Bankalar::find($virman->birinci_banka);
            $birinciBanka->bakiye -= $virman->virman_tutar;
            $birinciBanka->save();

            $sonHareket = Bankahrkt::where('banka_id', $virman->birinci_banka)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $birinciBanka->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->banka_id = $virman->birinci_banka;
            $bankahrkt->hareket_saati = Carbon::now();
            $bankahrkt->hareket_tipi = 'Virman';
            $bankahrkt->bakiye = $oncekiBakiye;
            $bankahrkt->eklenen_tutar = $virman->virman_tutar;
            $bankahrkt->guncel_bakiye = $bankahrkt->bakiye - $bankahrkt->eklenen_tutar;
            $bankahrkt->save();

            $ikinciBanka = Bankalar::find($virman->ikinci_banka);
            $ikinciBanka->bakiye += $virman->virman_tutar;
            $ikinciBanka->save();

            $sonHareket = Bankahrkt::where('banka_id', $virman->ikinci_banka)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $ikinciBanka->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->banka_id = $virman->ikinci_banka;
            $bankahrkt->hareket_saati = Carbon::now();
            $bankahrkt->hareket_tipi = 'Virman';
            $bankahrkt->bakiye = $oncekiBakiye;
            $bankahrkt->eklenen_tutar = $virman->virman_tutar;
            $bankahrkt->guncel_bakiye = $bankahrkt->bakiye + $bankahrkt->eklenen_tutar;
            $bankahrkt->save();

        } elseif ($virman->secimislemi == 3) {
            $birinciKasa = Kasalar::find($virman->birinci_kasa);
            $birinciKasa->bakiye -= $virman->virman_tutar;
            $birinciKasa->save();

            $sonHareket = Kasahrkt::where('kasa_id', $virman->birinci_kasa)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $virman->birinciKasa->bakiye;

            $kasahrkt = new Kasahrkt();
            $kasahrkt->kasa_id = $virman->birinci_kasa;
            $kasahrkt->hareket_saati = Carbon::now();
            $kasahrkt->hareket_tipi = 'Virman';
            $kasahrkt->bakiye = $oncekiBakiye;
            $kasahrkt->eklenen_tutar = $virman->virman_tutar;
            $kasahrkt->guncel_bakiye = $kasahrkt->bakiye - $kasahrkt->eklenen_tutar;
            $kasahrkt->save();

            $birinciBanka = Bankalar::find($virman->birinci_banka);
            $birinciBanka->bakiye += $virman->virman_tutar;
            $birinciBanka->save();

            $sonHareket = Bankahrkt::where('banka_id', $virman->birinci_banka)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $birinciBanka->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->banka_id = $virman->birinci_banka;
            $bankahrkt->hareket_saati = Carbon::now();
            $bankahrkt->hareket_tipi = 'Virman';
            $bankahrkt->bakiye = $oncekiBakiye;
            $bankahrkt->eklenen_tutar = $virman->virman_tutar;
            $bankahrkt->guncel_bakiye = $bankahrkt->bakiye + $bankahrkt->eklenen_tutar;
            $bankahrkt->save();

        } elseif ($virman->secimislemi == 4) {
            $ikinciBanka = Bankalar::find($virman->ikinci_banka);
            $ikinciBanka->bakiye -= $virman->virman_tutar;
            $ikinciBanka->save();

            $sonHareket = Bankahrkt::where('banka_id', $virman->ikinci_banka)
            ->orderBy('id', 'desc') // En son hareketi al
            ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $ikinciBanka->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->banka_id = $virman->ikinci_banka;
            $bankahrkt->hareket_saati = Carbon::now();
            $bankahrkt->hareket_tipi = 'Virman';
            $bankahrkt->bakiye = $oncekiBakiye;
            $bankahrkt->eklenen_tutar = $virman->virman_tutar;
            $bankahrkt->guncel_bakiye = $bankahrkt->bakiye - $bankahrkt->eklenen_tutar;
            $bankahrkt->save();

            $ikinciKasa = Kasalar::find($virman->ikinci_kasa);
            $ikinciKasa->bakiye += $virman->virman_tutar;
            $ikinciKasa->save();

            $sonHareket = Kasahrkt::where('kasa_id', $virman->ikinci_kasa)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $virman->ikinci_kasa->bakiye;

            $kasahrkt = new Kasahrkt();
            $kasahrkt->kasa_id = $virman->ikinci_kasa;
            $kasahrkt->hareket_saati = Carbon::now();
            $kasahrkt->hareket_tipi = 'Virman';
            $kasahrkt->bakiye = $oncekiBakiye;
            $kasahrkt->eklenen_tutar = $virman->virman_tutar;
            $kasahrkt->guncel_bakiye = $kasahrkt->bakiye + $kasahrkt->eklenen_tutar;
            $kasahrkt->save();
        }
        return redirect('virman')->with('success','Virman İşlemi Başarılı');
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
