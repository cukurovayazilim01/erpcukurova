<?php

namespace App\Http\Controllers;

use App\Exports\ItiraztakipExport;
use App\Exports\MarkatakipExport;
use App\Exports\TescilnoksanExport;
use App\Models\Itiraztakip;
use App\Models\Markatakip;
use App\Models\Tescilnoksan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;


class ExcelController extends Controller
{
    public function export(Request $request, $type, Excel $excel)
    {
        // Filtreleri al
        $filters = $request->only(['cari_id', 'ilk_tarih', 'son_tarih', 'satis_temsilcisi', 'sehir','firma_adi']);

        // Sayfalama için perPage değeri
        $perPage = $request->input('entries', 20);

        // Şu anki tarihi al (format: Y-m-d_H-i-s)
        $date = Carbon::now()->format('Y-m-d_H-i-s');

        // Excel dosyasını indirme işlemine başla
        switch ($type) {
            case 'marka':
                // Marka Takip verilerini filtrele
                $query = Markatakip::query();

                // Filtreler uygulandı
                if (!empty($filters['cari_id'])) {
                    $query->where('cari_id', $filters['cari_id']);
                }
                if (!empty($filters['ilk_tarih'])) {
                    $query->whereDate('basvuru_tarihi', '>=', Carbon::parse($filters['ilk_tarih'])->startOfDay());
                }
                if (!empty($filters['son_tarih'])) {
                    $query->whereDate('basvuru_tarihi', '<=', Carbon::parse($filters['son_tarih'])->endOfDay());
                }
                if (!empty($filters['satis_temsilcisi'])) {
                    $query->where('satis_temsilcisi', $filters['satis_temsilcisi']);
                }
                if (!empty($filters['sehir'])) {
                    $query->where('sehir', $filters['sehir']);
                }

                // Sayfalandırma
                $markatakip = $query->orderByDesc('id')->paginate($perPage);

                // Excel'de sayfa numarasını belirlemek
                $page = $markatakip->currentPage();
                $startNumber = $markatakip->total() - (($page - 1) * $perPage);

                // Dosya adını belirle
                $fileName1 = "marka_takip_{$date}.xlsx";

                // Excel export işlemini başlat
                return $excel->download(new MarkaTakipExport($filters, $markatakip), $fileName1);
                break;

            case 'itiraztakip':
                // İtiraz Takip verilerini filtrele
                $query = Itiraztakip::query();

                // İtiraztakip için filtreleme işlemleri burada
                if (!empty($filters['cari_id'])) {
                    $query->where('cari_id', $filters['cari_id']);
                }
                if (!empty($filters['firma_adi'])) {
                    $query->where('firma_adi', $filters['firma_adi']);
                }
                if (!empty($filters['ilk_tarih'])) {
                    $query->whereDate('teblig_bitis_tarihi', '>=', Carbon::parse($filters['ilk_tarih'])->startOfDay());
                }
                if (!empty($filters['son_tarih'])) {
                    $query->whereDate('teblig_bitis_tarihi', '<=', Carbon::parse($filters['son_tarih'])->endOfDay());
                }
                if (!empty($filters['satis_temsilcisi'])) {
                    $query->where('satis_temsilcisi', $filters['satis_temsilcisi']);
                }
                if (!empty($filters['sehir'])) {
                    $query->where('sehir', $filters['sehir']);
                }

                // Sayfalandırma
                $itiraztakip = $query->orderByDesc('id')->paginate($perPage);

                // Dosya adı
                $fileName2 = "itiraz_takip_{$date}.xlsx";

                // Excel export işlemini başlat
                return $excel->download(new ItiraztakipExport($filters, $itiraztakip), $fileName2);
                break;

            case 'tescilnoksan':
                    // İtiraz Takip verilerini filtrele
                    $query = Tescilnoksan::query();

                    // İtiraztakip için filtreleme işlemleri burada
                    if (!empty($filters['cari_id'])) {
                        $query->where('cari_id', $filters['cari_id']);
                    }
                    if (!empty($filters['firma_adi'])) {
                        $query->where('firma_adi', $filters['firma_adi']);
                    }
                    if (!empty($filters['ilk_tarih'])) {
                        $query->whereDate('teblig_bitis_tarihi', '>=', Carbon::parse($filters['ilk_tarih'])->startOfDay());
                    }
                    if (!empty($filters['son_tarih'])) {
                        $query->whereDate('teblig_bitis_tarihi', '<=', Carbon::parse($filters['son_tarih'])->endOfDay());
                    }
                    if (!empty($filters['satis_temsilcisi'])) {
                        $query->where('satis_temsilcisi', $filters['satis_temsilcisi']);
                    }
                    if (!empty($filters['sehir'])) {
                        $query->where('sehir', $filters['sehir']);
                    }

                    // Sayfalandırma
                    $tescilnoksan = $query->orderByDesc('id')->paginate($perPage);

                    // Dosya adı
                    $fileName2 = "tescil_noksan_{$date}.xlsx";

                    // Excel export işlemini başlat
                    return $excel->download(new TescilnoksanExport($filters, $tescilnoksan), $fileName2);
                    break;

            default:
                abort(404, 'Geçersiz tip');
        }
    }
    public function indirFiltreliEXCEL(Request $request, Excel $excel)
{
    $cari_id = $request->input('cari_id');
    $ilk_tarih = $request->input('ilk_tarih');
    $son_tarih = $request->input('son_tarih');
    $satis_temsilcisi = $request->input('satis_temsilcisi');
    $sehir = $request->input('sehir');

    // Filtreler
    $filters = [
        'cari_id' => $cari_id,
        'ilk_tarih' => $ilk_tarih,
        'son_tarih' => $son_tarih,
        'satis_temsilcisi' => $satis_temsilcisi,
        'sehir' => $sehir,
    ];

    // Sorgu başlat
    $query = Markatakip::query();

    if ($cari_id) {
        $query->where('cari_id', $cari_id);
    }
    if ($satis_temsilcisi) {
        $query->where('satis_temsilcisi', $satis_temsilcisi);
    }
    if ($sehir) {
        $query->where('sehir', $sehir);
    }
    if ($ilk_tarih || $son_tarih) {
        $baslangic = $ilk_tarih ? Carbon::parse($ilk_tarih)->startOfDay() : null;
        $son = $son_tarih ? Carbon::parse($son_tarih)->endOfDay() : null;

        if ($baslangic && $son) {
            $query->whereBetween('basvuru_tarihi', [$baslangic, $son]);
        } elseif ($baslangic) {
            $query->where('basvuru_tarihi', '>=', $baslangic);
        } elseif ($son) {
            $query->where('basvuru_tarihi', '<=', $son);
        }
    }

    // Veriyi al
    $markatakip = $query->get();

    // Dosya adı
    $fileName = "marka_takip_" . Carbon::now()->format('Y-m-d_H-i-s') . ".xlsx";

    // Export işlemini başlat
    return $excel->download(new MarkaTakipExport($filters, $markatakip), $fileName);
}

public function itiraztakipFiltreliEXCEL(Request $request, Excel $excel)
{
    $firma_adi = $request->input('firma_adi');
    $ilk_tarih = $request->input('ilk_tarih');
    $son_tarih = $request->input('son_tarih');
    $satis_temsilcisi = $request->input('satis_temsilcisi');

    // Filtreler
    $filters = [
        'firma_adi' => $firma_adi,
        'ilk_tarih' => $ilk_tarih,
        'son_tarih' => $son_tarih,
        'satis_temsilcisi' => $satis_temsilcisi,
    ];

    // Sorgu başlat
    $query = Itiraztakip::query();

    if ($firma_adi) {
        $query->where('firma_adi', $firma_adi);
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

    // Veriyi al
    $itiraztakip = $query->get();

    // Dosya adı
    $fileName = "itiraz_takip_" . Carbon::now()->format('Y-m-d_H-i-s') . ".xlsx";

    // Export işlemini başlat
    return $excel->download(new ItirazTakipExport($filters, $itiraztakip), $fileName);
}
public function tescilnoksanFiltreliEXCEL(Request $request, Excel $excel)
{
    $firma_adi = $request->input('firma_adi');
    $ilk_tarih = $request->input('ilk_tarih');
    $son_tarih = $request->input('son_tarih');
    $satis_temsilcisi = $request->input('satis_temsilcisi');
    // Filtreler
    $filters = [
        'firma_adi' => $firma_adi,
        'ilk_tarih' => $ilk_tarih,
        'son_tarih' => $son_tarih,
        'satis_temsilcisi' => $satis_temsilcisi,
    ];

    // Sorgu başlat
    $query = Tescilnoksan::query();

    if ($firma_adi) {
        $query->where('firma_adi', $firma_adi);
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

    // Veriyi al
    $tescilnoksan = $query->get();

    // Dosya adı
    $fileName = "tescil_noksan_" . Carbon::now()->format('Y-m-d_H-i-s') . ".xlsx";
    // dd($query->toSql(), $query->getBindings());
    // Export işlemini başlat
    return $excel->download(new TescilnoksanExport($filters, $tescilnoksan), $fileName);
}
}
