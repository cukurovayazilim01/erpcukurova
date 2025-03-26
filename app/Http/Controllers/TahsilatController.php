<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Bankahrkt;
use App\Models\Bankalar;
use App\Models\Cariler;
use App\Models\Firmahrkt;
use App\Models\Kasahrkt;
use App\Models\Kasalar;
use App\Models\Tahsilat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TahsilatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function firmahrktaktartahsilat()
{
    try {
        $tahsilatlar = Tahsilat::all(); // Tüm tahsilatları al

        if ($tahsilatlar->isEmpty()) {
            return redirect('tahsilat')->with('warning', 'Aktarılacak Tahsilat Kaydı Bulunamadı!');
        }

        $firmaHareketleri = []; // Firma hareketleri için dizi

        foreach ($tahsilatlar as $tahsilat) {
            $kasahareket_id = null;
            $bankahareket_id = null;

            if ($tahsilat->odeme_tipi == 'Banka') {
                $sonHareket = Bankahrkt::where('banka_id', $tahsilat->banka_id)
                    ->orderBy('id', 'desc')
                    ->first();

                $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $tahsilat->bankaadi->bakiye;

                $bankahrkt = Bankahrkt::create([
                    'tahsilat_id'    => $tahsilat->id,
                    'banka_id'       => $tahsilat->banka_id,
                    'hareket_saati'  => $tahsilat->tarih,
                    'hareket_tipi'   => $tahsilat->odeme_turu === 'EFT' ? 'Gelen EFT' : 'Gelen Havale',
                    'bakiye'         => $oncekiBakiye,
                    'eklenen_tutar'  => $tahsilat->tahsilat_tutar,
                    'guncel_bakiye'  => $oncekiBakiye + $tahsilat->tahsilat_tutar,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now()
                ]);

                $bankahareket_id = $bankahrkt->id;

            } elseif ($tahsilat->odeme_tipi === 'Kasa') {
                $sonHareket = Kasahrkt::where('kasa_id', $tahsilat->kasa_id)
                    ->orderBy('id', 'desc')
                    ->first();

                $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $tahsilat->kasaadi->bakiye;

                $kasahrkt = Kasahrkt::create([
                    'tahsilat_id'    => $tahsilat->id,
                    'kasa_id'        => $tahsilat->kasa_id,
                    'hareket_saati'  => $tahsilat->tarih,
                    'hareket_tipi'   => 'Gelen Nakit',
                    'bakiye'         => $oncekiBakiye,
                    'eklenen_tutar'  => $tahsilat->tahsilat_tutar,
                    'guncel_bakiye'  => $oncekiBakiye + $tahsilat->tahsilat_tutar,
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now()
                ]);

                $kasahareket_id = $kasahrkt->id;
            }

            $firmaHareketleri[] = [
                'islem_tarihi'     => $tahsilat->tarih,
                'tarih'            => Carbon::now(),
                'islem_yapan'      => Auth::user()->id,
                'cari_id'          => $tahsilat->cari_id,
                'kasahareket_id'   => $kasahareket_id,
                'bankahareket_id'  => $bankahareket_id,
                'islem'            => 'Tahsilat',
                'tahsilat_id'      => $tahsilat->id,
                'alacak'           => $tahsilat->tahsilat_tutar,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now()
            ];
        }

        Firmahrkt::insert($firmaHareketleri);

        return redirect('tahsilat')->with('success', 'Tüm Tahsilatlar Firma Hareketlerine Başarıyla Aktarıldı');
    } catch (\Exception $e) {
        return redirect('tahsilat')->with('error', 'Aktarım sırasında bir hata oluştu: ' . $e->getMessage());
    }
}
    public function tahsilatsearch(Request $request)
    {
        $tahsilatsearch = $request->input('tahsilatsearch');

        // Eğer arama yapılmışsa
        if ($tahsilatsearch) {
            $tahsilat = Tahsilat::orderByDesc('id')
                ->whereHas('firmaadi',function($query) use ($tahsilatsearch) {
                    $query->where('firma_unvan', 'like', '%' . $tahsilatsearch . '%');
                })
                ->paginate(50);

            // Sayfa numarasını hesapla
            $page = $request->query('page', 1);
            $perPage = 50;
            $startNumber = $tahsilat->total() - (($page - 1) * $perPage);

            $user = User::all();

            // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
            if ($request->ajax()) {
                return view('admin.contents.tahsilat.tahsilat-search', compact('tahsilat', 'startNumber', 'user'));
            }

            // Normal sayfa için arama sonucu döndür
            return view('admin.contents.tahsilat.tahsilat', compact('tahsilat', 'startNumber', 'user'));
        }

        // Arama yapılmamışsa ana sayfayı döndür
        return view('admin.contents.tahsilat.tahsilat');
    }

    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        // $cariler = Cariler::all();
        $tahsilat = Tahsilat::orderBy('created_at', 'desc')->paginate($perPage);
        $page = $tahsilat->currentPage();
        $startNumber = $tahsilat->total() - (($page - 1) * $perPage);
        $user = User::all();
        return view('admin.contents.tahsilat.tahsilat', compact('tahsilat', 'startNumber', 'perPage','user'));
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
        return view('admin.contents.tahsilat.tahsilat-create', compact('cariler', 'user', 'kasalar', 'bankalar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tahsilat_max_no = Tahsilat::max('tahsilat_kodu');
        $tahsilat = new Tahsilat();
        $tahsilat->tahsilat_kodu = empty($tahsilat_max_no) ? 1 : $tahsilat_max_no + 1;
        $tahsilat->tahsilat_kodu_text = 'TF';
        $tahsilat->islem_yapan = Auth::user()->id;
        $tahsilat->islem_tarihi = Carbon::now();
        $tahsilat->tarih = $request->tarih;
        $tahsilat->cari_id = $request->cari_id;
        $tahsilat->tahsileden_id = $request->tahsileden_id;

        $tahsilat->odeme_yapan = $request->odeme_yapan;
        $tahsilat->odeme_tipi = $request->odeme_tipi;
        $tahsilat->odeme_turu = $request->odeme_turu;


        $tahsilat->kasa_id = $request->kasa_id;
        $tahsilat->banka_id = $request->banka_id;
        $tahsilat->tahsilat_tutar = $request->tahsilat_tutar;
        $tahsilat->save();


        if ($tahsilat->odeme_tipi == 'Banka') {
            // Banka hareketi işlemleri
            $sonHareket = Bankahrkt::where('banka_id', $tahsilat->banka_id)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $tahsilat->bankaadi->bakiye;

            $bankahrkt = new Bankahrkt();
            $bankahrkt->tahsilat_id = $tahsilat->id;
            $bankahrkt->banka_id = $tahsilat->banka_id;
            $bankahrkt->hareket_saati = $tahsilat->tarih;
            $bankahrkt->hareket_tipi = $tahsilat->odeme_turu === 'EFT' ? 'Gelen EFT' : 'Gelen Havale';
            $bankahrkt->bakiye = $oncekiBakiye;
            $bankahrkt->eklenen_tutar = $tahsilat->tahsilat_tutar;
            $bankahrkt->guncel_bakiye = $bankahrkt->bakiye + $bankahrkt->eklenen_tutar;
            $bankahrkt->save();

            $banka = Bankalar::find($tahsilat->banka_id);
            $banka->bakiye = $banka->bakiye + $tahsilat->tahsilat_tutar;
            $banka->save();
        } elseif ($tahsilat->odeme_tipi === 'Kasa') {
            // Kasa hareketi işlemleri
            $sonHareket = Kasahrkt::where('kasa_id', $tahsilat->kasa_id)
                ->orderBy('id', 'desc') // En son hareketi al
                ->first();

            $oncekiBakiye = $sonHareket ? $sonHareket->guncel_bakiye : $tahsilat->kasaadi->bakiye;

            $kasahrkt = new Kasahrkt();
            $kasahrkt->tahsilat_id = $tahsilat->id;
            $kasahrkt->kasa_id = $tahsilat->kasa_id;
            $kasahrkt->hareket_saati = $tahsilat->tarih;
            $kasahrkt->hareket_tipi = 'Gelen Nakit';
            $kasahrkt->bakiye = $oncekiBakiye;
            $kasahrkt->eklenen_tutar = $tahsilat->tahsilat_tutar;
            $kasahrkt->guncel_bakiye = $kasahrkt->bakiye + $kasahrkt->eklenen_tutar;
            $kasahrkt->save();

            $kasa = Kasalar::find($tahsilat->kasa_id);
            $kasa->bakiye = $kasa->bakiye + $tahsilat->tahsilat_tutar;
            $kasa->save();
        }

        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $tahsilat->tarih;
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id =  $tahsilat->cari_id;
        if ($tahsilat->odeme_tipi == 'Kasa'){
            $firmahrkt->kasahareket_id = $kasahrkt->id;
        }
        elseif($tahsilat->odeme_tipi == 'Banka'){
            $firmahrkt->bankahareket_id = $bankahrkt->id;
        }
        $firmahrkt->islem = 'Tahsilat';
        $firmahrkt->tahsilat_id = $tahsilat->id;
        $firmahrkt->alacak = $tahsilat->tahsilat_tutar;
        $firmahrkt->save();


        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $tahsilat->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' .$tahsilat->tahsilat_kodu_text.'-'. $tahsilat->tahsilat_kodu .' kodlu'. $tahsilat->tahsilat_tutar . ' ₺ Tahsilat kaydı Eklendi.';

        $log->save();


        return redirect('tahsilat')->with('success', 'Ekleme Başarılı');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tahsilat = Tahsilat::find($id);
        return view('admin.contents.tahsilat.tahsilat-show',compact('tahsilat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

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
        $tahsilat = Tahsilat::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $tahsilat->firmaadi->firma_unvan . ' ' . 'Carisine' . ' ' .$tahsilat->tahsilat_kodu_text.'-'. $tahsilat->tahsilat_kodu .' kodlu'. $tahsilat->tahsilat_tutar . ' ₺ Tahsilat kaydı Silindi.';
        $log->save();
        $firmahrkt = Firmahrkt::where('tahsilat_id',$tahsilat->id)->first();
        $firmahrkt->delete();

        if ($tahsilat->odeme_tipi == 'Banka') {
            $bankahrkt = Bankahrkt::where('tahsilat_id', $tahsilat->id)->first();

            if ($bankahrkt) {
                $banka = Bankalar::find($tahsilat->banka_id);
                if ($banka) {
                    $banka->bakiye -= $bankahrkt->eklenen_tutar;
                    $banka->save();
                }

                $bankahrkt->delete();
            }
        } elseif ($tahsilat->odeme_tipi === 'Kasa') {
            $kasahrkt = Kasahrkt::where('tahsilat_id', $tahsilat->id)->first();

            if ($kasahrkt) {
                $kasa = Kasalar::find($tahsilat->kasa_id);
                if ($kasa) {
                    $kasa->bakiye -= $kasahrkt->eklenen_tutar;
                    $kasa->save();
                }

                $kasahrkt->delete();
            }
        }
        $tahsilat->delete();

        return redirect('tahsilat')->with('success', 'Tahsilat ve ilgili işlemler başarıyla silindi.');
    }
}
