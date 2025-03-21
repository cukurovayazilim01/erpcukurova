<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\Aramalar;
use App\Models\Cariler;
use App\Models\Kontak;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;

class AramalarController extends Controller
{

    //  KONTAKKKKK BÖLÜMÜÜÜ
    public function kontakEkle(Request $request)
    {
        $kontak = new Kontak();
        $kontak->cari_id = $request->cari_id;
        $kontak->yetkili_isim = $request->yetkili_isim;
        $kontak->telefon = $request->telefon;
        $kontak->eposta = $request->eposta;
        $kontak->save();

        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $kontak->firmaadi->firma_unvan . ' ' . 'Carisine kontak Ekledi';
        $log->save();

        return redirect('cariler/' . $request->cari_id)->with('success', 'Ekleme Başarılı');
    }

    public function kontakGuncelle(Request $request, string $id)
    {
        $kontaklar = Kontak::find($id);
        $kontaklar -> cari_id = $request-> cari_id;
        $kontaklar -> yetkili_isim = $request-> yetkili_isim;
        $kontaklar -> telefon = $request-> telefon;
        $kontaklar->eposta = $request->eposta;

        $kontaklar->save();
        return redirect('cariler/' . $request->cari_id)->with('success', 'Güncelleme Başarılı');

    }
    public function kontakSilme(string $id)
    {
        $kontak = Kontak::find($id);
        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $kontak->firmaadi->firma_unvan . ' ' . 'Carisinin kontağı Silindi';
        $log->save();
        $kontak->delete();
        return redirect()->route('cariler.show', ['cariler' => $kontak->cari_id])->with('success', 'Silme Başarılı');
    }



    public function aramalarsearch(Request $request)
    {
        $aramalarsearch = $request->input('aramalarsearch');

        // Temel sorgu
        $aramalarQuery = Aramalar::orderByDesc('id');

        // Eğer arama yapılmışsa
        if ($aramalarsearch) {
            $aramalarQuery->whereHas('cariler', function ($query) use ($aramalarsearch) {
                $query->where('firma_unvan', 'like', '%' . $aramalarsearch . '%');
            });
        }

        // Sorguyu tamamla ve sayfala
        $aramalar = $aramalarQuery->paginate(50);

        // Sayfa numarasını hesapla
        $page = $request->query('page', 1);
        $perPage = 50;
        $startNumber = $aramalar->total() - (($page - 1) * $perPage);

        $user = User::all();

        // Eğer AJAX isteği ise arama sonucunu döndür
        if ($request->ajax()) {
            return view('admin.contents.gorusmelistesi.gorusmelistesi-search', compact('aramalar', 'startNumber', 'user'));
        }

        // Normal sayfa için arama sonucu döndür
        return view('admin.contents.gorusmelistesi.gorusmelistesi', compact( 'startNumber', 'user'));

    }


    public function index(Request $request)
    {
        // Kullanıcının seçtiği kayıt sayısını al veya varsayılan 20 olarak ayarla
        $perPage = $request->input('entries', 20);

        // cariler tablosundaki verileri sıralayarak, seçilen sayıya göre sayfalama işlemi
        $aramalar = Aramalar::orderByDesc('id')->paginate($perPage);

        // Sayfalama için başlangıç numarasını hesaplama
        $page = $aramalar->currentPage();
        $startNumber = $aramalar->total() - (($page - 1) * $perPage);

        $user = User::all();

        return view('admin.contents.gorusmelistesi.gorusmelistesi', compact('startNumber', 'user', 'aramalar', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aramalar = new Aramalar();
        return view('admin.contents.gorusmelistesi.gorusmelistesi-create',compact('aramalar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        $log->islem = $aramalar->cariler->firma_unvan . ' ' . 'Carisine'. $aramalar->not . 'ekledi';
        $log->save();
        $referer = $request->headers->get('referer');

        if (strpos($referer, '/gorusmelistesi/create') !== false) {
            // Eğer önceki URL 'gorusmelistesi/create' ise
            return redirect('gorusmelistesi')->with('success', 'Ekleme Başarılı');
        }
        return redirect('cariler/' . $request->cari_id)->with('success', 'Ekleme Başarılı');
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
        $aramalar = Aramalar::find($id);
        $log = new Aktiflog();
        $log->islem_tarihi = Carbon::now();
        $log->islemiyapan_id = Auth::user()->id;
        $log->islem = $aramalar->cariler->firma_unvan . ' ' . 'Carisinin'. $aramalar->not . 'silindi';
        $log->save();
        $aramalar -> delete();
        return redirect('/gorusmelistesi')->with('success','Silme Başarılı');
    }
}
