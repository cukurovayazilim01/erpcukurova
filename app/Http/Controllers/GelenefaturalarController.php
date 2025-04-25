<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Alislar;
use App\Models\Alislardata;
use App\Models\Bankahrkt;
use App\Models\Bankalar;
use App\Models\Efaturaapi;
use App\Models\Firmahrkt;
use App\Models\Gelenefaturalar;
use App\Models\Giderkategori;
use App\Models\Kasahrkt;
use App\Models\Kasalar;
use App\Models\Odemeler;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GelenefaturalarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function gelenfaturalarsearch(Request $request)
    {
        $search = $request->input('gelenfaturalarsearch');

        $query = Gelenefaturalar::orderByDesc('issue_date');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sender_name', 'like', '%' . $search . '%')
                    ->orWhere('fatura_no', 'like', '%' . $search . '%');
            });
        }

        $perPage = 30;
        $page = $request->query('page', 1);

        $gelenefatura = $query->paginate($perPage);
        $startNumber = $gelenefatura->total() - (($page - 1) * $perPage);

        if ($request->ajax()) {
            return view('admin.contents.gelenefaturalar.gelenefaturalar-search', compact('gelenefatura', 'startNumber'));
        }

        return view('admin.contents.gelenefaturalar.gelenefaturalar', compact('gelenefatura', 'startNumber'));
    }


    public function mimsoftlogin()
    {
        $efaturaApi = Efaturaapi::first();

        if (!$efaturaApi) {
            return response()->json(['error' => 'Efatura API bilgileri bulunamadı'], 500);
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.mimsoft.com.tr/v1.0/account/auth', [
            'username' => $efaturaApi->rf_kullanici_adi,
            'password' => $efaturaApi->rf_sifre,
        ]);


        return $response->json();
    }
    public function getEinvoice(Request $request)
    {
        // Mimsoft API'ye giriş yap ve access token al
        $login = $this->mimsoftlogin();

        if (!isset($login['access_token'])) {
            Log::error('Mimsoft login başarısız', ['login_response' => $login]);
            return null;
        }

        $mimsoft_access_token = $login['access_token'];

        // Doğru tarih formatı oluştur
        $start_date = now()->subMonth()->format('Y-m-d');
        $end_date = now()->format('Y-m-d');

        // API URL’si
        $url = "https://api.mimsoft.com.tr/v1.0/einvoice?direction=in&start_date={$start_date}&end_date={$end_date}&limit=100&type=json&include_erp=true";

        // API isteğini yap
        $response = Http::withHeaders([
            'Authorization' => "Bearer $mimsoft_access_token"
        ])->get($url);

        if ($response->successful()) {
            return $response->json()['items'];
        }

        Log::error('Mimsoft API isteği başarısız', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return null;
    }


    public function getInvoicePdf($invoiceUuid)
    {
        // Mimsoft API'ye giriş yap ve access token al
        $login = $this->mimsoftlogin();

        if (!isset($login['access_token'])) {
            return response()->json(['error' => 'Mimsoft login başarısız'], 401);
        }

        $mimsoft_access_token = $login['access_token'];

        // PDF almak için URL
        $pdfUrl = "https://api.mimsoft.com.tr/v1.0/einvoice/{$invoiceUuid}/export?type=pdf";

        // PDF'yi indir
        $pdfResponse = Http::withHeaders([
            'Authorization' => "Bearer $mimsoft_access_token",
            'Content-Type' => 'application/json'
        ])->get($pdfUrl);

        // PDF yanıtı başarılı ise, PDF dosyasını döndür
        if ($pdfResponse->successful()) {
            return response($pdfResponse->body(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="invoice_' . $invoiceUuid . '.pdf"');
        } else {
            return response()->json([
                'error' => 'PDF indirilemedi',
                'message' => $pdfResponse->body(),
            ], $pdfResponse->status());
        }
    }
    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        $gelenefatura = Gelenefaturalar::orderByDesc('issue_date')->paginate($perPage);
        // Sayfalama işlemini gerçekleştirecek fonksiyonu çağır
        // $gelenefatura = $this->getEinvoice($request);

        // Sayfalama ile gelen verileri görüntüle
        $page = $gelenefatura->currentPage();
        $startNumber = $gelenefatura->total() - (($page - 1) * $perPage);

        return view('admin.contents.gelenefaturalar.gelenefaturalar', compact('perPage', 'startNumber', 'gelenefatura'));
    }

    public function gelenfaturayialisaktar(string $id)
    {
        $gelenefatura = Gelenefaturalar::find($id);

        $giderkategori = Giderkategori::all();
        $kasalar = Kasalar::all();
        $bankalar = Bankalar::all();
        return view('admin.contents.gelenefaturalar.gelenefatura-alisaaktar', compact('bankalar', 'kasalar', 'gelenefatura', 'giderkategori'));
    }
    public function gelenfaturayialisaktarPOST(Request $request, string $id)
    {
        $gelenefatura = Gelenefaturalar::find($id);
        $alislar_max_no = Alislar::max('alis_kodu');

        $alislar = new Alislar();
        $alislar->alis_kodu = empty($alislar_max_no) ? 1 : $alislar_max_no + 1;
        $alislar->alis_kodu_text = 'AF';
        $alislar->islem_yapan = Auth::user()->id;
        $alislar->islem_tarihi = Carbon::now();
        $alislar->fis_tarihi = $request->fis_tarihi;
        $alislar->fis_no = $request->fis_no;
        $alislar->cari_id = $request->cari_id;
        $alislar->aciklama = $request->aciklama;

        $alislar->toplam_ara_toplam = $request->toplam_ara_toplam;
        $alislar->toplam_iskonto = $request->toplam_iskonto;
        $alislar->indirimli_tutar = $request->indirimli_tutar;
        $alislar->toplam_kdv_tutar = $request->toplam_kdv_tutar;
        $alislar->toplam_tutar = $request->toplam_tutar;

        $alislar->save();

        $inputs = $request->input('inputs'); // Formdan gelen veriler

        // JSON verisini PHP dizisine çevir
        $json_data = json_decode($gelenefatura->json_data, true);

        if (!isset($json_data['lines'])) {
            dd("Hata: JSON içinde 'lines' verisi bulunamadı!", $json_data);
        }

        // Döngü başlat
        foreach ($json_data['lines'] as $key => $line) {
            $giderkategori_id = isset($inputs[$key]['giderkategori_id']) ? $inputs[$key]['giderkategori_id'] : null;
            $gider_id = isset($inputs[$key]['gider_id']) ? $inputs[$key]['gider_id'] : null;
            $gider_adi = isset($inputs[$key]['gider_adi']) ? $inputs[$key]['gider_adi'] : null;

            $alislardata = new Alislardata();
            $alislardata->alis_id = $alislar->id;
            $alislardata->giderkategori_id = $giderkategori_id;
            $alislardata->gider_id = $gider_id;
            $alislardata->gider_adi = $gider_adi;
            $alislardata->miktar = $line['quantity'];
            $alislardata->birim = $line['quantity_unit'];
            $alislardata->ara_toplam = $line['extension_amount'];
            $alislardata->birim_fiyat = $line['price'];
            $alislardata->iskonto = 0; // JSON'da iskonto bilgisi yoksa varsayılan 0
            $alislardata->kdv_oran = isset($line['tax']['subtotals'][0]['percent']) ? $line['tax']['subtotals'][0]['percent'] : 0;
            $alislardata->kdv_tutar = isset($line['tax']['subtotals'][0]['amount']) ? $line['tax']['subtotals'][0]['amount'] : 0;
            $alislardata->tutar = $line['extension_amount'];

            $alislardata->save();
        }



        $firmahrkt = new Firmahrkt();
        $firmahrkt->tarih = Carbon::now();
        $firmahrkt->islem_tarihi = $alislar->fis_tarihi;
        $firmahrkt->islem_yapan = Auth::user()->id;
        $firmahrkt->cari_id = $alislar->cari_id;
        $firmahrkt->islem = 'Alış';
        $firmahrkt->alis_id = $alislar->id;
        $firmahrkt->alacak = $alislar->toplam_tutar;
        $firmahrkt->save();

        $odeme_max_no = Odemeler::max('odeme_kodu');
        $odeme = new Odemeler();
        $odeme->odeme_kodu = empty($odeme_max_no) ? 1 : $odeme_max_no + 1;
        $odeme->odeme_kodu_text = 'OF';
        $odeme->islem_yapan = Auth::user()->id;
        $odeme->islem_tarihi = Carbon::now();
        $odeme->tarih = $alislar->fis_tarihi;
        $odeme->cari_id = $request->cari_id;
        $odeme->odemeyapan_id = Auth::user()->id;

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
        $firmahrkt->cari_id = $odeme->cari_id;
        if ($odeme->odeme_tipi == 'Kasa') {
            $firmahrkt->kasahareket_id = $kasahrkt->id;
        } elseif ($odeme->odeme_tipi == 'Banka') {
            $firmahrkt->bankahareket_id = $bankahrkt->id;
        }
        $firmahrkt->islem = 'Ödeme';
        $firmahrkt->odeme_id = $odeme->id;
        $firmahrkt->borc = $odeme->odeme_tutar;
        $firmahrkt->save();

        $gelenefatura->alis_aktarilma_durum = 'Aktarıldı';
        $gelenefatura->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $gelenefatura->fatura_no . ' ' . 'Nolu Fatura Alışlara Aktarıldı';
        $log->save();

        return redirect('gelenefaturalar')->with('success', 'Aktarma Başarılı');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
