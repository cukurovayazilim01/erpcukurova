<!-- Modal -->
<div class="modal fade" id="carilerupdateModal-{{ $cariitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('cariler.update', ['cariler' => $cariitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{ $cariitem->firma_unvan }} GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-8" style="border-right: 1px solid black; padding: 1%; ">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firma_unvan">Firma Ünvanı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="firma_unvan" id="firma_unvan"
                                        class="form-control form-control-sm" required
                                        value="{{ $cariitem->firma_unvan }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ticari_unvan">Ticari Ünvanı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="ticari_unvan" id="ticari_unvan"
                                        class="form-control form-control-sm" required
                                        value="{{ $cariitem->ticari_unvan }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="firma_sektor">Firma Sektörü<code>*</code></label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="firma_sektor" id="firma_sektor" class="form-select form-select-sm "
                                        required>
                                        <option value="Bilişim"
                                            {{ $cariitem->firma_sektor == 'Bilişim' ? 'selected' : '' }}>Bilişim
                                        </option>
                                        <option value="Gıda"
                                            {{ $cariitem->firma_sektor == 'Gıda' ? 'selected' : '' }}>
                                            Gıda
                                        </option>
                                        <option value="Sağlık"
                                            {{ $cariitem->firma_sektor == 'Sağlık' ? 'selected' : '' }}>
                                            Sağlık
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="is_tel">İş Telefonu</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="number" name="is_tel" id="is_tel"
                                        class="form-control form-control-sm no-zero" required value="{{ $cariitem->is_tel }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="eposta">E-Posta</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="eposta" id="eposta"
                                        class="form-control form-control-sm" required value="{{ $cariitem->eposta }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="firma_turu">Firma Türü</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-folder"></i>
                                    </span>
                                    <select name="firma_turu" id="firma_turu" class="form-select form-select-sm">
                                        <option value="Şahıs" {{ $cariitem->firma_turu == 'Şahıs' ? 'selected' : '' }}>
                                            Şahıs
                                        </option>
                                        <option value="Tüzel"
                                            {{ $cariitem->firma_turu == 'Tüzel' ? 'selected' : '' }}>
                                            Tüzel
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="yetkili_kisi">Yetkili Kişi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="yetkili_kisi" id="yetkili_kisi"
                                        class="form-control form-control-sm" required
                                        value="{{ $cariitem->yetkili_kisi }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="yetkili_kisi_tel">Yetkili Kişi Telefon</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                    <input type="number" name="yetkili_kisi_tel" id="yetkili_kisi_tel"
                                        class="form-control form-control-sm no-zero" required
                                        value="{{ $cariitem->yetkili_kisi_tel }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                    <select name="musteri_temsilcisi" id="musteri_temsilcisi"
                                        class="form-select form-select-sm" required>
                                        <option value="">Müşteri Temsilcisi Seçiniz</option>
                                        @foreach ($user as $usercariitem)
                                            <option value="{{ $usercariitem->ad_soyad }}"
                                                @if (isset($cariitem) && $cariitem->musteri_temsilcisi == $usercariitem->ad_soyad) selected @endif>
                                                {{ $usercariitem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="adres">Adresi</label>
                                    <textarea name="adres" id="adres" cols="20" rows="2" class="form-control form-control-sm ">{{ $cariitem->adres }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="aciklama">Açıklama</label>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm ">{{ $cariitem->aciklama }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 1%;">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="vergi_no">Vergi No</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-check"></i>
                                </span>
                                    <input type="text" name="vergi_no" id="vergi_no" required inputmode="numeric" maxlength="11" minlength="11"
                                        class="form-control form-control-sm input-mask" value="{{ $cariitem->vergi_no }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="vergi_no">Vergi Dairesi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-folder-minus"></i>
                                </span>
                                    <input type="text" name="vergi_dairesi" id="vergi_dairesi"
                                        class="form-control form-control-sm" value="{{ $cariitem->vergi_dairesi }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tc_kimlik">T C Kimlik No</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-address-card"></i>
                                    </span>
                                    <input type="number" name="tc_kimlik" id="tc_kimlik" inputmode="numeric" maxlength="11" minlength="11"
                                        class="form-control form-control-sm input-mask" value="{{ $cariitem->tc_kimlik }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="firma_tipi">Firma Tipi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-building"></i>
                                    </span>
                                    <select name="firma_tipi" id="firma_tipi" class="form-select form-select-sm">
                                        <option value="Müşteri"
                                            {{ $cariitem->firma_tipi == 'Müşteri' ? 'selected' : '' }}>Müşteri
                                        </option>
                                        <option value="Tedarikçi"
                                            {{ $cariitem->firma_tipi == 'Tedarikçi' ? 'selected' : '' }}>Tedarikçi
                                        </option>
                                        <option value="Çözüm Ortağı"
                                        {{ $cariitem->firma_tipi == 'Çözüm Ortağı' ? 'selected' : '' }}>Çözüm Ortağı
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="il">İl</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-city"></i>
                                    </span>
                                    <select name="il" id="firma_il" class="form-select form-select-sm" required onchange="firma_ilceListele()" >
                                        <option value="{{ $cariitem->il }}" {{ old('il', $cariitem->il) == $cariitem->il ? 'selected' : '' }}>
                                            {{ $cariitem->il }}
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="ilce">İlçe</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-sharp fa-solid fa-city"></i>
                                    </span>
                                    <select name="ilce" id="firma_ilce" class="form-select form-select-sm" required>
                                        <option value="{{ $cariitem->ilce }}" {{ old('ilce', $cariitem->ilce) == $cariitem->ilce ? 'selected' : '' }}>
                                            {{ $cariitem->ilce }}
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <label for="web_adres">Web Adresi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-globe"></i>
                                    </span>
                                    <input type="text" name="web_adres" id="web_adres"
                                        class="form-control form-control-sm" value="{{ $cariitem->web_adres }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="firma_durumu">Firma Durumu</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="firma_durumu" id="firma_durumu"
                                        class="form-select form-select-sm">
                                        <option value="Olumlu"
                                            {{ $cariitem->firma_durumu == 'Olumlu' ? 'selected' : '' }}>Olumlu
                                        </option>
                                        <option value="Olumsuz"
                                            {{ $cariitem->firma_durumu == 'Olumsuz' ? 'selected' : '' }}>Olumsuz
                                        </option>
                                        <option value="Düşünüyor"
                                            {{ $cariitem->firma_durumu == 'Düşünüyor' ? 'selected' : '' }}>Düşünüyor
                                        </option>
                                        <option value="Standart Kayıt"
                                            {{ $cariitem->firma_durumu == 'Standart Kayıt' ? 'selected' : '' }}>
                                            Standart Kayıt
                                        </option>
                                        <option value="Ziyaret Bekliyor"
                                            {{ $cariitem->firma_durumu == 'Ziyaret Bekliyor' ? 'selected' : '' }}>
                                            Ziyaret Bekliyor
                                        </option>
                                        <option value="Aranacak"
                                            {{ $cariitem->firma_durumu == 'Aranacak' ? 'selected' : '' }}>Aranacak
                                        </option>
                                        <option value="Kara Liste"
                                            {{ $cariitem->firma_durumu == 'Kara Liste' ? 'selected' : '' }}>Kara Liste
                                        </option>
                                        <option value="Sözleşme Yapıldı"
                                            {{ $cariitem->firma_durumu == 'Sözleşme Yapıldı' ? 'selected' : '' }}>
                                            Sözleşme Yapıldı
                                        </option>
                                        <option value="Kaybedilen"
                                            {{ $cariitem->firma_durumu == 'Kaybedilen' ? 'selected' : '' }}>Kaybedilen
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn btn-outline-success btn-sm ">Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>
