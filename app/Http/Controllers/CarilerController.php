<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Aramalar;
use App\Models\Cariler;
use App\Models\Dokuman;
use App\Models\Efaturaapi;
use App\Models\Firmahrkt;
use App\Models\Kontak;
use App\Models\Teklifler;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CarilerController extends Controller
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

    public function vkncheck(Request $request)
    {

        // Request'ten vkn parametresini alıyoruz
        $carivkn = $request->input('vergi_no');

        // Eğer vkn parametresi boş değilse işlem yapalım
        if (!empty($carivkn)) {
            $login = $this->mimsoftlogin();  // Login işlemi

            // Eğer login başarılı olduysa access token alalım
            if ($login && isset($login['access_token'])) {
                $mimsoft_access_token = $login['access_token'];

                // API'den veri çekelim
                $url = 'https://api.mimsoft.com.tr/v1.0/kep/' . $carivkn;
                $sonuc = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $mimsoft_access_token
                ])->get($url);

                // API'den gelen yanıtı kontrol edelim
                if ($sonuc->ok()) {
                    return response()->json($sonuc->json());
                } else {
                    return response()->json(['error' => 'API isteği basarisiz'], 400);
                }
            } else {
                return response()->json(['error' => 'Mimsoft login basarisiz'], 401);
            }
        }

        return response()->json(['error' => 'VKN numarası girilmedi'], 400);
    }
    public function getFirmaUnvani(Request $request)
    {
        $vkn = $request->input('vergi_no');

        // API isteği gönder
        $response = Http::withHeaders([
            'Authorization' => 'Bearer sucatutest1',
            'Content-Type' => 'application/json'
        ])->get("https://apitest.mimsoft.com.tr/v1.0/kep/{$vkn}");

        $data = $response->json();

        // Eğer firma unvanı varsa döndür
        if ($response->successful() && isset($data['firma_unvani'])) {
            return response()->json(['firma_unvani' => $data['firma_unvani']]);
        }

        return response()->json(['error' => 'Firma bulunamadı'], 404);
    }


    public function carilersearch(Request $request)
    {
        $carilersearch = $request->input('carilersearch');

        // Eğer arama yapılmışsa filtre uygula, yoksa tüm verileri çek
        $cariler = Cariler::orderByDesc('id')
            ->when(!empty($carilersearch), function ($query) use ($carilersearch) {
                $query->where('firma_unvan', 'like', '%' . $carilersearch . '%')->orwhere('yetkili_kisi', 'like', '%' . $carilersearch . '%')->orwhere('firma_sektor', 'like', '%' . $carilersearch . '%');
            })
            ->paginate(50);

        // Sayfa numarasını hesapla
        $page = $request->query('page', 1);
        $perPage = 50;
        $startNumber = $cariler->total() - (($page - 1) * $perPage);

        $user = User::all();
        $aramalar = Aramalar::all();

        // AJAX isteği ise sadece arama sonuçlarını döndür
        if ($request->ajax()) {
            return view('admin.contents.cariler.cariler-search', compact('cariler', 'startNumber', 'user', 'aramalar'));
        }

        // Normal sayfa için tüm veriyi döndür
        return view('admin.contents.cariler.cariler', compact('cariler', 'startNumber', 'user', 'aramalar'));
    }


    public function aramaEkle(Request $request)
    {
        $aramalar = new Aramalar();
        $aramalar->islem_yapan = Auth::user()->id;
        $aramalar->islem_tarihi = Carbon::now();
        $aramalar->cari_id = $request->cari_id;
        $aramalar->arama_tipi = $request->arama_tipi;
        $aramalar->hatirlat_durumu = $request->hatirlat_durumu;
        $aramalar->hatirlat_tarihi = $request->hatirlat_tarihi;
        $aramalar->not = $request->not;
        $aramalar->hizmet_turu = $request->hizmet_turu;
        $aramalar->save();
        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $aramalar->cariler->firma_unvan . ' ' . 'Carisine ' . $aramalar->not . ' Arama Kaydı Eklendi';
        $log->save();

        return redirect()->route('cariler.show', ['cariler' => $request->cari_id])->with('success', 'Ekleme Başarılı');
    }

    public function aramasil($id)
    {
        $aramalar = Aramalar::find($id);
        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $aramalar->cariler->firma_unvan . ' ' . 'Carisinin ' . $aramalar->not . ' Arama Kaydı Silindi';
        $log->save();

        $aramalar->delete();
        return redirect()->route('cariler.show', ['cariler' => $aramalar->cari_id])->with('success', 'Silme Başarılı');

    }
    public function tedarikciler(Request $request)
    {
        // Kullanıcının seçtiği kayıt sayısını al veya varsayılan 20 olarak ayarla
        $perPage = $request->input('entries', 20);

        // cariler tablosundaki verileri sıralayarak, seçilen sayıya göre sayfalama işlemi
        $cariler = Cariler::orderByDesc('id')->where('firma_tipi', 'Tedarikçi')->paginate($perPage);

        // Sayfalama için başlangıç numarasını hesaplama
        $page = $cariler->currentPage();
        $startNumber = $cariler->total() - (($page - 1) * $perPage);

        $user = User::all();
        $aramalar = Aramalar::all();

        return view('admin.contents.cariler.tedarikciler', compact('cariler', 'startNumber', 'user', 'aramalar', 'perPage'));
    }

    public function index(Request $request)
    {
        // Kullanıcının seçtiği kayıt sayısını al veya varsayılan 20 olarak ayarla
        $perPage = $request->input('entries', 20);

        // cariler tablosundaki verileri sıralayarak, seçilen sayıya göre sayfalama işlemi
        $cariler = Cariler::orderByDesc('id')->where('firma_tipi', 'Müşteri')->paginate($perPage);

        // Sayfalama için başlangıç numarasını hesaplama
        $page = $cariler->currentPage();
        $startNumber = $cariler->total() - (($page - 1) * $perPage);

        $user = User::all();
        $aramalar = Aramalar::all();

        return view('admin.contents.cariler.cariler', compact('cariler', 'startNumber', 'user', 'aramalar', 'perPage'));
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
        $cariler = new Cariler();
        $cariler->islem_yapan = Auth::user()->id;
        $cariler->islem_tarihi = Carbon::now();
        $cariler->son_guncelleyen = Auth::user()->id;
        $cariler->firma_unvan = $request->firma_unvan;
        $cariler->ticari_unvan = $request->ticari_unvan;
        $cariler->firma_sektor = $request->firma_sektor;
        $cariler->is_tel = $request->is_tel;
        $cariler->yetkili_kisi = $request->yetkili_kisi;
        $cariler->yetkili_kisi_tel = $request->yetkili_kisi_tel;
        $cariler->eposta = $request->eposta;
        $cariler->web_adres = $request->web_adres;
        $cariler->firma_turu = $request->firma_turu;
        $cariler->il = $request->il;
        $cariler->ilce = $request->ilce;
        $cariler->vergi_no = $request->vergi_no;
        $cariler->vergi_dairesi = $request->vergi_dairesi;
        $cariler->tc_kimlik = $request->tc_kimlik;
        $cariler->adres = $request->adres;
        $cariler->aciklama = $request->aciklama;
        $cariler->musteri_temsilcisi = $request->musteri_temsilcisi;
        $cariler->firma_tipi = $request->firma_tipi;
        $cariler->firma_durumu = $request->firma_durumu;
        $cariler->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $cariler->firma_unvan . ' ' . 'Carisini Ekledi';
        $log->save();
        $referer = $request->headers->get('referer');

        if (strpos($referer, '/tedarikciler') !== false) {
            return redirect('tedarikciler')->with('success', 'Ekleme Başarılı');
        }

        return redirect('cariler')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {

        $cariler = Cariler::find($id);
        $aramalar = Aramalar::where('cari_id', $id)->get();
        $kontak = Kontak::where('cari_id', $id)->get();
        $user = User::all();
        $teklifler = Teklifler::where('cari_id', $id)->get();
        $durumlar = [
            'Bekleyen' => $teklifler->where('durum', 0),
            'Onaylanan' => $teklifler->where('durum', 1),
            'Reddedilen' => $teklifler->where('durum', 2),
            'Toplam' => $teklifler
        ];
        $dokuman = Dokuman::where('cari_id', $id)->get();
        $firmahrkt = Firmahrkt::where('cari_id', $id)->where('durum', null)->get();


        $satislar = Firmahrkt::where('cari_id', $id)
            ->whereNotNull('satis_id')
            ->orderBy('id', 'desc')
            ->get();
        $satissayisi = $satislar->count();
        $satistutari = $satislar->sum('borc');

        $alislar = Firmahrkt::where('cari_id', $id)
            ->whereNotNull('alis_id')
            ->orderBy('id', 'desc')
            ->get();
        $alissayisi = $alislar->count();
        $alistutari = $alislar->sum('alacak');

        $tahsilat = Firmahrkt::where('cari_id', $id)->whereNotNull('tahsilat_id')->orderBy('id', 'desc')->get();
        $tahsilattutari = $tahsilat->sum('alacak');

        $odeme = Firmahrkt::where('cari_id', $id)->whereNotNull('odeme_id')->orderBy('id', 'desc')->get();
        $odemetutari = $odeme->sum('borc');

        return view('admin.contents.cariler.cariler-show', compact(
            'cariler',
            'alislar',
            'alissayisi',
            'alistutari',
            'aramalar',
            'kontak',
            'user',
            'teklifler',
            'durumlar',
            'dokuman',
            'firmahrkt',
            'satislar',
            'satissayisi',
            'satistutari',
            'tahsilat',
            'tahsilattutari',
            'odemetutari',
            'odeme'
        ));
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
        $cariler = Cariler::find($id);


        // **Eski verileri al**
        $eskiVeriler = $cariler->getOriginal();

        $cariler->islem_yapan = Auth::user()->id;
        $cariler->islem_tarihi = Carbon::now();
        $cariler->son_guncelleyen = Auth::user()->id;
        $cariler->firma_unvan = $request->firma_unvan;
        $cariler->ticari_unvan = $request->ticari_unvan;
        $cariler->firma_sektor = $request->firma_sektor;
        $cariler->is_tel = $request->is_tel;
        $cariler->yetkili_kisi = $request->yetkili_kisi;
        $cariler->yetkili_kisi_tel = $request->yetkili_kisi_tel;
        $cariler->eposta = $request->eposta;
        $cariler->web_adres = $request->web_adres;
        $cariler->firma_turu = $request->firma_turu;
        $cariler->il = $request->il;
        $cariler->ilce = $request->ilce;
        $cariler->vergi_no = $request->vergi_no;
        $cariler->vergi_dairesi = $request->vergi_dairesi;
        $cariler->tc_kimlik = $request->tc_kimlik;
        $cariler->adres = $request->adres;
        $cariler->aciklama = $request->aciklama;
        $cariler->musteri_temsilcisi = $request->musteri_temsilcisi;
        $cariler->firma_tipi = $request->firma_tipi;
        $cariler->firma_durumu = $request->firma_durumu;
        $cariler->save();

        // **Değişen alanları belirle ve log kaydı oluştur**
        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            // Eğer eski veri ile yeni veri farklıysa, değişimi kaydet
            if (isset($cariler->$alan) && $cariler->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $cariler->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // **Değişiklikleri tek bir metin olarak birleştir**
            $degisenAlanlarText = '<br><ul>' .  implode(' ', $degisenAlanlar) . '</ul>';

            // Log kaydını oluştur
            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $cariler->firma_unvan . ' Carisinin bilgileri güncellendi.',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }

        return redirect('cariler')->with('success', 'Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cariler = Cariler::find($id);

        if (!$cariler) {
            return redirect('cariler')->with('error', 'Cari bulunamadı.');
        }

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $cariler->firma_unvan . ' ' . 'Carisi Silindi';
        $log->save();

        if ($cariler->teklifler()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait teklif olduğu için silinemez.');
        }
        if ($cariler->satislar()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait satış olduğu için silinemez.');
        }

        if ($cariler->ceksenet()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait çek/senet olduğu için silinemez.');
        }

        if ($cariler->tahsilatlar()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait tahsilat olduğu için silinemez.');
        }

        if ($cariler->alislar()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait alış olduğu için silinemez.');
        }
        if ($cariler->odemeler()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait ödeme olduğu için silinemez.');
        }
        if ($cariler->aramakaydi()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait arama kaydı olduğu için silinemez.');
        }
        if ($cariler->kontaklist()->count() > 0) {
            return redirect('cariler')->with('error', 'Bu cariye ait kontak olduğu için silinemez.');
        }

        $cariler->delete();
        return redirect('cariler')->with('success', 'Silme Başarılı');
    }
}
