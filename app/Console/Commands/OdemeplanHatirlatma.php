<?php

namespace App\Console\Commands;

use App\Mail\OdemeplanhatirlatmaMail;
use App\Models\Odemeplanlari;
use App\Models\Smsapi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class OdemeplanHatirlatma extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:odemeplan-hatirlatma';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tahsilat planda vade tarihi gelen kayıtları mail ve sms gönderir.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

    // Smsapi verisini al
    $smsapi = Smsapi::first();

    // Smsapi verisi mevcutsa işlemi başlat
    if (!empty($smsapi)) {
        $postUrl = 'http://www.ozteksms.com/panel/smsgonder1Npost.php';
        $KULLANICINO = $smsapi->kullanici_no;
        $KULLANICIADI = $smsapi->kullanici_adi;
        $SIFRE = $smsapi->sifre;
        $ORGINATOR = $smsapi->orginator;
        $TUR = 'Normal';

        // Vade tarihi bugüne eşit olan tahsilat planlarını al
        $odemeplan = Odemeplanlari::where('vade_tarih', $today)
        ->where('durum','Yapılmadı')->get();

        // Her bir tahsilat planı için işlem yap
        foreach ($odemeplan as $odeme) {
            $islemyapan = $odeme->islemyapan;


            // E-posta gönderimi
            if (!empty($islemyapan->email)) {
                Mail::to($islemyapan->email)
                    ->send(new OdemeplanhatirlatmaMail($odeme));
            }

            // SMS gönderimi
            if (!empty($islemyapan->telefon)) {
                $mesaj = "Sayın {$islemyapan->ad_soyad}, vade tarihi {$odeme->vade_tarih} olan {$odeme->firmaadi->firma_unvan} carisine {$odeme->odeme_tutar} tl ödeme yapmayı unutmayınız.";

                $numara = $islemyapan->telefon;

                $xmlString = 'data=<sms>
                    <kno>' . $KULLANICINO . '</kno>
                    <kulad>' . $KULLANICIADI . '</kulad>
                    <sifre>' . $SIFRE . '</sifre>
                    <gonderen>' . $ORGINATOR . '</gonderen>
                    <mesaj>' . $mesaj . '</mesaj>
                    <numaralar>' . $numara . '</numaralar>
                    <tur>' . $TUR . '</tur>
                </sms>';

                // cURL isteği başlat
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $postUrl);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);

                $response = curl_exec($ch);
                if(curl_errno($ch)) {
                    $this->error('cURL error: ' . curl_error($ch));
                }
                curl_close($ch);
            }
        }

        // Başarılı işlem bilgisi
        $this->info('Mail ve SMS başarıyla gönderildi!');
    } else {
        // Smsapi bilgileri yoksa hata mesajı
        $this->error('SMS API bilgileri bulunamadı!');
    }
    }
}
