<!doctype html>
<html class="no-js" lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $teklifler->teklif_kodu_text }}-{{ $teklifler->teklif_kodu }}-{{ $teklifler->firmaadi->firma_unvan }}
        Teklifi</title>
    <meta name="author" content="themeholy">
    <meta name="description" content="Invar - Invoice HTML Template">
    <meta name="keywords" content="Invar - Invoice HTML Template" />
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logintemp/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
 Google Fonts
 ============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;500;600;700;800;900;1000&display=swap"
        rel="stylesheet">


    <!--==============================
 All CSS File
 ============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('custom/invoce/css/bootstrap.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('custom/invoce/css/style.css') }}">
    <style>
        @media print {
            .body {
                margin: 0;
                padding: 0;
            }

            .invoice-container {
                padding: 1px 15px;
                margin: 1px auto;
                width: 100%;
            }

            table {
                width: 100%;
                /* Tabloların yazdırma alanına sığması */
                border-collapse: collapse;
            }

            .invoice-table {
                width: 100%;
                border-collapse: collapse;
            }

            .invoice-table th,
            .invoice-table td {
                border: 1px solid #000;
                padding: 5px;
                /* Düşük padding kullanın */
                text-align: center;
                line-height: 1;
                /* Satır yüksekliğini sabitleyin */
            }

            .invoice-table th {
                background-color: #ccc;
                /* Gri arka planı korumak için */
                -webkit-print-color-adjust: exact;
            }

            .invoice_style7 {
                padding-bottom: none;
                border-bottom: 1px solid white;
            }
            .invoice-buttons{
                display: none;
            }



        }
    </style>

</head>

<body class="train-template">


    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->


    <!--********************************
   Code Start From Here
 ******************************** -->

    <div class="invoice-container-wrap">
        <div class="invoice-container">
            <main>
                <!--==============================
Invoice Area
==============================-->
                <div class="th-invoice invoice_style7">
                    <div class="download-inner" id="download_section">
                        <!--==============================
 Header Area
==============================-->
                        <header class="th-header header-layout4">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <div class="header-logo">
                                        <a><img src="{{ asset('logintemp/cukurovalogo.png') }}"
                                                style="width: auto; height: 72px;"></a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h1 class="big-title">Teklif Formu</h1>
                                    <p class="invoice-number"><b>Teklif No:
                                        </b>{{ $teklifler->teklif_kodu_text }}-{{ $teklifler->teklif_kodu }}</p>
                                    <p class="invoice-number"><b>Teklif Tarihi: </b>{{ $teklifler->teklif_tarihi }}</p>
                                    <p class="invoice-number"><b>Revizyon No: </b>00</p>
                                    <p class="invoice-number"><b>Revizyon Tarihi: </b>00</p>
                                </div>
                            </div>
                        </header>
                        {{-- <hr class="style1"> --}}
                        <div class="row justify-content-between" style="margin-top: -16px">
                            <div class="col-auto">
                                <div class="invoice-left">
                                    <b>Danışman Firma:</b>
                                    <address>
                                        ÇUKUROVA MARKA PATENT KALİTE DANIŞMANLIK<br>
                                        OSMAN ÇEKİRGE <br>
                                        444 8 148 <br>
                                        info@cukurovapatent.com
                                    </address>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="invoice-right">
                                    <b>Müşteri:</b>
                                    <address>
                                        {{Str::limit($teklifler->firmaadi->firma_unvan,55)  }} <br>
                                        {{ $teklifler->firmaadi->yetkili_kisi }} <br>
                                        {{ $teklifler->firmaadi->yetkili_kisi_tel }} <br>
                                        {{ $teklifler->firmaadi->eposta }}
                                    </address>
                                </div>
                            </div>
                        </div>
                        <hr class="style1">
                        <p class="table-title text-center"><b>Talep Edilen Hizmetler:</b></p>
                        <table class="invoice-table table-stripe4 theme-color">
                            <thead>
                                <tr>
                                    <th style="width: 10px;  text-align: center;">#</th>
                                    {{-- <th>Hizmet Türü</th> --}}
                                    <th>Hizmet Adı</th>
                                    <th>Açıklama</th>
                                    <th>Miktar</th>
                                    <th>Birim Fiyat</th>
                                    <th>İndirim Tutarı</th>
                                    <th>İndirimli Fiyat</th>
                                    <th>KDV Tutar</th>
                                    <th>KDV'li Tutar</th>
                                </tr>
                            </thead>
                            @php
                                $birim_fiyat = 0;
                                $indirim_tutar = 0;
                                $sonuc = 0;
                            @endphp
                            <tbody>
                                @foreach ($tekliflerdata as $sn => $tekliflerdataitem)
                                    @php
                                        $birim_fiyat += $tekliflerdataitem->teklif_fiyat;
                                        $indirim_tutar += $tekliflerdataitem->teklif_iskonto;
                                        $sonuc = $birim_fiyat - $indirim_tutar;
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $sn + 1 }}</strong></td>
                                        {{-- <td style=" text-align: center;">
                                            {{ $tekliflerdataitem->hizmetlerkategori->kategori_ad }}</td> --}}
                                        <td style=" text-align: center;">{{ $tekliflerdataitem->hizmetler->hizmet_ad }}
                                        </td>
                                        <td style=" text-align: center;">{{ $tekliflerdataitem->satir_aciklama }}
                                        <td style=" text-align: center;">{{ $tekliflerdataitem->teklif_hizmet_miktar }}
                                            {{ $tekliflerdataitem->teklif_hizmet_birim }}</td>
                                        <td style=" text-align: center;">
                                            {{ $tekliflerdataitem->teklif_fiyat }} ₺</td>
                                        <td style=" text-align: center;">
                                            {{ $tekliflerdataitem->teklif_iskonto ? : 0 }} ₺</td>
                                        <td style=" text-align: center;">{{ $sonuc }} ₺
                                        </td>
                                        <td style=" text-align: center;">
                                            {{ $tekliflerdataitem->teklif_kdv_tutar }} ₺
                                            (%{{ $tekliflerdataitem->teklif_kdv_oran }})
                                        </td>
                                        <td style=" text-align: center;">
                                            {{ $tekliflerdataitem->teklif_toplam_fiyat }}
                                            ₺</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="row" >
                            @if ($teklifler->odemeplan_durum == 'Var')
                            <div class="col-md-9">
                                <b style="font-size: 11px; text-align: center; display: block;">Ödeme Planı:</b>

                                   <table class="invoice-table table-stripe4 theme-color">
                                       <thead>
                                           <tr>
                                               <th style="width: 10px;  text-align: center;">#</th>
                                               <th>Ödeme Tarihi</th>
                                               <th>Tutar</th>
                                               <th>Ödeme Şekli</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach ($odemeplan as $sn => $odemeplanitem)

                                           <tr>
                                               <td><strong>{{ $sn + 1 }}</strong></td>

                                               <td style=" text-align: center;">{{ $odemeplanitem->odeme_tarihi }}
                                               </td>
                                               <td style=" text-align: center;">{{ number_format( $odemeplanitem->tutar, 2, ',', '.') }} ₺
                                               </td>
                                               <td style=" text-align: center;">{{ $odemeplanitem->odeme_turu }}
                                               </td>
                                           </tr>
                                           @endforeach

                                       </tbody>
                                   </table>
                               </div>
                            @else
                               <div class="col-md-9"></div>
                            @endif

                            <div class="col-md-3" style="padding-left: 1px;">
                                <table class="total-table">
                                    <tr>
                                        <th>TOPLAM İSKONTO</th>
                                        <td>{{ number_format($teklifler->teklif_iskonto_toplam, 2, ',', '.') }} ₺</td>
                                    </tr>
                                    <tr>
                                        <th>TOPLAM KDV</th>
                                        <td>{{ number_format($teklifler->teklif_kdv_toplam, 2, ',', '.') }} ₺</td>
                                    </tr>
                                    <tr>
                                        <th>ARA TOPLAM</th>
                                        <td>{{ number_format($teklifler->teklif_ara_toplam, 2, ',', '.') }} ₺</td>
                                    </tr>
                                    <tr>
                                        <th>TOPLAM TUTAR</th>
                                        <td>{{ number_format($teklifler->teklif_kdvli_toplam, 2, ',', '.') }} ₺</td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <br>
                        {{-- <table class="invoice-table table-style1">

                            <tbody>
                                <tr>
                                    <td colspan="3" style="text-align: justify;"> Marka Başvurusu ile Markanın
                                        Yayına çıkması veya reddedilip edilmeyeceği süre yaklaşık olarak 3-4 aydır.
                                        Marka yayına çıkar ise 3.kişilerin itirazı için yine 2 ay yayında kaldıktan
                                        sonra başvurudan itibaren 4-8 ay sonra tescil kararı verilir ve gerekli harçlar
                                        ödendikten sonra da 1 ay içerisinde tescil belgesi tarafınıza teslim edilir.
                                        2023 yılı marka tescil belge harcı ve hizmet bedeli 4890 TL+KDV 'dir. Tescil
                                        belge ödeme işleminin mevcut vekil dışında yapılması durumunda tescil belge
                                        harcı hariç kalan hizmet bedeli müvekkilden tahsil edilir.Tescil Kararı verilen
                                        markanızla ilgili belge harcı Türk Patent ve Marka Kurumuna yatırıldıktan sonra
                                        MARKA TESCİL BELGESİ düzenlenerek tarafınıza ulaştırılır. Marka Tescil Belgesini
                                        almış olduğunuz markanızın koruma süresi başvuru tarihinden itibaren 10 yıldır.
                                        Bu sürenin dolmasından önceki 6 ay içerisinde marka yenileme talebinde
                                        bulunmanız durumunda koruma süreniz 10 yıl süreyle uzatılacaktır. Marka başvuru
                                        işlem ücretine araştırma ücreti dahildir. Başvuru sahibinin işlemden vazgeçmesi
                                        durumunda % 25 araştırma hizmet ücreti kesilerek kalan ücret iade edilir. Süreç
                                        içerisinde Türk Patent tarafından yapılan zamlar aynen yansıtılır. **TPE
                                        Çevrimiçi İşlemler sayfasından elde edilen araştırma sonuçları bilgi amaçlı
                                        olup, bu sonuçlara göre yapılacak başvurular "tescil edilir ya da edilemez"
                                        kesin yargısına varılmamalıdır.</td>
                                </tr>
                            </tbody>
                        </table> --}}
                        </table>
                        <hr>
                        <p style="text-align: justify;"><span style="font-weight: bold"></span>Marka Başvurusu ile Markanın Yayına çıkması veya
                            reddedilip edilmeyeceği süre yaklaşık olarak 3-4 aydır. Marka yayına çıkar ise 3.kişilerin
                            itirazı için yine 2
                            ay yayında kaldıktan sonra başvurudan itibaren 4-8 ay sonra tescil kararı verilir ve gerekli
                            harçlar ödendikten sonra da 1 ay içerisinde tescil belgesi tarafınıza
                            teslim edilir. 2024 yılı marka tescil belge harcı ve hizmet bedeli <b
                                style="color: red;">{{ $teklifler->tescil_tl }} ₺ + KDV</b> 'dir. Tescil belge ödeme
                            işleminin mevcut vekil dışında yapılması durumunda
                            tescil belge harcı hariç kalan hizmet bedeli müvekkilden tahsil edilir.Tescil Kararı verilen
                            markanızla ilgili belge harcı Türk Patent ve Marka Kurumuna
                            yatırıldıktan sonra MARKA TESCİL BELGESİ düzenlenerek tarafınıza ulaştırılır. Marka Tescil
                            Belgesini almış olduğunuz markanızın koruma süresi başvuru
                            tarihinden itibaren 10 yıldır. Bu sürenin dolmasından önceki 6 ay içerisinde marka yenileme
                            talebinde bulunmanız durumunda koruma süreniz 10 yıl süreyle
                            uzatılacaktır. Marka başvuru işlem ücretine araştırma ücreti dahildir. Başvuru sahibinin
                            işlemden vazgeçmesi durumunda % 25 araştırma hizmet ücreti
                            kesilerek kalan ücret iade edilir. Süreç içerisinde Türk Patent tarafından yapılan zamlar
                            aynen yansıtılır.
                            <b>**TPE Çevrimiçi İşlemler sayfasından elde edilen araştırma sonuçları bilgi amaçlı olup,
                                bu sonuçlara göre yapılacak başvurular "tescil
                                edilir ya da edilemez" kesin yargısına varılmamalıdır.</b>
                        </p>
                        <hr>
                        <p style="text-align: justify;"><span style="font-weight: bold">Açıklama :</span>{{ $teklifler->aciklama }} </p>
                        <hr>
                        <p style="text-align: center; color: red">DOLANDIRICILIĞA DİKKAT</p>
                        <p style="text-align: justify;"><span style="font-weight: bold; "></span>
                            Marka tescil işlemi için başvuru esnasında ve 4-8 ay sonra TÜRKPATENT tebliği ile beraber
                            olmak üzere ikinci ödeme olan belge ödemesi yapılması zorunlu ve tescil süreci için
                            gereklidir.
                            Tüm bu süreç boyunca FİRMA tarafından MÜŞTERİ dosyanın takibi ve gereki bildirimlerin
                            yapılması için müşteri temsilcisi atanacak olup bildirimler temsilci tarafından MÜŞTERİ’ye
                            yapılacaktır.
                            Kendilerini Marka Vekili veya OSMAN ÇEKİRGE’ nin çalışanı olarak tanıtan yetkisiz kişiler,
                            başvuru veya tescil sahiplerini telefonla arayarak ve muhtelif senaryolarla kandırmaya
                            çalışılması ve çeşitli ücretler talep eden yazılar gönderilmesi,
                            fatura benzeri bildirimler yapılması durumunda MÜŞTERİ mutlak suret ile müşteri temsilcisi
                            veya ÇUKUROVA MARKA PATENT’in sabit hattını (444 8 148) arayarak durumu bildirmekle
                            yükümlüdür.MÜŞTERİ tarafından 3. Kişilere yapılan ödemelerden FİRMA sorumlu olmayıp tüm
                            sorumluluk MÜŞTERİ’ ye aittir.
                            OSMAN ÇEKİRGE resmi hesapları dışında yapılan ödemeler FİRMA’nın sorumluluğunda değildir.
                            <br>
                            <b>RESMİ HESAP BİLGİLERİ:</b><br>
                            <b>Enpara: TR05 0011 1000 0000 0069 1295 05</b><br>
                            <b>Halkbankası: TR46 0001 2009 2290 0009 0074 94</b><br>
                            <hr style="float: left"> <br>

<style>
    .page-break {
    page-break-before: always; /* Bu öğeden önce sayfa sonu ekler */
}
</style>

                        </p>
                        <p class="page-break">
                        <p style="text-align: center;"><strong><u>MARKA BAŞVURU VE TESCİL &nbsp;HİZMET
                                    S&Ouml;ZLEŞMESİ</u></strong></p>
                        <p style="margin:0 0 0 0"><strong>Madde 2 &ndash; <u>KONU :</u></strong></p>
                        <p style="margin:0 0 0 0">İş bu sözleşmenin konusunu Müşteri adına Türk Patent ve Marka Kurumu nezrinde başvurusu
                            yapılacak olan markanın, başvuru tarihinden itibaren koruma süresi 10 yıl geçerli marka
                            tescili başvuru işlemleri ve dosyanın takibi hizmetlerinin MÜŞTERİ adına firma tarafından
                            yürütülmesi tescil işlemlerinin başvuru tamamlanarak belge aslının alınması ve teslimi
                            işidir.</p>
                        <p style="margin:0 0 0 0"><strong>Madde 3 &ndash; <u>M&Uuml;ŞTERİ&rsquo;NİN Y&Uuml;K&Uuml;ML&Uuml;L&Uuml;KLERİ
                                    :</u></strong></p>
                        <p style="margin:0 0 0 0">3.1. Müşteri,Sözleşmede belirtilen ödeme vadelerine ve şekline uymakla yükümlüdür.</p>
                        <p style="margin:0 0 0 0">3.2. Müşteri, tescil belgesi kararı çıktıktan ve FiRMA tarafından bilgi verildiği tarihten
                            sonra Türk Patent ve Marka Kurumu Resmi Belge Harcı ve vekillik ücretleri dahil (başvurudan
                            yaklaşık olarak 4-8 Ay sonra) 8400 ₺ +KDV ödemesi müşteri tarafından vekil OSMAN ÇEKİRGE
                            hesabına ödenecektir.</p>
                        <p style="margin:0 0 0 0">3.3. Müşteri, Tescil Belgesinin tesliminden sonraki ücret takibinden kendi sorumludur.
                            Sorumluluk ancak karşılıklı anlaşma ve ücret mutakabatı sağlandıktan sonra firmamızca
                            yürütülecektir. Ilgili tutar müşteriye 15 gün öncesinden bildirilecek. Ilgili ücret Firma
                            tarafından vekil ofis hesabına ödenecektir.</p>
                        <p style="margin:0 0 0 0">.<strong>Madde 4 &ndash; <u>FİRMANIN Y&Uuml;K&Uuml;ML&Uuml;L&Uuml;KLERİ:</u></strong></p>
                        <p style="margin:0 0 0 0">4.1. İş bu sözleşme ile, markanın logosuyla birlikte müşteri ile belirlenen ve anılan
                            sınıflar için marka tescili amacıyla 6769 Sayılı Markaların Korunması Hakkındaki Kanun ve
                            ilgili yönetmelikler uyarınca tescil başvuru dosyası firma tarafından hazırlanacak ve Türk
                            Patent ve marka kurumu nezdinde başvuru işlemleri yerine getirilecektir.</p>
                        <p style="margin:0 0 0 0">4.2. FİRMA, Müşteri adına tescil işlemleri için gerekli başvuruları yapacak. Yapılan
                            başvuruları takip edecek ve sonuçlanması için gerekli çalışmaları sürdürecek, tescil
                            işlemlerinin tamamlanmasını müteakip belge aslını alarak Müşteriye teslim edecektir.</p>
                        <p style="margin:0 0 0 0">4.3. FİRMA, tescil başvurusu yaptıktan sonra tescil için gelen talepleri derhal
                            cevaplandıracak ve işin aksamaması ve tescil süresinin uzamaması için her türlü çaba ve
                            gayreti gösterecektir.</p>
                        <p style="margin:0 0 0 0">4.4. FİRMA, marka takibi süreci boyunca herhangi bir takipsizlikten ötürü müşterinin hak
                            kaybına uğramasına yol açarsa sözleşme sebebiyle almış olduğu ücreti iade edeceğini
                            müşterinin bu nedenle uğrayacağı zararın tazminini aldığı ücret tutarında ödeyeceğini kabul
                            ve taahhüt etmektedir.</p>
                        <p style="margin:0 0 0 0">4.5. FİRMA, Tescilin, başvurunun, ve gerekli işlemlerin yapılmamasının ve/ veya zamanında
                            ve/veya gereği gibi yapılmamasının neticesinde başvurunun müşteri adına tescil
                            edilmemesinden kaynaklı bir zarara uğrar ise FİRMA bu zararı aldığı bedel üzerinden mahkeme
                            ilanına gerek kalmaksızın MÜŞTERİ’nin ilk talebi halinde ödeyeceğini kabul ve taahhüt
                            etmektedir. Başvuru haricinde çıkacak itirazlar, ret kararlarına karşı müşteri firma harç ve
                            vekillik ücretini ödemek şartı ile hizmet alabilecektir.</p>
                        <p style="margin:0 0 0 0">4.6. FİRMA, sözleşmeye konu tescil işlemlerinin her aşamasında ve başvurunun durumu ile
                            ilgili MÜŞTERİ’yi bilgilendirecektir.</p>
                        <p style="margin:0 0 0 0">4.7. Firma, hizmet bedeli ve başvuru harçlarının kendisine ödenmesinden, gerekli başvuru
                            evrakları ve marka+şekil (logosunu) teslim ettiği günden itibaren 3 iş günü içerisinde marka
                            tescil başvurusunu yapmakla yükümlüdür.</p>
                        <p style="margin:0 0 0 0">4.8. Marka tescil başvurusu tamamlandıktan ve tescil işlemi bittikten itibaren marka tescil
                            belgesinin Türk Patent ve Marka Kurumu nezrinde yenilenmesi gerekmektedir. Bu tarih, başvuru
                            tarihinden itibaren geçerli olmak üzere 10 yıl olup, firmanın sorumluluğu tescil belgesinin
                            teslimi ile sona ermektedir. Bu sürenin dolmasından önceki 6 ay içerisinde müşterinin marka
                            yenileme talebinde bulunması durumunda koruma süresi 10 yıl süre ile uzatılacaktır.</p>
                        <p style="margin:0 0 0 0">4.9. FİRMA, işbu sözleşme ile öğrenmiş olduğu ticari sırları saklamakla yükümlüdür işbu
                            sözleşmenin gizlilik maddesine aykırı davranmamayı kabul ve taahhüt etmektedir.</p>
                        <p style="margin:0 0 0 0">4.10. Marka Tescil başvurusundan sonra gelebilecek her türlü itiraz ve görüş bildirme
                            işlemleri için ayrıca hizmet bedeli istenir.</p>
                        <p style="margin:0 0 0 0"><strong>Madde 5 &ndash; HİZMET S&Uuml;RESİ VE BEDELİ</strong></p>
                        <p style="margin:0 0 0 0">İşbu s&ouml;zleşmeye konu FİRMA&rsquo;nın yatıracağı har&ccedil;ların ve&nbsp; alacağı
                            &uuml;creti ile s&ouml;zleşmenin s&uuml;resi aşağıdaki gibidir.</p>
                        <p style="margin:0 0 0 0">5.1. İşbu sözleşme kapsamındaki hizmetlerin hizmetin süresi sözleşme konusu tescil
                            başvurusunun neticelenerek sözleşme konusu başvurunun tescilininin sağlanarak tescil belgesi
                            alınması ve belge aslının MÜŞTERİ’ye teslimi ile sona erer. Süre bitiminde her iki tarafın
                            mutabakatı sonucu marka yenileme talebi doğrultusunda hizmet süresi taraflar tarafından
                            tekrar belirlenecek olan, ücreti mukabilinde uzatılabilecektir.</p>
                        <p style="margin:0 0 0 0"><strong>5.2 Talep edeceğiniz bir marka başvurusu ile ilgili ger&ccedil;ekleşecek
                                s&uuml;re&ccedil; ş&ouml;yledir;</strong></p>
                        <table >
                            <tbody>
                                <tr>
                                    <td ><strong>1.Aşama</strong></td>
                                    <td ><strong>Başvuru</strong></td>
                                    <td ><strong>Gerekli evraklar tarafınızca
                                            sağlandıktan sonra e-imza ile başvuru yapılır ve başvuru yapıldığına dair
                                            “ALINDI” yazısı tarafınıza yollanır.</strong></td>
                                </tr>
                                <tr>
                                    <td ><strong>2.Aşama</strong></td>
                                    <td ><strong>Şekli İnceleme</strong></td>
                                    <td ><strong>Kurum tarafından şekli
                                            eksikler incelenecek dosyanın değerlendirmeye alındığına dair bilgi
                                            elektronik ortamda, görüntülenir.</strong></td>
                                </tr>
                                <tr>
                                    <td ><strong>3.Aşama</strong></td>
                                    <td ><strong>Sınıf Listesi</strong></td>
                                    <td ><strong>Markanizda bir eksiklik tespit
                                            edilmez ise, müracaat edilen sınıfların kodlaması yapılır.</strong></td>
                                </tr>
                                <tr>
                                    <td ><strong>4.Aşama</strong></td>
                                    <td ><strong>Benzerlik</strong></td>
                                    <td ><strong>Mevcut markalar arasında
                                            benzerlik araştırması yapılır.</strong></td>
                                </tr>
                                <tr>
                                    <td ><strong>5.Aşama</strong></td>
                                    <td ><strong>Karar</strong></td>
                                    <td ><strong>Değerlendirme sonucu uzman
                                            tarafından “kabul” – “kısmi kabul” – “red” kararı verilir.</strong></td>
                                </tr>
                                <tr>
                                    <td ><strong>6.Aşama</strong></td>
                                    <td ><strong>Yayın</strong></td>
                                    <td ><strong>Kabul ve kısmi kabul
                                            sonucunda marka resmi bültende 2 ay süre ile ilan edilir.</strong></td>
                                </tr>
                                <tr>
                                    <td ><strong>7.Aşama</strong></td>
                                    <td ><strong>Tescil Kararı</strong></td>
                                    <td ><strong>İlan sürecinde itiraz
                                            gelmemesi durumunda markanız için tescil kararı verilir.</strong></td>
                                </tr>
                                <tr>
                                    <td ><strong>8.Aşama</strong></td>
                                    <td ><strong>Belge</strong></td>
                                    <td ><strong>Tescil Kararı verilen marka
                                            ile ilgili “belge harcı” ödemesi yapıldıktan sonra tescil belgesi tarafınıza
                                            ulaştırılır.</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <p style="margin:0 0 0 0">5.3. Hizmet bedeli karşılığı MÜŞTERİ tarafından işbu sözleşme kapsamındaki hizmetler
                            karşılığı FİRMA’ya ödenecek tutar teklifte belirlenmiştir.</p>
                        <p style="margin:0 0 0 0">5.4. Sözleşme bedeli’ne, başvuru ve tescil işlemleri yürütülürken MÜŞTERİ adına ödenmesi
                            gereken her türlü harç, resim, vergi, ve benzeri her türlü resmi ödemeler dahil olmayıp bu
                            giderler MÜŞTERİ tarafından 5.4. madde gereğince ödenecektir.</p>
                        <p style="margin:0 0 0 0">5.5. 5.3. Madde gereğince yapılacak ödemeler ödenme tarihinden itibaren 15 (on beş ) gün
                            öncesinde FİRMA’nın ödemenin yeri yatırılacağı hesap numarası ve tarihi konusunda MÜŞTERİ’yi
                            bilgilendirmesi gerekmekte olup MÜŞTERİ ödeme yaptıktan sonra ödemeler ile ilgili dekontun
                            bir suretini FİRMA’ya iletecektir.</p>
                        <p class="page-break" style="margin:20px 0 0 0"><strong>Madde 6 &ndash; &Ouml;DEMELER ve TEBLİGAT ADRESLERİ</strong></p>
                        <p style="margin:0 0 0 0">6.1. Sözleşme gereğince ödenmesi gereken hizmet karşılığı ödenecek tutarın %100 +KDV kısmını
                            MÜŞTERİ , FİRMA’ya peşin olarak veya banka yolu ile veya pos işlemleri ile ödeyecektir.
                            Tescil Belge Harcı ve Vekillik Ücretini ise tescil tebliğ tarihinden itibaren 2 ay içinde
                            (60 gün) %100+Kdv olarak peşin olarak veya banka yolu ile veya pos işlemleri ile
                            ödeyecektir.</p>
                        <p style="margin:0 0 0 0">Tarafların sözleşmede belirttikleri adresler kanuni ikametgah adresleri olup, bu adreslerde
                            meydana gelecek değişiklikleri diğer tarafa yazılı olarak bildirilmesi zorunludur. Aksi
                            halde sözleşmede belirtilen adreslere yapılacak bildirim ve tebligatlar Tebligat Kanunun
                            hükümlerince yapılmış tebligatın hüküm ve sonuçlarını doğuracağını taraflar kabul
                            etmektedir.</p>
                        <p style="margin:0 0 0 0" ><strong>Madde 7 &ndash; S&Ouml;ZLEŞMENİN GİZLİLİĞİ</strong></p>
                        <p style="margin:0 0 0 0">7.1. <strong>FİRMA</strong>, birbirleri hakkında bu sözleşmenin ifası dolayısıyla
                            öğrendikleri yasal yollarla bilinen ya da bilinecekler dışında, gizli olduğu bildirilsin ya
                            da bildirilmesin, tüm bilgileri, Gizli Bilgi veya Ticari Sır olarak kabul etmeyi ve bu
                            bilgileri, yasal zorunluluklar hariç birbirlerinin yazılı izni olmadan üçüncü kişilere ya da
                            kuruşlulara vermemeyi, açıklamamayı, kamuoyuna duyurmamayı veya bu şekilde sonuçlanacak
                            davranışlardan kaçınmayı taahhüt eder.</p>
                        <p style="margin:0 0 0 0">7.2. <strong>FİRMA</strong>, iş bu sözleşme ile öğrenmiş olduğu bilgileri bu sözleşmenin
                            gizlilik maddelerine ya da iyi niyet kurallarına aykırı kullanması halinde, 4.8. madde
                            gereğince sorumlu olduğunu kabul ve taahhüt etmektedir.</p>
                        <p style="margin:0 0 0 0">7.3. İş bu Sözleşme sona erse dahi, gizlilik hükümleri yürürlükte kalmaya devam edecektir.
                        </p>
                        <p style="margin:0 0 0 0">7.4. Bu sözleşme ve içeriği TARAFLAR‘ca üçüncü kişilere hiçbir suretle ifşa edilemez.</p>
                        <p style="margin:0 0 0 0">7.5. Taraflar personellerinin dahi bu kurala uymasını temin etmekle yükümlüdürler.</p>
                        <p style="margin:0 0 0 0"><strong>Madde 8 &ndash; S&Ouml;ZLEŞMENİN FESHİ</strong></p>
                        <p style="margin:0 0 0 0">8.1. FİRMA’nın iş bu sözleşme hükümlerini yerine getirmemesi halinde herhangi bir ihtara
                            gerek kalmaksızın MÜŞTERİ sözleşmeyi tek taraflı olarak fesh edebilir, FİRMA’ya yaptığı
                            ödemeleri geri isteme hakkına sahip olup, FİRMA bunu peşinen kabul etmiştir. Sözleşme
                            hükümlerinin yerine getirilmesi ile yapılan başvuru ve tescil sürecindeki tüm takip ve
                            işlemlerin ardından gerekçeleri belirtilmeden müşteri tarafından yapılan vekil azli ile
                            firmamızın isteyeceği hizmet bedeli müşteriden talep edilir ve müşteri bunu ödemekle
                            yükümlüdür. Marka takip süreci boyunca firmamızca herhangi bir takipsizlikten ötürü hak
                            kaybına uğrayan firmanın veya şahsın adımıza yaptığı ödeme tutarı kadar maddi zararı tanzim
                            edilir. Devri herhangi sebebe dayanmayan ve tescil kararı çıktıktan sonra ödemeyi yapamayan
                            firma Türk Patent ve Marka Kurumu belge harcı düşülerek geriye kalan hizmet bedelimizi
                            ödemek zorundadır. Haksız rekabet ve ticari ahlaka aykırı alınan teklifler ve
                            fiyatlandırmalar firmamızca dikkate alınmayacak olup yapılan sözleşmeye iki taraf olarak
                            sadık kalınacaktır.</p>
                        <p style="margin:0 0 0 0">8.2. Marka takibi sadece işlem bazında olup sadece markanın kendi sürecini içermektedir.
                            Markanın başvurundan sonra yapılacak benzer veya yanılgıya sebep verici markaların takibi
                            ancak ek ücret karşılığı yapılacaktır. Firmamız bu tür başvurulardan veya diğer
                            başvurulardan sorumlu değildir.</p>
                        <p style="margin:0 0 0 0">8.3. İsim benzerliği veya ürün benzerliği tespitinde ilgili marka veya ürün sahibi kendi
                            fikri ve sınai haklarını korumak adına her türlü girişimi ekstra ücret ödemek koşuluyla
                            firma avukatımızca takibini isteyebilir. Kendi avukatı veya şahsı takip edebilir. Ödenecek
                            harç ve ücretler marka veya ürün sahibine ait olup vaktinde ödenmelidir.</p>
                        <p style="margin:0 0 0 0"><strong>Madde 9 &ndash; SAİR H&Uuml;K&Uuml;MLER</strong></p>
                        <p style="margin:0 0 0 0">9.1. FİRMA, işbu sözleşmeden doğan hak, yükümlük, alacak ve sorumluluklarını, her ne surette
                            olursa olsun üçüncü şahıslara devir ve temlik edemeyecek, bir başka gerçek veya tüzel üçüncü
                            bir şahsı her hangi bir sebeple, bu sözleşmede ve dolayısıyla ilgili yasal hükümlerde
                            kayıtlı sorumluluklarına, hak ve alacaklarına ortak edemeyecektir.</p>
                        <p style="margin:0 0 0 0">9.2. Sözleşmeden doğan damga vergisi taraflar arasında eşit olarak paylaşılacaktır.
                            Sözleşmeden doğan damga vergisi MÜŞTERİ tarafından ödenerek yarısı FİRMA’ya fatura
                            edilecektir.</p>
                        <p style="margin:0 0 0 0"><strong>Madde 10 &ndash; YETKİLİ MAHKEME VE İCRA DAİRELERİ</strong></p>
                        <p style="margin:0 0 0 0">İşbu sözleşmenin uygulanmasından doğabilecek her türlü uyuşmazlıkların çözümünde İl
                            Mahkemeleri ve İcra Daireleri yetkilidir.</p>
                        </p>



                        <table style="margin: 0 0 0 0">
                            <tbody>
                                <tr>
                                    <td style="width: 429px; text-align: center;">&nbsp;<b>DANIŞMAN FİRMA</b></td>
                                    <td style="width: 400.5px; text-align: center;">&nbsp;<b>MÜŞTERİ FİRMA</b></td>
                                </tr>
                            </tbody>
                        </table>
                        <table style=" margin:0 0 0 0; ">
                            <tbody>
                                <tr style="height: 11px;">
                                    <td style="width: 220px; height: 11px; text-align: center;">&nbsp;MEHMET ASİ</td>
                                    <td style="width: 220px; height: 11px; text-align: center;">&nbsp;OSMAN ÇEKİRGE
                                    </td>
                                    <td style="width: 414px; height: 11px; text-align: center;">&nbsp;İSİM SOYİSİM VE
                                        İMZA KAŞE</td>
                                </tr>
                                <tr style="height: 11px;">
                                    <td style="width: 220px; height: 11px; text-align: center;">&nbsp;Endüstri
                                        Mühendisi</td>
                                    <td style="width: 220px; height: 11px; text-align: center;">&nbsp;Endüstri
                                        Mühendisi</td>
                                    <td style="width: 220px; height: 11px;" rowspan="3">&nbsp;</td>
                                </tr>
                                <tr style="height: 11px;">
                                    <td style="width: 220px; height: 11px; text-align: center;">&nbsp;Yönetim
                                        Sistemleri Danışmanı ve Marka Vekili</td>
                                    <td style="width: 220px; height: 11px; text-align: center;">&nbsp;Yönetim
                                        Sistemleri Danışmanı ve Marka Vekili</td>
                                </tr>
                                <tr style="height: 52px;">
                                    <td style="width: 220px; height: 52px;">&nbsp;<img
                                            src="https://erp.cukurovayazilim.com.tr/sozlesmepdf/mimza.png"
                                            width="200" height="100" alt=""></td>
                                    <td style="width: 220px; height: 52px;">&nbsp;<img
                                            src="https://erp.cukurovayazilim.com.tr/sozlesmepdf/oimza.jpg"
                                            width="200" height="100" alt=""></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row pt-15">
                            <div class="col-md-12">
                                <p style="text-align: center; margin: 0 0 0 0;">Adres: Sümer Mahallesi Bülent Angın Bulvarı 69051 Sokak
                                    Hatice Hatun Apartmanı No:1 (Denizbank Üstü) 0322 225 8233 <br> Adres: Kavaslı
                                    Mahallesi Atatürk Bulvarı Ahmet Gürses Apt. No:81/9 Tel: 444 8 148
                                    Antakya/Hatay/Türkiye
                                    <br> Adres: İstanbul Cad. No:5 Pelin İş Merkezi Kat:4 No:121 ( Nimet Abla Gişesi
                                    Üstü ) Tel: 444 8 148 Bakırköy - İstanbul Banka Hesap No: Adana Barajyolu İşbank
                                    Şubesi: TR030006400000160130862216 İş Bankası Esenler
                                    Şubesi:TR700006400000110980696588
                                    <br> Web: www.cukurovapatent.com / info@cukurovapatent.com /
                                    adana@cukurovapatent.com / istanbul@cukurovapatent.com
                                </p>
                            </div>
                        </div>


                        <div class="body-shape1">
                            <svg width="850" height="200" viewBox="0 0 850 200" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M377 45H0V0H319.357L377 45Z" fill="#242437" />
                                <path d="M850 0V200L770.414 66.0637L403.561 65.9779L377.479 45.3821L320 0H850Z"
                                    fill="#0CAAF6" />
                            </svg>
                        </div>
                    </div>
                    <div class="invoice-buttons">
                        <button class="print_btn">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.25 13C16.6146 13 16.9141 13.1172 17.1484 13.3516C17.3828 13.5859 17.5 13.8854 17.5 14.25V19.25C17.5 19.6146 17.3828 19.9141 17.1484 20.1484C16.9141 20.3828 16.6146 20.5 16.25 20.5H3.75C3.38542 20.5 3.08594 20.3828 2.85156 20.1484C2.61719 19.9141 2.5 19.6146 2.5 19.25V14.25C2.5 13.8854 2.61719 13.5859 2.85156 13.3516C3.08594 13.1172 3.38542 13 3.75 13H16.25ZM16.25 19.25V14.25H3.75V19.25H16.25ZM17.5 8C18.2031 8.02604 18.7891 8.27344 19.2578 8.74219C19.7266 9.21094 19.974 9.79688 20 10.5V14.875C19.974 15.2656 19.7656 15.474 19.375 15.5C18.9844 15.474 18.776 15.2656 18.75 14.875V10.5C18.75 10.1354 18.6328 9.83594 18.3984 9.60156C18.1641 9.36719 17.8646 9.25 17.5 9.25H2.5C2.13542 9.25 1.83594 9.36719 1.60156 9.60156C1.36719 9.83594 1.25 10.1354 1.25 10.5V14.875C1.22396 15.2656 1.01562 15.474 0.625 15.5C0.234375 15.474 0.0260417 15.2656 0 14.875V10.5C0.0260417 9.79688 0.273438 9.21094 0.742188 8.74219C1.21094 8.27344 1.79688 8.02604 2.5 8V3C2.52604 2.29688 2.77344 1.71094 3.24219 1.24219C3.71094 0.773438 4.29688 0.526042 5 0.5H14.7266C15.0651 0.5 15.3646 0.617188 15.625 0.851562L17.1484 2.375C17.3828 2.60938 17.5 2.90885 17.5 3.27344V8ZM16.25 8V3.27344L14.7266 1.75H5C4.63542 1.75 4.33594 1.86719 4.10156 2.10156C3.86719 2.33594 3.75 2.63542 3.75 3V8H16.25ZM16.875 10.1875C17.4479 10.2396 17.7604 10.5521 17.8125 11.125C17.7604 11.6979 17.4479 12.0104 16.875 12.0625C16.3021 12.0104 15.9896 11.6979 15.9375 11.125C15.9896 10.5521 16.3021 10.2396 16.875 10.1875Z"
                                    fill="#111111" />
                            </svg>
                        </button>
                        <button id="download_btn" class="download_btn">
                            <svg width="25" height="19" viewBox="0 0 25 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.94531 11.1797C8.6849 10.8932 8.6849 10.6068 8.94531 10.3203C9.23177 10.0599 9.51823 10.0599 9.80469 10.3203L11.875 12.3516V6.375C11.901 5.98438 12.1094 5.77604 12.5 5.75C12.8906 5.77604 13.099 5.98438 13.125 6.375V12.3516L15.1953 10.3203C15.4818 10.0599 15.7682 10.0599 16.0547 10.3203C16.3151 10.6068 16.3151 10.8932 16.0547 11.1797L12.9297 14.3047C12.6432 14.5651 12.3568 14.5651 12.0703 14.3047L8.94531 11.1797ZM10.625 0.75C11.7969 0.75 12.8646 1.01042 13.8281 1.53125C14.8177 2.05208 15.625 2.76823 16.25 3.67969C16.8229 3.39323 17.4479 3.25 18.125 3.25C19.375 3.27604 20.4036 3.70573 21.2109 4.53906C22.0443 5.34635 22.474 6.375 22.5 7.625C22.5 8.01562 22.4479 8.41927 22.3438 8.83594C23.151 9.2526 23.7891 9.85156 24.2578 10.6328C24.7526 11.4141 25 12.2865 25 13.25C24.974 14.6562 24.4922 15.8411 23.5547 16.8047C22.5911 17.7422 21.4062 18.224 20 18.25H5.625C4.03646 18.1979 2.70833 17.651 1.64062 16.6094C0.598958 15.5417 0.0520833 14.2135 0 12.625C0.0260417 11.375 0.377604 10.2812 1.05469 9.34375C1.73177 8.40625 2.63021 7.72917 3.75 7.3125C3.88021 5.4375 4.58333 3.88802 5.85938 2.66406C7.13542 1.4401 8.72396 0.802083 10.625 0.75ZM10.625 2C9.08854 2.02604 7.78646 2.54688 6.71875 3.5625C5.67708 4.57812 5.10417 5.85417 5 7.39062C4.94792 7.91146 4.67448 8.27604 4.17969 8.48438C3.29427 8.79688 2.59115 9.33073 2.07031 10.0859C1.54948 10.8151 1.27604 11.6615 1.25 12.625C1.27604 13.875 1.70573 14.9036 2.53906 15.7109C3.34635 16.5443 4.375 16.974 5.625 17H20C21.0677 16.974 21.9531 16.6094 22.6562 15.9062C23.3594 15.2031 23.724 14.3177 23.75 13.25C23.75 12.5208 23.5677 11.8698 23.2031 11.2969C22.8385 10.724 22.3568 10.2682 21.7578 9.92969C21.2109 9.59115 21.0026 9.09635 21.1328 8.44531C21.2109 8.21094 21.25 7.9375 21.25 7.625C21.224 6.73958 20.9245 5.9974 20.3516 5.39844C19.7526 4.82552 19.0104 4.52604 18.125 4.5C17.6302 4.5 17.1875 4.60417 16.7969 4.8125C16.1719 5.04688 15.651 4.90365 15.2344 4.38281C14.7135 3.65365 14.0495 3.08073 13.2422 2.66406C12.4609 2.22135 11.5885 2 10.625 2Z"
                                    fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Invoice Conainter End -->

    <!--==============================
    All Js File
============================== -->
    <!-- Jquery -->
    <script src="{{ asset('custom/invoce/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('custom/invoce/js/bootstrap.min.js') }}"></script>
    <!-- PDF Generator -->
    <script src="{{ asset('custom/invoce/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('custom/invoce/js/html2canvas.min.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            /*=================================
              JS Index Here
            ==================================*/
            /*
            01. Print and Download Button

            00. Right Click Disable
            00. Inspect Element Disable
            */
            /*=================================
              JS Index End
            ==================================*/

            /*----------- 01. Print and Download Button ----------*/
            $('#download_btn').on('click', function() {
                var downloadSection = $('#download_section');
                var cWidth = downloadSection.width();
                var cHeight = downloadSection.height();
                var topLeftMargin = 40;
                var pdfWidth = cWidth + topLeftMargin * 2;
                var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
                var canvasImageWidth = cWidth;
                var canvasImageHeight = cHeight;
                var totalPDFPages = Math.ceil(cHeight / pdfHeight) - 1;

                html2canvas(downloadSection[0], {
                    allowTaint: true
                }).then(function(
                    canvas
                ) {
                    canvas.getContext('2d');
                    var imgData = canvas.toDataURL('image/jpeg', 1.0);
                    var pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
                    pdf.addImage(
                        imgData,
                        'JPG',
                        topLeftMargin,
                        topLeftMargin,
                        canvasImageWidth,
                        canvasImageHeight
                    );
                    for (var i = 1; i <= totalPDFPages; i++) {
                        pdf.addPage(pdfWidth, pdfHeight);
                        pdf.addImage(
                            imgData,
                            'JPG',
                            topLeftMargin,
                            -(pdfHeight * i) + topLeftMargin * 0,
                            canvasImageWidth,
                            canvasImageHeight
                        );
                    }
                    var pdfUrl =
                        '{{ $teklifler->teklif_kodu }}-{{ $teklifler->firmaadi->firma_unvan }} Teklifi.pdf';
                    pdf.save(pdfUrl);
                });
            });

            // Print Html Document
            $('.print_btn').on('click', function(e) {
                window.print();
            });



            // Background Image
            if ($("[data-bg-src]").length > 0) {
                $("[data-bg-src]").each(function() {
                    var src = $(this).attr("data-bg-src");
                    $(this).css("background-image", "url(" + src + ")");
                    $(this).removeAttr("data-bg-src").addClass("background-image");
                });
            }



        })(jQuery);
    </script>
    <!-- Main Js File -->
    <script src="{{ asset('custom/invoce/js/main.js') }}"></script>

</body>

</html>
