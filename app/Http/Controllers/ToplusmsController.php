<?php

namespace App\Http\Controllers;

use App\Models\Cariler;
use App\Models\Smsapi;
use App\Models\Toplusms;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToplusmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toplusms = Toplusms::all();
        $user = User::all();
        return view('admin.contents.toplusms.toplusms', compact('toplusms', 'user'));
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
        $toplusms = new Toplusms();
        $toplusms->islem_yapan = Auth::user()->id;
        $toplusms->islem_tarihi = Carbon::now();
        $toplusms->mesaj = $request->mesaj;
        $toplusms->firma_sektor = $request->firma_sektor;
        $toplusms->save();

        $smsapi = Smsapi::first();
        $cariler = Cariler::whereNotNull('yetkili_kisi_tel')
        ->where('firma_sektor', $toplusms->firma_sektor)->pluck('yetkili_kisi_tel')->toArray(); // Telefon numaralarını al

        if (!empty($smsapi->kullanici_no)) {
            header('Content-Type: text/html; charset=utf-8');
            $postUrl = 'http://www.ozteksms.com/panel/smsgonder1Npost.php';
            $KULLANICINO = $smsapi->kullanici_no;
            $KULLANICIADI = $smsapi->kullanici_adi;
            $SIFRE = $smsapi->sifre;
            $ORGINATOR = $smsapi->orginator;
            $TUR = 'Normal';

            // 20'şer gruplara böl
            $chunks = array_chunk($cariler, 20);

            foreach ($chunks as $numaraGrubu) {
                $numaralar = implode(',', $numaraGrubu); // Numara listesini birleştir

                $xmlString = 'data=<sms>
        <kno>' . $KULLANICINO . '</kno>
        <kulad>' . $KULLANICIADI . '</kulad>
        <sifre>' . $SIFRE . '</sifre>
        <gonderen>' . $ORGINATOR . '</gonderen>
        <mesaj>' . $toplusms->mesaj . '</mesaj>
        <numaralar>' . $numaralar . '</numaralar>
        <tur>' . $TUR . '</tur>
        </sms>';

                // CURL ile API'ye istek gönder
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $postUrl);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                $response = curl_exec($ch);
                curl_close($ch);

                // Başarılı olup olmadığını kontrol et
                if (strpos($response, 'OK') === false) {
                    continue; // Eğer başarısız olursa bu grubu atla ve sonraki gruba geç
                }

                sleep(5); // 5 saniye bekle ki API yoğunlaşmasın
            }
        } else {
            return redirect('satislar')->with('error', 'Sms Entegrasyonu Bulunamadı !');
        }

        return redirect('toplusms')->with('success', 'Toplu SMS Gönderimi Başladı');
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
