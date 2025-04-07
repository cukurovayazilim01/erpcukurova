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

    public function anasayfa(){

        $user = User::where('durum','Aktif')->get();
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

        $ayliksatisgrafigi = Firmahrkt::whereNotNull('satis_id')->orWhereNotNull('alis_id')->orderBy('id', 'desc')->get();
        $tahsilatodemechart = Firmahrkt::where(function($query) {
            $query->whereNotNull('tahsilat_id')
                  ->orWhereNotNull('odeme_id');
        })
        ->whereDate('islem_tarihi', Carbon::today()) // Sadece bugünün tarihine ait kayıtlar
        ->orderBy('id', 'desc')
        ->get();

        $currentYear = date('Y'); // Şu anki yılı al (2025)
        $personelhedefgrafigi = Pyillikhedefler::whereYear('islem_tarihi', $currentYear)->get();

        $yillikizingrafigi = Yillikizinhakki::where('yili', $currentYear)->get();


        return view('anasayfa',compact('user','markatakip','itiraztakip','aramalar','tescilnoksan','ayliksatisgrafigi','tahsilatodemechart','personelhedefgrafigi','yillikizingrafigi'));
    }



}
