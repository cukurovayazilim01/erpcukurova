<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Isbasvurulari;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class IsbasvurulariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function personeleaktar($id)
    {
        $isbasvuru = Isbasvurulari::find($id);
        $personel = new Personel();
        $personel->islem_yapan = Auth::user()->id;
        $personel->islem_tarihi = Carbon::now();
        $personel->ad_soyad = $isbasvuru->ad_soyad;
        $personel->dogum_tarihi = $isbasvuru->dogum_tarihi;
        $personel->dogum_yeri = $isbasvuru->dogum_yeri;
        $personel->mezuniyet = $isbasvuru->mezuniyet;
        $personel->meslegi = $isbasvuru->meslegi;
        $personel->departman = $isbasvuru->basvuru_pozisyon;
        $personel->gsm = $isbasvuru->telefon;
        $personel->mail = $isbasvuru->email;
        $personel->medeni_hali = $isbasvuru->medeni_hal;
        $personel->kan_grubu = $isbasvuru->kan_grubu;
        $personel->askerlik_durumu = $isbasvuru->askerlik_durumu;
        $personel->ehliyet_sinif = $isbasvuru->ehliyet_sinif;
        $personel->ehliyet_tarihi = $isbasvuru->ehliyet_tarihi;
        $personel->ev_gsm = $isbasvuru->ev_telefon;
        $personel->ev_adresi = $isbasvuru->ev_adresi;
        $personel->save();
        $isbasvuru->personel_aktarma_durum = 1;
        $isbasvuru->save();
        return redirect()->route("personell.index")->with("success", "Personel Listesine Aktarıldı");
    }
    public function isbasvurularilist()
    {
        $isbasvuru = Isbasvurulari::all();

        return view('admin.contents.isbasvurulari.isbasvurularilist', compact('isbasvuru'));
    }
    public function index()
    {
        $isbasvuru = Isbasvurulari::all();
        return view('admin.contents.isbasvurulari.isbasvurulari', compact('isbasvuru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contents.isbasvurulari.isbasvurulari-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $yabancidilinputs = $request->input('inputs'); // Formdan gelen tüm verileri al
        $yabanciDiller = []; // Boş bir dizi oluştur

        foreach ($yabancidilinputs as $yabancidilinput) {
            $yabanciDiller[] = [
                'yabanci_dil' => $yabancidilinput['yabanci_dil'],
                'yabanci_dil_derecesi' => $yabancidilinput['yabanci_dil_derecesi']
            ];
        }

        $egitimdurumuinputs = $request->input('inputss'); // Formdan gelen tüm verileri al

        $egitimdurumu = []; // Boş bir dizi oluştur

        foreach ($egitimdurumuinputs as $egitimdurumuinput) {
            $egitimdurumu[] = [
                'okul_seviyesi' => $egitimdurumuinput['okul_seviyesi'],
                'okul_adi' => $egitimdurumuinput['okul_adi'],
                'mezuniyet_yili' => $egitimdurumuinput['mezuniyet_yili'],
                'okul_derecesi' => $egitimdurumuinput['okul_derecesi']
            ];
        }

        $calisilanfirmainputs = $request->input('inputsss'); // Formdan gelen tüm verileri al

        $calisilanfirma = []; // Boş bir dizi oluştur

        foreach ($calisilanfirmainputs as $calisilanfirmainput) {
            $calisilanfirma[] = [
                'firma_adi' => $calisilanfirmainput['firma_adi'],
                'calisilan_yil' => $calisilanfirmainput['calisilan_yil'],
                'cikis_nedeni' => $calisilanfirmainput['cikis_nedeni']
            ];
        }

        $referansinputs = $request->input('inputssss'); // Formdan gelen tüm verileri al

        $referans = []; // Boş bir dizi oluştur

        foreach ($referansinputs as $referansinput) {
            $referans[] = [
                'referans_adsoyad' => $referansinput['referans_adsoyad'],
                'referans_meslegi' => $referansinput['referans_meslegi'],
                'referans_tel' => $referansinput['referans_tel']
            ];
        }

        $pcprogramiinputs = $request->input('inputsssss'); // Formdan gelen tüm verileri al

        $pcprogrami = []; // Boş bir dizi oluştur

        foreach ($pcprogramiinputs as $pcprogramiinput) {
            $pcprogrami[] = [
                'bilgisayar_prog' => $pcprogramiinput['bilgisayar_prog'],
                'bilgisayar_prog_derecesi' => $pcprogramiinput['bilgisayar_prog_derecesi']
            ];
        }


        $isbasvuru = new Isbasvurulari();

        $isbasvuru->yabanci_dil = json_encode($yabanciDiller);
        $isbasvuru->egitim_durumu = json_encode($egitimdurumu);
        $isbasvuru->calisilan_firma = json_encode($calisilanfirma);
        $isbasvuru->referanss = json_encode($referans);
        $isbasvuru->pc_programi = json_encode($pcprogrami);

        $isbasvuru->islem_yapan = Auth::user()->id;
        $isbasvuru->islem_tarihi = Carbon::now();
        $isbasvuru->tarih = $request->tarih;
        $isbasvuru->ad_soyad = $request->ad_soyad;
        $isbasvuru->basvuru_pozisyon = $request->basvuru_pozisyon;
        $isbasvuru->telefon = $request->telefon;
        $isbasvuru->ev_telefon = $request->ev_telefon;
        $isbasvuru->dogum_yeri = $request->dogum_yeri;
        $isbasvuru->dogum_tarihi = $request->dogum_tarihi;
        $isbasvuru->meslegi = $request->meslegi;
        $isbasvuru->email = $request->email;
        $isbasvuru->mezuniyet = $request->mezuniyet;
        $isbasvuru->medeni_hal = $request->medeni_hal;
        $isbasvuru->cocuk_yasi = $request->cocuk_yasi;
        $isbasvuru->askerlik_durumu = $request->askerlik_durumu;
        $isbasvuru->ehliyet_sinif = $request->ehliyet_sinif;
        $isbasvuru->ehliyet_tarihi = $request->ehliyet_tarihi;
        $isbasvuru->kan_grubu = $request->kan_grubu;
        $isbasvuru->sorusturma = $request->sorusturma;
        $isbasvuru->sigara = $request->sigara;
        $isbasvuru->ameliyat = $request->ameliyat;
        $isbasvuru->kurs = $request->kurs;
        $isbasvuru->sertifika = $request->sertifika;
        $isbasvuru->kalite_firma = $request->kalite_firma;
        $isbasvuru->ev_adresi = $request->ev_adresi;
        $isbasvuru->aylik_ucret = $request->aylik_ucret;
        $isbasvuru->ise_baslama = $request->ise_baslama;
        $isbasvuru->signature_data = $request->signature_data;

        $isbasvuru->gorusme_notu = $request->gorusme_notu;
        if ($request->hasFile('dosya')) {
            $fileExtension = $request->dosya->getClientOriginalExtension();
            $fileName = str_replace(' ', '-', $isbasvuru->ad_soyad) . '.' . $fileExtension;
            $request->dosya->move(public_path('/isbasvuruevrak'), $fileName);
            $isbasvuru->dosya = '/isbasvuruevrak/' . $fileName;
        }

        if ($request->hasFile('resim')) {
            $fileExtension = $request->resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $isbasvuru->ad_soyad) . '-Fotografi.' . $fileExtension;
            $request->resim->move(public_path('/isbasvuruevrak'), $imageName);
            $isbasvuru->resim = '/isbasvuruevrak/' . $imageName;
        }



        $isbasvuru->save();
        // Eğer "Kaydet ve Personel Listesine Aktar" butonuna basılmışsa
        if ($request->input('action') == 'save_and_transfer') {
            return $this->personeleaktar($isbasvuru->id); // Mevcut personele aktar fonksiyonunu çağır
        }

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $isbasvuru->ad_soyad . ' ' . $isbasvuru->tarih . ' tarihinde iş başvurusu kaydı eklendi';
        $log->save();
        return redirect('isbasvurulari')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $isbasvuru = Isbasvurulari::find($id);

        return view('admin.contents.isbasvurulari.isbasvurulari-show', compact('isbasvuru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $isbasvuru = Isbasvurulari::find($id);
        return view('admin.contents.isbasvurulari.isbasvurulari-update', compact('isbasvuru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $isbasvuru = Isbasvurulari::find($id);

        $eskiVeriler = $isbasvuru->getOriginal();


        // Güncellenmiş verileri al
        $yabancidilinputs = $request->input('inputs', []);
        $egitimdurumuinputs = $request->input('inputss', []);
        $calisilanfirmainputs = $request->input('inputsss', []);
        $referansinputs = $request->input('inputssss', []);
        $pcprogramiinputs = $request->input('inputsssss', []);

        // Güncelleme işlemleri
        $yabanciDiller = [];
        foreach ($yabancidilinputs as $key => $input) {
            $yabanciDiller[$key] = [
                'yabanci_dil' => $input['yabanci_dil'] ?? '',
                'yabanci_dil_derecesi' => $input['yabanci_dil_derecesi'] ?? ''
            ];
        }

        $egitimdurumu = [];
        foreach ($egitimdurumuinputs as $key => $input) {
            $egitimdurumu[$key] = [
                'okul_seviyesi' => $input['okul_seviyesi'] ?? '',
                'okul_adi' => $input['okul_adi'] ?? '',
                'mezuniyet_yili' => $input['mezuniyet_yili'] ?? '',
                'okul_derecesi' => $input['okul_derecesi'] ?? ''
            ];
        }

        $calisilanfirma = [];
        foreach ($calisilanfirmainputs as $key => $input) {
            $calisilanfirma[$key] = [
                'firma_adi' => $input['firma_adi'] ?? '',
                'calisilan_yil' => $input['calisilan_yil'] ?? '',
                'cikis_nedeni' => $input['cikis_nedeni'] ?? ''
            ];
        }

        $referans = [];
        foreach ($referansinputs as $key => $input) {
            $referans[$key] = [
                'referans_adsoyad' => $input['referans_adsoyad'] ?? '',
                'referans_meslegi' => $input['referans_meslegi'] ?? '',
                'referans_tel' => $input['referans_tel'] ?? ''
            ];
        }

        $pcprogrami = [];
        foreach ($pcprogramiinputs as $key => $input) {
            $pcprogrami[$key] = [
                'bilgisayar_prog' => $input['bilgisayar_prog'] ?? '',
                'bilgisayar_prog_derecesi' => $input['bilgisayar_prog_derecesi'] ?? ''
            ];
        }

        // Güncellenmiş JSON verilerini kaydet
        $isbasvuru->yabanci_dil = json_encode($yabanciDiller);
        $isbasvuru->egitim_durumu = json_encode($egitimdurumu);
        $isbasvuru->calisilan_firma = json_encode($calisilanfirma);
        $isbasvuru->referanss = json_encode($referans);
        $isbasvuru->pc_programi = json_encode($pcprogrami);

        $isbasvuru->islem_yapan = Auth::user()->id;
        $isbasvuru->islem_tarihi = Carbon::now();
        $isbasvuru->tarih = $request->tarih;
        $isbasvuru->ad_soyad = $request->ad_soyad;
        $isbasvuru->basvuru_pozisyon = $request->basvuru_pozisyon;
        $isbasvuru->telefon = $request->telefon;
        $isbasvuru->ev_telefon = $request->ev_telefon;
        $isbasvuru->dogum_yeri = $request->dogum_yeri;
        $isbasvuru->dogum_tarihi = $request->dogum_tarihi;
        $isbasvuru->meslegi = $request->meslegi;
        $isbasvuru->email = $request->email;
        $isbasvuru->mezuniyet = $request->mezuniyet;
        $isbasvuru->medeni_hal = $request->medeni_hal;
        $isbasvuru->cocuk_yasi = $request->cocuk_yasi;
        $isbasvuru->askerlik_durumu = $request->askerlik_durumu;
        $isbasvuru->ehliyet_sinif = $request->ehliyet_sinif;
        $isbasvuru->ehliyet_tarihi = $request->ehliyet_tarihi;
        $isbasvuru->kan_grubu = $request->kan_grubu;
        $isbasvuru->sorusturma = $request->sorusturma;
        $isbasvuru->sigara = $request->sigara;
        $isbasvuru->ameliyat = $request->ameliyat;
        $isbasvuru->kurs = $request->kurs;
        $isbasvuru->sertifika = $request->sertifika;
        $isbasvuru->kalite_firma = $request->kalite_firma;
        $isbasvuru->ev_adresi = $request->ev_adresi;
        $isbasvuru->aylik_ucret = $request->aylik_ucret;
        $isbasvuru->ise_baslama = $request->ise_baslama;
        $isbasvuru->signature_data = $request->signature_data;
        $isbasvuru->gorusme_notu = $request->gorusme_notu;

        if ($request->hasFile('dosya')) {
            $fileExtension = $request->dosya->getClientOriginalExtension();
            $fileName = str_replace(' ', '-', $isbasvuru->ad_soyad) . '.' . $fileExtension;
            $request->dosya->move(public_path('/isbasvuruevrak'), $fileName);
            $isbasvuru->dosya = '/isbasvuruevrak/' . $fileName;
        }

        if ($request->hasFile('resim')) {
            $fileExtension = $request->resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $isbasvuru->ad_soyad) . '-Fotografi.' . $fileExtension;
            $request->resim->move(public_path('/isbasvuruevrak'), $imageName);
            $isbasvuru->resim = '/isbasvuruevrak/' . $imageName;
        }

        $isbasvuru->save();


        // **Değişen alanları belirle ve log kaydı oluştur**
        $degisenAlanlar = [];
        foreach ($eskiVeriler as $alan => $eskiDeger) {
            if (isset($isbasvuru->$alan) && $isbasvuru->$alan != $eskiDeger) {
                $degisenAlanlar[] = '<li>' . ucfirst(str_replace('_', ' ', $alan)) . ' değişti: ' . $eskiDeger . ' → ' . $isbasvuru->$alan . '</li>';
            }
        }

        if (!empty($degisenAlanlar)) {
            // Değişiklikleri HTML formatında birleştir
            $degisenAlanlarText = '<br><ul>' . implode(' ', $degisenAlanlar) . '</ul>';

            Aktiflog::create([
                'islem_tarihi' => Carbon::now(),
                'islemiyapan_id' => Auth::user()->id,
                'islem' => $isbasvuru->ad_soyad . ' ' . $isbasvuru->tarih . ' tarihinde iş başvurusu kaydı Güncellendi.',
                'guncellenmis_islem' => 'Değişiklikler: ' . $degisenAlanlarText,
            ]);
        }
        return redirect('isbasvurulari')->with('success', 'Güncelleme Başarılı');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isbasvuru = Isbasvurulari::find($id);

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $isbasvuru->ad_soyad . ' ' . $isbasvuru->tarih . ' tarihinde iş başvurusu kaydı Silindi';
        $log->save();
        $isbasvuru->delete();
        return redirect('isbasvurulari')->with('success', 'Silme Başarılı');
    }
}
