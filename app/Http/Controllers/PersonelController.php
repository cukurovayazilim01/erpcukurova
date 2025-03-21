<?php

namespace App\Http\Controllers;

use App\Models\Dokumanlar;
use App\Models\Izinler;
use App\Models\Personel;
use App\Models\Poegitim;
use App\Models\User;
use App\Models\Zimmet;
use App\Models\Zimmetdata;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function personelegitimDELETE($id)
    {
        $poegitim = Poegitim::find($id);

        if ($poegitim) {
            $poegitim->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function personelegitimPOST(Request $request,$id)
    {
        $personel = Personel::find($id);
        $poegitim = new Poegitim();
        $poegitim -> personel_id = $personel->id;
        $poegitim -> egitim_yili = $request -> egitim_yili;
        $poegitim -> egitim_adi = $request -> egitim_adi;
        $poegitim -> egitim_suresi = $request -> egitim_suresi;
        $poegitim -> egitim_yeri = $request -> egitim_yeri;
        if ($request->hasFile('egitim_dosya')) {
            $fileExtension = $request->egitim_dosya->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $poegitim->egitim_adi) . '.' . $fileExtension;
            $request->egitim_dosya->move(public_path('/personelegitim'), $imageName);
            $poegitim->egitim_dosya = '/personelegitim/' . $imageName;
        }
        $poegitim -> egitim_sonucu = $request -> egitim_sonucu;
        $poegitim -> save();
        return redirect('personell')->with('success', 'Ekleme Başarılı');

    }
    public function personeldokumanpost(Request $request,$id)
    {
        $personel = Personel::find($id);
        $personeldokuman = new Dokumanlar();
        $personeldokuman -> personel_id = $personel->id;
        $personeldokuman -> kategori = 'Personel';
        $personeldokuman -> dokuman_donem = $request -> dokuman_donem;
        $personeldokuman -> dokuman_adi = $request -> dokuman_adi;
        if ($request->hasFile('dokuman_yolu')) {
            $fileExtension = $request->dokuman_yolu->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $personeldokuman->dokuman_adi) . '.' . $fileExtension;
            $request->dokuman_yolu->move(public_path('/personeldokuman'), $imageName);
            $personeldokuman->dokuman_yolu = '/personeldokuman/' . $imageName;
        }
        $personeldokuman -> aciklama = $request -> aciklama;
        $personeldokuman -> save();
        return redirect('personell')->with('success', 'Ekleme Başarılı');

    }
    public function personeldokumandelete($id)
    {
        $dokuman = Dokumanlar::find($id);

        if ($dokuman) {
            $dokuman->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    // public function personeldokumandelete(string $id)
    // {
    //     $personeldokuman = Dokumanlar::find($id);
    //     dd($personeldokuman);
    //     $personeldokuman -> delete();
    //     return redirect('personell')->with('success', 'Silme Başarılı');

    // }
    public function personellistesi()
    {
        $personel = Personel::all();
        $user = User::all();
        return view('admin.contents.personel.personellistesi', compact('personel', 'user'));
    }
    public function index()
    {
        $personel = Personel::all();
        $user = User::all();
        $personeldokuman = Dokumanlar::where('kategori','Personel')->get();
        $personelegitim = Poegitim::all();
        return view('admin.contents.personel.personel', compact('personel', 'user','personeldokuman','personelegitim'));
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
        $personel = new Personel();
        $personel->islem_yapan = Auth::user()->id;
        $personel->islem_tarihi = Carbon::now();
        $personel->ad_soyad = $request->ad_soyad;
        $personel->tc = $request->tc;
        $personel->sigorta_sicil_no = $request->sigorta_sicil_no;
        $personel->sigorta_giris_tarihi = $request->sigorta_giris_tarihi;
        $personel->meslek_kodu = $request->meslek_kodu;
        $personel->okul = $request->okul;
        $personel->mezuniyet = $request->mezuniyet;
        $personel->meslegi = $request->meslegi;
        $personel->departman = $request->departman;
        $personel->dogum_yeri = $request->dogum_yeri;
        $personel->dogum_tarihi = $request->dogum_tarihi;
        $personel->gsm = $request->gsm;
        $personel->mail = $request->mail;
        $personel->ise_giris_tarihi = $request->ise_giris_tarihi;
        $personel->isten_cikis_tarihi = $request->isten_cikis_tarihi;
        $personel->gorevi = $request->gorevi;
        $personel->kidem_yili = $request->kidem_yili;
        $personel->medeni_hali = $request->medeni_hali;
        $personel->kan_grubu = $request->kan_grubu;
        $personel->medeni_hali = $request->medeni_hali;
        $personel->askerlik_durumu = $request->askerlik_durumu;
        if ($request->hasFile('personel_resim')) {
            $fileExtension = $request->personel_resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $personel->ad_soyad) . '.' . $fileExtension;
            $request->personel_resim->move(public_path('/personel'), $imageName);
            $personel->personel_resim = '/personel/' . $imageName;
        }
        $personel->ehliyet_sinif = $request->ehliyet_sinif;
        $personel->ehliyet_tarihi = $request->ehliyet_tarihi;
        $personel->baba_adi = $request->baba_adi;
        $personel->baba_meslegi = $request->baba_meslegi;
        $personel->ayak_no = $request->ayak_no;
        $personel->beden = $request->beden;
        $personel->ev_gsm = $request->ev_gsm;
        $personel->ev_adresi = $request->ev_adresi;
        $personel->acil_durum_kisi = $request->acil_durum_kisi;
        $personel->save();
        $referer = $request->headers->get('referer');

        if (strpos($referer, '/personellistesi') !== false) {

            return redirect()->route('personellistesi')->with('success', 'Ekleme Başarılı');
        }
        return redirect('personell')->with('success', 'Ekleme Başarılı');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $personel = Personel::find($id);
        $personelegitim = Poegitim::where('personel_id', $personel->id)->get();
        $personelzimmet = Zimmet::where('personel_id',$personel->id)->get();
        $personelizin = Izinler::where('personel_id',$personel->id)->get();
        return view('admin.contents.personel.personel-show',compact('personelizin','personel','personelegitim','personelzimmet'));
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
        $personel = Personel::find($id);
        $personel->islem_yapan = Auth::user()->id;
        $personel->islem_tarihi = Carbon::now();
        $personel->ad_soyad = $request->ad_soyad;
        $personel->tc = $request->tc;
        $personel->sigorta_sicil_no = $request->sigorta_sicil_no;
        $personel->sigorta_giris_tarihi = $request->sigorta_giris_tarihi;
        $personel->meslek_kodu = $request->meslek_kodu;
        $personel->okul = $request->okul;
        $personel->mezuniyet = $request->mezuniyet;
        $personel->meslegi = $request->meslegi;
        $personel->departman = $request->departman;
        $personel->dogum_yeri = $request->dogum_yeri;
        $personel->dogum_tarihi = $request->dogum_tarihi;
        $personel->gsm = $request->gsm;
        $personel->mail = $request->mail;
        $personel->ise_giris_tarihi = $request->ise_giris_tarihi;
        $personel->isten_cikis_tarihi = $request->isten_cikis_tarihi;
        $personel->gorevi = $request->gorevi;
        $personel->kidem_yili = $request->kidem_yili;
        $personel->medeni_hali = $request->medeni_hali;
        $personel->kan_grubu = $request->kan_grubu;
        $personel->medeni_hali = $request->medeni_hali;
        $personel->askerlik_durumu = $request->askerlik_durumu;
        if ($request->hasFile('personel_resim')) {
            $fileExtension = $request->personel_resim->getClientOriginalExtension();
            $imageName = str_replace(' ', '-', $personel->ad_soyad) . '.' . $fileExtension;
            $request->personel_resim->move(public_path('/personel'), $imageName);
            $personel->personel_resim = '/personel/' . $imageName;
        }
        $personel->ehliyet_sinif = $request->ehliyet_sinif;
        $personel->ehliyet_tarihi = $request->ehliyet_tarihi;
        $personel->baba_adi = $request->baba_adi;
        $personel->baba_meslegi = $request->baba_meslegi;
        $personel->ayak_no = $request->ayak_no;
        $personel->beden = $request->beden;
        $personel->ev_gsm = $request->ev_gsm;
        $personel->ev_adresi = $request->ev_adresi;
        $personel->acil_durum_kisi = $request->acil_durum_kisi;
        $personel->save();
        return redirect('personell')->with('success', 'Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personel = Personel::find($id);
        $personel->delete();
        return redirect('personell')->with('success', 'Silme Başarılı');

    }


}
