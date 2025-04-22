<!-- Modal -->
<div class="modal fade" id="isotakipupdateModal-{{ $isotakipitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('isotakipp.update', ['isotakipp' => $isotakipitem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{ $isotakipitem->firmaadi->firma_unvan }}-{{$isotakipitem->hizmet_adi}}  GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            {{-- <div class="col-md-3 select2-sm">
                                <label for="cari_id_3">Firma Ünvanı</label>

                                <select name="cari_id" id="cari_id_3_3" required
                                    style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                    <!-- Dinamik veriler buraya yüklenecek -->
                                </select>
                            </div> --}}
                            <div class="col-md-3">
                                <label for="cari_id">Firma</label>
                                <div class="input-group mb-2" style="display: flex; align-items: center;">
                                    <span class="icon" >
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="cari_id" id="cari_unvan" class="form-control form-control-sm"
                                           value="{{ $isotakipitem->firmaadi->firma_unvan }}" readonly>
                                    <input type="hidden" name="cari_id" value="{{ $isotakipitem->firmaadi->id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ticari_unvan">Ticari Ünvanı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="ticari_unvan" id="ticari_unvan"
                                        class="form-control form-control-sm" value="{{ $isotakipitem->firmaadi->ticari_unvan }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                        class="form-control form-control-sm" value="{{ $isotakipitem->musteri_temsilcisi }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="sehir">Şehir</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-city"></i>
                                    </span>
                                    <input type="text" name="il" id="sehir"
                                        class="form-control form-control-sm"  value="{{ $isotakipitem->il }}" readonly required>
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
                                        @foreach ($user as $useritem)
                                            <option value="{{ $useritem->id }}"
                                                {{ old('satis_temsilcisi', $isotakipitem->satis_temsilcisi ?? '') == $useritem->id ? 'selected' : '' }}>
                                                {{ $useritem->ad_soyad }}
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
                                        class="form-control form-control-sm" value="{{ $isotakipitem->basvuru_tarihi }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="belge_tarihi">Belge Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="belge_tarihi" id="belge_tarihi"
                                        class="form-control form-control-sm" value="{{ $isotakipitem->belge_tarihi }}" required>
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
                                        style="pointer-events: none; cursor: not-allowed" value="{{ $isotakipitem->belge_bitis_tarihi }}"
                                        onkeydown="return false;" required readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ara_denetim_tarihi">Ara Denetim Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="ara_denetim_tarihi" id="ara_denetim_tarihi" value="{{ $isotakipitem->ara_denetim_tarihi }}"
                                        class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed"
                                        onkeydown="return false;" readonly required>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label for="basvuru_referans_no">Başvuru Ref. No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="basvuru_referans_no" id="basvuru_referans_no" value="{{ $isotakipitem->basvuru_referans_no }}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="akreditasyon_kurulusu">Akreditasyon Kuruluşu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="akreditasyon_kurulusu" id="akreditasyon_kurulusu" value="{{ $isotakipitem->akreditasyon_kurulusu }}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="belgelendirme_kurulusu">Belgelendirme Kuruluşu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="belgelendirme_kurulusu" value="{{ $isotakipitem->belgelendirme_kurulusu }}"
                                        id="belgelendirme_kurulusu" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="kapsam">Kapsam</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="kapsam" id="kapsam" value="{{ $isotakipitem->kapsam }}"
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
                                        <option value="Aktif"
                                            {{ $isotakipitem->yenileme_durumu == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Pasif"
                                            {{ $isotakipitem->yenileme_durumu == 'Pasif' ? 'selected' : '' }}>
                                            Pasif
                                        </option>
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
                                        placeholder="Kalite Yönetim Sistemi" class="form-control form-control-sm"  value="{{ $isotakipitem->hizmet_turu }}"
                                         readonly required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hizmet_adi">Hizmet Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="hizmet_adi" id="hizmet_adi" class="form-select form-select-sm" required>
                                        <option value="">Hizmet Seçin</option>
                                        @php
                                            $hizmetler = [
                                                "Danışmanlık Hizmet Bedeli",
                                                "SEDEX Belgelendirme",
                                                "CE Belgelendirme Teknik Dosya Danışmanlık Hizmeti",
                                                "TSE Ürün Belgelendirme Danışmanlık Hizmeti",
                                                "TSE Hizmet Yeri Belgelendirme Danışmanlık Hizmeti",
                                                "ISO 9001:2015 Kalite Yonetim Sistem Belgelendirme Hizmeti",
                                                "ISO 9001:2015 Kalite Yonetim Sistem Belge Yenileme Hizmeti",
                                                "ISO 14001:2015 Çevre Yönetim Sistem Belgelendirme Hizmeti",
                                                "ISO 14001:2015 Çevre Yönetim Sistem Belge Yenileme Hizmeti",
                                                "ISO 45001:2018 İş Güvenliği Yönetim Sistemi Belgelendirme Hizmeti",
                                                "ISO 45001:2018 İş Güvenliği Yönetim Sistem Belge Yenileme Hizmeti",
                                                "ISO 22000:2018 Gıda Güvenlik Sistem Belgelendirme Hizmeti",
                                                "ISO 22000:2018 Gıda Güvenlik Sistem Belge Yenileme Hizmeti",
                                                "ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Belgelendirme Hizmeti",
                                                "ISO/IEC 27001, Bilgi Güvenliği Yönetimi Sistemi Yenileme Hizmeti",
                                                "ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Hizmeti",
                                                "ISO 10002:2018 Müşteri Memnuniyeti Yönetim Sistemi Belgelendirme Yenileme Hizmeti",
                                                "ISO 22716 Gmp Belgelendirme Hizmeti",
                                                "ISO 22716 GMP Belgelendirme Yıllık Yenileme Hizmeti",
                                                "ISO 50001:2011 Enerji Yönetim Sistem Belgelendirme Hizmeti",
                                                "ISO 13485 13485:2016 Tıbbi Cihazlar Kalite Yönetim Sistemi",
                                                "ISO 3834-2 Kaynaklı İmalat Yönetim Sistemi",
                                                "ISO 22301:2012 İş Sürekliliği Yönetim Sistemi Standardı",
                                                "ISO 20000-1:2018 Bilgi Teknolojisi Yönetim Sistemi Belgesi",
                                                "Helal 22 Belgelendirme Hizmet Bedeli",
                                                "ISO 9001:2015 KALİTE YÖNETİM SİSTEM DANIŞMANLIK HİZMETİ",
                                                "ISO 45001:2018 İŞ GÜVENLİĞİ YÖNETİM SİSTEM DANIŞMANLIĞI",
                                                "ISO/IEC 17025",
                                                "KOŞER",
                                                "ISO 18001:2007 İş Güvenliği Yönetim Sistem Belgesi",
                                                "ISO 45001:2018 İş Sağlığı ve Güvenliği Yönetim Sistemi Dokümantasyon Eğitimi",
                                                "GDP İyi Dağıtım Uygulamaları"
                                            ];
                                        @endphp

                                        @foreach ($hizmetler as $hizmet)
                                            <option value="{{ $hizmet }}"
                                                {{ old('hizmet', $isotakipitem->hizmet_adi ?? '') == $hizmet ? 'selected' : '' }}>
                                                {{ $hizmet }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="belge">Belgeler</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="file" name="belge" id="belge" class="form-control form-control-sm" value="{{ $isotakipitem->belge }}">

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-success btn-sm ">Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>



