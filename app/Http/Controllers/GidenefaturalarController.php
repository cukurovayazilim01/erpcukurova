<?php

namespace App\Http\Controllers;

use App\Models\Cariler;
use App\Models\Efaturaapi;
use App\Models\Efaturalar;
use App\Models\Efaturalardata;
use App\Models\Gidenefaturalar;
use App\Models\Hizmetler;
use App\Models\Hizmetlerkategori;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GidenefaturalarController extends Controller
{
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
    public function getEinvoicegiden(Request $request)
    {
        $login = $this->mimsoftlogin();

        if (!isset($login['access_token'])) {
            Log::error('Mimsoft login başarısız (giden)', ['login_response' => $login]);
            return null;
        }

        $mimsoft_access_token = $login['access_token'];

        $start_date = now()->subMonth()->format('Y-m-d');
        $end_date = now()->format('Y-m-d');

        $url = "https://api.mimsoft.com.tr/v1.0/einvoice?direction=out&start_date={$start_date}&end_date={$end_date}&limit=100&type=json&include_erp=true";

        $response = Http::withHeaders([
            'Authorization' => "Bearer $mimsoft_access_token"
        ])->get($url);

        if ($response->successful()) {
            return $response->json()['items'];
        }

        Log::error('Giden Mimsoft API isteği başarısız', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return null;
    }




    public function createInvoice(Request $request)
    {
        $efaturaApi = Efaturaapi::first();

        if (!$efaturaApi || empty($efaturaApi->rf_token)) {
            return back()->with('error', 'Efatura entegrasyon bilgileri eksik!');
        }

        // Fatura no
        $nextFaturaNo = Efaturalar::max('fatura_no') ?? 0;

        // Yeni fatura kaydı
        $efaturalar = new Efaturalar();
        $efaturalar->fatura_no_text = 'EF';
        $efaturalar->fatura_no = $nextFaturaNo + 1;
        $efaturalar->islem_yapan = Auth::id();
        $efaturalar->islem_tarihi = now();
        $efaturalar->fatura_tarihi = $request->fatura_tarihi;
        $efaturalar->cari_id = $request->cari_id;
        $efaturalar->user_id = Auth::id();
        $efaturalar->vkn = $request->vergi_no;
        $efaturalar->tckimlikno = $request->tc_kimlik;
        $efaturalar->vergidairesi = $request->vergi_dairesi;
        $efaturalar->il = $request->il;
        $efaturalar->ilce = $request->ilce;
        $efaturalar->kdv_toplam = $request->toplam_kdv_tutar;
        $efaturalar->ara_toplam = $request->toplam_ara_toplam;
        $efaturalar->iskonto_toplam = $request->toplam_iskonto;
        $efaturalar->toplam_tutar = $request->toplam_tutar;
        $efaturalar->save();

        if (!$request->has('inputs') || empty($request->inputs)) {
            return back()->with('error', 'Fatura detayları eksik!');
        }

        $lines = [];
        foreach ($request->inputs as $input) {
            $efaturalardata = new Efaturalardata();
            $efaturalardata->efatura_id = $efaturalar->id;
            $efaturalardata->hizmet_adi = $input['hizmet_adi'];
            $efaturalardata->miktar = floatval($input['miktar']);
            $efaturalardata->birim = $input['birim'];
            $efaturalardata->fiyat = floatval($input['birim_fiyat']);
            $efaturalardata->kdv_oran = floatval($input['kdv_oran']);
            $efaturalardata->kdv_tutar = $input['kdv_tutar'];
            $efaturalardata->iskonto = $input['iskonto'];
            $efaturalardata->toplam_fiyat = $input['tutar'];
            $efaturalardata->save();

            $lines[] = [
                "Name" => $efaturalardata->hizmet_adi,
                "Quantity" => $efaturalardata->miktar,
                "UnitCode" => "C62",
                "Price" => $efaturalardata->fiyat,
                "KDV" => [
                    "Percent" => $efaturalardata->kdv_oran
                ],
                "Allowance" => [
                    "Price" => floatval($efaturalardata->iskonto)
                ],
            ];
        }

        $taxNumber = $request->vergi_no ?: $request->tc_kimlik;

        $body = [
            "draft" => true,
            "document" => [
                "External" => [
                    "ID" => (string) $efaturalar->id,
                    "RefNo" => (string) $efaturalar->fatura_no,
                    "Type" => 'Cukurova Entegre'
                ],
                "IssueDateTime" => now()->format('Y-m-d\TH:i:s'),
                "Type" => $request->efatura_tipi, // örn: "SATIS" gibi
                "TaxExemptions" => [
                    "KDV" => 350
                ],
                "Notes" => [], // ← boş array olmalı
                "Customer" => [
                    "TaxNumber" => $taxNumber,
                    "TaxOffice" => $request->vergi_dairesi,
                    "Name" => $request->firma_unvan,
                    "Address" => trim($request->ilce . ' ' . $request->il . ' ' . $request->adres),
                    "District" => $request->ilce,
                    "City" => $request->il,
                    "Country" => "TÜRKİYE",
                    "Phone" => $request->is_tel,
                    "Mail" => $request->eposta
                ],
                "Lines" => $lines
            ]
        ];

        try {
            $response = Http::withHeaders([
                'api-key' => $efaturaApi->rf_token,
                'Content-Type' => 'application/json',
            ])->post('https://api.rahatsistem.com.tr/v2/documents/invoice.create', $body);

            if ($response->successful()) {
                return back()->with('success', 'Fatura başarıyla kesildi!');
            } else {
                return back()->with('error', 'API Hatası: ' . $response->body());
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Fatura API isteğinde hata: ' . $e->getMessage());
        }
    }



    public function getMusteri($vkn)
    {
        // VKN'ye göre müşteri bilgilerini getir
        $musteri = Cariler::where('vergi_no', $vkn)->first();

        // Eğer müşteri bulunamazsa hata mesajı döndür
        if (!$musteri) {
            return response()->json(['error' => 'Müşteri bulunamadı'], 404);
        }

        // JSON formatında müşteri bilgilerini döndür
        return response()->json([
            'musteri_temsilcisi' => $musteri->musteri_temsilcisi,
            'tc' => $musteri->tc_kimlik,
            'vkn' => $musteri->vergi_no,
            'sehir' => $musteri->il,
            'vergi_dairesi' => $musteri->vergi_dairesi,
            'ilce' => $musteri->ilce,
            'is_tel' => $musteri->is_tel,
            'eposta' => $musteri->eposta,
            'firma_unvan' => $musteri->firma_unvan,
            'adres' => $musteri->adres,
        ]);
    }

    public function index(Request $request)
    {
        $perPage = $request->input('entries', 20);

        $gidenefaturalar = Gidenefaturalar::orderByDesc('issue_date')->paginate($perPage);
        // Sayfalama işlemini gerçekleştirecek fonksiyonu çağır
        // $gidenefaturalar = $this->getEinvoice($request);

        $page = $gidenefaturalar->currentPage();
        $startNumber = $gidenefaturalar->total() - (($page - 1) * $perPage);

        return view('admin.contents.gidenefaturalar.gidenefaturalar', compact('perPage', 'startNumber', 'gidenefaturalar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        $hizmetlerkategori = Hizmetlerkategori::all();
        $hizmetler = Hizmetler::all();
        return view('admin.contents.gidenefaturalar.gidenefaturalar-create', compact('user', 'hizmetlerkategori', 'hizmetler'));
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
