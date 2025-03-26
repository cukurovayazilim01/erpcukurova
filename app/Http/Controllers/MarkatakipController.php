<?php

namespace App\Http\Controllers;

use App\Exports\MarkatakipExport;
use App\Models\Cariler;
use App\Models\Hizmetler;
use App\Models\Itiraztakip;
use App\Models\Markatakip;
use App\Models\Tescilnoksan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class MarkatakipController extends Controller
{

    public function indirFiltreliPDF(Request $request)
    {
        $cari_id = $request->input('cari_id');
        $ilk_tarih = $request->input('ilk_tarih');
        $son_tarih = $request->input('son_tarih');
        $satis_temsilcisi = $request->input('satis_temsilcisi');
        $sehir = $request->input('sehir');

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

        $data = $query->get();

        // PDF için başlangıç numarasını hesapla
        $startNumber = $data->count();

        // PDF oluşturma işlemi
        $pdf = Pdf::loadView('admin.contents.markatakip.markatakip_pdf', compact('data', 'startNumber'));
        return $pdf->download('markatakip_filtered.pdf');
    }
    public function indirPDF(Request $request,$type)
{
    $date = Carbon::now();
        // Veritabanından alınacak veriler ve ilgili view dosyaları
    switch ($type) {
        case 'itiraz':
            $data = Itiraztakip::orderByDesc('id')->get();
            $view = 'admin.contents.itiraztakip.itiraztakip_pdf';
            $fileName = "itiraz_takip_{$date}.pdf";
        break;

    case 'marka':
        $data = MarkaTakip::orderByDesc('id')->get();
        $view = 'admin.contents.markatakip.markatakip_pdf';
        $fileName = "marka_takip_{$date}.pdf";
        break;

    case 'tescilnoksan':
        $data = Tescilnoksan::orderByDesc('id')->get();
        $view = 'admin.contents.tescilnoksan.tescilnoksan_pdf';
        $fileName = "tescilnoksan_{$date}.pdf";
        break;

        // Diğer tablolar için yeni case blokları eklenebilir
        default:
            abort(404, 'Sayfa Bulunamadı');
    }

    // Toplam kayıt sayısını başlangıç noktası olarak al
    $startNumber = $data->count();
    $pdf = Pdf::loadView($view, compact('data', 'startNumber','date'));
    return $pdf->download($fileName);
}

    public function markatakipfiltre(Request $request)
{
    $perPage = $request->input('entries', 20);
    $currentPage = $request->input('page', 1);

    $cari_id = $request->input('cari_id');
    $ilk_tarih = $request->input('ilk_tarih');
    $son_tarih = $request->input('son_tarih');
    $satis_temsilcisi = $request->input('satis_temsilcisi');
    $sehir = $request->input('sehir');
    $islem_tarihi = Carbon::now();
    $user = User::all();
    $hizmetler = Hizmetler::all();


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
    } else {
        $query->whereNotNull('basvuru_tarihi');
    }

    // Sayfalama ve veri çekme
    $markatakip = $query->paginate($perPage);

    // Sayfa ve sıralama başlangıç numarasını hesapla
    $startNumber = $markatakip->total() - (($currentPage - 1) * $perPage);

    return view('admin.contents.markatakip.markatakip-filtre', compact('perPage','markatakip','ilk_tarih','son_tarih','islem_tarihi','cari_id','startNumber','user','hizmetler','sehir'));
}


    public function markatakipsearch(Request $request)
    {
        $markatakipsearch = $request->input('markatakipsearch');

        // Eğer arama yapılmışsa
        if ($markatakipsearch) {
            $markatakip = Markatakip::orderByDesc('id')
                ->whereHas('firmaadi',function($query) use ($markatakipsearch) {
                    $query->where('firma_unvan', 'like', '%' . $markatakipsearch . '%');
                })
                ->paginate(50);

            // Sayfa numarasını hesapla
            $page = $request->query('page', 1);
            $perPage = 50;
            $startNumber = $markatakip->total() - (($page - 1) * $perPage);

            $user = User::all();

            // Arama sonucu varsa ve AJAX isteği ise arama sonucunu döndür
            if ($request->ajax()) {
                return view('admin.contents.markatakip.markatakip-search', compact('markatakip', 'startNumber', 'user'));
            }

            // Normal sayfa için arama sonucu döndür
            return view('admin.contents.markatakip.markatakip', compact('markatakip', 'startNumber', 'user'));
        }

        // Arama yapılmamışsa ana sayfayı döndür
        return view('admin.contents.markatakip.markatakip');
    }
    public function getMusteriTemsilcisi($cariId)
    {
        $cari = Cariler::find($cariId);

        return response()->json([
            'musteri_temsilcisi' => $cari->musteri_temsilcisi,
            'tc' => $cari->tc_kimlik,
            'vkn' => $cari->vergi_no,
            'sehir' => $cari->il,
            'ilce' => $cari->ilce,
            'telefon_no' => $cari->yetkili_kisi_tel,
            'ticari_unvan' => $cari->ticari_unvan,
            'vergi_dairesi' => $cari->vergi_dairesi,
            'is_tel' => $cari->is_tel,
            'eposta' => $cari->eposta,
            'firma_unvan' => $cari->firma_unvan,
            'adres' => $cari->adres,
        ]);
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 5);

        $markatakip = Markatakip::orderByDesc('id')->paginate($perPage);
        $page = $markatakip->currentPage();
        $startNumber = $markatakip->total() - (($page - 1) * $perPage);
        $cariler = Cariler::all();
        $user = User::all();
        $hizmetler = Hizmetler::all();

        return view('admin.contents.markatakip.markatakip',compact('markatakip', 'startNumber', 'user','cariler', 'perPage','hizmetler'));
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
        $markatakip = new Markatakip();
        $markatakip->islem_yapan = Auth::user()->id;
        $markatakip->islem_tarihi = Carbon::now();
        $markatakip->cari_id = $request->cari_id;
        $markatakip->musteri_temsilcisi = $request->musteri_temsilcisi;
        $markatakip->satis_temsilcisi = $request->satis_temsilcisi;
        $markatakip->tc = $request->tc;
        $markatakip->vkn = $request->vkn;
        $markatakip->sehir = $request->sehir;
        $markatakip->basvuru_no = $request->basvuru_no;
        $markatakip->referans_no = $request->referans_no;
        $markatakip->marka_adi = $request->marka_adi;
        $markatakip->marka_sinif = $request->marka_sinif;
        $markatakip->hizmet_turu = $request->hizmet_turu;
        $markatakip->basvuru_tarihi = $request->basvuru_tarihi;
        $markatakip->marka_islem = $request->marka_islem;
        $markatakip->marka_durum = $request->marka_durum;
        $markatakip->yenileme_tarih = Carbon::parse($markatakip->basvuru_tarihi)->addYears(10);
        $markatakip->save();

        return redirect('markatakip')->with('success','Ekleme Başarılı');
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
        $markatakip = Markatakip::find($id);
        $markatakip->islem_yapan = Auth::user()->id;
        $markatakip->islem_tarihi = Carbon::now();
        $markatakip->cari_id = $request->cari_id;
        $markatakip->musteri_temsilcisi = $request->musteri_temsilcisi;
        $markatakip->satis_temsilcisi = $request->satis_temsilcisi;
        $markatakip->tc = $request->tc;
        $markatakip->vkn = $request->vkn;
        $markatakip->sehir = $request->sehir;
        $markatakip->basvuru_no = $request->basvuru_no;
        $markatakip->referans_no = $request->referans_no;
        $markatakip->marka_adi = $request->marka_adi;
        $markatakip->marka_sinif = $request->marka_sinif;
        $markatakip->hizmet_turu = $request->hizmet_turu;
        $markatakip->basvuru_tarihi = $request->basvuru_tarihi;
        $markatakip->marka_islem = $request->marka_islem;
        $markatakip->marka_durum = $request->marka_durum;
        $markatakip->yenileme_tarih = Carbon::parse($markatakip->basvuru_tarihi)->addYears(10);
        $markatakip->save();

        return redirect('markatakip')->with('success','Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $markatakip = Markatakip::find($id);

        if ($markatakip->itiraz()->count() > 0) {
            return redirect('markatakip')->with('error', 'Bu markaya ait itiraz olduğu için silinemez.');
        }
        $markatakip->delete();
        return redirect('markatakip')->with('success','Silme Başarılı');
    }
}
