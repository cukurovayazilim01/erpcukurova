<?php

namespace App\Console\Commands;

use App\Mail\TescilnoksanhatirlatmaMail;
use App\Models\Smsapi;
use App\Models\Tescilnoksan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Tescilnoksanhatirlatma extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tescilnoksanhatirlatma';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tescil noksan teblig bitis tarihine 1 hafta kala sms mail atar';

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
            $tescilnoksansatistemsilcisi = Tescilnoksan::whereBetween('teblig_bitis_tarihi', [$baslama_tarihi, $bitis_tarihi])->get();
            foreach ($tescilnoksansatistemsilcisi as $tescilnoksansatistemsilcisiitem) {
                if (!empty($tescilnoksansatistemsilcisiitem->referansno->satistemsilcisi->email)) {
                    Mail::to($tescilnoksansatistemsilcisiitem->referansno->satistemsilcisi->email)
                        ->send(new TescilnoksanhatirlatmaMail($tescilnoksansatistemsilcisiitem, 'satistemsilcisi'));
                }

                if (!empty($tescilnoksansatistemsilcisiitem->referansno->satistemsilcisi->telefon)) {
                    $mesaj = "Sayın {$tescilnoksansatistemsilcisiitem->satis_temsilcisi}, başvuru no {$tescilnoksansatistemsilcisiitem->referansno->basvuru_no} olan markanın tescil noksan tebliğ bitiş tarihine 7 gün kalmıştır. Tebliğ Bitiş Tarihi: " . Carbon::parse($tescilnoksansatistemsilcisiitem->teblig_bitis_tarihi)->format('d.m.Y') . " Lütfen gerekli işlemleri tamamlamayı unutmayın.";

                    $numara = $tescilnoksansatistemsilcisiitem->referansno->satistemsilcisi->telefon;

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

            // // Müşteriye hem mail hem SMS gönderme
            // $itiraztakipmusteri = Itiraztakip::whereBetween('teblig_bitis_tarihi', [$baslama_tarihi, $bitis_tarihi])->get();
            // foreach ($itiraztakipmusteri as $itiraztakipmusteriitem) {
            //     if (!empty($itiraztakipmusteriitem->referansno->firmaadi->eposta)) {
            //         Mail::to($itiraztakipmusteriitem->referansno->firmaadi->eposta)
            //             ->send(new ItiraztakiphatirlatmaMail($itiraztakipmusteriitem, 'musteri'));
            //     }

            //     if (!empty($itiraztakipmusteriitem->referansno->firmaadi->yetkili_kisi_tel)) {
            //         $mesaj = "Sayın {$itiraztakipmusteriitem->referansno->firmaadi->yetkili_kisi},
            //         Marka tescil başvurunuza  {$itiraztakipmusteriitem->bakanlik_karari} gelmiştir. Kanuni süre olarak 7 gün kalmıştır.
            //         Tebliğ Bitiş Tarihi: " . Carbon::parse($itiraztakipmusteriitem->teblig_bitis_tarihi)->format('d.m.Y') . "
            //         Lütfen gerekli işlemleri tamamlamak için Çukurova Patent müşteri temsilcisine ulaşınız.
            //         {$itiraztakipmusteriitem->referansno->satistemsilcisi->ad_soyad}  {$itiraztakipmusteriitem->referansno->satistemsilcisi->telefon}";

            //         $numara = $itiraztakipmusteriitem->referansno->firmaadi->yetkili_kisi_tel;

            //         $xmlString = 'data=<sms>
            //     <kno>' . $KULLANICINO . '</kno>
            //     <kulad>' . $KULLANICIADI . '</kulad>
            //     <sifre>' . $SIFRE . '</sifre>
            //     <gonderen>' . $ORGINATOR . '</gonderen>
            //     <mesaj>' . $mesaj . '</mesaj>
            //     <numaralar>' . $numara . '</numaralar>
            //     <tur>' . $TUR . '</tur>
            //     </sms>';

            //         $ch = curl_init();
            //         curl_setopt($ch, CURLOPT_URL, $postUrl);
            //         curl_setopt($ch, CURLOPT_POST, 1);
            //         curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
            //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //         curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            //         curl_exec($ch);
            //         curl_close($ch);
            //     }
            // }
        }

        $this->info('Mail ve SMS başarıyla gönderildi!');
    }
}
