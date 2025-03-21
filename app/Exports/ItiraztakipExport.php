<?php

namespace App\Exports;

use App\Models\Itiraztakip;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;

class ItiraztakipExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }
    public function view(): \Illuminate\Contracts\View\View
    {
        $query = Itiraztakip::query();
        // Filtreleri uygula
        // if (!empty($this->filters['cari_id'])) {
        //     $query->where('cari_id', $this->filters['cari_id']);
        // }
        if (!empty($filters['firma_adi'])) {
            $query->where('firma_adi', $this->filters['firma_adi']);
        }
        if (!empty($this->filters['satis_temsilcisi'])) {
            $query->where('satis_temsilcisi', $this->filters['satis_temsilcisi']);
        }
        if (!empty($this->filters['sehir'])) {
            $query->where('sehir', $this->filters['sehir']);
        }

        if (!empty($this->filters['ilk_tarih']) || !empty($this->filters['son_tarih'])) {
            $baslangic = !empty($this->filters['ilk_tarih']) ? Carbon::parse($this->filters['ilk_tarih'])->startOfDay() : null;
            $son = !empty($this->filters['son_tarih']) ? Carbon::parse($this->filters['son_tarih'])->endOfDay() : null;

            if ($baslangic && $son) {
                $query->whereBetween('teblig_bitis_tarihi', [$baslangic, $son]);
            } elseif ($baslangic) {
                $query->where('teblig_bitis_tarihi', '>=', $baslangic);
            } elseif ($son) {
                $query->where('teblig_bitis_tarihi', '<=', $son);
            }
        } else {
            $query->whereNotNull('teblig_bitis_tarihi');
        }

        // Filtrelenmiş verilerle görünümü döndür
        return view('admin.contents.itiraztakip.itiraztakip-excel', ['itiraztakip' => $query->get()]);
    }
}
