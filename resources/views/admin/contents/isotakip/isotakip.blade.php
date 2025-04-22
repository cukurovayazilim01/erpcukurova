@extends('admin.layouts.app')
@section('title')
    ISO TAKİP
@endsection
@section('contents')
@section('topheader')
    ISO TAKİP
@endsection

<style>
    .error {
        border: 2px solid red;
    }

    .success {
        border: 2px solid green;
    }

    .error-message {
        color: red;
        font-size: 12px;
    }
</style>
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row align-items-center g-3">
            <!-- Entries Dropdown -->
            <div class="col-md-1 col-1 col-lg-1">
                <form method="GET" action="{{ route('isotakipp.index') }}" id="entriesForm">
                    <select class="form-select form-select-sm" name="entries"
                        onchange="document.getElementById('entriesForm').submit();">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>

            <!-- Filtrele Button -->
            <div class="col-md-2 col-6 text-start">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#isotakipfilmodal" style="border-radius: 3px;">
                    Filtrele
                </button>
            </div>
            <!-- CSS: Butonlar için stil -->
            <style>
                .table-buttons {
                    text-align: center;
                }

                .table-buttons button {
                    font-size: 11px;
                    border-radius: 5px;
                }

                /* İkon ve butonları hizalama */
                .table-buttons i {
                    margin-right: 8px;
                }
            </style>

            <!-- Yeni Ekle and Action Buttons -->
            <div class="col-md-9 text-end" style="display: flex; justify-content: flex-end  ">
                <div class="table-buttons">
                    <button class="btn btn-primary" id="copyBtn"><i class="fa fa-copy"></i> </button>
                    <button class="btn btn-success" id="excelBtn"><i class="fa fa-file-excel"></i> </button>
                    <button class="btn btn-danger" id="pdfBtn"><i class="fa fa-file-pdf"></i> </button>
                    <button class="btn btn-warning" id="printBtn"><i class="fa fa-print"></i> </button>
                    <!-- Yeni Ekle Button -->
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary px-5 ms-2" style="margin-left: 10px"
                    data-bs-toggle="modal" data-bs-target="#isotakipmodal">
                    <i class="fa-solid fa-plus"></i> Yeni Ekle
                </button>

            </div>

            <style>
                .table-buttons {
                    justify-content: flex-end;
                    /* Butonları sağa yaslar */
                    gap: 10px;
                    /* Butonlar arasında boşluk bırakır */
                    align-items: center;
                    /* Yükseklik hizalaması için */
                }

                .table-buttons button {
                    font-size: 11px;
                    /* Buton yazı boyutunu ayarlama */
                }
            </style>

        </div>
    </div>




    <!--FİLTRELEME Modal -->
    <div class="modal fade" id="isotakipfilmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('isotakipfiltre.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">ISO Filtreleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id_3">Firma</label>
                                    <select name="cari_id_3" id="cari_id_3_1"
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="satis_temsilcisi" id="satis_temsilcisi"
                                            class="form-select form-select-sm">
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <label for="sehir">Şehir</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-city"></i>
                                        </span>
                                        <input type="text" name="sehir" id=""
                                            class="form-control form-control-sm">
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <label for="il">İl</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-city"></i>
                                        </span>
                                        <select name="sehir" id="firma_il" class="form-select form-select-sm"
                                             onchange="firma_ilceListele()">
                                            <option value="">İl Seçin</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="akreditasyon_kurulusu">Akreditasyon Kuruluşu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="akreditasyon_kurulusu" id="akreditasyon_kurulusu"
                                            class="form-select form-select-sm" >
                                            <option value="">Lütfen Seçiniz</option>
                                            <option value="TÜRKAK">TÜRKAK</option>
                                            <option value="IAS">IAS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="akreditasyon_kurulusu">Hizmet Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="hizmet_adi" class="form-select form-select-sm">

                                            <option value="">Hizmet Seçin</option>
                                            <option value="Danışmanlık Hizmet Bedeli">Danışmanlık Hizmet Bedeli
                                            </option>
                                            <option value="SEDEX Belgelendirme">SEDEX Belgelendirme</option>
                                            <option value="CE Belgelendirme Teknik Dosya Danışmanlık Hizmeti">CE
                                                Belgelendirme Teknik Dosya Danışmanlık Hizmeti</option>
                                            <option value="TSE Ürün Belgelendirme Danışmanlık Hizmeti">TSE Ürün
                                                Belgelendirme Danışmanlık Hizmeti</option>
                                            <option value="TSE Hizmet Yeri Belgelendirme Danışmanlık Hizmeti">TSE
                                                Hizmet Yeri Belgelendirme Danışmanlık Hizmeti</option>
                                            <option value="ISO 9001:2015 Kalite Yonetim Sistem Belgelendirme Hizmeti">
                                                ISO 9001:2015 Kalite Yonetim Sistem Belgelendirme Hizmeti</option>
                                            <option value="ISO 9001:2015 Kalite Yonetim Sistem Belge Yenileme Hizmeti">
                                                ISO 9001:2015 Kalite Yonetim Sistem Belge Yenileme Hizmeti</option>
                                            <option value="ISO 14001:2015 Çevre Yönetim Sistem Belgelendirme Hizmeti">
                                                ISO 14001:2015 Çevre Yönetim Sistem Belgelendirme Hizmeti</option>
                                            <option value="ISO 14001:2015 Çevre Yönetim Sistem Belge Yenileme Hizmeti">
                                                ISO 14001:2015 Çevre Yönetim Sistem Belge Yenileme Hizmeti</option>
                                            <option
                                                value="ISO 45001:2018 İş Güvenliği Yönetim Sistemi Belgelendirme Hizmeti">
                                                ISO 45001:2018 İş Güvenliği Yönetim Sistemi Belgelendirme Hizmeti
                                            </option>
                                            <option
                                                value="ISO 45001:2018 İş Güvenliği Yönetim Sistem Belge Yenileme Hizmeti">
                                                ISO 45001:2018 İş Güvenliği Yönetim Sistem Belge Yenileme Hizmeti
                                            </option>
                                            <option value="ISO 22000:2018 Gıda Güvenlik Sistem Belgelendirme Hizmeti">
                                                ISO 22000:2018 Gıda Güvenlik Sistem Belgelendirme Hizmeti</option>
                                            <option value="ISO 22000:2018 Gıda Güvenlik Sistem Belge Yenileme Hizmeti">
                                                ISO 22000:2018 Gıda Güvenlik Sistem Belge Yenileme Hizmeti</option>
                                            <option
                                                value="ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Belgelendirme Hizmeti">
                                                ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Belgelendirme Hizmeti
                                            </option>
                                            <option
                                                value="ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Yenileme Hizmeti">
                                                ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Yenileme Hizmeti
                                            </option>
                                            <option
                                                value="ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Hizmeti">
                                                ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Hizmeti
                                            </option>
                                            <option
                                                value="ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Yenileme Hizmeti">
                                                ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme
                                                Yenileme Hizmeti</option>
                                            <option value="ISO 22716 Gmp Belgelendirme Hizmeti">ISO 22716 Gmp
                                                Belgelendirme Hizmeti</option>
                                            <option value="ISO 22716 GMP Belgelendirme Yıllık Yenileme Hizmeti">ISO
                                                22716 GMP Belgelendirme Yıllık Yenileme Hizmeti</option>
                                            <option value="ISO 50001:2011 Enerji Yönetim Sistem Belgelendirme Hizmeti">
                                                ISO 50001:2011 Enerji Yönetim Sistem Belgelendirme Hizmeti</option>
                                            <option value="ISO 13485 13485:2016 Tıbbi Cihazlar Kalite Yönetim Sistemi">
                                                ISO 13485 13485:2016 Tıbbi Cihazlar Kalite Yönetim Sistemi</option>
                                            <option value="ISO 3834-2 Kaynaklı İmalat Yönetim Sistemi">ISO 3834-2
                                                Kaynaklı İmalat Yönetim Sistemi</option>
                                            <option value="ISO 22301:2012 İş Sürekliliği Yönetim Sistemi Standardı">ISO
                                                22301:2012 İş Sürekliliği Yönetim Sistemi Standardı</option>
                                            <option value="ISO 20000-1:2018 Bilgi Teknolojisi Yönetim Sistemi Belgesi">
                                                ISO 20000-1:2018 Bilgi Teknolojisi Yönetim Sistemi Belgesi</option>
                                            <option value="Helal 22 Belgelendirme Hizmet Bedeli">Helal 22 Belgelendirme
                                                Hizmet Bedeli</option>
                                            <option value="ISO 9001:2015 KALİTE YÖNETİM SİSTEM DANIŞMANLIK HİZMETİ">ISO
                                                9001:2015 KALİTE YÖNETİM SİSTEM DANIŞMANLIK HİZMETİ</option>
                                            <option value="ISO 45001:2018 İŞ GÜVENLİĞİ YÖNETİM SİSTEM DANIŞMANLIĞI">ISO
                                                45001:2018 İŞ GÜVENLİĞİ YÖNETİM SİSTEM DANIŞMANLIĞI</option>
                                            <option value="ISO/IEC 17025">ISO/IEC 17025</option>
                                            <option value="KOŞER">KOŞER</option>
                                            <option value="ISO 18001:2007 İş Güvenliği Yönetim Sistem Belgesi">ISO
                                                18001:2007 İş Güvenliği Yönetim Sistem Belgesi</option>
                                            <option
                                                value="ISO 45001:2018 İş Sağlığı ve Güvenliği Yönetim Sistemi Dokümantasyon Eğitimi">
                                                ISO 45001:2018 İş Sağlığı ve Güvenliği Yönetim Sistemi Dokümantasyon
                                                Eğitimi</option>
                                            <option value="GDP İyi Dağıtım Uygulamaları">GDP İyi Dağıtım Uygulamaları
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="belgelendirme_kurulusu">Belgelendirme Kuruluşu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="belgelendirme_kurulusu" id="belgelendirme_kurulusu"
                                            class="form-select form-select-sm" >
                                            <option value="">Lütfen Seçiniz</option>
                                            <option value="DSR BELGELENDİRME">DSR BELGELENDİRME</option>
                                            <option value="PCA BELGELENDİRME">PCA BELGELENDİRME</option>
                                            <option value="UDEM BELGELENDİRME">UDEM BELGELENDİRME</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ilk_tarih">Başvuru İlk Tarih</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Başvuru Son Tarih</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="son_tarih" id="son_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="isotakipmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('isotakipp.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">ISO Ekleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row">
                                <div class="col-md-3 select2-sm">
                                    <label for="cari_id_3">Firma Ünvanı</label>

                                    <select name="cari_id" id="cari_id_3_3" required
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="ticari_unvan">Ticari Ünvanı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="ticari_unvan" id="ticari_unvan"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="sehir">Şehir</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-city"></i>
                                        </span>
                                        <input type="text" name="il" id="sehir"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="satis_temsilcisi" id="satis_temsilcisi"
                                            class="form-select form-select-sm" required>
                                            <option value="">Satış Temsilcisi Seçiniz</option>
                                            @foreach ($user as $isotakipitem)
                                                <option value="{{ $isotakipitem->id }}">{{ $isotakipitem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <label for="basvuru_tarihi">Başvuru Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="basvuru_tarihi" id="basvuru_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="belge_tarihi">Belge Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="belge_tarihi" id="belge_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="belge_bitis_tarihi">Belge Bitiş Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="belge_bitis_tarihi" id="belge_bitis_tarihi"
                                            class="form-control form-control-sm"
                                            style="pointer-events: none; cursor: not-allowed"
                                            onkeydown="return false;" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ara_denetim_tarihi">Ara Denetim Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="ara_denetim_tarihi" id="ara_denetim_tarihi"
                                            class="form-control form-control-sm"
                                            style="pointer-events: none; cursor: not-allowed"
                                            onkeydown="return false;" readonly required>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <label for="basvuru_referans_no">Başvuru Ref. No</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="basvuru_referans_no" id="basvuru_referans_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="akreditasyon_kurulusu">Akreditasyon Kuruluşu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="akreditasyon_kurulusu" id="akreditasyon_kurulusu"
                                            class="form-select form-select-sm" required>
                                            <option value="">Lütfen Seçiniz</option>
                                            <option value="TÜRKAK">TÜRKAK</option>
                                            <option value="IAS">IAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="belgelendirme_kurulusu">Belgelendirme Kuruluşu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="belgelendirme_kurulusu" id="belgelendirme_kurulusu"
                                            class="form-select form-select-sm" required>
                                            <option value="">Lütfen Seçiniz</option>
                                            <option value="DSR BELGELENDİRME">DSR BELGELENDİRME</option>
                                            <option value="PCA BELGELENDİRME">PCA BELGELENDİRME</option>
                                            <option value="UDEM BELGELENDİRME">UDEM BELGELENDİRME</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="kapsam">Kapsam</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="kapsam" id="kapsam"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="iso_durum">Durum</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="yenileme_durumu" id="yenileme_durumu"
                                            class="form-select form-select-sm" required>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="hizmet_turu">Hizmet Türü</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="hizmet_turu" id="hizmet_turu"
                                            placeholder="Kalite Yönetim Sistemi" class="form-control form-control-sm"
                                            value="Kalite Yönetim Sistemi" readonly required>
                                    </div>
                                </div>
                                <div id="hizmetlerContainer">
                                    <div class="hizmet-item d-flex align-items-center">
                                        <div class="col-md-10">
                                            <label for="hizmet_adi">Hizmet Adı</label>
                                            <div class="input-group mb-2">
                                                <span class="input-group-text">
                                                    <i class="fa fa-cogs"></i>
                                                </span>
                                                <select name="inputs[0][hizmet_adi]"
                                                    class="form-select form-select-sm" required>
                                                    <option value="">Hizmet Seçin</option>
                                                    <option value="Danışmanlık Hizmet Bedeli">Danışmanlık Hizmet Bedeli
                                                    </option>
                                                    <option value="SEDEX Belgelendirme">SEDEX Belgelendirme</option>
                                                    <option value="CE Belgelendirme Teknik Dosya Danışmanlık Hizmeti">
                                                        CE
                                                        Belgelendirme Teknik Dosya Danışmanlık Hizmeti</option>
                                                    <option value="TSE Ürün Belgelendirme Danışmanlık Hizmeti">TSE Ürün
                                                        Belgelendirme Danışmanlık Hizmeti</option>
                                                    <option value="TSE Hizmet Yeri Belgelendirme Danışmanlık Hizmeti">
                                                        TSE
                                                        Hizmet Yeri Belgelendirme Danışmanlık Hizmeti</option>
                                                    <option
                                                        value="ISO 9001:2015 Kalite Yonetim Sistem Belgelendirme Hizmeti">
                                                        ISO 9001:2015 Kalite Yonetim Sistem Belgelendirme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 9001:2015 Kalite Yonetim Sistem Belge Yenileme Hizmeti">
                                                        ISO 9001:2015 Kalite Yonetim Sistem Belge Yenileme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 14001:2015 Çevre Yönetim Sistem Belgelendirme Hizmeti">
                                                        ISO 14001:2015 Çevre Yönetim Sistem Belgelendirme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 14001:2015 Çevre Yönetim Sistem Belge Yenileme Hizmeti">
                                                        ISO 14001:2015 Çevre Yönetim Sistem Belge Yenileme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 45001:2018 İş Güvenliği Yönetim Sistemi Belgelendirme Hizmeti">
                                                        ISO 45001:2018 İş Güvenliği Yönetim Sistemi Belgelendirme
                                                        Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 45001:2018 İş Güvenliği Yönetim Sistem Belge Yenileme Hizmeti">
                                                        ISO 45001:2018 İş Güvenliği Yönetim Sistem Belge Yenileme
                                                        Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 22000:2018 Gıda Güvenlik Sistem Belgelendirme Hizmeti">
                                                        ISO 22000:2018 Gıda Güvenlik Sistem Belgelendirme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 22000:2018 Gıda Güvenlik Sistem Belge Yenileme Hizmeti">
                                                        ISO 22000:2018 Gıda Güvenlik Sistem Belge Yenileme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Belgelendirme Hizmeti">
                                                        ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Belgelendirme
                                                        Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Yenileme Hizmeti">
                                                        ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Yenileme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Hizmeti">
                                                        ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme
                                                        Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Yenileme Hizmeti">
                                                        ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme
                                                        Yenileme Hizmeti</option>
                                                    <option value="ISO 22716 Gmp Belgelendirme Hizmeti">ISO 22716 Gmp
                                                        Belgelendirme Hizmeti</option>
                                                    <option
                                                        value="ISO 22716 GMP Belgelendirme Yıllık Yenileme Hizmeti">ISO
                                                        22716 GMP Belgelendirme Yıllık Yenileme Hizmeti</option>
                                                    <option
                                                        value="ISO 50001:2011 Enerji Yönetim Sistem Belgelendirme Hizmeti">
                                                        ISO 50001:2011 Enerji Yönetim Sistem Belgelendirme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 13485 13485:2016 Tıbbi Cihazlar Kalite Yönetim Sistemi">
                                                        ISO 13485 13485:2016 Tıbbi Cihazlar Kalite Yönetim Sistemi
                                                    </option>
                                                    <option value="ISO 3834-2 Kaynaklı İmalat Yönetim Sistemi">ISO
                                                        3834-2
                                                        Kaynaklı İmalat Yönetim Sistemi</option>
                                                    <option
                                                        value="ISO 22301:2012 İş Sürekliliği Yönetim Sistemi Standardı">
                                                        ISO
                                                        22301:2012 İş Sürekliliği Yönetim Sistemi Standardı</option>
                                                    <option
                                                        value="ISO 20000-1:2018 Bilgi Teknolojisi Yönetim Sistemi Belgesi">
                                                        ISO 20000-1:2018 Bilgi Teknolojisi Yönetim Sistemi Belgesi
                                                    </option>
                                                    <option value="Helal 22 Belgelendirme Hizmet Bedeli">Helal 22
                                                        Belgelendirme
                                                        Hizmet Bedeli</option>
                                                    <option
                                                        value="ISO 9001:2015 KALİTE YÖNETİM SİSTEM DANIŞMANLIK HİZMETİ">
                                                        ISO
                                                        9001:2015 KALİTE YÖNETİM SİSTEM DANIŞMANLIK HİZMETİ</option>
                                                    <option
                                                        value="ISO 45001:2018 İŞ GÜVENLİĞİ YÖNETİM SİSTEM DANIŞMANLIĞI">
                                                        ISO
                                                        45001:2018 İŞ GÜVENLİĞİ YÖNETİM SİSTEM DANIŞMANLIĞI</option>
                                                    <option value="ISO/IEC 17025">ISO/IEC 17025</option>
                                                    <option value="KOŞER">KOŞER</option>
                                                    <option value="ISO 18001:2007 İş Güvenliği Yönetim Sistem Belgesi">
                                                        ISO
                                                        18001:2007 İş Güvenliği Yönetim Sistem Belgesi</option>
                                                    <option
                                                        value="ISO 45001:2018 İş Sağlığı ve Güvenliği Yönetim Sistemi Dokümantasyon Eğitimi">
                                                        ISO 45001:2018 İş Sağlığı ve Güvenliği Yönetim Sistemi
                                                        Dokümantasyon
                                                        Eğitimi</option>
                                                    <option value="GDP İyi Dağıtım Uygulamaları">GDP İyi Dağıtım
                                                        Uygulamaları
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button"
                                                class="btn btn-sm btn-danger removeRow mt-4">Sil</button>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" id="addRow"
                                                class="btn btn-sm btn-primary mt-3">Hizmet Ekle</button>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Kaydet</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">


                    <form id="searchForm" action="{{ route('isotakipsearch') }}" method="GET">
                        @csrf
                        <div class="ms-auto position-relative" style="margin-bottom: 10px">
                            <!-- Arama ikonu -->
                            <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"
                                style="color: blue;">
                                <i class="bi bi-search"></i>
                            </div>
                            <!-- Arama inputu -->
                            <input type="text" id="searchInput" class="form-control ps-5"
                                style="border: 1px solid blue; height: 38px;"
                                placeholder="Lütfen Arama Terimi Giriniz">
                        </div>
                    </form>


                </div>
                <table class="table align-middle mb-0 display " id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Referans No</th>
                            <th>Belge Tarihi</th>
                            <th>Ara Denetim Tarihi</th>
                            <th>Belge Bitiş Tarihi</th>
                            <th>Firma Ünvanı</th>
                            <th>Hizmet Adı</th>
                            <th>Akreditasyon Kuruluşu</th>
                            <th>Belge Kuruluşu</th>
                            <th>Kapsam</th>
                            <th>Müşteri Temsilcisi</th>
                            <th>Dosya</th>
                            <th>Durum</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($isotakip as $isotakipitem)
                            <tr>
                                <th>{{ $startNumber - $loop->index }}</th>
                                <td>{{ $isotakipitem->basvuru_referans_no }}</td>
                                <td>{{ $isotakipitem->belge_tarihi }}</td>
                                <td>{{ $isotakipitem->ara_denetim_tarihi }}</td>
                                <td>{{ $isotakipitem->belge_bitis_tarihi }}</td>
                                <td>{{ $isotakipitem->firmaadi->firma_unvan }}</td>
                                <td>{{ Str::limit($isotakipitem->hizmet_adi,30)  }}</td>
                                <td>{{ $isotakipitem->akreditasyon_kurulusu }}</td>
                                <td>{{ $isotakipitem->belgelendirme_kurulusu }}</td>
                                <td>{{ $isotakipitem->kapsam }}</td>
                                <td>{{ $isotakipitem->musteri_temsilcisi }}</td>
                                <td>
                                    @if ($isotakipitem->belge)
                                        @php $fileExtension = pathinfo($isotakipitem->belge, PATHINFO_EXTENSION); @endphp
                                        @if (strtolower($fileExtension) === 'pdf')
                                            <a href="{{ asset($isotakipitem->belge) }}" target="_blank"
                                                style="color: red">
                                                <i class="bi bi-file-earmark-pdf"></i> Görüntüle
                                            </a>
                                        @else
                                            <a href="{{ asset($isotakipitem->belge) }}" target="_blank">
                                                <i class="bi bi-image"></i> Görüntüle
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($isotakipitem->yenileme_durumu === 'Aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($isotakipitem->yenileme_durumu === 'Pasif')
                                        <span class="badge bg-danger"><i class="fa fa-times"></i></span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="d-flex align-items-center">
                                        <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#isotakipupdateModal-{{ $isotakipitem->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        @include('admin.contents.isotakip.isotakip-update')

                                        <form
                                            action="{{ route('isotakipp.destroy', ['isotakipp' => $isotakipitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger show_confirm">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
                        {{ $isotakip->appends(['entries' => $perPage])->links() }}
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script src="{{ asset('custom/customjs/city.js') }}"></script>

<script>
    document.getElementById("belge_tarihi").addEventListener("change", function() {
        let belgeTarihi = new Date(this.value);
        if (!isNaN(belgeTarihi.getTime())) {
            // 1 yıl ekleyerek belge bitiş tarihini belirle
            let bitisTarihi = new Date(belgeTarihi);
            bitisTarihi.setFullYear(bitisTarihi.getFullYear() + 1);
            document.getElementById("belge_bitis_tarihi").value = bitisTarihi.toISOString().split("T")[0];

            // 11 ay ekleyerek ara denetim tarihini belirle
            let araDenetimTarihi = new Date(belgeTarihi);
            araDenetimTarihi.setMonth(araDenetimTarihi.getMonth() + 11);
            document.getElementById("ara_denetim_tarihi").value = araDenetimTarihi.toISOString().split("T")[0];
        }
    });
</script>
<script>
    // Başlangıç dizini
    let rowIndex = 1;

    // Add new row
    document.getElementById("addRow").addEventListener("click", function() {
        let container = document.getElementById("hizmetlerContainer");

        let newRow = document.createElement("div");
        newRow.classList.add("hizmet-item", "d-flex", "align-items-center");

        newRow.innerHTML = `
            <div class="col-md-10">
                <div class="input-group mb-2">
                    <span class="input-group-text">
                        <i class="fa fa-cogs"></i>
                    </span>
                    <select name="inputs[${rowIndex}][hizmet_adi]" class="form-select form-select-sm" required>
                       <option value="">Hizmet Seçin</option>
                                                    <option value="Danışmanlık Hizmet Bedeli">Danışmanlık Hizmet Bedeli
                                                    </option>
                                                    <option value="SEDEX Belgelendirme">SEDEX Belgelendirme</option>
                                                    <option value="CE Belgelendirme Teknik Dosya Danışmanlık Hizmeti">CE
                                                        Belgelendirme Teknik Dosya Danışmanlık Hizmeti</option>
                                                    <option value="TSE Ürün Belgelendirme Danışmanlık Hizmeti">TSE Ürün
                                                        Belgelendirme Danışmanlık Hizmeti</option>
                                                    <option value="TSE Hizmet Yeri Belgelendirme Danışmanlık Hizmeti">TSE
                                                        Hizmet Yeri Belgelendirme Danışmanlık Hizmeti</option>
                                                    <option value="ISO 9001:2015 Kalite Yonetim Sistem Belgelendirme Hizmeti">
                                                        ISO 9001:2015 Kalite Yonetim Sistem Belgelendirme Hizmeti</option>
                                                    <option value="ISO 9001:2015 Kalite Yonetim Sistem Belge Yenileme Hizmeti">
                                                        ISO 9001:2015 Kalite Yonetim Sistem Belge Yenileme Hizmeti</option>
                                                    <option value="ISO 14001:2015 Çevre Yönetim Sistem Belgelendirme Hizmeti">
                                                        ISO 14001:2015 Çevre Yönetim Sistem Belgelendirme Hizmeti</option>
                                                    <option value="ISO 14001:2015 Çevre Yönetim Sistem Belge Yenileme Hizmeti">
                                                        ISO 14001:2015 Çevre Yönetim Sistem Belge Yenileme Hizmeti</option>
                                                    <option
                                                        value="ISO 45001:2018 İş Güvenliği Yönetim Sistemi Belgelendirme Hizmeti">
                                                        ISO 45001:2018 İş Güvenliği Yönetim Sistemi Belgelendirme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 45001:2018 İş Güvenliği Yönetim Sistem Belge Yenileme Hizmeti">
                                                        ISO 45001:2018 İş Güvenliği Yönetim Sistem Belge Yenileme Hizmeti
                                                    </option>
                                                    <option value="ISO 22000:2018 Gıda Güvenlik Sistem Belgelendirme Hizmeti">
                                                        ISO 22000:2018 Gıda Güvenlik Sistem Belgelendirme Hizmeti</option>
                                                    <option value="ISO 22000:2018 Gıda Güvenlik Sistem Belge Yenileme Hizmeti">
                                                        ISO 22000:2018 Gıda Güvenlik Sistem Belge Yenileme Hizmeti</option>
                                                    <option
                                                        value="ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Belgelendirme Hizmeti">
                                                        ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Belgelendirme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Yenileme Hizmeti">
                                                        ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Yenileme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Hizmeti">
                                                        ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Hizmeti
                                                    </option>
                                                    <option
                                                        value="ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Yenileme Hizmeti">
                                                        ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme
                                                        Yenileme Hizmeti</option>
                                                    <option value="ISO 22716 Gmp Belgelendirme Hizmeti">ISO 22716 Gmp
                                                        Belgelendirme Hizmeti</option>
                                                    <option value="ISO 22716 GMP Belgelendirme Yıllık Yenileme Hizmeti">ISO
                                                        22716 GMP Belgelendirme Yıllık Yenileme Hizmeti</option>
                                                    <option value="ISO 50001:2011 Enerji Yönetim Sistem Belgelendirme Hizmeti">
                                                        ISO 50001:2011 Enerji Yönetim Sistem Belgelendirme Hizmeti</option>
                                                    <option value="ISO 13485 13485:2016 Tıbbi Cihazlar Kalite Yönetim Sistemi">
                                                        ISO 13485 13485:2016 Tıbbi Cihazlar Kalite Yönetim Sistemi</option>
                                                    <option value="ISO 3834-2 Kaynaklı İmalat Yönetim Sistemi">ISO 3834-2
                                                        Kaynaklı İmalat Yönetim Sistemi</option>
                                                    <option value="ISO 22301:2012 İş Sürekliliği Yönetim Sistemi Standardı">ISO
                                                        22301:2012 İş Sürekliliği Yönetim Sistemi Standardı</option>
                                                    <option value="ISO 20000-1:2018 Bilgi Teknolojisi Yönetim Sistemi Belgesi">
                                                        ISO 20000-1:2018 Bilgi Teknolojisi Yönetim Sistemi Belgesi</option>
                                                    <option value="Helal 22 Belgelendirme Hizmet Bedeli">Helal 22 Belgelendirme
                                                        Hizmet Bedeli</option>
                                                    <option value="ISO 9001:2015 KALİTE YÖNETİM SİSTEM DANIŞMANLIK HİZMETİ">ISO
                                                        9001:2015 KALİTE YÖNETİM SİSTEM DANIŞMANLIK HİZMETİ</option>
                                                    <option value="ISO 45001:2018 İŞ GÜVENLİĞİ YÖNETİM SİSTEM DANIŞMANLIĞI">ISO
                                                        45001:2018 İŞ GÜVENLİĞİ YÖNETİM SİSTEM DANIŞMANLIĞI</option>
                                                    <option value="ISO/IEC 17025">ISO/IEC 17025</option>
                                                    <option value="KOŞER">KOŞER</option>
                                                    <option value="ISO 18001:2007 İş Güvenliği Yönetim Sistem Belgesi">ISO
                                                        18001:2007 İş Güvenliği Yönetim Sistem Belgesi</option>
                                                    <option
                                                        value="ISO 45001:2018 İş Sağlığı ve Güvenliği Yönetim Sistemi Dokümantasyon Eğitimi">
                                                        ISO 45001:2018 İş Sağlığı ve Güvenliği Yönetim Sistemi Dokümantasyon
                                                        Eğitimi</option>
                                                    <option value="GDP İyi Dağıtım Uygulamaları">GDP İyi Dağıtım Uygulamaları
                                                    </option>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-sm btn-danger removeRow mt-1">Sil</button>
            </div>
        `;

        container.appendChild(newRow);

        // Artırılacak olan indeks
        rowIndex++;
    });

    // Remove row
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("removeRow")) {
            e.target.closest(".hizmet-item").remove();
        }
    });
</script>



{{-- SEARCHHHH  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JavaScript: DataTable Yapılandırma -->
<script>
    $(document).ready(function() {
        var table = $("#example2").DataTable({
            responsive: true,
            lengthChange: false, // Sayfa uzunluğu değişikliğini kaldır
            autoWidth: false, // Otomatik genişlik ayarlamasını kaldır
            pageLength: 10000, // Sayfa başına gösterilecek kayıt sayısını artır (örneğin 10000)
            dom: 'frtip', // Sadece butonları gösterecek
            language: {
                url: "{{ asset('vendor/tr.json') }}" // Dil dosyasını ekleyin
            },
            ordering: false, // Sıralamayı devre dışı bırak
            buttons: [{
                    extend: 'copyHtml5',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-copy"></i> Kopyala',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i> Yazdır',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
                }
            ]
        });

        // Butonları tıklamak yerine DataTable'ın kendi butonlarını kullanacağız
        $("#copyBtn").click(function() {
            table.button('.buttons-copy').trigger();
        });

        $("#excelBtn").click(function() {
            table.button('.buttons-excel').trigger();
        });

        $("#pdfBtn").click(function() {
            table.button('.buttons-pdf').trigger();
        });

        $("#printBtn").click(function() {
            table.button('.buttons-print').trigger();
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
                    url: '{{ route('isotakipsearch') }}',
                    method: 'GET',
                    data: {
                        isotakipsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('isotakipsearch') }}',
                    method: 'GET',
                    data: {
                        isotakipsearch: searchValue
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
<script>
    $(document).ready(function() {
        $('#cari_id_3_3').on('change', function() {
            var selectedCariId = $(this).val();

            $.ajax({
                url: '/getMusteriTemsilcisi/' + selectedCariId,
                type: 'GET',
                dataType: 'json', // Gelen verinin JSON olduğunu belirtin
                success: function(data) {
                    // AJAX isteği başarılı olduğunda çalışacak kod
                    $('#musteri_temsilcisi').val(data.musteri_temsilcisi);
                    $('#tc').val(data.tc);
                    $('#ticari_unvan').val(data.ticari_unvan);
                    $('#sehir').val(data.sehir);
                },
                error: function(xhr, textStatus, errorThrown) {
                    // AJAX isteği başarısız olduğunda çalışacak kod
                    console.error('AJAX isteği başarısız: ' + textStatus);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Birinci modal için Select2
        $('#cari_id_3_1').select2({
            theme: 'bootstrap4',
            placeholder: "Firma Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%',
            ajax: {
                url: '/cari-search',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.firma_unvan
                            };
                        })
                    };
                },
                cache: true
            },
            dropdownParent: $('#isotakipfilmodal'),
            language: {
                inputTooShort: function() {
                    return "Lütfen en az 3 karakter girin.";
                },
                noResults: function() {
                    return "Sonuç bulunamadı.";
                }
            }
        });
        // Select2 açıldığında arama inputuna otomatik odaklanma
        $('#cari_id_3_1').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });

        // İkinci modal için Select2
        $('#cari_id_3_2').select2({
            theme: 'bootstrap4',
            placeholder: "Firma Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%',
            ajax: {
                url: '/cari-search',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.firma_unvan
                            };
                        })
                    };
                },
                cache: true
            },
            dropdownParent: $('#isotakipfilexcelmodal'),
            language: {
                inputTooShort: function() {
                    return "Lütfen en az 3 karakter girin.";
                },
                noResults: function() {
                    return "Sonuç bulunamadı.";
                }
            }
        });
         // Select2 açıldığında arama inputuna otomatik odaklanma
         $('#cari_id_3_2').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
        // İkinci modal için Select2
        $('#cari_id_3_3').select2({
            theme: 'bootstrap4',
            placeholder: "Firma Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%',
            ajax: {
                url: '/cari-search',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.firma_unvan
                            };
                        })
                    };
                },
                cache: true
            },
            dropdownParent: $('#isotakipmodal'),
            language: {
                inputTooShort: function() {
                    return "Lütfen en az 3 karakter girin.";
                },
                noResults: function() {
                    return "Sonuç bulunamadı.";
                }
            }
        });
         // Select2 açıldığında arama inputuna otomatik odaklanma
         $('#cari_id_3_3').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });

    });
</script>
@include('session.session')
@endsection
