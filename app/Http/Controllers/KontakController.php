<?php

namespace App\Http\Controllers;

use App\Models\Cariler;
use App\Models\Kontak;
use App\Models\User;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function kontaklarsearch(Request $request)
    {
        $kontaklarsearch = $request->input('kontaklarsearch');

        // Temel sorgu
        $kontaklarQuery = Kontak::orderByDesc('id');


        // Eğer arama yapılmışsa
        if ($kontaklarsearch) {
            $kontaklarQuery->whereHas('firmaadi', function ($query) use ($kontaklarsearch) {
                $query->where('firma_unvan', 'like', '%' . $kontaklarsearch . '%');
            });
        }



        // Sorguyu tamamla ve sayfala
        $kontak = $kontaklarQuery->paginate(50);

        // Sayfa numarasını hesapla
        $page = $request->query('page', 1);
        $perPage = 50;
        $startNumber = $kontak->total() - (($page - 1) * $perPage);

        $user = User::all();

        // Eğer AJAX isteği ise arama sonucunu döndür
        if ($request->ajax()) {
            return view('admin.contents.kontaklistesi.kontaklistesi-search', compact('kontak', 'startNumber', 'user','perPage'));
        }

        // Normal sayfa için arama sonucu döndür
        return view('admin.contents.kontaklistesi.kontaklistesi', compact( 'startNumber', 'user','perPage'));

    }

    public function cariSearchkontak(Request $request)
    {
        $searchTerm = $request->get('q');  // Arama kelimesi
        $cariler = Cariler::where('firma_unvan', 'like', '%' . $searchTerm . '%')->get();
        return response()->json($cariler);
    }
    public function index(Request $request)
    {
        // Kullanıcının seçtiği kayıt sayısını al veya varsayılan 20 olarak ayarla
        $perPage = $request->input('entries', 20);

        // cariler tablosundaki verileri sıralayarak, seçilen sayıya göre sayfalama işlemi
        $kontak = Kontak::orderByDesc('id')->paginate($perPage);

        // Sayfalama için başlangıç numarasını hesaplama
        $page = $kontak->currentPage();
        $startNumber = $kontak->total() - (($page - 1) * $perPage);

        $user = User::all();


        return view('admin.contents.kontaklistesi.kontaklistesi', compact('startNumber', 'user', 'kontak', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kontak = new Kontak();
        $user = User::all();
        return view('admin.contents.kontaklistesi.kontaklistesi-create',compact('user','kontak'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kontak = new Kontak();
        $kontak->cari_id = $request->cari_id;
        $kontak->yetkili_isim = $request->yetkili_isim;
        $kontak->telefon = $request->telefon;
        $kontak->eposta = $request->eposta;
        $kontak->save();

        return redirect('kontaklistesi')->with('success','Ekleme Başarılı');
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
        $kontak = Kontak::find($id);
        $firmalar = Cariler::all();
        return view('admin.contents.kontaklistesi.kontaklistesi-update',compact('kontak','firmalar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kontak = Kontak::find($id);
        $kontak->yetkili_isim = $request->yetkili_isim;
        $kontak->telefon = $request->telefon;
        $kontak->eposta = $request->eposta;

        $kontak->save();
        return redirect('kontaklistesi')->with('success','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kontak = Kontak::find($id);
        $kontak -> delete();
        return redirect('kontaklistesi')->with('success','Silme Başarılı');
    }
}
