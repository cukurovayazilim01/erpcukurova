<?php

namespace App\Http\Controllers;


use App\Models\Aramalar;
use App\Models\Firmahrkt;
use App\Models\Itiraztakip;
use App\Models\Markatakip;
use App\Models\Pyillikhedefler;
use App\Models\Tescilnoksan;
use App\Models\User;
use App\Models\Yillikizinhakki;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function anasayfa(Request $request)
    {

        $user = User::where('durum', 'Aktif')->get();
        $markatakip = Markatakip::where('yenileme_tarih', '<=', Carbon::now()->subYear())->get();
        $itiraztakip = Itiraztakip::where('teblig_bitis_tarihi', '>=', Carbon::now())
            ->where('teblig_bitis_tarihi', '<=', Carbon::now()->addWeeks(2))
            ->get();
        $aramalar = Aramalar::where('hatirlat_tarihi', '>=', Carbon::now())
            ->where('hatirlat_tarihi', '<=', Carbon::now()->addWeeks(2))
            ->get();
        $tescilnoksan = Tescilnoksan::where('teblig_bitis_tarihi', '>=', Carbon::now())
            ->where('teblig_bitis_tarihi', '<=', Carbon::now()->addMonths(1))
            ->get();

        // Her grafik için farklı yıl al
    $yil_satinalis   = $request->input('yil_satinalis', date('Y'));
    $yil_personel    = $request->input('yil_personel', date('Y'));
    $yil_kategori    = $request->input('yil_kategori', date('Y'));
    $yil_hedef       = $request->input('yil_hedef', date('Y'));
    $yil_izin        = $request->input('yil_izin', date('Y'));

    // Satış & Alış Grafiği
    $ayliksatisgrafigi = Firmahrkt::with(['satis.satislardata', 'alis.alislardata'])
        ->where(function ($query) use ($yil_satinalis) {
            $query->whereHas('satis', function ($q) use ($yil_satinalis) {
                $q->whereYear('satis_tarihi', $yil_satinalis);
            })
            ->orWhereHas('alis', function ($q) use ($yil_satinalis) {
                $q->whereYear('fis_tarihi', $yil_satinalis);
            });
        })
        ->where(function ($query) {
            $query->whereNotNull('satis_id')
                  ->orWhereNotNull('alis_id');
        })
        ->orderBy('id', 'desc')
        ->get();

        $ayliksatisgrafigipersonel = Firmahrkt::with(['satis.satislardata', 'alis.alislardata'])
        ->where(function ($query) use ($yil_personel) {
            $query->whereHas('satis', function ($q) use ($yil_personel) {
                $q->whereYear('satis_tarihi', $yil_personel);
            })
            ->orWhereHas('alis', function ($q) use ($yil_personel) {
                $q->whereYear('fis_tarihi', $yil_personel);
            });
        })
        ->where(function ($query) {
            $query->whereNotNull('satis_id')
                  ->orWhereNotNull('alis_id');
        })
        ->orderBy('id', 'desc')
        ->get();

        $ayliksatisgrafigikategori = Firmahrkt::with(['satis.satislardata', 'alis.alislardata'])
        ->where(function ($query) use ($yil_kategori) {
            $query->whereHas('satis', function ($q) use ($yil_kategori) {
                $q->whereYear('satis_tarihi', $yil_kategori);
            })
            ->orWhereHas('alis', function ($q) use ($yil_kategori) {
                $q->whereYear('fis_tarihi', $yil_kategori);
            });
        })
        ->where(function ($query) {
            $query->whereNotNull('satis_id')
                  ->orWhereNotNull('alis_id');
        })
        ->orderBy('id', 'desc')
        ->get();

    // Günlük Tahsilat ve Ödeme (bugünün tarihi)
    $tahsilatodemechart = Firmahrkt::where(function ($query) {
        $query->whereNotNull('tahsilat_id')
              ->orWhereNotNull('odeme_id');
    })
    ->whereDate('islem_tarihi', Carbon::today())
    ->orderBy('id', 'desc')
    ->get();

    // Personel Hedef Grafiği
    $personelhedefgrafigi = Pyillikhedefler::whereYear('islem_tarihi', $yil_hedef)->get();

    // Yıllık İzin Grafiği
    $yillikizingrafigi = Yillikizinhakki::where('yili', $yil_izin)->get();


        return view('anasayfa', compact('user', 'markatakip', 'itiraztakip', 'aramalar', 'tescilnoksan','ayliksatisgrafigi','ayliksatisgrafigipersonel','ayliksatisgrafigikategori',
        'tahsilatodemechart',
        'personelhedefgrafigi',
        'yillikizingrafigi',
        'yil_satinalis',
        'yil_personel',
        'yil_kategori',
        'yil_hedef',
        'yil_izin'
));
    }
}
