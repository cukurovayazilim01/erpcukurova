@extends('admin.layouts.app')
@section('title')
    Cariler
@endsection
@section('contents')
@section('topheader')
    Cariler
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">

                <div class=" col-md-4 mr-4 mobile-erp1 d-flex gap-2">

                    <form method="GET" action="{{ route('cariler.index') }}" id="entriesForm">
                        <select class="form-select form-select-sm" name="entries"
                            onchange="document.getElementById('entriesForm').submit();">
                            <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>

                    <a href="{{ route('cariler.index') }}">
                        <button type="button" class="btn btn-dark btn-sm px-3"><i
                                class="fa-solid fa-user"></i>Müşteriler</button>
                    </a>
                    <a href="{{ route('tedarikciler') }}">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-users"></i>
                            Tedarikçiler</button>
                    </a>
                </div>

                <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                    <form id="searchForm" action="{{ route('carilersearch') }}"  method="GET">
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                            <input class="form-control ps-5" id="searchInput" type="text" placeholder="Genel Arama">
                          </div>
                        </form>
                </div>
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm mx-0 mx-lg-2" data-bs-toggle="modal"
                        data-bs-target="#carilermodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>

                </div>

            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="carilermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('cariler.store') }}" method="POST">
                @csrf
                <div class="modal-content">

                    <div class="modal-header">
                        <h2 class="modal-title">Cari Kayıt </h2>
                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">

                            <div class="col-md-6 col-sm-12 ">
                                <label for="firma_unvan">Firma Unvanı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    <input type="text" name="firma_unvan" id="firma_unvan"
                                        class="form-control form-control-sm" required
                                        oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="ticari_unvan">Ticari Unvanı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                    <input type="text" name="ticari_unvan" id="ticari_unvan"
                                        class="form-control form-control-sm" required
                                        oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                            {{-- =============================== --}}


                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="is_tel">İş Telefonu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                                    <input type="number" name="is_tel" id="is_tel"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="eposta">E-Posta</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    <input type="email" name="eposta" id="eposta"
                                        class="form-control form-control-sm"
                                        oninput="this.value = this.value.toLowerCase()" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="yetkili_kisi">Yetkili Kişi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-user-tie"></i>
                                    </span>
                                    <input type="text" name="yetkili_kisi" id="yetkili_kisi"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="yetkili_kisi_tel">Yetkili Kişi Telefon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                                    <input type="number" name="yetkili_kisi_tel" id="yetkili_kisi_tel"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>

                            {{-- ================================= --}}




                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <select name="user_id" id="user_id"
                                        class="form-control form-control-sm" required>
                                        <option value="">Müşteri Temsilcisi Seçiniz</option>
                                        @foreach ($user as $cariitem)
                                            <option value="{{ $cariitem->id }}">{{ $cariitem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <label for="firma_turu">Firma Türü</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                                    <select name="firma_turu" id="firma_turu" class="form-control form-control-sm">
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="sahis">Şahıs</option>
                                        <option value="tuzel">Tüzel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <label for="firma_sektor">Firma Sektörü</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                                    <select name="firma_sektor" id="firma_sektor" class="form-control form-control-sm">
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            <option value="Ambalaj Sanayi">Ambalaj Sanayi</option>
                                            <option value="Ağaç ve Orman Ürünleri">Ağaç ve Orman Ürünleri</option>
                                            <option value="Avcılık ve Balıkçılık">Avcılık ve Balıkçılık</option>
                                            <option value="Altyapı ve İnşaat">Altyapı ve İnşaat</option>
                                            <option value="Araç Kiralama">Araç Kiralama</option>
                                            <option value="Akaryakıt ve Petrol Ürünleri">Akaryakıt ve Petrol Ürünleri
                                            </option>
                                            <option value="Asansör ve Yürüyen Merdiven">Asansör ve Yürüyen Merdiven
                                            </option>
                                            <option value="Aydınlatma ve Elektrik Malzemeleri">Aydınlatma ve Elektrik
                                                Malzemeleri</option>
                                            <option value="Araştırma ve Danışmanlık">Araştırma ve Danışmanlık</option>
                                            <option value="Ar-Ge ve İnovasyon">Ar-Ge ve İnovasyon</option>
                                            <option value="Bilişim ve Teknoloji">Bilişim ve Teknoloji</option>
                                            <option value="Bankacılık ve Finans">Bankacılık ve Finans</option>
                                            <option value="Boya ve Kimya">Boya ve Kimya</option>
                                            <option value="Beyaz Eşya Üretimi">Beyaz Eşya Üretimi</option>
                                            <option value="Bilgisayar ve Elektronik">Bilgisayar ve Elektronik</option>
                                            <option value="Borsa ve Yatırım">Borsa ve Yatırım</option>
                                            <option value="Bakliyat ve Tahıl Ürünleri">Bakliyat ve Tahıl Ürünleri
                                            </option>
                                            <option value="Bal ve Arıcılık">Bal ve Arıcılık</option>
                                            <option value="Biyoteknoloji">Biyoteknoloji</option>
                                            <option value="Bahçe ve Peyzaj">Bahçe ve Peyzaj</option>
                                            <option value="Cam ve Seramik Sanayi">Cam ve Seramik Sanayi</option>
                                            <option value="Çimento ve Hazır Beton">Çimento ve Hazır Beton</option>
                                            <option value="Çelik Üretimi">Çelik Üretimi</option>
                                            <option value="Çağrı Merkezi Hizmetleri">Çağrı Merkezi Hizmetleri</option>
                                            <option value="Çevre ve Geri Dönüşüm">Çevre ve Geri Dönüşüm</option>
                                            <option value="Cep Telefonu ve Aksesuarları">Cep Telefonu ve Aksesuarları
                                            </option>
                                            <option value="Çiftlik Yönetimi ve Tarım Ürünleri">Çiftlik Yönetimi ve Tarım
                                                Ürünleri</option>
                                            <option value="Çikolata ve Şekerleme Ürünleri">Çikolata ve Şekerleme
                                                Ürünleri</option>
                                            <option value="Çocuk Oyuncakları ve Gereçleri">Çocuk Oyuncakları ve
                                                Gereçleri</option>
                                            <option value="Çay ve Kahve Üretimi">Çay ve Kahve Üretimi</option>
                                            <option value="Demir-Çelik ve Metal Sanayi">Demir-Çelik ve Metal Sanayi
                                            </option>
                                            <option value="Deri ve Deri Ürünleri">Deri ve Deri Ürünleri</option>
                                            <option value="Denizcilik ve Gemi Sanayi">Denizcilik ve Gemi Sanayi
                                            </option>
                                            <option value="Dayanıklı Tüketim Malları">Dayanıklı Tüketim Malları
                                            </option>
                                            <option value="Dijital Pazarlama">Dijital Pazarlama</option>
                                            <option value="Düğün ve Organizasyon">Düğün ve Organizasyon</option>
                                            <option value="Dekorasyon ve İç Mimarlık">Dekorasyon ve İç Mimarlık
                                            </option>
                                            <option value="Dijital İçerik Üretimi">Dijital İçerik Üretimi</option>
                                            <option value="Doğalgaz ve LPG Sektörü">Doğalgaz ve LPG Sektörü</option>
                                            <option value="Dondurulmuş Gıda Üretimi">Dondurulmuş Gıda Üretimi</option>
                                            <option value="Eğitim Kurumları">Eğitim Kurumları</option>
                                            <option value="Elektrik ve Elektronik Üretimi">Elektrik ve Elektronik
                                                Üretimi</option>
                                            <option value="Emlak ve Gayrimenkul">Emlak ve Gayrimenkul</option>
                                            <option value="Enerji Üretimi ve Dağıtımı">Enerji Üretimi ve Dağıtımı
                                            </option>
                                            <option value="Ev Tekstili ve Dekorasyon">Ev Tekstili ve Dekorasyon
                                            </option>
                                            <option value="Eğlence ve Medya">Eğlence ve Medya</option>
                                            <option value="Evcil Hayvan Ürünleri">Evcil Hayvan Ürünleri</option>
                                            <option value="Et ve Et Ürünleri">Et ve Et Ürünleri</option>
                                            <option value="Elektrikli Araçlar ve Şarj İstasyonları">Elektrikli Araçlar
                                                ve Şarj İstasyonları</option>
                                            <option value="E-Spor ve Oyun Endüstrisi">E-Spor ve Oyun Endüstrisi
                                            </option>
                                            <option value="Sigara ve Tütün Ürünleri">Sigara ve Tütün Ürünleri</option>
                                            <option value="Mobilya Üretimi">Mobilya Üretimi</option>
                                            <option value="Moda ve Tekstil">Moda ve Tekstil</option>
                                            <option value="Sağlık ve Medikal">Sağlık ve Medikal</option>
                                            <option value="Turizm ve Otelcilik">Turizm ve Otelcilik</option>
                                            <option value="Lojistik ve Taşımacılık">Lojistik ve Taşımacılık</option>
                                            <option value="Havacılık ve Uzay Sanayi">Havacılık ve Uzay Sanayi</option>
                                            <option value="Sigorta ve Risk Yönetimi">Sigorta ve Risk Yönetimi</option>
                                            <option value="Bilişim">Bilişim</option>
                                            <option value="Üretim / Endüstriyel Ürünler">Üretim /
                                                Endüstriyel Ürünler</option>
                                            <option value="Elektrik & Elektronik">Elektrik & Elektronik
                                            </option>
                                            <option value="Güvenlik">Güvenlik</option>
                                            <option value="Enerji">Enerji</option>
                                            <option value="Gıda">Gıda</option>
                                            <option value="Kimya">Kimya</option>
                                            <option value="Maden ve Metal Sanayi">Maden ve Metal Sanayi
                                            </option>
                                            <option value="Mobilya & Aksesuar">Mobilya & Aksesuar</option>
                                            <option value="Ev Eşyaları">Ev Eşyaları</option>
                                            <option value="Orman Ürünleri">Orman Ürünleri</option>
                                            <option value="Ofis / Büro Malzemeleri">Ofis / Büro Malzemeleri
                                            </option>
                                            <option value="Otomotiv">Otomotiv</option>
                                            <option value="Sağlık">Sağlık</option>
                                            <option value="Tarım / Ziraat">Tarım / Ziraat</option>
                                            <option value="Taşımacılık">Taşımacılık</option>
                                            <option value="Tekstil">Tekstil</option>
                                            <option value="Telekomünikasyon">Telekomünikasyon</option>
                                            <option value="Turizm">Turizm</option>
                                            <option value="Yapı">Yapı</option>
                                            <option value="Topluluklar">Topluluklar</option>
                                            <option value="Hizmet">Hizmet</option>
                                            <option value="Danışmanlık">Danışmanlık</option>
                                            <option value="Reklam ve Tanıtım">Reklam ve Tanıtım</option>
                                            <option value="Eğitim">Eğitim</option>
                                            <option value="Finans - Ekonomi">Finans - Ekonomi</option>
                                            <option value="Ticaret">Ticaret</option>
                                            <option value="Denizcilik">Denizcilik</option>
                                            <option value="Eğlence - Kültür - Sanat">Eğlence - Kültür -
                                                Sanat</option>
                                            <option value="Basım - Yayın">Basım - Yayın</option>
                                            <option value="Medya">Medya</option>
                                            <option value="Havacılık">Havacılık</option>
                                            <option value="Hızlı Tüketim Malları">Hızlı Tüketim Malları
                                            </option>
                                            <option value="Hayvancılık">Hayvancılık</option>
                                            <option value="Sigortacılık">Sigortacılık</option>
                                            <option value="Dayanıklı Tüketim Ürünleri">Dayanıklı Tüketim
                                                Ürünleri</option>
                                            <option value="Atık Yönetimi ve Geri Dönüşüm">Atık Yönetimi ve
                                                Geri Dönüşüm</option>
                                            <option value="Arşiv Yönetimi ve Saklama">Arşiv Yönetimi ve
                                                Saklama</option>
                                            <option value="Perakende">Perakende</option>
                                            <option value="Perakende">Perakende</option>
                                            <option value="Çevre">Çevre</option>
                                            <option value="İletişim Danışmanlığı">İletişim Danışmanlığı
                                            </option>
                                            <option value="Kaynak ve Kesme Ekipmanları">Kaynak ve Kesme
                                                Ekipmanları</option>
                                            <option value="Gemi Yan Sanayi">Gemi Yan Sanayi</option>
                                            <option value="Bina ve Site Yönetimi">Bina ve Site Yönetimi
                                            </option>
                                            <option value="Sondaj">Sondaj</option>
                                            <option value="Bilgi Teknolojileri">Bilgi Teknolojileri
                                            </option>
                                            <option value="Dental">Dental</option>
                                            <option value="Medikal">Medikal</option>
                                            <option value="Kozmetik">Kozmetik</option>
                                            <option value="İnşaat">İnşaat</option>
                                            <option value="Organizasyon">Organizasyon</option>
                                            <option value="Otoyol, Tünel ve Köprü İşletmeciliği">Otoyol,
                                                Tünel ve Köprü İşletmeciliği</option>
                                            <option value="Güzellik Merkezi">Güzellik Merkezi</option>
                                            <option value="Restaurant">Restaurant</option>
                                            <option value="Cafe">Cafe</option>
                                            <option value="Tarım ve Hayvancılık">Tarım ve Hayvancılık</option>
                                            <option value="Tarım ve Hayvancılık">Tarım ve Hayvancılık</option>
                                            <option value="İnşaat ve Yapı">İnşaat ve Yapı</option>
                                            <option value="Otomotiv">Otomotiv</option>
                                            <option value="Tekstil ve Hazır Giyim">Tekstil ve Hazır Giyim</option>
                                            <option value="Gıda ve İçecek">Gıda ve İçecek</option>
                                            <option value="Teknoloji ve Bilişim">Teknoloji ve Bilişim</option>
                                            <option value="Enerji">Enerji</option>
                                            <option value="Sağlık ve İlaç">Sağlık ve İlaç</option>
                                            <option value="Turizm ve Konaklama">Turizm ve Konaklama</option>
                                            <option value="Perakende Ticaret">Perakende Ticaret</option>
                                            <option value="Finans ve Bankacılık">Finans ve Bankacılık</option>
                                            <option value="Eğitim ve Öğretim">Eğitim ve Öğretim</option>
                                            <option value="Medya ve İletişim">Medya ve İletişim</option>
                                            <option value="Sanayi ve Üretim">Sanayi ve Üretim</option>
                                            <option value="Hizmet Sektörü">Hizmet Sektörü</option>
                                            <option value="Denizcilik ve Liman İşletmeciliği">Denizcilik ve Liman
                                                İşletmeciliği</option>
                                            <option value="Metal ve Madencilik">Metal ve Madencilik</option>
                                            <option value="Kimya ve Petrokimya">Kimya ve Petrokimya</option>
                                            <option value="Savunma Sanayi">Savunma Sanayi</option>
                                            <option value="Lojistik ve Taşımacılık">Lojistik ve Taşımacılık</option>
                                            <option value="Otomasyon ve Robotik">Otomasyon ve Robotik</option>
                                            <option value="Tarım Teknolojileri">Tarım Teknolojileri</option>
                                            <option value="Sağlık Turizmi">Sağlık Turizmi</option>
                                            <option value="Finansal Teknolojiler (Fintech)">Finansal Teknolojiler
                                                (Fintech)</option>
                                            <option value="İnsan Kaynakları ve İstihdam Hizmetleri">İnsan Kaynakları ve
                                                İstihdam Hizmetleri</option>
                                            <option value="Yenilenebilir Enerji">Yenilenebilir Enerji</option>
                                            <option value="Film ve Dizi Endüstrisi">Film ve Dizi Endüstrisi</option>
                                            <option value="Telekomünikasyon">Telekomünikasyon</option>
                                            <option value="Çevre Teknolojileri">Çevre Teknolojileri</option>
                                            <option value="Oyun Geliştirme ve Eğlence Endüstrisi">Oyun Geliştirme ve
                                                Eğlence Endüstrisi</option>
                                            <option value="Havacılık ve Uzay Teknolojileri">Havacılık ve Uzay
                                                Teknolojileri</option>
                                            <option value="Yazılım Geliştirme ve Programlama">Yazılım Geliştirme ve
                                                Programlama</option>
                                            <option value="Biyoteknoloji ve Genetik">Biyoteknoloji ve Genetik</option>
                                            <option value="Reklam ve Pazarlama">Reklam ve Pazarlama</option>
                                            <option value="Moda ve Tasarım">Moda ve Tasarım</option>
                                            <option value="Müzik ve Eğlence Endüstrisi">Müzik ve Eğlence Endüstrisi
                                            </option>
                                            <option value="Yazılım As A Service (SaaS)">Yazılım As A Service (SaaS)
                                            </option>
                                            <option value="Web Geliştirme ve Tasarım">Web Geliştirme ve Tasarım
                                            </option>
                                            <option value="Güvenlik ve Savunma">Güvenlik ve Savunma</option>
                                            <option value="Sağlık Hizmetleri ve Hastane İşletmeciliği">Sağlık
                                                Hizmetleri ve Hastane İşletmeciliği</option>
                                            <option value="Danışmanlık ve Stratejik Planlama">Danışmanlık ve Stratejik
                                                Planlama</option>
                                            <option value="Sigortacılık">Sigortacılık</option>
                                            <option value="Tarım Makineleri ve Ekipmanları">Tarım Makineleri ve
                                                Ekipmanları</option>
                                            <option value="Mimarlık ve Peyzaj Tasarımı">Mimarlık ve Peyzaj Tasarımı
                                            </option>
                                            <option value="Elektronik ve Elektrik">Elektronik ve Elektrik</option>
                                            <option value="Otel ve Konaklama İşletmeciliği">Otel ve Konaklama
                                                İşletmeciliği</option>
                                            <option value="E-Ticaret ve Online Perakende">E-Ticaret ve Online Perakende
                                            </option>
                                            <option value="Mühendislik Hizmetleri">Mühendislik Hizmetleri</option>
                                            <option value="Yatırım ve Portföy Yönetimi">Yatırım ve Portföy Yönetimi
                                            </option>
                                            <option value="Eğlence Parkları ve Tema Parkları">Eğlence Parkları ve Tema
                                                Parkları</option>
                                            <option value="Mobilya ve Dekorasyon">Mobilya ve Dekorasyon</option>
                                            <option value="Yapay Zeka ve Makine Öğrenimi">Yapay Zeka ve Makine Öğrenimi
                                            </option>
                                            <option value="Nanoteknoloji">Nanoteknoloji</option>
                                            <option value="Dijital Pazarlama ve SEO">Dijital Pazarlama ve SEO</option>
                                            <option value="Emlak ve Gayrimenkul Yatırımı">Emlak ve Gayrimenkul Yatırımı
                                            </option>
                                            <option value="Tarım ve Bahçecilik">Tarım ve Bahçecilik</option>
                                            <option value="Bilgi Teknolojileri Danışmanlığı">Bilgi Teknolojileri
                                                Danışmanlığı</option>
                                            <option value="Moda Perakendeciliği">Moda Perakendeciliği</option>
                                            <option value="Gemi İnşa ve Denizcilik">Gemi İnşa ve Denizcilik</option>
                                            <option value="İthalat ve İhracat Ticareti">İthalat ve İhracat Ticareti
                                            </option>
                                            <option value="Video Oyunları Geliştirme">Video Oyunları Geliştirme
                                            </option>
                                            <option value="Biyomedikal Mühendisliği">Biyomedikal Mühendisliği</option>
                                            <option value="Sağlık Bakım Hizmetleri">Sağlık Bakım Hizmetleri</option>
                                            <option value="Restoran İşletmeciliği">Restoran İşletmeciliği</option>
                                            <option value="Yapı Malzemeleri Üretimi">Yapı Malzemeleri Üretimi</option>
                                            <option value="Dijital Ajanslar">Dijital Ajanslar</option>
                                            <option value="Ar-Ge ve Yenilikçilik">Ar-Ge ve Yenilikçilik</option>
                                            <option value="Ürün Tasarımı ve Geliştirme">Ürün Tasarımı ve Geliştirme
                                            </option>
                                            <option value="İlaç ve Tıbbi Cihazlar">İlaç ve Tıbbi Cihazlar</option>
                                            <option value="Eğitim Teknolojileri">Eğitim Teknolojileri</option>
                                            <option value="Film Prodüksiyonu">Film Prodüksiyonu</option>
                                            <option value="Deniz Turizmi">Deniz Turizmi</option>
                                            <option value="Danışmanlık ve Mühendislik">Danışmanlık ve Mühendislik
                                            </option>
                                            <option value="Görüntüleme ve Grafik Tasarım">Görüntüleme ve Grafik Tasarım
                                            </option>
                                            <option value="Tarım Makineleri ve Ekipmanları">Tarım Makineleri ve
                                                Ekipmanları</option>
                                            <option value="Telekomünikasyon Altyapı Hizmetleri">Telekomünikasyon
                                                Altyapı Hizmetleri</option>
                                            <option value="Mobilya Üretimi">Mobilya Üretimi</option>
                                            <option value="Yapı Kimyasalları">Yapı Kimyasalları</option>
                                            <option value="Güzellik ve Kişisel Bakım">Güzellik ve Kişisel Bakım
                                            </option>
                                            <option value="Kimya Analizi ve Laboratuvar Hizmetleri">Kimya Analizi ve
                                                Laboratuvar Hizmetleri</option>
                                            <option value="Fuar ve Organizasyon Hizmetleri">Fuar ve Organizasyon
                                                Hizmetleri</option>
                                            <option value="İçecek ve Alkollü İçecekler">İçecek ve Alkollü İçecekler
                                            </option>
                                            <option value="Rekreasyon ve Eğlence Merkezleri">Rekreasyon ve Eğlence
                                                Merkezleri</option>
                                            <option value="Ambalaj ve Paketleme">Ambalaj ve Paketleme</option>
                                            <option value="Tarım Danışmanlığı ve Destek Hizmetleri">Tarım Danışmanlığı
                                                ve Destek Hizmetleri</option>
                                            <option value="Yazılım Testi ve Kalite Güvencesi">Yazılım Testi ve Kalite
                                                Güvencesi</option>
                                            <option value="Finansal Danışmanlık ve Danışmanlık">Finansal Danışmanlık ve
                                                Danışmanlık</option>
                                            <option value="Sağlık Bilgi Yönetimi">Sağlık Bilgi Yönetimi</option>
                                            <option value="Tarım ve Bahçecilik">Tarım ve Bahçecilik</option>
                                            <option value="Reklam ve Tanıtım Ajansları">Reklam ve Tanıtım Ajansları
                                            </option>
                                            <option value="Endüstriyel Otomasyon">Endüstriyel Otomasyon</option>
                                            <option value="Organik Tarım ve Organik Ürünler">Organik Tarım ve Organik
                                                Ürünler</option>
                                            <option value="Web Hosting ve Alan Adı Hizmetleri">Web Hosting ve Alan Adı
                                                Hizmetleri</option>
                                            <option value="Plastik ve Kauçuk Ürünleri">Plastik ve Kauçuk Ürünleri
                                            </option>
                                            <option value="Elektronik Ticaret ve Pazar Yeri Platformları">Elektronik
                                                Ticaret ve Pazar Yeri Platformları</option>
                                            <option value="Sosyal Medya Yönetimi ve Stratejisi">Sosyal Medya Yönetimi
                                                ve Stratejisi</option>
                                            <option value="Finansal Analiz ve Raporlama">Finansal Analiz ve Raporlama
                                            </option>
                                            <option value="Tarım ve Bahçe Ekipmanları">Tarım ve Bahçe Ekipmanları
                                            </option>
                                            <option value="Yazılım Dağıtımı ve Dağıtık Sistemler">Yazılım Dağıtımı ve
                                                Dağıtık Sistemler</option>
                                            <option value="Turizm Rehberliği ve Seyahat Acentaları">Turizm Rehberliği
                                                ve Seyahat Acentaları</option>
                                            <option value="Demir ve Çelik Üretimi">Demir ve Çelik Üretimi</option>
                                            <option value="Veri Analizi ve Büyük Veri">Veri Analizi ve Büyük Veri
                                            </option>
                                            <option value="Ahşap ve Orman Ürünleri">Ahşap ve Orman Ürünleri</option>
                                            <option value="Yapı Malzeme Tedarikçileri">Yapı Malzeme Tedarikçileri
                                            </option>
                                            <option value="Enerji Dağıtımı ve İletimi">Enerji Dağıtımı ve İletimi
                                            </option>
                                            <option value="İnternet Servis Sağlayıcıları (ISP)">İnternet Servis
                                                Sağlayıcıları (ISP)</option>
                                            <option value="Endüstriyel Temizlik ve Hijyen">Endüstriyel Temizlik ve
                                                Hijyen</option>
                                            <option value="Otomotiv Parça ve Aksesuarları">Otomotiv Parça ve
                                                Aksesuarları</option>
                                            <option value="Bilgisayar Donanımı ve Bileşenleri">Bilgisayar Donanımı ve
                                                Bileşenleri</option>
                                            <option value="Gıda İşleme ve Paketleme">Gıda İşleme ve Paketleme</option>
                                            <option value="Enerji Verimliliği ve Yenilenebilir Enerji">Enerji
                                                Verimliliği ve Yenilenebilir Enerji</option>
                                            <option value="Yazılım Geliştirme Araçları">Yazılım Geliştirme Araçları
                                            </option>
                                            <option value="Mekatronik ve Otomasyon Sistemleri">Mekatronik ve Otomasyon
                                                Sistemleri</option>
                                            <option value="Tarım Ekipmanları ve Makineleri">Tarım Ekipmanları ve
                                                Makineleri</option>
                                            <option value="Dış Ticaret ve İhracat Pazarlama">Dış Ticaret ve İhracat
                                                Pazarlama</option>
                                            <option value="Sağlık Bilgi Teknolojileri">Sağlık Bilgi Teknolojileri
                                            </option>
                                            <option value="Yapı Malzeme Satışı ve Ticareti">Yapı Malzeme Satışı ve
                                                Ticareti</option>
                                            <option value="İklim Kontrol Sistemleri">İklim Kontrol Sistemleri</option>
                                            <option value="Organik Gıda Üretimi">Organik Gıda Üretimi</option>
                                            <option value="Tarım ve Bahçecilik">Tarım ve Bahçecilik</option>
                                            <option value="Oyun ve Eğlence Merkezleri">Oyun ve Eğlence Merkezleri
                                            </option>
                                            <option value="İçme Suyu ve Atık Su Arıtma">İçme Suyu ve Atık Su Arıtma
                                            </option>
                                            <option value="Yazılım Güvenliği ve Siber Güvenlik">Yazılım Güvenliği ve
                                                Siber Güvenlik</option>
                                            <option value="Uygulama Geliştirme ve Mobil Teknolojiler">Uygulama
                                                Geliştirme ve Mobil Teknolojiler</option>
                                            <option value="Endüstriyel Tasarım ve Mühendislik">Endüstriyel Tasarım ve
                                                Mühendislik</option>
                                            <option value="Araştırma ve Geliştirme Hizmetleri">Araştırma ve Geliştirme
                                                Hizmetleri</option>
                                            <option value="Tarım ve Bahçe Ekipmanları">Tarım ve Bahçe Ekipmanları
                                            </option>
                                            <option value="Teknoloji Eğitimi ve Eğitim Teknolojisi">Teknoloji Eğitimi
                                                ve Eğitim Teknolojisi</option>
                                            <option value="Kimyasal Ürünler ve Malzemeler">Kimyasal Ürünler ve
                                                Malzemeler</option>
                                            <option value="Web Sitesi Tasarımı ve Geliştirme">Web Sitesi Tasarımı ve
                                                Geliştirme</option>
                                            <option value="Tarım ve Bahçecilik">Tarım ve Bahçecilik</option>
                                            <option value="Mekanik Mühendislik ve Tasarım">Mekanik Mühendislik ve
                                                Tasarım</option>
                                            <option value="Dijital Varlık Yönetimi">Dijital Varlık Yönetimi</option>
                                            <option value="İnternet Reklamcılığı ve PPC Yönetimi">İnternet Reklamcılığı
                                                ve PPC Yönetimi</option>
                                            <option value="İş Zekası ve Veri Analitiği">İş Zekası ve Veri Analitiği
                                            </option>
                                            <option value="Tarım Makineleri ve Ekipmanları">Tarım Makineleri ve
                                                Ekipmanları</option>
                                            <option value="Gemi İnşa ve Denizcilik">Gemi İnşa ve Denizcilik</option>
                                            <option value="Lojistik ve Tedarik Zinciri Yönetimi">Lojistik ve Tedarik
                                                Zinciri Yönetimi</option>
                                            <option value="Diş Hekimliği ve Diş Bakım Hizmetleri">Diş Hekimliği ve Diş
                                                Bakım Hizmetleri</option>
                                            <option value="Kimyasal Temizlik ve Temizlik Malzemeleri">Kimyasal Temizlik
                                                ve Temizlik Malzemeleri</option>
                                            <option value="İş Yönetimi ve Danışmanlık">İş Yönetimi ve Danışmanlık
                                            </option>
                                            <option value="Medikal Cihazlar ve Ekipmanlar">Medikal Cihazlar ve
                                                Ekipmanlar</option>
                                            <option value="Tarım ve Bahçe Ekipmanları">Tarım ve Bahçe Ekipmanları
                                            </option>
                                            <option value="Yapı Malzemesi Üretimi ve Tedarikçileri">Yapı Malzemesi
                                                Üretimi ve Tedarikçileri</option>
                                            <option value="Eğitim Materyalleri ve Kitap Yayıncılığı">Eğitim
                                                Materyalleri ve Kitap Yayıncılığı</option>
                                            <option value="Güneş Enerjisi ve Fotovoltaik Sistemler">Güneş Enerjisi ve
                                                Fotovoltaik Sistemler</option>
                                            <option value="Dijital Eğlence ve Eğlence İçerikleri">Dijital Eğlence ve
                                                Eğlence İçerikleri</option>
                                            <option value="Yatırım ve Portföy Yönetimi">Yatırım ve Portföy Yönetimi
                                            </option>
                                            <option value="Makine Üretimi ve Üreticileri">Makine Üretimi ve Üreticileri
                                            </option>
                                            <option value="Sigara ve Tütün Ürünleri">Sigara ve Tütün Ürünleri</option>
                                    </select>
                                </div>
                            </div>


                            {{-- ================================= --}}


                            <div class="col-md-6">
                                <label for="adres">Adres</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i></span>
                                    <textarea name="adres" id="adres" class="form-control" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="aciklama">Açıklama</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                    <textarea name="aciklama" id="aciklama" class="form-control" aria-label="With textarea"></textarea>
                                </div>
                            </div>


                            {{-- =================================== --}}
                            <div class="title mt-4 text-center">
                                <h6>Firma Vergilendirme</h6>
                            </div>
                            {{-- =========================== --}}

                            <div class="col-md-3">
                                <label for="vergi_no">Vergi No</label>
                                <button type="button" onclick="vknSorgula()" class="btn btn-danger btn-sm p-0 m-0"
                                    style="display: inline-block; margin-left: 10px;"><b style="font-size: 10px">Firma
                                        Bilgisi Getir</b></button>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-receipt"></i></span>
                                    <input type="text" name="vergi_no" id="vergi_no"
                                        class="form-control form-control-sm input-mask" pattern="^\d{10,11}$"
                                        inputmode="numeric" maxlength="11" minlength="10" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="vergi_dairesi">Vergi Dairesi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i
                                            class="fa-solid fa-house-chimney-user"></i></span>
                                    <input type="text" name="vergi_dairesi" id="vergi_dairesi"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">T.C Kimlik No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card-clip"></i></span>
                                    <input type="text" name="tc_kimlik" id="tc_kimlik"
                                        class="form-control form-control-sm input-mask" pattern="\d{11}"
                                        inputmode="numeric" maxlength="11" minlength="11">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="firma_tipi">Firma Tipi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-building"></i>
                                    </span>
                                    <select name="firma_tipi" id="firma_tipi" class="form-control form-control-sm">
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Müşteri">Müşteri</option>
                                        <option value="Tedarikçi">Tedarikçi</option>
                                        <option value="Çözüm Ortağı">Çözüm Ortağı</option>
                                    </select>
                                </div>
                            </div>
                            {{-- ================================= --}}

                            <div class="col-md-3">
                                <label for="">İl</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-city"></i></span>
                                    <select name="il" id="firma_il" class="form-control form-control-sm"
                                        onchange="firma_ilceListele()">
                                        <option value="">İl Seçin</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ilce">İlçe</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-tree-city"></i></span>
                                    <select name="ilce" id="firma_ilce" class="form-control form-control-sm">
                                        <option value="">İlçe Seçin</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="web_adres">Web Adresi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-globe"></i></span>
                                    <input type="text" name="web_adres" id="web_adres"
                                        class="form-control form-control-sm"
                                        oninput="this.value = this.value.toLowerCase()">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="firma_durumu">Firma Durumu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-building"></i>
                                    </span>
                                    <select name="firma_durumu" id="firma_durumu"
                                        class="form-control form-control-sm">
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Olumlu">Olumlu</option>
                                        <option value="Olumsuz">Olumsuz</option>
                                        <option value="Düşünüyor">Düşünüyor</option>
                                        <option value="Standart Kayıt">Standart Kayıt</option>
                                        <option value="Ziyaret Bekliyor">Ziyaret Bekliyor</option>
                                        <option value="Aranacak">Aranacak</option>
                                        <option value="Kara Liste">Kara Liste</option>
                                        <option value="Sözleşme Yapıldı">Sözleşme Yapıldı</option>
                                        <option value="Kaybedilen">Kaybedilen</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-footer"
                            style="display: flex;  gap:20px; text-align: center; justify-content: end; ">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table id="example2" class="table table-bordered table-striped" style="width:100%;  ">
                <thead>
                    <tr>
                        <th style="color: white">Firma No</th>
                        <th style="color: white">Firma Ünvan</th>
                        <th style="color: white; text-align: center">Sektör</th>
                        <th style="color: white; text-align: center">Yetkili Kişi</th>
                        <th style="color: white; text-align: center">Telefon</th>
                        <th style="color: white; text-align: center">E-Posta</th>
                        <th style="color: white; text-align: center">Müşteri Temsilcisi</th>
                        <th style="color: white; text-align: center">Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cariler as $cariitem)
                        <tr>
                            <th>{{$cariitem->firma_no_text}}-{{$cariitem->firma_no}}</th>
                            <td><a style="color:inherit"
                                    href="{{ route('cariler.show', ['cariler' => $cariitem->id]) }}">{{ $cariitem->firma_unvan }}
                                </a> </td>
                            <td style="text-align: center">{{ $cariitem->firma_sektor }}</td>
                            <td style="text-align: center">{{ $cariitem->yetkili_kisi }}</td>
                            <td style="text-align: center">{{ $cariitem->yetkili_kisi_tel }}</td>
                            <td style="text-align: center">{{ $cariitem->eposta }}</td>
                            <td style="text-align: center">{{ $cariitem->user->ad_soyad }}</td>

                            <td class="text-right">
                                <div class="databutton ">
                                    <div class="d-flex align-items-center fs-6"
                                        style="justify-content: space-evenly; ">
                                        @include('admin.contents.cariler.aramalar.cari-aramalar')
                                        <a href="{{ route('cariler.show', ['cariler' => $cariitem->id]) }}"
                                            class=" btn btn-link p-0 m-0 ">
                                            <i style="color:#293445;  "
                                                class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                        </a>
                                        <button class="open-modal-btn" data-bs-toggle="modal"
                                            data-bs-target="#dokumanModal-{{ $cariitem->id }}">
                                            <i style="color:#293445" class="fa-solid fa-file-pdf fs-6"></i>
                                        </button>
                                        @include('admin.contents.cariler.dokuman.cari-dokuman')
                                        <button class=" open-modal-btn" data-bs-toggle="modal"
                                            data-bs-target="#aramalarModal-{{ $cariitem->id }}">
                                            <i style="color:rgb(88, 134, 88)"
                                                class="fa-solid fa-square-phone-flip fs-6"></i>
                                        </button>

                                        <button class="" data-bs-toggle="modal"
                                            data-bs-target="#carilerupdateModal-{{ $cariitem->id }}">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </button>
                                        @include('admin.contents.cariler.cariler-update')

                                        <form action="{{ route('cariler.destroy', ['cariler' => $cariitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn  p-0 m-0 show_confirm ">
                                                <i style="color: rgb(180, 68, 34)"
                                                    class="fa-solid fa-trash-can fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="d-flex justify-content-end" style="float: right; margin-top: 20px; ">
                {{ $cariler->appends(['entries' => $perPage])->links() }}
            </div>
        </div>
    </div>






</div>

<script src="{{ asset('custom/customjs/city.js') }}"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Sayfa başına gösterilecek giriş sayısı seçim menüsü
        const entriesForm = document.getElementById("entriesForm");
        const entriesSelect = entriesForm.querySelector("select[name='entries']");

        // Seçim değiştirildiğinde form gönderiliyor
        entriesSelect.addEventListener("change", function() {
            entriesForm.submit();
        });
    });
</script>


@include('session.session')



{{-- SEARCHHHH  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function vknSorgula() {
        let vkn = document.getElementById('vergi_no').value.trim();

        if (vkn.length === 10 || vkn.length === 11) {
            fetch(`/vkn-check?vergi_no=${vkn}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Gelen JSON:", data); // Gelen JSON'u konsola yazdır

                    // JSON içindeki ilk öğeyi alıyoruz
                    if (data.length > 0) {
                        let firmaUnvan = data[0].title; // İlk öğenin "title" alanını alıyoruz

                        if (firmaUnvan) {
                            document.getElementById('firma_unvan').value =
                                firmaUnvan; // Firma unvanını inputa yazıyoruz
                        } else {
                            alert("Firma bilgisi bulunamadı!");
                        }
                    } else {
                        alert("Geçerli firma bilgisi bulunamadı!");
                    }
                })
                .catch(error => console.error("Hata:", error));
        } else {
            alert("Lütfen geçerli bir VKN girin (10 veya 11 hane).");
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('carilersearch') }}',
                    method: 'GET',
                    data: {
                        carilersearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('carilersearch') }}',
                    method: 'GET',
                    data: {
                        carilersearch: searchValue
                    }, // Arama değeri
                    success: function(response) {
                        // Sadece tbody kısmını güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            }
        });
    });
</script>
@endsection
