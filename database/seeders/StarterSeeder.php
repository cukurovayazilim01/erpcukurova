<?php

namespace Database\Seeders;

use App\Models\Cari;
use App\Models\Cariler;
use App\Models\Efaturaapi;
use App\Models\Hizmetler;
use App\Models\Hizmetlerkategori;
use App\Models\Siteayarlari;
use App\Models\Smsapi;
use App\Models\User;
use DB;
use Faker\Provider\ar_EG\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smsapi = [
            [
                'id' => 1,
            ]

        ];

        foreach ($smsapi as $key => $smsapivalue) {
            Smsapi::create($smsapivalue);
        }

        $efaturaapi = [
            [
                'id' => 1,
            ]

        ];

        foreach ($efaturaapi as $key => $efaturaapivalue) {
            Efaturaapi::create($efaturaapivalue);
        }


        $user = [
            [
                'username' => 'bekir',
                'email' => 'superadmin@superadmin.com',
                'ad_soyad' => 'BEKİR ÜNAL KAYMAKÇI',

                'password' => bcrypt('123123')
            ],
            [
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'ad_soyad' => 'SÜLEYMAN OLGUN',
                'password' => bcrypt('123123')
            ],
            [
                'username' => 'user',
                'email' => 'user@user.com',
                'ad_soyad' => 'EMRE',
                'password' => bcrypt('123123')
            ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

        $hizmetkategori = [
            [
                'kategori_ad' => 'MARKA',
                'durum' => 'Aktif',
            ],
            [
                'kategori_ad' => 'WEB',
                'durum' => 'Aktif',
            ],
            [
                'kategori_ad' => 'KALİTE',
                'durum' => 'Aktif',
            ],
        ];

        foreach ($hizmetkategori as $key => $value) {
            Hizmetlerkategori::create($value);
        }

        $hizmet = [
            [
                'hizmetler_kategori_id' => '1',
                'hizmet_ad' => '1 SINIFLI MARKA',
                'hizmet_maliyet' => 1000,
                'hizmet_satis_fiyati' => 5000,
                'durum' => 'Aktif',
            ],
            [
                'hizmetler_kategori_id' => '1',
                'hizmet_ad' => '2 SINIFLI MARKA',
                'hizmet_maliyet' => 2000,
                'hizmet_satis_fiyati' => 7000,
                'durum' => 'Aktif',
            ],
            [
                'hizmetler_kategori_id' => '2',
                'hizmet_ad' => 'KARVİZİT',
                'hizmet_maliyet' => 1000,
                'hizmet_satis_fiyati' => 10000,
                'durum' => 'Aktif',
            ],
            [
                'hizmetler_kategori_id' => '2',
                'hizmet_ad' => 'KURUMSAL',
                'hizmet_maliyet' => 2000,
                'hizmet_satis_fiyati' => 20000,
                'durum' => 'Aktif',
            ],
            [
                'hizmetler_kategori_id' => '3',
                'hizmet_ad' => 'ISO',
                'hizmet_maliyet' => 1000,
                'hizmet_satis_fiyati' => 10000,
                'durum' => 'Aktif',
            ],
        ];
        foreach ($hizmet as $key => $value) {
            Hizmetler::create($value);
        }


        $faker = Faker::create();
        $numaralar = ['5436854151', '5302896162', '5530572633'];

        for ($i = 0; $i < 3; $i++) {
            DB::table('carilers')->insert([
                'islem_yapan' => 1,
                'islem_tarihi' => now(),
                'son_guncelleyen' => 1,
                'firma_unvan' => $faker->company,
                'ticari_unvan' => $faker->companySuffix,
                'firma_sektor' => 'Bilişim',
                'is_tel' => $faker->phoneNumber,
                'yetkili_kisi' => $faker->name,
                'yetkili_kisi_tel' => ($i % 3 === 0) ? $numaralar[($i / 3) % 3] : $faker->phoneNumber, // Her 3 kayıtta bir özel numaraları atar
                'eposta' => $faker->email,
                'web_adres' => $faker->url,
                'firma_turu' => 'Limited Şirket',
                'il' => $faker->city,
                'ilce' => $faker->citySuffix,
                'vergi_no' => $faker->randomNumber(9, true),
                'vergi_dairesi' => 'Örnek Vergi Dairesi',
                'tc_kimlik' => $faker->randomNumber(9, true),
                'adres' => $faker->address,
                'aciklama' => 'Örnek açıklama metni',
                'musteri_temsilcisi' => $faker->name,
                'firma_tipi' => 'Müşteri',
                'firma_durumu' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }



        $personels = [
            [
                'islem_yapan' => 2,
                'islem_tarihi' => '2025-02-24',
                'ad_soyad' => 'BEKİR ÜNAL KAYMAKÇI',
                'tc' => '10612420714',
                'sigorta_sicil_no' => '12312444443',
                'sigorta_giris_tarihi' => '2025-02-24',
                'meslek_kodu' => '4545',
                'okul' => 'CUKUROVA',
                'mezuniyet' => 'Lisans',
                'meslegi' => 'BİLGİSAYAR MÜHENDİSİ',
                'departman' => 'YAZILIM',
                'dogum_yeri' => 'ADANA',
                'dogum_tarihi' => '2025-02-24',
                'gsm' => '5414305541',
                'mail' => 'info@cukurovapatent.com',
                'ise_giris_tarihi' => '2025-02-24',
                'gorevi' => 'FULLSTACK DEVELOPER',
                'kidem_yili' => '10',
                'medeni_hali' => 'Evli',
                'kan_grubu' => 'A+',
                'askerlik_durumu' => 'Yapıldı',
                'personel_resim' => '/personel/BEKİR-ÜNAL-KAYMAKÇI.png',
                'ehliyet_sinif' => 'B',
                'ehliyet_tarihi' => '2025-02-24',
                'baba_adi' => 'MEHMET',
                'baba_meslegi' => 'MESLEK',
                'ayak_no' => '45',
                'beden' => '54',
                'ev_gsm' => '2311323123',
                'ev_adresi' => 'HUZUREVLERİ MH',
                'acil_durum_kisi' => 'MEHMET',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'islem_yapan' => 2,
                'islem_tarihi' => '2025-02-24',
                'ad_soyad' => 'SÜLEYMAN OLGUN',
                'tc' => '111111',
                'sigorta_sicil_no' => '11111',
                'sigorta_giris_tarihi' => '2025-02-24',
                'meslek_kodu' => '4545',
                'okul' => 'CUKUROVA',
                'mezuniyet' => 'Lisans',
                'meslegi' => 'BİLGİSAYAR MÜHENDİSİ',
                'departman' => 'YAZILIM',
                'dogum_yeri' => 'ADANA',
                'dogum_tarihi' => '2025-02-24',
                'gsm' => '5414305541',
                'mail' => 'info@cukurovapatent.com',
                'ise_giris_tarihi' => '2025-02-04',
                'gorevi' => 'BACKEND DEVELOPER',
                'kidem_yili' => '1',
                'medeni_hali' => 'Evli',
                'kan_grubu' => 'A+',
                'askerlik_durumu' => 'Yapıldı',
                'personel_resim' => '/personel/SÜLEYMAN-OLGUN.png',
                'ehliyet_sinif' => 'B',
                'ehliyet_tarihi' => '2025-02-24',
                'baba_adi' => 'MEHMET',
                'baba_meslegi' => 'BABA',
                'ayak_no' => '45',
                'beden' => '54',
                'ev_gsm' => '213123',
                'ev_adresi' => 'SADASD',
                'acil_durum_kisi' => 'DSADA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Verileri tabloya ekle
        DB::table('personels')->insert($personels);


    }
}
