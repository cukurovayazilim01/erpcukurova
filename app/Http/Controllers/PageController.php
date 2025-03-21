<?php

namespace App\Http\Controllers;


use App\Models\Aramalar;
use App\Models\Itiraztakip;
use App\Models\Markatakip;
use App\Models\Tescilnoksan;
use App\Models\User;
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
        return view('anasayfa',compact('user','markatakip','itiraztakip','aramalar','tescilnoksan'));
    }

}
