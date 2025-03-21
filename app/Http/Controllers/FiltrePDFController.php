<?php

namespace App\Http\Controllers;

use App\Models\Itiraztakip;
use App\Models\Tescilnoksan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FiltrePDFController extends Controller
{
    public function itiraztakipFiltreliPDF(Request $request)
    {
        $cari_id = $request->input('firma_adi');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $satis_temsilcisi = $request->input('satis_temsilcisi');
        $date = Carbon::now()->format('Y-m-d');
        $query = Itiraztakip::query();

        if ($cari_id) {
            $query->where('firma_adi', $cari_id);
        }
        if ($satis_temsilcisi) {
            $query->where('satis_temsilcisi', $satis_temsilcisi);
        }

        if ($ilk_tarih || $son_tarih) {
            $baslangic = $ilk_tarih ? Carbon::parse($ilk_tarih)->startOfDay() : null;
            $son = $son_tarih ? Carbon::parse($son_tarih)->endOfDay() : null;

            if ($baslangic && $son) {
                $query->whereBetween('teblig_bitis_tarihi', [$baslangic, $son]);
            } elseif ($baslangic) {
                $query->where('teblig_bitis_tarihi', '>=', $baslangic);
            } elseif ($son) {
                $query->where('teblig_bitis_tarihi', '<=', $son);
            }
        }

        $data = $query->get();

        // PDF için başlangıç numarasını hesapla
        $startNumber = $data->count();

        // PDF oluşturma işlemi
        $pdf = Pdf::loadView('admin.contents.itiraztakip.itiraztakip_pdf', compact('data', 'startNumber'));
        return $pdf->download("itiraztakip_filtered_{$date}.pdf");

    }
    public function tescilnoksanFiltreliPDF(Request $request)
    {
        $cari_id = $request->input('firma_adi');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $satis_temsilcisi = $request->input('satis_temsilcisi');
        $date = Carbon::now()->format('Y-m-d');
        $query = Tescilnoksan::query();

        if ($cari_id) {
            $query->where('firma_adi', $cari_id);
        }
        if ($satis_temsilcisi) {
            $query->where('satis_temsilcisi', $satis_temsilcisi);
        }

        if ($ilk_tarih || $son_tarih) {
            $baslangic = $ilk_tarih ? Carbon::parse($ilk_tarih)->startOfDay() : null;
            $son = $son_tarih ? Carbon::parse($son_tarih)->endOfDay() : null;

            if ($baslangic && $son) {
                $query->whereBetween('teblig_bitis_tarihi', [$baslangic, $son]);
            } elseif ($baslangic) {
                $query->where('teblig_bitis_tarihi', '>=', $baslangic);
            } elseif ($son) {
                $query->where('teblig_bitis_tarihi', '<=', $son);
            }
        }

        $data = $query->get();
        // PDF için başlangıç numarasını hesapla
        $startNumber = $data->count();

        // PDF oluşturma işlemi
        $pdf = Pdf::loadView('admin.contents.tescilnoksan.tescilnoksan_pdf', compact('data', 'startNumber'));
        return $pdf->download("tescilnoksan_filtered_{$date}.pdf");

    }
}
