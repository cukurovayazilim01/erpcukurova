<?php

namespace App\Http\Controllers;

use App\Models\Aramalar;
use App\Models\Bankalar;
use App\Models\Firmahrkt;
use App\Models\Hizmetler;
use App\Models\Hizmetlerkategori;
use App\Models\Kasalar;
use App\Models\Satislardata;
use App\Models\Teklifler;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class RaporlarController extends Controller
{
    public function raporlar()
    {
        $kasalar = Kasalar::all();
        $bankalar = Bankalar::all();
        $user = User::all();
        $hizmetkategori = Hizmetlerkategori::all();
        $hizmetler = Hizmetler::all();
        return view('admin.contents.raporlar.raporlar', compact('kasalar', 'bankalar', 'user', 'hizmetkategori', 'hizmetler'));
    }

    public function carihesaprapor(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $carihesapekstre = Firmahrkt::query();

        if ($cari_id) {
            $carihesapekstre->where('cari_id', $cari_id);
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                $carihesapekstre->whereDate('islem_tarihi', $baslangic);
            } else {
                $carihesapekstre->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $carihesapekstre->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            $son = Carbon::parse($son_tarih)->endOfDay();
            $carihesapekstre->where('islem_tarihi', '<=', $son);
        } else {
            $carihesapekstre->whereNotNull('islem_tarihi');
        }

        // `orWhereDoesntHave` koşulunu bir grup içinde tanımlıyoruz
        $carihesapekstre->where(function ($query) {
            $query->whereNotIn('islem', ['Gelen Çek', 'Giden Çek']) // Hem Gelen Çek hem de Giden Çek hariç
                ->orWhereDoesntHave('ceksenet', function ($subQuery) {
                    $subQuery->where('pasifcekme_durum', '1'); // pasif çekme durumunda olmayanlar
                });
        });

        $carihesapekstre = $carihesapekstre->orderBy('id', 'desc')->get();


        // dd($carihesapekstre);
        return view('admin.contents.raporlar.raporpdf.carihesapekstre', compact('carihesapekstre', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'cari_id'));
    }
    public function satisrapor(Request $request)
    {

        $teklifler = Teklifler::query();

        $cari_id = $request->input('cari_id');
        $islem_yapan = $request->input('islem_yapan');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $satisrapor = Firmahrkt::query();


        if ($cari_id) {
            $satisrapor->where('cari_id', $cari_id);
        }

          // İşlem yapan kişi filtresi
          if (!empty($islem_yapan)) {
            $satisrapor->where('islem_yapan', $islem_yapan);
        }
        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $satisrapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $satisrapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $satisrapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $satisrapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $satisrapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        // $satisrapor = $satisrapor->get();
        $satisrapor = $satisrapor->whereNotNull('satis_id')->orderBy('id', 'desc')->get();
        if (!empty($islem_yapan)) {
            $teklifler->where('user_id', $islem_yapan);
        }
        $teklifler = $teklifler->orderBy('id', 'desc')->get();

        // dd($satisrapor);
        $satisraporencokurun = Satislardata::with('hizmetler')
            ->whereNull('deleted_at') // deleted_at sütunu NULL olanları al
            ->select('hizmet_id', DB::raw('SUM(satis_hizmet_miktar) as toplam_miktar'))
            ->groupBy('hizmet_id')
            ->orderByDesc('toplam_miktar')
            ->take(5)
            ->get();

        $enCokSatisFirmalari = DB::table('satislars')
            ->join('carilers', 'satislars.cari_id', '=', 'carilers.id') // satislar tablosunu cari tablosu ile birleştir
            ->select(
                'cari_id as cari_id',
                'carilers.firma_unvan as firma_unvan', // Firma adını al
                DB::raw('SUM(satislars.satis_kdvli_toplam) as toplam_satis') // Toplam satış tutarını hesapla
            )
            ->whereNull('satislars.deleted_at') // deleted_at sütunu NULL olanları al
            ->groupBy('cari_id', 'carilers.firma_unvan') // Firma adına göre gruplandır
            ->orderByDesc('toplam_satis') // Büyükten küçüğe sırala
            ->take(5) // İlk 5 firmayı al
            ->get();
        return view('admin.contents.raporlar.raporpdf.satisrapor', compact('satisrapor', 'teklifler','islem_yapan','ilk_tarih', 'son_tarih', 'islem_tarihi', 'satisraporencokurun', 'enCokSatisFirmalari', 'cari_id'));
    }
    public function alisrapor(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $alisrapor = Firmahrkt::query();

        if ($cari_id) {
            $alisrapor->where('cari_id', $cari_id);
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $alisrapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $alisrapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $alisrapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $alisrapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $alisrapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        $alisrapor = $alisrapor->whereNotNull('alis_id')->orderBy('id', 'desc')->get();

        // dd($alisrapor);
        $enCokAlisFirmalari = DB::table('alislars')
            ->join('carilers', 'alislars.cari_id', '=', 'carilers.id') // satislar tablosunu cari tablosu ile birleştir
            ->select(
                'cari_id as cari_id',
                'carilers.firma_unvan as firma_unvan', // Firma adını al
                DB::raw('SUM(alislars.toplam_tutar) as toplam_alis') // Toplam satış tutarını hesapla
            )
            ->whereNull('alislars.deleted_at') // deleted_at sütunu NULL olanları al
            ->groupBy('cari_id', 'carilers.firma_unvan') // Firma adına göre gruplandır
            ->orderByDesc('toplam_alis') // Büyükten küçüğe sırala
            ->take(5) // İlk 5 firmayı al
            ->get();
        return view('admin.contents.raporlar.raporpdf.alisrapor', compact('alisrapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'enCokAlisFirmalari', 'cari_id'));
    }
    public function tahsilatrapor(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $tahsilatrapor = Firmahrkt::query();

        if ($cari_id) {
            $tahsilatrapor->where('cari_id', $cari_id);
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $tahsilatrapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $tahsilatrapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $tahsilatrapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $tahsilatrapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $tahsilatrapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        $tahsilatrapor = $tahsilatrapor->whereNotNull('tahsilat_id')->orderBy('id', 'desc')->get();

        // dd($tahsilatrapor);
        $enCokTahsilatFirmalari = DB::table('tahsilats')
            ->join('carilers', 'tahsilats.cari_id', '=', 'carilers.id') // satislar tablosunu cari tablosu ile birleştir
            ->select(
                'cari_id as cari_id',
                'carilers.firma_unvan as firma_unvan', // Firma adını al
                DB::raw('SUM(tahsilats.tahsilat_tutar) as toplam_tahsilat') // Toplam satış tutarını hesapla
            )
            ->whereNull('tahsilats.deleted_at') // deleted_at sütunu NULL olanları al
            ->groupBy('cari_id', 'carilers.firma_unvan') // Firma adına göre gruplandır
            ->orderByDesc('toplam_tahsilat') // Büyükten küçüğe sırala
            ->take(5) // İlk 5 firmayı al
            ->get();
        return view('admin.contents.raporlar.raporpdf.tahsilatrapor', compact('tahsilatrapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'enCokTahsilatFirmalari', 'cari_id'));
    }

    public function odemerapor(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $odemerapor = Firmahrkt::query();

        if ($cari_id) {
            $odemerapor->where('cari_id', $cari_id);
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $odemerapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $odemerapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $odemerapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $odemerapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $odemerapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        $odemerapor = $odemerapor->whereNotNull('odeme_id')->orderBy('id', 'desc')->get();

        // dd($odemerapor);
        $enCokOdemeFirmalari = DB::table('odemelers')
            ->join('carilers', 'odemelers.cari_id', '=', 'carilers.id') // satislar tablosunu cari tablosu ile birleştir
            ->select(
                'cari_id as cari_id',
                'carilers.firma_unvan as firma_unvan', // Firma adını al
                DB::raw('SUM(odemelers.odeme_tutar) as toplam_odeme') // Toplam satış tutarını hesapla
            )
            ->whereNull('odemelers.deleted_at') // deleted_at sütunu NULL olanları al
            ->groupBy('cari_id', 'carilers.firma_unvan') // Firma adına göre gruplandır
            ->orderByDesc('toplam_odeme') // Büyükten küçüğe sırala
            ->take(5) // İlk 5 firmayı al
            ->get();
        return view('admin.contents.raporlar.raporpdf.odemerapor', compact('odemerapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'enCokOdemeFirmalari', 'cari_id'));
    }

    public function giderrapor(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $giderrapor = Firmahrkt::query();

        if ($cari_id) {
            $giderrapor->where('cari_id', $cari_id);
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $giderrapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $giderrapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $giderrapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $giderrapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $giderrapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        $giderrapor = $giderrapor->whereNotNull('alis_id')->orderBy('id', 'desc')->get();

        // dd($giderrapor);
        $enCokAlisFirmalari = DB::table('alislars')
            ->join('carilers', 'alislars.cari_id', '=', 'carilers.id') // satislar tablosunu cari tablosu ile birleştir
            ->select(
                'cari_id as cari_id',
                'carilers.firma_unvan as firma_unvan', // Firma adını al
                DB::raw('SUM(alislars.toplam_tutar) as toplam_alis') // Toplam satış tutarını hesapla
            )
            ->whereNull('alislars.deleted_at') // deleted_at sütunu NULL olanları al
            ->groupBy('cari_id', 'carilers.firma_unvan') // Firma adına göre gruplandır
            ->orderByDesc('toplam_alis') // Büyükten küçüğe sırala
            ->take(5) // İlk 5 firmayı al
            ->get();
        return view('admin.contents.raporlar.raporpdf.giderrapor', compact('giderrapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'enCokAlisFirmalari', 'cari_id'));
    }
    public function kasarapor(Request $request)
    {
        $kasalar = $request->input('kasa_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $kasarapor = Firmahrkt::query();

        if ($kasalar) {
            $kasarapor->whereHas('kasahrkt', function ($query) use ($kasalar) {
                $query->where('kasa_id', $kasalar);
            });
        }


        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $kasarapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $kasarapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $kasarapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $kasarapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $kasarapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        $kasarapor = $kasarapor->whereNotNull('kasahareket_id')->get();


        // dd($kasarapor);
        $enCokOdemeFirmalari = DB::table('odemelers')
            ->join('carilers', 'odemelers.cari_id', '=', 'carilers.id') // satislar tablosunu cari tablosu ile birleştir
            ->select(
                'cari_id as cari_id',
                'carilers.firma_unvan as firma_unvan', // Firma adını al
                DB::raw('SUM(odemelers.odeme_tutar) as toplam_odeme') // Toplam satış tutarını hesapla
            )
            ->whereNull('odemelers.deleted_at') // deleted_at sütunu NULL olanları al
            ->groupBy('cari_id', 'carilers.firma_unvan') // Firma adına göre gruplandır
            ->orderByDesc('toplam_odeme') // Büyükten küçüğe sırala
            ->take(5) // İlk 5 firmayı al
            ->get();
        return view('admin.contents.raporlar.raporpdf.kasarapor', compact('kasarapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'enCokOdemeFirmalari', 'kasalar'));
    }
    public function bankarapor(Request $request)
    {
        $bankalar = $request->input('banka_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $bankarapor = Firmahrkt::query();


        if ($bankalar) {
            $bankarapor->whereHas('bankahrkt', function ($query) use ($bankalar) {
                $query->where('banka_id', $bankalar);
            });
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $bankarapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $bankarapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $bankarapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $bankarapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $bankarapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        $bankarapor = $bankarapor->whereNotNull('bankahareket_id')->get();


        // dd($bankarapor);
        $enCokOdemeFirmalari = DB::table('odemelers')
            ->join('carilers', 'odemelers.cari_id', '=', 'carilers.id') // satislar tablosunu cari tablosu ile birleştir
            ->select(
                'cari_id as cari_id',
                'carilers.firma_unvan as firma_unvan', // Firma adını al
                DB::raw('SUM(odemelers.odeme_tutar) as toplam_odeme') // Toplam satış tutarını hesapla
            )
            ->whereNull('odemelers.deleted_at') // deleted_at sütunu NULL olanları al
            ->groupBy('cari_id', 'carilers.firma_unvan') // Firma adına göre gruplandır
            ->orderByDesc('toplam_odeme') // Büyükten küçüğe sırala
            ->take(5) // İlk 5 firmayı al
            ->get();
        return view('admin.contents.raporlar.raporpdf.bankarapor', compact('bankarapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'enCokOdemeFirmalari', 'bankalar'));
    }

    public function borctakiprapor(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $borctakiprapor = Firmahrkt::query();

        if ($cari_id) {
            $borctakiprapor->where('cari_id', $cari_id);
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                $borctakiprapor->whereDate('islem_tarihi', $baslangic);
            } else {
                $borctakiprapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $borctakiprapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            $son = Carbon::parse($son_tarih)->endOfDay();
            $borctakiprapor->where('islem_tarihi', '<=', $son);
        } else {
            $borctakiprapor->whereNotNull('islem_tarihi');
        }

        // `orWhereDoesntHave` koşulunu bir grup içinde tanımlıyoruz
        $borctakiprapor->where(function ($query) {
            $query->whereNotIn('islem', ['Gelen Çek', 'Giden Çek']) // Hem Gelen Çek hem de Giden Çek hariç
                ->orWhereDoesntHave('ceksenet', function ($subQuery) {
                    $subQuery->where('pasifcekme_durum', '1'); // pasif çekme durumunda olmayanlar
                });
        });

        $borctakiprapor = $borctakiprapor->orderBy('id', 'desc')->get();

        // dd($borctakiprapor);
        return view('admin.contents.raporlar.raporpdf.borctakiprapor', compact('borctakiprapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'cari_id'));
    }

    public function hizmetbazlipersonelrapor(Request $request)
    {
        $islem_yapan = $request->input('islem_yapan');
        $cari_id = $request->input('cari_id');

        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $hizmet_kategori = $request->input('hizmet_kategori');
        $hizmet_adi = $request->input('hizmet_adi');
        $il = $request->input('il');
        $islem_tarihi = Carbon::now();

        // Sorguyu başlat
        $hizmetbazlipersonelrapor = Firmahrkt::query();


        if ($cari_id) {
            $hizmetbazlipersonelrapor->where('cari_id', $cari_id);
        }

        // İşlem yapan kişi filtresi
        if (!empty($islem_yapan)) {
            $hizmetbazlipersonelrapor->where('islem_yapan', $islem_yapan);
        }


        // Tarih filtreleme
        if (!empty($ilk_tarih) && !empty($son_tarih)) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                $hizmetbazlipersonelrapor->whereDate('islem_tarihi', $baslangic);
            } else {
                $hizmetbazlipersonelrapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif (!empty($ilk_tarih)) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $hizmetbazlipersonelrapor->where('islem_tarihi', '>=', $baslangic);
        } elseif (!empty($son_tarih)) {
            $son = Carbon::parse($son_tarih)->endOfDay();
            $hizmetbazlipersonelrapor->where('islem_tarihi', '<=', $son);
        } else {
            $hizmetbazlipersonelrapor->whereNotNull('islem_tarihi');
        }
        // Hizmet kategorisi filtresi
        if (!empty($hizmet_kategori)) {
            $hizmetbazlipersonelrapor->whereHas('satis.satislardata', function ($query) use ($hizmet_kategori) {
                $query->where('hizmetlerkategori_id', $hizmet_kategori);
            });
        }
        if (!empty($hizmet_adi)) {
            $hizmetbazlipersonelrapor->whereHas('satis.satislardata', function ($query) use ($hizmet_adi) {
                $query->where('hizmet_id', $hizmet_adi);
            });
        }
        if (!empty($il)) {
            $hizmetbazlipersonelrapor->whereHas('firmaadi', function ($query) use ($il) {
                $query->where('il', $il);
            });
        }




        $hizmetbazlipersonelrapor = $hizmetbazlipersonelrapor->orderBy('id', 'desc')->get();

        // dd($hizmet_kategori);


        return view('admin.contents.raporlar.raporpdf.personelhizmet', compact('hizmetbazlipersonelrapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'islem_yapan', 'hizmet_kategori','hizmet_adi','il','cari_id'));
    }

    public function kdvrapor(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $islem_tarihi = Carbon::now();
        $kdvrapor = Firmahrkt::query();

        if ($cari_id) {
            $kdvrapor->where('cari_id', $cari_id);
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $kdvrapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $kdvrapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $kdvrapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $kdvrapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $kdvrapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        // $kdvrapor = $kdvrapor->get();
        $kdvrapor = $kdvrapor->orderBy('id', 'desc')->whereNotNull('satis_id')->orWhereNotNull('alis_id')->get();

        // dd($kdvrapor);

        return view('admin.contents.raporlar.raporpdf.kdvrapor', compact('kdvrapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'cari_id'));
    }
    public function aramarapor(Request $request)
    {
        $islem_yapan = $request->input('islem_yapan');
        $arama_tipi = $request->input('arama_tipi');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $il = $request->input('il');
        $islem_tarihi = Carbon::now();
        $aramarapor = Aramalar::query();

        if ($islem_yapan) {
            $aramarapor->where('islem_yapan', $islem_yapan);
        }
        if ($arama_tipi) {
            $aramarapor->where('arama_tipi', $arama_tipi);
        }
        if ($il) {
            $aramarapor->whereHas('cariler', function ($query) use ($il) {
                $query->where('il', $il);
            });
        }

        if ($ilk_tarih && $son_tarih) {
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $son = Carbon::parse($son_tarih)->endOfDay();

            if ($baslangic->equalTo($son)) {
                // Durum 1: İki aynı tarih seçildiyse, sadece bu tarihe ait veriler
                $aramarapor->whereDate('islem_tarihi', $baslangic);
            } else {
                // Durum 4: İki farklı tarih seçildiyse, belirtilen aralıktaki veriler
                $aramarapor->whereBetween('islem_tarihi', [$baslangic, $son]);
            }
        } elseif ($ilk_tarih) {
            // Durum 2: Sadece ilk tarih seçildiyse, o tarihten sonraki veriler
            $baslangic = Carbon::parse($ilk_tarih)->startOfDay();
            $aramarapor->where('islem_tarihi', '>=', $baslangic);
        } elseif ($son_tarih) {
            // Durum 3: Sadece son tarih seçildiyse, o tarihten önceki veriler
            $son = Carbon::parse($son_tarih)->endOfDay();
            $aramarapor->where('islem_tarihi', '<=', $son);
        } else {
            // Durum 6: Hiçbir tarih seçilmediyse, tüm veriler
            $aramarapor->whereNotNull('islem_tarihi'); // veya tüm verileri çekmek için herhangi bir filtre uygulanmaz
        }
        // $aramarapor = $aramarapor->get();
        $aramarapor = $aramarapor->orderBy('id', 'desc')->get();



        // dd($aramarapor);

        return view('admin.contents.raporlar.raporpdf.aramarapor', compact('aramarapor', 'ilk_tarih', 'son_tarih', 'islem_tarihi', 'islem_yapan'));
    }
}
