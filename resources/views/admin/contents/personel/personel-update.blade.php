   <!-- Modal -->
   <div class="modal fade" id="personelupdateModal-{{ $personelitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('personell.update', ['personell' => $personelitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Personel Özlük Dosyası Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                <div class="row ">

                            <div class="col-md-3">
                                <label for="ad_soyad">Ad Soyad</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="ad_soyad" id="ad_soyad"
                                        class="form-control form-control-sm" value="{{$personelitem->ad_soyad}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="tc">TC Kimlik No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="number" name="tc" id="tc"
                                        class="form-control form-control-sm" value="{{$personelitem->tc}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="sigorta_sicil_no">Sigorta Sicil No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="number" name="sigorta_sicil_no" id="sigorta_sicil_no"
                                        class="form-control form-control-sm" value="{{$personelitem->sigorta_sicil_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="sigorta_giris_tarihi">Sigorta Giriş Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="sigorta_giris_tarihi" id="sigorta_giris_tarihi"
                                        class="form-control form-control-sm" value="{{$personelitem->sigorta_giris_tarihi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="meslek_kodu">Meslek Kodu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="number" name="meslek_kodu" id="meslek_kodu"
                                        class="form-control form-control-sm" value="{{$personelitem->meslek_kodu}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="okul">Okulu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="okul" id="okul"
                                        class="form-control form-control-sm" value="{{$personelitem->okul}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="mezuniyet">Mezuniyet</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="mezuniyet" id="mezuniyet" class="form-select form-select-sm">
                                        <option value="Lisans"  {{ $personelitem->mezuniyet == 'Lisans' ? 'selected' : '' }}>Lisans</option>
                                        <option value="Yüksek Lisans" {{ $personelitem->mezuniyet == 'Yüksek Lisans' ? 'selected' : '' }}>Yüksek Lisans</option>
                                        <option value="Ön Lisans" {{ $personelitem->mezuniyet == 'Ön Lisans' ? 'selected' : '' }}>Ön Lisans</option>
                                        <option value="Lise" {{ $personelitem->mezuniyet == 'Lise' ? 'selected' : '' }}>Lise</option>
                                        <option value="OrtaOkul" {{ $personelitem->mezuniyet == 'OrtaOkul' ? 'selected' : '' }}>OrtaOkul</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="meslegi">Mesleği</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="meslegi" id="meslegi"
                                        class="form-control form-control-sm" value="{{$personelitem->meslegi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="departman">Departman</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="departman" id="departman"
                                        class="form-control form-control-sm" value="{{$personelitem->departman}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="dogum_yeri">Doğum Yeri</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="dogum_yeri" id="dogum_yeri"
                                        class="form-control form-control-sm" value="{{$personelitem->dogum_yeri}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="dogum_tarihi">Doğum Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar"></i>
                                    </span>
                                    <input type="date" name="dogum_tarihi" id="dogum_tarihi"
                                        class="form-control form-control-sm" value="{{$personelitem->dogum_tarihi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="gsm">Cep Telefonu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                    <input type="number" name="gsm" id="gsm"
                                        class="form-control form-control-sm no-zero" value="{{$personelitem->gsm}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="mail">E-Posta</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="mail" id="mail"
                                        class="form-control form-control-sm" value="{{$personelitem->mail}}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="gorevi">Görevi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="gorevi" id="gorevi"
                                        class="form-control form-control-sm" value="{{$personelitem->gorevi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="kidem_yili">Kıdem Yılı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="number" name="kidem_yili" id="kidem_yili"
                                        class="form-control form-control-sm" value="{{$personelitem->kidem_yili}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="medeni_hali">Medeni Hali</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="medeni_hali" id="medeni_hali" class="form-select form-select-sm">
                                        <option value="Evli" {{ $personelitem->medeni_hali == 'Evli' ? 'selected' : '' }}>Evli</option>
                                        <option value="Bekar" {{ $personelitem->medeni_hali == 'Bekâr' ? 'selected' : '' }}>Bekâr</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="kan_grubu">Kan Grubu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="kan_grubu" id="kan_grubu"
                                        class="form-control form-control-sm" value="{{$personelitem->kan_grubu}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="askerlik_durumu">Askerlik Durumu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="askerlik_durumu" id="askerlik_durumu" class="form-select form-select-sm">
                                        <option value="Yapıldı" {{ $personelitem->askerlik_durumu == 'Yapıldı' ? 'selected' : '' }}>Yapıldı</option>
                                        <option value="Yapılmadı" {{ $personelitem->askerlik_durumu == 'Yapılmadı' ? 'selected' : '' }}>Yapılmadı</option>
                                        <option value="Tecilli" {{ $personelitem->askerlik_durumu == 'Tecilli' ? 'selected' : '' }}>Tecilli</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="personel_resim">Personel Resmi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <!-- Mevcut resmi göster -->
                                    <div class="mb-1">
                                        <img src="{{ asset($personelitem->personel_resim) }}" alt="Personel Resmi" class="img-thumbnail" width="60">
                                    </div>
                                    <!-- Yeni resim yükleme -->
                                    <input type="file" name="personel_resim" id="personel_resim" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ehliyet_sinif">Ehliyet Sınfı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="ehliyet_sinif" id="ehliyet_sinif"
                                        class="form-control form-control-sm" value="{{$personelitem->ehliyet_sinif}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ehliyet_tarihi">Ehliyet Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="date" name="ehliyet_tarihi" id="ehliyet_tarihi"
                                        class="form-control form-control-sm" value="{{$personelitem->ehliyet_tarihi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="baba_adi">Baba Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="baba_adi" id="baba_adi"
                                        class="form-control form-control-sm" value="{{$personelitem->baba_adi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="baba_meslegi">Baba Mesleği</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="baba_meslegi" id="baba_meslegi"
                                        class="form-control form-control-sm" value="{{$personelitem->baba_meslegi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ayak_no">Ayak No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="number" name="ayak_no" id="ayak_no"
                                        class="form-control form-control-sm" value="{{$personelitem->ayak_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="beden">Beden</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="number" name="beden" id="beden"
                                        class="form-control form-control-sm" value="{{$personelitem->beden}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ev_gsm">Ev Telefonu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="number" name="ev_gsm" id="ev_gsm"
                                        class="form-control form-control-sm no-zero" value="{{$personelitem->ev_gsm}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ise_giris_tarihi">İşe Giriş Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="ise_giris_tarihi" id="ise_giris_tarihi"
                                        class="form-control form-control-sm" value="{{$personelitem->ise_giris_tarihi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="isten_cikis_tarihi">İşten Çıkış Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="isten_cikis_tarihi" id="isten_cikis_tarihi"
                                        class="form-control form-control-sm" value="{{$personelitem->isten_cikis_tarihi}}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ev_adresi">Ev Adresi</label>
                                <textarea name="ev_adresi" id="ev_adresi" cols="20" rows="2"
                                    class="form-control form-control-sm ">{{$personelitem->ev_adresi}}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="acil_durum_kisi">Acil Durum Kişisi</label>
                                <textarea name="acil_durum_kisi" id="acil_durum_kisi" cols="20" rows="2"
                                    class="form-control form-control-sm ">{{$personelitem->acil_durum_kisi}}</textarea>
                            </div>
                        </div>
                        <div
                            style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                        </div>
                    </div>

                    </div>
                </form>
            </div>
        </div>

