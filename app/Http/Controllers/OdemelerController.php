<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Bankahrkt;
use App\Models\Bankalar;
use App\Models\Cariler;
use App\Models\Firmahrkt;
use App\Models\Kasahrkt;
use App\Models\Kasalar;
use App\Models\Odemeler;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OdemelerController extends Controller
{
    public function firmahrktaktarodeme()
{
    try {
        $odemeler = Odemeler::all(); // Tüm ödemeleri al

        if ($odemeler->isEmpty()) {
            return redirect('odemeler')->with('warning', 'Aktarılacak Ödeme Kaydı Bulunamadı!');
        }

        $firmaHareketleri = []; // Firma hareketleri için dizi

        foreach ($odemeler as $odeme) {
            $kasahareket_id = null;
            $bankahareket_id = null;

            if ($odeme->odeme_tipi == 'Banka') {
                $sonHareket = Bankahrkt::where('banka_id', $odeme->banka_id)
                    ->orderBy('id', 'desc')
                    ->first();

                $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $odeme->bankaadi->bakiye;

                $bankahrkt = Bankahrkt::create([
                    'odeme_id'       => $odeme->id,
                    'banka_id'       => $odeme->banka_id,
                    'hareket_saati'  => $odeme->tarih,
                    'hareket_tipi'   => $odeme->odeme_turu === 'EFT' ? 'Giden EFT' : 'Giden Havale',
                    'bakiye'         => $oncekiBakiye,
                    'eklenen_tutar'  => $odeme->odeme_tutar,
                    'guncel_bakiye'  => $oncekiBakiye - $odeme->odeme_tutar,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now()
                ]);

                $bankahareket_id = $bankahrkt->id;

            } elseif ($odeme->odeme_tipi === 'Kasa') {
                $sonHareket = Kasahrkt::where('kasa_id', $odeme->kasa_id)
                    ->orderBy('id', 'desc')
                    ->first();

                $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $odeme->kasaadi->bakiye;

                $kasahrkt = Kasahrkt::create([
                    'odeme_id'       => $odeme->id,
                    'kasa_id'        => $odeme->kasa_id,
                    'hareket_saati'  => $odeme->tarih,
                    'hareket_tipi'   => 'Giden Nakit',
                    'bakiye'         => $oncekiBakiye,
                    'eklenen_tutar'  => $odeme->odeme_tutar,
                    'guncel_bakiye'  => $oncekiBakiye - $odeme->odeme_tutar,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now()
                ]);

                $kasahareket_id = $kasahrkt->id;
            }

            $firmaHareketleri[] = [
                'islem_tarihi'     => $odeme->tarih,
                'tarih'     => Carbon::now(),
                'islem_yapan'      => Auth::user()->id,
                'cari_id'          => $odeme->cari_id,
                'kasahareket_id'   => $kasahareket_id,
                'bankahareket_id'  => $bankahareket_id,
                'islem'            => 'Ödeme',
                'odeme_id'         => $odeme->id,
                'borc'             => $odeme->odeme_tutar,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now()
            ];
        }

        Firmahrkt::insert($firmaHareketleri);

        return redirect('odemeler')->with('success', 'Tüm Ödemeler Firma Hareketlerine Başarıyla Aktarıldı');
    } catch (\Exception $e) {
        return redirect('odemeler')->with('error', 'Aktarım sırasında bir hata oluştu: ' . $e->getMessage());
    }
}

    public function odemelersearch(Request $request)
    {
        $odemelersearch = $request->input('odemelersearch');

        // Eğer arama yapılmışsa
        if ($odemelersearch) {
            $odemeler = Odemeler::orderByDesc('id')
                ->whereHas('firmaadi',function($query) use ($odemelersearch) {
                    $query->where('firma_unvan', 'like', '%' . $odemelersearch . '%');
                })
                ->paginate(50);

            // Sayfa numarasını hesapla
            $page = $request->query('page', 1);
            $perPage = 50;
            $startNumber = $odemeler->total() - (($page - 1) * $perPage);

            $user = User::all();

            // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
            if ($request->ajax()) {
                return view('admin.contents.odemeler.odemeler-search', compact('odemeler', 'startNumber', 'user'));
            }

            // Normal sayfa için arama sonucu döndür
            return view('admin.contents.odemeler.odemeler',compact('odemeler', 'startNumber', 'user'));
        }

        // Arama yapılmamışsa ana sayfayı döndür
        return view('admin.contents.odemeler.odemeler');
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // $cariler = Cariler::all();
        $odemeler = Odemeler::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $odemeler->currentPage();
        $startNumber = $odemeler->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.odemeler.odemeler', compact('odemeler', 'startNumber', 'perPage','user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cariler = Cariler::all();
        $user = User::all();
        $kasalar = Kasalar::all();
        $bankalar = Bankalar::all();
        return view('admin.contents.odemeler.odemeler-create', compact('cariler', 'user', 'kasalar', 'bankalar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $odeme_max_no = Odemeler::max('odeme_kodu');
        $odeme = new Odemeler();
        $odeme->odeme_kodu = empty($odeme_max_no) ? 1 : $odeme_max_no + 1;
        $odeme->odeme_kodu_text = 'OF';
        $odeme->islem_yapan = Auth::user()->id;
        $odeme->islem_tarihi = Carbon::now();
        $odeme->tarih = $request->tarih;
        $odeme->cari_id = $request->cari_id;
        $odeme->odemeyapan_id = $request->odemeyapan_id;

        $odeme->tahsil_eden = $request->tahsil_eden;
        $odeme->odeme_tipi = $request->odeme_tipi;
        $odeme->odeme_turu = $request->odeme_turu;


        $odeme->kasa_id = $request->kasa_id;
        $odeme->banka_id = $request->banka_id;
        $odeme->odeme_tutar = $request->odeme_tutar;
        $odeme->save();


        if ($odeme->odeme_tipi == 'Banka') {
            // Banka hareketi işlemleri
            $sonHareket = Bankahrkt::where('banka_id', $odeme->banka_id)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $odeme->bankaadi->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->odeme_id = $odeme->id;
            $bankahrkt->banka_id = $odeme->banka_id;
            $bankahrkt->hareket_saati = $odeme->tarih;
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
            $kasahrkt->hareket_saati = $odeme->tarih;
            $kasahrkt->hareket_tipi = 'Giden Nakit';
            $kasahrkt->bakiye = $oncekiBakiye;
            $kasahrkt->eklenen_tutar = $odeme->odeme_tutar;
            $kasahrkt->guncel_bakiye = $kasahrkt->bakiye - $kasahrkt->eklenen_tutar;
            $kasahrkt->save();

            $kasa = Kasalar::find($odeme->kasa_id);
            $kasa->bakiye = $kasa->bakiye - $odeme->odeme_tutar;
            $kasa->save();
        }

        $firmahrkt = new Firmahrkt();
        $firmahrkt->islem_tarihi = $odeme->tarih;
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id =  $odeme->cari_id;
        if ($odeme->odeme_tipi == 'Kasa'){
            $firmahrkt->kasahareket_id = $kasahrkt->id;
        }
        elseif($odeme->odeme_tipi == 'Banka'){
            $firmahrkt->bankahareket_id = $bankahrkt->id;
        }
        $firmahrkt->islem = 'Ödeme';
        $firmahrkt->odeme_id = $odeme->id;
        $firmahrkt->borc = $odeme->odeme_tutar;
        $firmahrkt->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $odeme->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $odeme->odeme_tutar . ' ₺ ödeme kaydı Eklendi.';
        $log->save();

        return redirect('odemeler')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $odemeler =  Odemeler::find($id);
        return view('admin.contents.odemeler.odemeler-show',compact('odemeler'));
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
        $odeme = Odemeler::find($id);
        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $odeme->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' . $odeme->odeme_tutar . ' ₺ ödeme kaydı Silindi.';
        $log->save();

        $firmahrkt = Firmahrkt::where('odeme_id',$odeme->id);
        $firmahrkt->delete();

        if ($odeme->odeme_tipi == 'Banka') {
            $bankahrkt = Bankahrkt::where('odeme_id', $odeme->id)->first();

            if ($bankahrkt) {
                $banka = Bankalar::find($odeme->banka_id);
                if ($banka) {
                    $banka->bakiye += $bankahrkt->eklenen_tutar;
                    $banka->save();
                }

                $bankahrkt->delete();
            }
        } elseif ($odeme->odeme_tipi === 'Kasa') {
            $kasahrkt = Kasahrkt::where('odeme_id', $odeme->id)->first();

            if ($kasahrkt) {
                $kasa = Kasalar::find($odeme->kasa_id);
                if ($kasa) {
                    $kasa->bakiye += $kasahrkt->eklenen_tutar;
                    $kasa->save();
                }

                $kasahrkt->delete();
            }
        }


        $odeme->delete();

        return redirect('odemeler')->with('success', 'Ödeme ve ilgili işlemler başarıyla silindi.');
    }
}
