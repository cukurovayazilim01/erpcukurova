<?php

namespace App\Http\Controllers;

use App\Models\Aktiflog;
use App\Models\User;
use Illuminate\Http\Request;

class AktifLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function aktiflogsearch(Request $request)
    {
        $aktiflogsearch = $request->input('aktiflogsearch');

        // Eğer arama yapılmışsa
        if (!empty($aktiflogsearch)) {
            $aktiflog = Aktiflog::orderByDesc('id')
                ->whereHas('adsoyad', function ($query) use ($aktiflogsearch) {
                    $query->where('ad_soyad', 'like', '%' . $aktiflogsearch . '%');
                })
                ->paginate(50);
        } else {
            // Arama yapılmamışsa tüm verileri getir
            $aktiflog = Aktiflog::orderByDesc('id')->paginate(50);
        }

        // Sayfa numarasını hesapla
        $page = $request->query('page', 1);
        $perPage = 50;
        $startNumber = $aktiflog->total() - (($page - 1) * $perPage);

        $user = User::all();

        // AJAX isteği ise sadece arama sonuçlarını döndür
        if ($request->ajax()) {
            return view('admin.contents.aktiflog.aktiflog-search', compact('aktiflog', 'startNumber', 'user'));
        }

        // Normal sayfa için tüm veriyi döndür
        return view('admin.contents.aktiflog.aktiflog', compact('aktiflog', 'startNumber', 'user'));
    }

    public function index(Request $request)
    {

        // Kullanıcının seçtiği kayıt sayısını al veya varsayılan 20 olarak ayarla
        $perPage = $request->input('entries', 15);

        // aktiflog tablosundaki verileri sıralayarak, seçilen sayıya göre sayfalama işlemi
        $aktiflog = Aktiflog::orderByDesc('id')->paginate($perPage);

        // Sayfalama için başlangıç numarasını hesaplama
        $page = $aktiflog->currentPage();
        $startNumber = $aktiflog->total() - (($page - 1) * $perPage);

        $user = User::all();
        return view('admin.contents.aktiflog.aktiflog', compact('aktiflog', 'user', 'startNumber', 'perPage'));
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
