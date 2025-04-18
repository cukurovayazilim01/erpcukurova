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
        $efaturalar->efatura_tipi = $request->efatura_tipi;
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
            $efaturalardata->aciklama = $input['aciklama'];
            $efaturalardata->miktar = floatval($input['miktar']);
            $efaturalardata->birim = $input['birim'];
            $efaturalardata->fiyat = floatval($input['birim_fiyat']);
            $efaturalardata->kdv_oran = floatval($input['kdv_oran']);
            $efaturalardata->kdv_tutar = $input['kdv_tutar'];
            $efaturalardata->kdvsiztutar = $input['kdvsiztutar'];
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
                "AdditionalNames" => [
                    "Description" => $efaturalardata->aciklama
                ]
            ];
        }

        $taxNumber = $request->vergi_no ?: $request->tc_kimlik;

        $body = [
            "draft" => "true",
            "integrator" => "mimsoft",
            "document" => [
                "External" => [
                    "ID" => $efaturalar->id,
                    "RefNo" => $efaturalar->fatura_no
                ],
                "IssueDateTime" => now()->format('Y-m-d\TH:i:s'),
                "Type" => $efaturalar->efatura_tipi,
                "TaxExemptions" => [
                    "KDV" => 350
                ],
                "Notes" => new \stdClass(),
                "Customer" => [
                    "TaxNumber" => $taxNumber,
                    "TaxOffice" => $request->vergi_dairesi,
                    "Name" => $request->firma_unvan,
                    "Address" => $request->ilce . ' ' . $request->il . ' ' . $request->adres,
                    "District" => $request->ilce,
                    "City" => $request->il,
                    "Country" => "TÜRKİYE",
                    "PostalCode" => "",
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
            ])->post('https://apidemo.rahatsistem.com.tr/v2/documents/invoice.create', $body);

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
