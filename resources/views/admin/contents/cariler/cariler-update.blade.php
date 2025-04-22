<!-- Modal -->
<div class="modal fade" id="carilerupdateModal-{{ $cariitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('cariler.update', ['cariler' => $cariitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">{{ $cariitem->firma_unvan }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                <div class="row ">

                    <div class="col-md-6 col-sm-12 ">
                        <label for="firma_unvan">Firma Unvanı</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                            <input type="text" name="firma_unvan" id="firma_unvan"
                                class="form-control form-control-sm" required value="{{$cariitem->firma_unvan}}"
                                oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="ticari_unvan">Ticari Unvanı</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                            <input type="text" name="ticari_unvan" id="ticari_unvan"
                                class="form-control form-control-sm" required value="{{$cariitem->ticari_unvan}}"
                                oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>

                    {{-- =============================== --}}


                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <label for="is_tel">İş Telefonu</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                            <input type="number" name="is_tel" id="is_tel" value="{{$cariitem->is_tel}}"
                                class="form-control form-control-sm no-zero" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <label for="eposta">E-Posta</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            <input type="email" name="eposta" id="eposta"
                                class="form-control form-control-sm" value="{{$cariitem->eposta}}"
                                oninput="this.value = this.value.toLowerCase()" required>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <label for="yetkili_kisi">Yetkili Kişi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-user-tie"></i>
                            </span>
                            <input type="text" name="yetkili_kisi" id="yetkili_kisi"
                                class="form-control form-control-sm" required value="{{$cariitem->yetkili_kisi}}">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <label for="yetkili_kisi_tel">Yetkili Kişi Telefon</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                            <input type="number" name="yetkili_kisi_tel" id="yetkili_kisi_tel"
                                class="form-control form-control-sm no-zero" required value="{{$cariitem->yetkili_kisi_tel}}">
                        </div>
                    </div>

                    {{-- ================================= --}}




                    <div class="col-md-6 col-lg-4 col-xl-6">
                        <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            <select name="user_id" id="user_id"
                                class="form-control form-control-sm" required>
                                <option value="">Müşteri Temsilcisi Seçiniz</option>
                                @foreach ($user as $usercariitem)
                                <option value="{{ $usercariitem->id }}"
                                    @if (isset($cariitem) && $cariitem->user_id == $usercariitem->id) selected @endif>
                                    {{ $usercariitem->ad_soyad }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-6">
                        <label for="firma_turu">Firma Türü</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                            <select name="firma_turu" id="firma_turu" class="form-control form-control-sm">
                                <option value="">Lütfen Seçim Yapınız</option>
                                <option value="sahis" {{ $cariitem->firma_turu == 'sahis' ? 'selected' : '' }}>
                                    Şahıs
                                </option>
                                <option value="tuzel"
                                    {{ $cariitem->firma_turu == 'tuzel' ? 'selected' : '' }}>
                                    Tüzel
                                </option>
                            </select>
                        </div>
                    </div>


                    {{-- ================================= --}}


                    <div class="col-md-6">
                        <label for="adres">Adres</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i></span>
                            <textarea name="adres" id="adres" class="form-control" aria-label="With textarea">{{ $cariitem->adres }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="aciklama">Açıklama</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                            <textarea name="aciklama" id="aciklama" class="form-control" aria-label="With textarea">{{ $cariitem->aciklama }}</textarea>
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
                                inputmode="numeric" maxlength="11" minlength="10" required value="{{ $cariitem->vergi_no }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="vergi_dairesi">Vergi Dairesi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i
                                    class="fa-solid fa-house-chimney-user"></i></span>
                            <input type="text" name="vergi_dairesi" id="vergi_dairesi"
                                class="form-control form-control-sm" value="{{ $cariitem->vergi_dairesi }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="">T.C Kimlik No</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-id-card-clip"></i></span>
                            <input type="text" name="tc_kimlik" id="tc_kimlik"
                                class="form-control form-control-sm input-mask" pattern="\d{11}"
                                inputmode="numeric" maxlength="11" minlength="11" value="{{ $cariitem->tc_kimlik }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="firma_tipi">Firma Tipi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-building"></i>
                            </span>
                            <select name="firma_tipi" id="firma_tipi" class="form-control form-control-sm">
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
                    {{-- ================================= --}}

                    <div class="col-md-3">
                        <label for="">İl</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-city"></i></span>
                            <select name="il" id="firma_il" class="form-control form-control-sm"
                                onchange="firma_ilceListele()">
                                <option value="{{ $cariitem->il }}" {{ old('il', $cariitem->il) == $cariitem->il ? 'selected' : '' }}>
                                    {{ $cariitem->il }}
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="ilce">İlçe</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-tree-city"></i></span>
                            <select name="ilce" id="firma_ilce" class="form-control form-control-sm">
                                <option value="{{ $cariitem->ilce }}" {{ old('ilce', $cariitem->ilce) == $cariitem->ilce ? 'selected' : '' }}>
                                    {{ $cariitem->ilce }}
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="web_adres">Web Adresi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-globe"></i></span>
                            <input type="text" name="web_adres" id="web_adres"
                                class="form-control form-control-sm" value="{{ $cariitem->web_adres }}"
                                oninput="this.value = this.value.toLowerCase()">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="">Firma Durumu</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"> <i class="fa fa-building"></i>
                            </span>
                            <select name="firma_durumu" id="firma_durumu"
                                class="form-control form-control-sm">
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
                <div
                    style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                    <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                </div>
            </div>

            </div>
        </form>
    </div>
</div>
