@extends('admin.layouts.app')
@section('title')
Toplu MAİL
@endsection
@section('contents')
@section('topheader')
Toplu MAİL
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#toplumailmodal"><i class="fa-solid fa-plus"></i>Toplu MAİL Oluştur</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="toplumailmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('toplumail.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Toplu MAİL Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="konu">Konu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="text" name="konu" id="konu"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="firma_sektor">Firma Sektörü</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="firma_sektor" id="firma_sektor" class="form-select form-select-sm"
                                            required>
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
                                <div class="col-md-12">
                                    <label for="mesaj">Mesaj</label>
                                        <textarea name="mesaj" id="mesaj" cols="20" rows="2" class="form-control form-control-sm ckeditor"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button"  class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit" id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Tarih</th>
                        <th>Firma Sektörü</th>
                        <th>Konu</th>
                        <th>Mesaj</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($toplumail as $sn => $toplumailitem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                           <td>{{$toplumailitem->islem_tarihi}}</td>
                           <td>{{$toplumailitem->firma_sektor}}</td>
                           <td>{{$toplumailitem->konu}}</td>
                           <td>{{$toplumailitem->mesaj}}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('session.session')
@endsection
