<?php

use App\Http\Controllers\AktifLogController;
use App\Http\Controllers\AlislarController;
use App\Http\Controllers\AramalarController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\BankalarController;
use App\Http\Controllers\CarilerController;
use App\Http\Controllers\CeksenetController;
use App\Http\Controllers\DokumanController;
use App\Http\Controllers\DomainhizmetController;
use App\Http\Controllers\DomaintakipController;
use App\Http\Controllers\EntegrasyonController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\FiltrePDFController;
use App\Http\Controllers\GelenefaturalarController;
use App\Http\Controllers\GidenefaturalarController;
use App\Http\Controllers\GiderController;
use App\Http\Controllers\GiderKategoriController;
use App\Http\Controllers\GorevlerController;
use App\Http\Controllers\HizmetlerController;
use App\Http\Controllers\HizmetlerKategoriController;
use App\Http\Controllers\IsbasvurulariController;
use App\Http\Controllers\IsotakipController;
use App\Http\Controllers\ItirazTakipController;
use App\Http\Controllers\IzinlerController;
use App\Http\Controllers\KargotakipController;
use App\Http\Controllers\KasalarController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\MarkatakipController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OdemelerController;
use App\Http\Controllers\OdemeplanlariController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PanoController;
use App\Http\Controllers\PerformanDegerlemeController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\PyillikhedeflerController;
use App\Http\Controllers\RaporlarController;
use App\Http\Controllers\ResmievraklarController;
use App\Http\Controllers\SatislarController;
use App\Http\Controllers\TahsilatController;
use App\Http\Controllers\TahsilatPlanController;
use App\Http\Controllers\TekliflerController;
use App\Http\Controllers\TescilnoksanController;
use App\Http\Controllers\ToplumailController;
use App\Http\Controllers\ToplusmsController;
use App\Http\Controllers\VirmanController;
use App\Http\Controllers\YillikizinController;
use App\Http\Controllers\YillikizinhakkiController;
use App\Http\Controllers\ZimmetController;
use Illuminate\Support\Facades\Route;





Route::get('/', [LoginController::class, 'index'])->name('admin.login');
Route::post('/userlogin', [LoginController::class, 'userlogin'])->name('user.login');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/anasayfa', [PageController::class, 'anasayfa'])->name('anasayfa');
    Route::resource('anamenu',MenuController::class);
    Route::get('/muhasebemenu',[MenuController::class,'muhasebemenu'])->name('muhasebemenu');
    Route::get('/ikmenu',[MenuController::class,'ikmenu'])->name('ikmenu');
    Route::get('/idariislermenu',[MenuController::class,'idariislermenu'])->name('idariislermenu');
    Route::get('/makinemenu',[MenuController::class,'makinemenu'])->name('makinemenu');


    Route::resource('cariler',CarilerController::class);
    Route::get('/carilersearch',[CarilerController::class,'carilersearch'])->name('carilersearch');
    Route::get('/tedarikciler',[CarilerController::class,'tedarikciler'])->name('tedarikciler');
    Route::get('/carihesapraporal', [RaporlarController::class, 'carihesaprapor'])->name('carihesaprapor.al');
    Route::get('/firma-unvani', [CarilerController::class, 'getFirmaUnvani'])->name('firma.unvani');


    Route::get('/vkn-check', [CarilerController::class, 'vkncheck'])->name('vkncheck');


    Route::post('/cariaramaeklePOST', [CarilerController::class, 'aramaEkle'])->name('aramaEkle');
    Route::delete('/aramasil/{id}', [CarilerController::class, 'aramasil'])->name('aramasil');
    Route::get('/gorusmelistesi',[AramalarController::class,'index'])->name('aramalar.index');
    Route::delete('/gorusmelistesi/{id}', [AramalarController::class, 'destroy'])->name('aramalar.destroy');
    Route::get('/aramalarsearch',[AramalarController::class,'aramalarsearch'])->name('aramalarsearch');
    Route::resource('gorusmelistesi',AramalarController::class);

    Route::get('/cariler/{id}', [AramalarController::class, 'store'])->name('aramalar.store');
    Route::delete('cariler/{id}/aramasil', [CarilerController::class, 'aramaSil'])->name('aramaSilshow');
    Route::post('/kontakekle',[AramalarController::class,'kontakEkle'])->name('kontakEkle');
    Route::put('/kontaklar/guncelle/{id}',[AramalarController::class,'kontakGuncelle'])->name('kontakGuncelle');
    Route::delete('/kontaksil/{id}', [AramalarController::class, 'kontakSilme'])->name('kontakSilme');
    Route::resource('kontaklistesi',KontakController::class);
    Route::get('/cari-search-kontak',[KontakController::class,'cariSearchkontak']);
    Route::get('/kontaklarsearch',[KontakController::class,'kontaklarsearch'])->name('kontaklarsearch');

    Route::post('/dokuman',[DokumanController::class,'store'])->name('dokuman.store');
    Route::post('/dokumanekle',[DokumanController::class,'dokumanEkle'])->name('dokumanEkle');


    //TEKLİFLER
    Route::resource('teklifler',TekliflerController::class);
    Route::get('/tekliflersearch',[TekliflerController::class,'tekliflersearch'])->name('tekliflersearch');

    Route::get('/get-hizmetler-by-kategori/{id}', [TekliflerController::class, 'getHizmetlerByKategori']);
    Route::get('/hizmetler/fiyat/{id}',[TekliflerController::class,'getFiyat']);
    Route::get('/cari-search',[TekliflerController::class,'cariSearch']);

    Route::post('/teklif/onayla/{id}', [TekliflerController::class, 'onaylaTeklif'])->name('onaylaTeklif');
    Route::post('/teklif/reddet/{id}', [TekliflerController::class, 'reddetTeklif'])->name('reddetTeklif');
    Route::post('/teklif/iptalet/{id}', [TekliflerController::class, 'iptaletTeklif'])->name('iptaletTeklif');

    Route::get('/bekleyenteklifler',[TekliflerController::class,'bekleyenteklifler'])->name('bekleyenteklifler');
    Route::get('/onaylananteklifler',[TekliflerController::class,'onaylananteklifler'])->name('onaylananteklifler');
    Route::get('/onaylanmayanteklifler',[TekliflerController::class,'onaylanmayanteklifler'])->name('onaylanmayanteklifler');

    Route::get('/satisfisineaktar/{id}',[TekliflerController::class,'satisafisineaktar'])->name('satisafisineaktar');
    Route::post('/satisfisineaktar/{id}', [TekliflerController::class, 'Postsatisfisineaktar'])->name('Postsatisfisineaktar');


    Route::resource('hizmetlerkategori',HizmetlerKategoriController::class);
    Route::resource('hizmetler',HizmetlerController::class);
    //SATIŞLAR
    Route::resource('satislar',SatislarController::class);
    Route::get('/satislarsearch',[SatislarController::class,'satislarsearch'])->name('satislarsearch');
    Route::post('/firmahrktaktarsatislar', [SatislarController::class, 'firmahrktaktarsatislar'])->name('firmahrktaktarsatislar');
    Route::get('/cari-search-satislar',[SatislarController::class,'cariSearchsatislar']);


    Route::resource('kasalar',KasalarController::class);
    Route::resource('bankalar',BankalarController::class);


    Route::resource('giderkategori',GiderKategoriController::class);
    Route::resource('gider',GiderController::class);
    //ALIŞLARR
    Route::resource('alislar',AlislarController::class);
    Route::get('/get-giderler-by-kategori/{kategoriId}', [AlislarController::class, 'getGiderlerByKategori']);
    Route::get('/alislarsearch',[AlislarController::class,'alislarsearch'])->name('alislarsearch');
    Route::post('/firmahrktaktaralislar', [AlislarController::class, 'firmahrktaktaralislar'])->name('firmahrktaktaralislar');
    Route::get('/cari-search-alislar',[AlislarController::class,'cariSearchalislar']);

    //TAHSİLAT
    Route::resource('tahsilat',TahsilatController::class);
    Route::get('/tahsilatsearch',[TahsilatController::class,'tahsilatsearch'])->name('tahsilatsearch');
    Route::post('/firmahrktaktartahsilat', [TahsilatController::class, 'firmahrktaktartahsilat'])->name('firmahrktaktartahsilat');

    //ÖDEMELER
    Route::resource('odemeler', OdemelerController::class);
    Route::get('/odemelersearch',[OdemelerController::class,'odemelersearch'])->name('odemelersearch');
    Route::post('/firmahrktaktarodeme', [OdemelerController::class, 'firmahrktaktarodeme'])->name('firmahrktaktarodeme');

    //ÇEKSENET
    Route::resource('ceksenet',CeksenetController::class);
    Route::get('/cektahsilat/{id}',[CeksenetController::class,'cektahsilat'])->name('cektahsilat');
    Route::post('/cektahsilat/{id}', [CeksenetController::class, 'Postcektahsilat'])->name('Postcektahsilat');
    Route::get('/cekodeme/{id}',[CeksenetController::class,'cekodeme'])->name('cekodeme');
    Route::post('/cekodeme/{id}', [CeksenetController::class, 'Postcekodeme'])->name('Postcekodeme');
    //VİRMANN
    Route::resource('virman',VirmanController::class);
    //ODEME PLANLARI
    Route::resource('odemeplanlari', OdemeplanlariController::class);
    //TAHSILAT PLAN
    Route::resource('tahsilatplan',TahsilatPlanController::class);

    //GELEN E FATURALAR
    Route::resource('gelenefaturalar',GelenefaturalarController::class);
    Route::get('/einvoice', [GelenefaturalarController::class, 'getEinvoice'])->name('getEinvoice');
    Route::get('/invoices/{invoiceUuid}/pdf', [GelenefaturalarController::class, 'getInvoicePdf'])->name('invoices.pdf');
    Route::get('/gelenfaturayialisaktar/{id}',[GelenefaturalarController::class,'gelenfaturayialisaktar'])->name('gelenfaturayialisaktar');
    Route::post('/gelenfaturayialisaktarPOST/{id}',[GelenefaturalarController::class,'gelenfaturayialisaktarPOST'])->name('gelenfaturayialisaktarPOST');


    //GIDEN E FATURALAR
    Route::resource('gidenefaturalar',GidenefaturalarController::class);
    Route::get('/einvoicegiden', [GidenefaturalarController::class, 'getEinvoicegiden'])->name('getEinvoicegiden');
    Route::get('/getMusteri/{vkn}', [GidenefaturalarController::class, 'getMusteri']);
    Route::post('/invoice/gonder', [GidenefaturalarController::class, 'createInvoice'])->name('createInvoice');

    //RAPORLARR
    Route::get('raporlar',[RaporlarController::class,'raporlar'])->name('raporlar.index');
    Route::get('carihesaprapor',[RaporlarController::class,'carihesaprapor'])->name('carihesaprapor.index');
    Route::get('satisrapor',[RaporlarController::class,'satisrapor'])->name('satisrapor.index');
    Route::get('alisrapor',[RaporlarController::class,'alisrapor'])->name('alisrapor.index');
    Route::get('tahsilatrapor',[RaporlarController::class,'tahsilatrapor'])->name('tahsilatrapor.index');
    Route::get('odemerapor',[RaporlarController::class,'odemerapor'])->name('odemerapor.index');
    Route::get('giderrapor',[RaporlarController::class,'giderrapor'])->name('giderrapor.index');
    Route::get('kasarapor',[RaporlarController::class,'kasarapor'])->name('kasarapor.index');
    Route::get('bankarapor',[RaporlarController::class,'bankarapor'])->name('bankarapor.index');
    Route::get('borctakiprapor',[RaporlarController::class,'borctakiprapor'])->name('borctakiprapor.index');
    Route::get('hizmetbazlipersonelrapor',[RaporlarController::class,'hizmetbazlipersonelrapor'])->name('hizmetbazlipersonelrapor.index');
    Route::get('kdvrapor',[RaporlarController::class,'kdvrapor'])->name('kdvrapor.index');
    Route::get('aramarapor',[RaporlarController::class,'aramarapor'])->name('aramarapor.index');
    Route::get('ayliksatisgrafigi',[RaporlarController::class,'ayliksatisgrafigi'])->name('ayliksatisgrafigi.index');


    //DOMAİNTAKİP
    Route::resource('domaintakip',DomaintakipController::class);
    Route::resource('domainhizmet',DomainhizmetController::class);
    Route::get('domaintakip/{id}/domainhizmet',[DomainhizmetController::class,'domainhizmet'])->name('domainhizmet');

    //İSOTAKİP
    Route::resource('isotakipp',IsotakipController::class);
    Route::get('/isotakipsearch',[IsotakipController::class,'isotakipsearch'])->name('isotakipsearch');
    Route::get('isotakipfiltre',[IsotakipController::class,'isotakipfiltre'])->name('isotakipfiltre.index');


    //MARKATAKİP
    Route::resource('markatakip', MarkatakipController::class);
    Route::get('/markatakipsearch',[MarkatakipController::class,'markatakipsearch'])->name('markatakipsearch');
    Route::get('/getMusteriTemsilcisi/{cariId}', [MarkatakipController::class, 'getMusteriTemsilcisi']);
    Route::get('markatakipfiltre',[MarkatakipController::class,'markatakipfiltre'])->name('markatakipfiltre.index');


    //İTİRAZTAKİP
    Route::resource('itiraztakipp',ItirazTakipController::class);
    Route::get('/basvuruno-search',[ItirazTakipController::class,'basvurunoSearch']);
    Route::get('/getMarkabilgi/{markaId}', [ItirazTakipController::class, 'getMarkabilgi']);
    Route::get('itiraztakipfiltre',[ItirazTakipController::class,'itiraztakipfiltre'])->name('itiraztakipfiltre.index');
    Route::get('/itiraztakipsearch',[ItirazTakipController::class,'itiraztakipsearch'])->name('itiraztakipsearch');

    //TESCSİLNOKSANN
    Route::resource('tescilnoksan',TescilnoksanController::class);
    Route::get('tescilnoksanfiltre',[TescilnoksanController::class,'tescilnoksanfiltre'])->name('tescilnoksanfiltre.index');
    Route::get('/tescilnoksansearch',[TescilnoksanController::class,'tescilnoksansearch'])->name('tescilnoksansearch');



    Route::get('/pdf/{type}', [MarkatakipController::class, 'indirPDF'])->name('pdf.download');
    //PDFFFİLTREEİNDİR
    Route::get('/markatakipfiltre/pdf', [MarkatakipController::class, 'indirFiltreliPDF'])->name('markatakip.pdf');
    Route::get('/itiraztakipfiltre/pdf', [FiltrePDFController::class, 'itiraztakipFiltreliPDF'])->name('itiraztakip.pdf');
    Route::get('/tescilnoksanfiltre/pdf', [FiltrePDFController::class, 'tescilnoksanFiltreliPDF'])->name('tescilnoksan.pdf');


    Route::get('/excel/export/{type}', [ExcelController::class, 'export'])->name('excel.export');
    //EXCELFİLTREİNDİR
    Route::get('/markatakipfiltre/excel', [ExcelController::class, 'indirFiltreliEXCEL'])->name('markatakip.excel');
    Route::get('/itiraztakipfiltre/excel', [ExcelController::class, 'itiraztakipFiltreliEXCEL'])->name('itiraztakip.excel');
    Route::get('/tescilnoksanfiltre/excel', [ExcelController::class, 'tescilnoksanFiltreliEXCEL'])->name('tescilnoksan.excel');


    //PANO
    Route::resource('pano',PanoController::class);

    //RESMİEVRAKLAR
    Route::resource('resmievraklarr',ResmievraklarController::class);
    //PERSONEL
    Route::resource('personell',PersonelController::class);
    Route::get('/personellistesi',[PersonelController::class,'personellistesi'])->name('personellistesi');
    Route::post('/personeldokumanpost/{id}',[PersonelController::class,'personeldokumanpost'])->name('personeldokumanpost');
    Route::delete('/personel-dokuman-sil/{id}',[PersonelController::class,'personeldokumandelete'])->name('personeldokumandelete');
    Route::post('/personelegitimPOST/{id}',[PersonelController::class,'personelegitimPOST'])->name('personelegitimPOST');
    Route::delete('/personelegitimDELETE/{id}',[PersonelController::class,'personelegitimDELETE'])->name('personelegitimDELETE');
    Route::get('/personelsearch',[PersonelController::class,'personelsearch'])->name('personelsearch');
    Route::get('/personelozluksearch',[PersonelController::class,'personelozluksearch'])->name('personelozluksearch');
    //GOREVLENDİRME
    Route::resource('gorevatama',GorevlerController::class);

    //KARGOTAKİP
    Route::resource('kargotakip',KargotakipController::class);

    //İZİNLER
    Route::resource('izinler',IzinlerController::class);
    Route::get('/izinlersearch',[IzinlerController::class,'izinlersearch'])->name('izinlersearch');

    //YILLIKİZİN
    Route::resource('yillikizin',YillikizinController::class);
    Route::post('/izinhakkipost',[YillikizinhakkiController::class,'izinhakkipost'])->name('izinhakkipost');
    Route::get('/get-izin-hakki', [YillikizinhakkiController::class, 'getIzinHakki']);
    Route::get('/yillikizinhaklari',[YillikizinController::class,'yillikizinhakkilist'])->name('yillikizinhakkilist');
    Route::get('/yillikizinsearch',[YillikizinController::class,'yillikizinsearch'])->name('yillikizinsearch');

    //ZİMMETLER
    Route::resource('zimmet',ZimmetController::class);
    Route::get('/zimmetsearch',[ZimmetController::class,'zimmetsearch'])->name('zimmetsearch');

    //IS BASVURULARI
    Route::resource('isbasvurulari',IsbasvurulariController::class);
    Route::get('isbasvurularilist',[IsbasvurulariController::class,'isbasvurularilist'])->name('isbasvurularilist');
    Route::post('/personellistesineaktar/{id}',[IsbasvurulariController::class,'personeleaktar'])->name('personeleaktar');
    //PERFORMANS DEGERLEME
    Route::resource('performansdegerleme',PerformanDegerlemeController::class);
    Route::get('performansdegerleme/{id}/formu',[PerformanDegerlemeController::class,'degerlemeformu'])->name('degerlemeformu');
    Route::get('/kriterler',[PerformanDegerlemeController::class,'degerlendirmekriterleri'])->name('degerlendirmekriterleri');
    Route::post('/degerlemeformuPOST',[PerformanDegerlemeController::class,'degerlemeformuPOST'])->name('degerlemeformuPOST');
    Route::get('/performans-degerleme-formu/{id}', [PerformanDegerlemeController::class, 'degerlemeformuSHOW'])->name('degerlemeformuSHOW');

    //PERSONEL YILLIK HEDEFLERİ
    Route::resource('pyillikhedefler',PyillikhedeflerController::class);
    Route::post('/yillikhedefkonulariPOST',[PyillikhedeflerController::class,'yillikhedefkonuPOST'])->name('yillikhedefkonuPOST');
    Route::get('/yillikhedefkonulari',[PyillikhedeflerController::class,'yillikhedefkonu'])->name('yillikhedefkonu');
    //ENTEGRASYONLAR
    Route::get('/entegrasyonmenu',[EntegrasyonController::class,'entegrasyonmenu'])->name('entegrasyonmenu');
    Route::get('/smsapi',[EntegrasyonController::class,'smsapi'])->name('smsapi');
    Route::put('/smsapiPUT/{id}',[EntegrasyonController::class,'smsapiPUT'])->name('smsapiPUT');
    Route::get('/smtp',[EntegrasyonController::class,'smtp'])->name('smtp');
    Route::get('/efaturaapi',[EntegrasyonController::class,'efaturaapi'])->name('efaturaapi');
    Route::put('/efaturaapiPUT/{id}',[EntegrasyonController::class,'efaturaapiPUT'])->name('efaturaapiPUT');

    //TOPLU SMS
    Route::resource('toplusms',ToplusmsController::class);
    Route::resource('toplumail',ToplumailController::class);

    Route::resource('aktiflog', AktifLogController::class);
    Route::get('/aktiflogsearch',[AktifLogController::class,'aktiflogsearch'])->name('aktiflogsearch');


    Route::resource('register', RegisterController::class)/* ->middleware('role:Super-Admin') */;
    Route::put('sifredegistir/{id}', [RegisterController::class, 'sifredegistir'])->name('sifredegistir');
    Route::get('userresetpassword', [RegisterController::class, 'userresetpassword'])->name('userresetpassword');
    Route::put('userresetpasswordPOST/{id}', [RegisterController::class, 'userresetpasswordPOST'])->name('userresetpasswordPOST');
    Route::get('usersearch', [RegisterController::class, 'usersearch'])->name('usersearch');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
