<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Bankahrkt;
use App\Models\Bankalar;
use App\Models\Cariler;
use App\Models\Ceksenet;
use App\Models\Firmahrkt;
use App\Models\Kasahrkt;
use App\Models\Kasalar;
use App\Models\Odemeler;
use App\Models\Tahsilat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CeksenetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Postcekodeme(Request $request, $id)
    {
        $ceksenet = Ceksenet::find($id);
        $ceksenet->durum = 1;
        $ceksenet->pasifcekme_durum = 1;

        $odeme_max_no = Odemeler::max('odeme_kodu');
        $odeme = new Odemeler();
        $odeme->odeme_kodu = empty($odeme_max_no) ? 1 : $odeme_max_no + 1;
        $odeme->odeme_kodu_text = 'ÇEK-OF';
        $odeme->islem_yapan = Auth::user()->id;
        $odeme->islem_tarihi = Carbon::now();
        $odeme->tarih = $odeme->islem_tarihi;
        $odeme->cari_id = $request->cari_id;
        //buraya bakılacak
        $odeme->odemeyapan_id = Auth::user()->id;
        $odeme->tahsil_eden = Auth::user()->ad_soyad;
        $odeme->odeme_tipi = $request->odeme_tipi;
        $odeme->odeme_turu = 'Çek';
        $odeme->banka_id = $request->banka_id;
        $odeme->odeme_tutar = $request->odeme_tutar;
        $odeme->save();

        $ceksenet->odeme_id = $odeme->id;
        $ceksenet->save();

        if ($odeme->odeme_tipi == 'Banka') {
            // Banka hareketi işlemleri
            $sonHareket = Bankahrkt::where('banka_id', $odeme->banka_id)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $odeme->bankaadi->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->odeme_id = $odeme->id;
            $bankahrkt->banka_id = $odeme->banka_id;
            $bankahrkt->hareket_saati = $odeme->islem_tarihi;
            $bankahrkt->hareket_tipi = $odeme->odeme_turu === 'EFT' ? 'Giden EFT' : 'Giden Havale';
            $bankahrkt->bakiye = $oncekiBakiye;
            $bankahrkt->eklenen_tutar = $odeme->odeme_tutar;
            $bankahrkt->guncel_bakiye = $bankahrkt->bakiye - $bankahrkt->eklenen_tutar;
            $bankahrkt->save();

            $banka = Bankalar::find($odeme->banka_id);
            $banka->bakiye = $banka->bakiye - $odeme->odeme_tutar;
            $banka->save();
        } elseif ($odeme->odeme_tipi === 'Kasa') {
            // Kasa hareketi işlemleri
            $sonHareket = Kasahrkt::where('kasa_id', $odeme->kasa_id)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $odeme->kasaadi->bakiye;

            $kasahrkt = new Kasahrkt();
            $kasahrkt->odeme_id = $odeme->id;
            $kasahrkt->kasa_id = $odeme->kasa_id;
            $kasahrkt->hareket_saati = $odeme->islem_tarihi;
            $kasahrkt->hareket_tipi = 'Giden Nakit';
            $kasahrkt->bakiye = $oncekiBakiye;
            $kasahrkt->eklenen_tutar = $odeme->odeme_tutar;
            $kasahrkt->guncel_bakiye = $kasahrkt->bakiye - $kasahrkt->eklenen_tutar;
            $kasahrkt->save();

            $kasa = Kasalar::find($odeme->kasa_id);
            $kasa->bakiye = $kasa->bakiye - $odeme->odeme_tutar;
            $kasa->save();
        }
        $firmahrkt = Firmahrkt::where('ceksenet_id', $ceksenet->id)->first();
        $firmahrkt -> durum = 0;
        $firmahrkt -> save();

        $odeme = Odemeler::find($ceksenet->odeme_id);

        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $odeme->islem_tarihi;
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id = $odeme->cari_id;
        $firmahrkt->bankahareket_id = $bankahrkt->id;
        $firmahrkt->islem = 'Çek Ödemesi';
        $firmahrkt->ceksenet_id = $ceksenet->id;

        $firmahrkt->odeme_id = $odeme->id;
        $firmahrkt->borc = $odeme->odeme_tutar;
        $firmahrkt->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $ceksenet->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' . $ceksenet->cek_no . ' nolu çeki ödemeye Aktarıldı.';
        $log->save();


        return redirect('odemeler')->with('success', 'Çek Ödemesi Başarılı');

    }
    public function cekodeme($id)
    {
        $ceksenet = Ceksenet::find($id);
        $user = User::find($ceksenet->islem_yapan);
        $cariler = Cariler::find($ceksenet->cari_id);
        $kasalar = Kasalar::all();
        $bankalar = Bankalar::all();
        return view('admin.contents.ceksenet.cekodeme', compact('ceksenet', 'user', 'cariler', 'bankalar', 'kasalar'));
    }

    public function cektahsilat($id)
    {
        $ceksenet = Ceksenet::find($id);
        $user = User::find($ceksenet->islem_yapan);
        $cariler = Cariler::find($ceksenet->cari_id);
        $kasalar = Kasalar::all();
        $bankalar = Bankalar::all();
        return view('admin.contents.ceksenet.cektahsilat', compact('ceksenet', 'user', 'cariler', 'bankalar', 'kasalar'));
    }

    public function Postcektahsilat(Request $request, $id)
    {

        $ceksenet = Ceksenet::find($id);
        $ceksenet->durum = 1;
        $ceksenet->pasifcekme_durum = 1;

        $tahsilat_max_no = Tahsilat::max('tahsilat_kodu');
        $tahsilat = new Tahsilat();
        $tahsilat->tahsilat_kodu = empty($tahsilat_max_no) ? 1 : $tahsilat_max_no + 1;
        $tahsilat->tahsilat_kodu_text = 'ÇEK-TF';
        $tahsilat->islem_yapan = Auth::user()->id;
        $tahsilat->islem_tarihi = Carbon::now();
        $tahsilat->tarih = $request->cek_vade_tarihi;
        $tahsilat->cari_id = $request->cari_id;
        $tahsilat->tahsileden_id = $tahsilat->islem_yapan;
        $tahsilat->odeme_turu = 'Çek';
        $tahsilat->odeme_yapan = $request->cari_unvan;
        $tahsilat->odeme_tipi = $request->odeme_tipi;
        $tahsilat->kasa_id = $request->kasa_id;
        $tahsilat->banka_id = $request->banka_id;
        $tahsilat->tahsilat_tutar = $request->tahsilat_tutar;
        $tahsilat->save();

        $ceksenet->tahsilat_id = $tahsilat->id;
        $ceksenet->save();

        if ($tahsilat->odeme_tipi == 'Banka') {
            // Banka hareketi işlemleri
            $sonHareket = Bankahrkt::where('banka_id', $tahsilat->banka_id)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $tahsilat->bankaadi->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->tahsilat_id = $tahsilat->id;
            $bankahrkt->banka_id = $tahsilat->banka_id;
            $bankahrkt->hareket_saati = $tahsilat->islem_tarihi;
            $bankahrkt->hareket_tipi = 'Çek';
            $bankahrkt->bakiye = $oncekiBakiye;
            $bankahrkt->eklenen_tutar = $tahsilat->tahsilat_tutar;
            $bankahrkt->guncel_bakiye = $bankahrkt->bakiye + $bankahrkt->eklenen_tutar;
            $bankahrkt->save();

            $banka = Bankalar::find($tahsilat->banka_id);
            $banka->bakiye = $banka->bakiye + $tahsilat->tahsilat_tutar;
            $banka->save();
        }
        $firmahrkt = Firmahrkt::where('ceksenet_id', $ceksenet->id)->first();
        $firmahrkt -> durum = 0;
        $firmahrkt -> save();

        $tahsilat = Tahsilat::find($ceksenet->tahsilat_id);

        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $tahsilat->islem_tarihi;
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id = $tahsilat->cari_id;
        $firmahrkt->bankahareket_id = $bankahrkt->id;
        $firmahrkt->islem = 'Çek Tahsilatı';
        $firmahrkt->ceksenet_id = $ceksenet->id;

        $firmahrkt->tahsilat_id = $tahsilat->id;
        $firmahrkt->alacak = $tahsilat->tahsilat_tutar;
        $firmahrkt->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $ceksenet->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' . $ceksenet->cek_no . ' nolu çeki Tahsil Edildi.';
        $log->save();

        return redirect('tahsilat')->with('success', 'Çek Tahsilatı Başarılı');
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // $cariler = Cariler::all();
        $ceksenet = Ceksenet::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $ceksenet->currentPage();
        $startNumber = $ceksenet->total() - (($page - 1) * $perPage);
        $user = User::all();
        $cariler = Cariler::all();

        return view('admin.contents.ceksenet.ceksenet', compact('ceksenet', 'startNumber', 'perPage', 'user', 'cariler'));
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
        $ceksenet = new Ceksenet();
        $ceksenet->islem_yapan = Auth::user()->id;
        $ceksenet->islem_tarihi = Carbon::now();
        $ceksenet->cek_vade_tarihi = $request->cek_vade_tarihi;
        $ceksenet->cek_no = $request->cek_no;
        $ceksenet->cek_tipi = $request->cek_tipi;
        $ceksenet->cari_id = $request->cari_id;
        $ceksenet->tutar = $request->tutar;
        $ceksenet->banka_adi = $request->banka_adi;
        $ceksenet->sube_adi = $request->sube_adi;
        $ceksenet->hesap_no = $request->hesap_no;
        $ceksenet->aciklama = $request->aciklama;
        $ceksenet->durum = 0;
        $ceksenet->pasifcekme_durum = 0;

        if ($request->hasFile('cek_resim')) {
            $fileExtension = $request->cek_resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $ceksenet->cek_no) . '.' . $fileExtension;
            $request->cek_resim->move(public_path('/cekresim'), $imageName);
            $ceksenet->cek_resim = '/cekresim/' . $imageName;
        }
        $ceksenet->save();

        $firmahrkt = new Firmahrkt();
        $firmahrkt->islem_tarihi = $ceksenet->cek_vade_tarihi;
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id =  $ceksenet->cari_id;
        $firmahrkt->ceksenet_id = $ceksenet->id;

        if ( $ceksenet->cek_tipi == 'Gelen' ) {
            $firmahrkt->islem = 'Gelen Çek';
            $firmahrkt->alacak = $ceksenet->tutar;
        }elseif($ceksenet->cek_tipi == 'Giden'){
            $firmahrkt->islem = 'Giden Çek';
            $firmahrkt->borc = $ceksenet->tutar;
        }
        $firmahrkt->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $ceksenet->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' . $ceksenet->cek_no . ' nolu çeki Kayıt Edildi.';
        $log->save();

        return redirect('ceksenet')->with('success', 'Ekleme Başarılı');

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
        $ceksenet = Ceksenet::find($id);

        if ($ceksenet->durum == '0') {
            $ceksenet->islem_yapan = Auth::user()->id;
            $ceksenet->islem_tarihi = Carbon::now();
            $ceksenet->cek_vade_tarihi = $request->cek_vade_tarihi;
            $ceksenet->cek_no = $request->cek_no;
            // $ceksenet->cek_tipi = $request->cek_tipi;
            // $ceksenet->cari_id = $request->cari_id;
            $ceksenet->tutar = $request->tutar;
            $ceksenet->banka_adi = $request->banka_adi;
            $ceksenet->sube_adi = $request->sube_adi;
            $ceksenet->hesap_no = $request->hesap_no;
            $ceksenet->aciklama = $request->aciklama;
            $ceksenet->durum = 0;

            if ($request->hasFile('cek_resim')) {
                $fileExtension = $request->cek_resim->getClientOriginalExtension();
                $imageName = str_replace(' ', '-', $ceksenet->cek_no) . '.' . $fileExtension;
                $request->cek_resim->move(public_path('/cekresim'), $imageName);
                $ceksenet->cek_resim = '/cekresim/' . $imageName;
            }

            $ceksenet->save();

            $firmahrkt = Firmahrkt::where('ceksenet_id', $ceksenet->id)->first();
            $firmahrkt->islem_tarihi = $ceksenet->cek_vade_tarihi;
            $firmahrkt->tarih = Carbon::now();
            $firmahrkt->islem_yapan = Auth::user()->id;
            $firmahrkt->cari_id =  $ceksenet->cari_id;

            if ( $ceksenet->cek_tipi == 'Gelen' ) {
                $firmahrkt->islem = 'Gelen Çek';
                $firmahrkt->borc = $ceksenet->tutar;
            }elseif($ceksenet->cek_tipi == 'Giden'){
                $firmahrkt->islem = 'Giden Çek';
                $firmahrkt->alacak = $ceksenet->tutar;
            }
            $firmahrkt->ceksenet_id = $ceksenet->id;
            $firmahrkt->save();
            return redirect('ceksenet')->with('success', 'Güncelleme Başarılı');
        }
        elseif ($ceksenet->durum == '1') {
            return redirect('ceksenet')->with('error', 'Çek Portföyde Olduğu İçin Güncellenemez.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ceksenet = Ceksenet::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $ceksenet->firmaadi->firma_unvan . ' ' . 'Carisinin' . ' ' . $ceksenet->cek_no . ' nolu çeki Silindi.';
        $log->save();

        if ($ceksenet->durum == '0') {
            $firmahrkt = Firmahrkt::where('ceksenet_id', $ceksenet->id)->first();
            $firmahrkt->delete();

            $ceksenet->delete();
            return redirect('ceksenet')->with('success', 'Çek başarıyla silindi.');
        } elseif ($ceksenet->durum == '1') {
            return redirect('ceksenet')->with('error', 'Çek Portföyde Olduğu İçin Silinemez');

        }
    }
}
