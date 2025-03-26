<?php

namespace App\Http\Controllers;

use App\Models\Bankalar;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BankalarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bankalar = Bankalar::all();
        $user = User::all();
        return view('admin.contents.bankalar.bankalar',compact('bankalar','user'));

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
        $bankalar = new Bankalar();
        $bankalar -> user_id = $request -> user_id;
        $bankalar -> islem_tarihi = Carbon::now();
        $bankalar -> banka_adi = $request -> banka_adi;
        $bankalar -> sube_adi = $request -> sube_adi;
        $bankalar -> sube_kodu = $request -> sube_kodu;
        $bankalar -> hesap_adi = $request -> hesap_adi;
        $bankalar -> hesap_no = $request -> hesap_no;
        $bankalar -> iban = $request -> iban;
        $bankalar -> kart_turu = $request -> kart_turu;
        $bankalar -> acilis_bakiyesi = $request -> acilis_bakiyesi;
        $bankalar -> acilis_bakiye_tarih = $request -> acilis_bakiye_tarih;
        $bankalar -> bakiye = $request -> acilis_bakiyesi;
        $bankalar -> doviz = $request -> doviz;
        $bankalar -> durum = $request -> durum;

        $bankalar -> save();

        return redirect('bankalar')->with('success','Ekleme Başarılı');
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
        $bankalar = Bankalar::find($id);
        $bankalar -> user_id = $request -> user_id;
        $bankalar -> islem_tarihi = Carbon::now();
        $bankalar -> banka_adi = $request -> banka_adi;
        $bankalar -> sube_adi = $request -> sube_adi;
        $bankalar -> sube_kodu = $request -> sube_kodu;
        $bankalar -> hesap_adi = $request -> hesap_adi;
        $bankalar -> hesap_no = $request -> hesap_no;
        $bankalar -> iban = $request -> iban;
        $bankalar -> kart_turu = $request -> kart_turu;
        $bankalar -> acilis_bakiyesi = $request -> acilis_bakiyesi;
        $bankalar -> acilis_bakiye_tarih = $request -> acilis_bakiye_tarih;
        $bankalar -> bakiye = $request -> acilis_bakiyesi;
        $bankalar -> doviz = $request -> doviz;
        $bankalar -> durum = $request -> durum;

        $bankalar -> save();

        return redirect('bankalar')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bankalar = Bankalar::find($id);
        if ($bankalar->odeme()->count() > 0) {
            return redirect('bankalar')->with('error', 'Bu bankaya ait ödeme olduğu için silinemez.');
        }
        if ($bankalar->tahsilat()->count() > 0) {
            return redirect('bankalar')->with('error', 'Bu bankaya ait tahsilat olduğu için silinemez.');
        }
        $bankalar -> delete();
        return redirect('bankalar')->with('success','Silme Başarılı');
    }
}
