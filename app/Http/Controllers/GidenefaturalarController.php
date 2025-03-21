<?php

namespace App\Http\Controllers;

use App\Models\Cariler;
use App\Models\Efaturaapi;
use App\Models\Gidenefaturalar;
use App\Models\Hizmetler;
use App\Models\Hizmetlerkategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

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
        // Mimsoft API'ye giriş yap ve access token al
        $login = $this->mimsoftlogin();

        if (!isset($login['access_token'])) {
            return response()->json(['error' => 'Mimsoft login başarısız'], 401);
        }

        $mimsoft_access_token = $login['access_token'];

        // API'den veri çekilecek URL
        $url = 'https://api.mimsoft.com.tr/v1.0/einvoice?direction=out&start_date=2025-02-01&end_date=2025-03-17&limit=100&type=json&include_erp=true';

        // API isteğini yap
        $response = Http::withHeaders([
            'Authorization' => "Bearer $mimsoft_access_token"
        ])->get($url);

        if ($response->successful()) {
            // API yanıtını al
            $data = $response->json();
            // Sayfalama parametrelerini belirle
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 20; // Sayfa başına 20 öğe
            $items = $data['items']; // Verilen öğeler
            $total = count($items); // Burada 'total' yerine item sayısını kullanıyoruz
            // LengthAwarePaginator ile sayfalama nesnesini oluştur
            $gelenefatura = new LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()] // Sayfalama için path ayarı
            );

            return $gelenefatura;
        } else {
            return response()->json([
                'error' => 'API isteği başarısız',
                'message' => $response->body()
            ], $response->status());
        }
    }

    public function createInvoice(Request $request)
    {
        $apiUrl = 'https://apidemo.rahatsistem.com.tr/v2/documents/invoice.create';
        $apiKey = 'sucatutest1';

        $data = [
            "draft" => true,
            "document" => [
                "External" => [
                    "ID" => "string",
                    "RefNo" => "MEA11152",
                    "Type" => "Müthiş Entegre App"
                ],
                "Type" => $request->input('fatura_tipi'),
                "Profile" => $request->input('fatura_turu'),
                "NumberOrSerie" => "RS",
                "UUID" => "f50af7e0-0dd5-4361-ab96-2e04f7bc7e30",
                "IssueDateTime" => "string",
                "Notes" => ["string"],
                "CurrencyCode" => "TRY",
                "ExchangeRate" => 0,
                "TaxExemptions" => ["KDV" => 322],
                "Order" => ["Date" => "2023-10-19", "Value" => "SIP0001"],
                "Despatches" => [["Date" => "2023-10-19", "Value" => "IRS0001"]],
                "Customer" => [
                    "TaxNumber" => $request->input('vergi_no'),
                    "TaxOffice" => $request->input('vergi_dairesi'),
                    "Name" => $request->input('firma_unvan'),
                    "Alias" => "string",
                    "Address" => $request->input('adres'),
                    "District" => $request->input('ilce'),
                    "City" => $request->input('il'),
                    "Country" => "TÜRKİYE",
                    "PostalCode" => "string",
                    "Phone" => $request->input('is_tel'),
                    "Fax" => "string",
                    "Mail" => $request->input('eposta'),
                    "Website" => "string"
                ],
                "Lines" => []
            ]
        ];

        foreach ($request->input('inputs', []) as $input) {
            $data["document"]["Lines"][] = [
                "Name" => $input['hizmet_adi'] ?? '',
                "Quantity" => isset($input['miktar']) ? (float) $input['miktar'] : 0,
                "UnitCode" => isset($input['birim']) ? strtoupper($input['birim']) : 'ADET',
                "Price" => isset($input['birim_fiyat']) ? (float) $input['birim_fiyat'] : 0,
                "KDV" => [
                    "Percent" => isset($input['kdv_oran']) ? (float) $input['kdv_oran'] : 0,
                    "Amount" => isset($input['kdv_tutar']) ? (float) $input['kdv_tutar'] : 0
                ],
                "Allowance" => [
                    "Percent" => isset($input['iskonto']) ? (float) $input['iskonto'] : 0,
                    "Price" => 0
                ],
                "WithholdingTax" => [
                    "Code" => 621
                ],
                "Taxes" => [
                    [
                        "Percent" => isset($input['kdv_oran']) ? (float) $input['kdv_oran'] : 0,
                        "Code" => "0053"
                    ]
                ]
            ];
        }


        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => $apiKey
        ])->post($apiUrl, $data);

        if ($response->successful()) {
            return $response->json();
        } else {
            return $response->body();
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
