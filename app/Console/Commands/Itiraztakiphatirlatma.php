<?php

namespace App\Console\Commands;

use App\Mail\ItiraztakiphatirlatmaMail;
use App\Models\Itiraztakip;
use App\Models\Smsapi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Itiraztakiphatirlatma extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:itiraztakiphatirlatma';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'İtiraz Takipte teblig bitis tarihine 1 hafta kala sms mail atar';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baslama_tarihi = Carbon::today()->subDays(7);
        $bitis_tarihi = Carbon::today();

        $smsapi = Smsapi::first();

        if (!empty($smsapi->kullanici_no)) {
            $postUrl = 'http://www.ozteksms.com/panel/smsgonder1Npost.php';
            $KULLANICINO = $smsapi->kullanici_no;
            $KULLANICIADI = $smsapi->kullanici_adi;
            $SIFRE = $smsapi->sifre;
            $ORGINATOR = $smsapi->orginator;
            $TUR = 'Normal';

            // Satış temsilcisine hem mail hem SMS gönderme
            $itiraztakipsatistemsilcisi = Itiraztakip::whereBetween('teblig_bitis_tarihi', [$baslama_tarihi, $bitis_tarihi])->get();
            foreach ($itiraztakipsatistemsilcisi as $itiraztakipsatistemsilcisiitem) {
                if (!empty($itiraztakipsatistemsilcisiitem->referansno->satistemsilcisi->email)) {
                    Mail::to($itiraztakipsatistemsilcisiitem->referansno->satistemsilcisi->email)
                        ->send(new ItiraztakiphatirlatmaMail($itiraztakipsatistemsilcisiitem, 'satistemsilcisi'));
                }

                if (!empty($itiraztakipsatistemsilcisiitem->referansno->satistemsilcisi->telefon)) {
                    $mesaj = "Sayın {$itiraztakipsatistemsilcisiitem->satis_temsilcisi}, başvuru no {$itiraztakipsatistemsilcisiitem->basvuru_no} olan markanın tebliğ bitiş tarihine 7 gün kalmıştır.
                    Tebliğ Bitiş Tarihi: " . Carbon::parse($itiraztakipsatistemsilcisiitem->teblig_bitis_tarihi)->format('d.m.Y') . "
                    Lütfen gerekli işlemleri tamamlamayı unutmayın.";

                    $numara = $itiraztakipsatistemsilcisiitem->referansno->satistemsilcisi->telefon;

                    $xmlString = 'data=<sms>
                <kno>' . $KULLANICINO . '</kno>
                <kulad>' . $KULLANICIADI . '</kulad>
                <sifre>' . $SIFRE . '</sifre>
                <gonderen>' . $ORGINATOR . '</gonderen>
                <mesaj>' . $mesaj . '</mesaj>
                <numaralar>' . $numara . '</numaralar>
                <tur>' . $TUR . '</tur>
                </sms>';

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $postUrl);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                    curl_exec($ch);
                    curl_close($ch);
                }
            }

            // Müşteriye hem mail hem SMS gönderme
            $itiraztakipmusteri = Itiraztakip::whereBetween('teblig_bitis_tarihi', [$baslama_tarihi, $bitis_tarihi])->get();
            foreach ($itiraztakipmusteri as $itiraztakipmusteriitem) {
                if (!empty($itiraztakipmusteriitem->referansno->firmaadi->eposta)) {
                    Mail::to($itiraztakipmusteriitem->referansno->firmaadi->eposta)
                        ->send(new ItiraztakiphatirlatmaMail($itiraztakipmusteriitem, 'musteri'));
                }

                if (!empty($itiraztakipmusteriitem->referansno->firmaadi->yetkili_kisi_tel)) {
                    $mesaj = "Sayın {$itiraztakipmusteriitem->referansno->firmaadi->yetkili_kisi},
                    Marka tescil başvurunuza  {$itiraztakipmusteriitem->bakanlik_karari} gelmiştir. Kanuni süre olarak 7 gün kalmıştır.
                    Tebliğ Bitiş Tarihi: " . Carbon::parse($itiraztakipmusteriitem->teblig_bitis_tarihi)->format('d.m.Y') . "
                    Lütfen gerekli işlemleri tamamlamak için Çukurova Patent müşteri temsilcisine ulaşınız.
                    {$itiraztakipmusteriitem->referansno->satistemsilcisi->ad_soyad}  {$itiraztakipmusteriitem->referansno->satistemsilcisi->telefon}";

                    $numara = $itiraztakipmusteriitem->referansno->firmaadi->yetkili_kisi_tel;

                    $xmlString = 'data=<sms>
                <kno>' . $KULLANICINO . '</kno>
                <kulad>' . $KULLANICIADI . '</kulad>
                <sifre>' . $SIFRE . '</sifre>
                <gonderen>' . $ORGINATOR . '</gonderen>
                <mesaj>' . $mesaj . '</mesaj>
                <numaralar>' . $numara . '</numaralar>
                <tur>' . $TUR . '</tur>
                </sms>';

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $postUrl);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                    curl_exec($ch);
                    curl_close($ch);
                }
            }
        }

        $this->info('Mail ve SMS başarıyla gönderildi!');
    }

}