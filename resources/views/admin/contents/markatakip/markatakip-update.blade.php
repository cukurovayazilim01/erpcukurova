 <!-- Modal -->
 <div class="modal fade" id="markatakipupdateModal-{{ $markatakipitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="add-form" action="{{ route('markatakip.update',['markatakip'=>$markatakipitem->id]) }}" method="POST" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <h5 class="modal-title">Marka Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                <div class="row ">
                              <div class="col-md-6">
                                <label for="cari_id">Firma</label>
                                <div class="input-group mb-2" style="display: flex; align-items: center;">
                                    <span class="input-group-text" >
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="cari_unvan" id="cari_unvan" class="form-control form-control-sm"
                                           value="{{ $markatakipitem->firmaadi->firma_unvan }}" readonly>
                                    <input type="hidden" name="cari_id" value="{{ $markatakipitem->firmaadi->id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                        class="form-control form-control-sm" value="{{$markatakipitem->musteri_temsilcisi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="satis_temsilcisi" id="satis_temsilcisi"
                                        class="form-control form-control-sm" required>
                                        <option value="">Satış Temsilcisi Seçiniz</option>
                                        @foreach ($user as $useritem)
                                            <option value="{{ $useritem->id }}"
                                                    {{old('satis_temsilcisi',$markatakipitem->satis_temsilcisi) == $useritem->id ? 'selected' : ''}}                                                                 >
                                                {{ $useritem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="tc">TC</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    <input type="text" name="tc" id="tc"
                                        class="form-control form-control-sm" value="{{$markatakipitem->tc}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="vkn">VKN</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    <input type="text" name="vkn" id="vkn"
                                        class="form-control form-control-sm" value="{{$markatakipitem->vkn}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="sehir">Şehir</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-city"></i>
                                    </span>
                                    <input type="text" name="sehir" id="sehir"
                                        class="form-control form-control-sm" value="{{$markatakipitem->sehir}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="basvuru_no">Başvuru No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="basvuru_no" id="basvuru_no"
                                        class="form-control form-control-sm" value="{{$markatakipitem->basvuru_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="referans_no">Referans No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="referans_no" id="referans_no"
                                        class="form-control form-control-sm" value="{{$markatakipitem->referans_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="marka_adi">Marka Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="marka_adi" id="marka_adi"
                                        class="form-control form-control-sm" value="{{$markatakipitem->marka_adi}}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="marka_sinif">Marka Sınıfı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="marka_sinif" id="marka_sinif"
                                        class="form-control form-control-sm" value="{{$markatakipitem->marka_sinif}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="hizmet_turu">Marka Hizmet</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="hizmet_turu" id="hizmet_turu" class="form-control form-control-sm"
                                        required>
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="1" {{ $markatakipitem->hizmet_turu == '1' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 1 Sınıflı</option>
                                        <option value="2" {{ $markatakipitem->hizmet_turu == '2' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 2 Sınıflı</option>
                                        <option value="3" {{ $markatakipitem->hizmet_turu == '3' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 3 Sınıflı</option>
                                        <option value="4" {{ $markatakipitem->hizmet_turu == '4' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 4 Sınıflı</option>
                                        <option value="5" {{ $markatakipitem->hizmet_turu == '5' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 5 Sınıflı</option>
                                        <option value="6" {{ $markatakipitem->hizmet_turu == '6' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 6 Sınıflı</option>
                                        <option value="7" {{ $markatakipitem->hizmet_turu == '7' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 7 Sınıflı</option>
                                        <option value="8" {{ $markatakipitem->hizmet_turu == '8' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 8 Sınıflı</option>
                                        <option value="9" {{ $markatakipitem->hizmet_turu == '9' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 9 Sınıflı</option>
                                        <option value="10" {{ $markatakipitem->hizmet_turu == '10' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 10 Sınıflı</option>
                                        <option value="11" {{ $markatakipitem->hizmet_turu == '11' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 11 Sınıflı</option>
                                        <option value="12" {{ $markatakipitem->hizmet_turu == '12' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 12 Sınıflı</option>
                                        <option value="13" {{ $markatakipitem->hizmet_turu == '13' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 13 Sınıflı</option>
                                        <option value="14" {{ $markatakipitem->hizmet_turu == '14' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 14 Sınıflı</option>
                                        <option value="15" {{ $markatakipitem->hizmet_turu == '15' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 15 Sınıflı</option>
                                        <option value="16" {{ $markatakipitem->hizmet_turu == '16' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 16 Sınıflı</option>
                                        <option value="17" {{ $markatakipitem->hizmet_turu == '17' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 18 Sınıflı</option>
                                        <option value="18" {{ $markatakipitem->hizmet_turu == '18' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 19 Sınıflı</option>
                                        <option value="19" {{ $markatakipitem->hizmet_turu == '19' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 20 Sınıflı</option>
                                        <option value="20" {{ $markatakipitem->hizmet_turu == '20' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 21 Sınıflı</option>
                                        <option value="21" {{ $markatakipitem->hizmet_turu == '21' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 22 Sınıflı</option>
                                        <option value="22" {{ $markatakipitem->hizmet_turu == '22' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 23 Sınıflı</option>
                                        <option value="23" {{ $markatakipitem->hizmet_turu == '23' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 24 Sınıflı</option>
                                        <option value="24" {{ $markatakipitem->hizmet_turu == '24' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 25 Sınıflı</option>
                                        <option value="25" {{ $markatakipitem->hizmet_turu == '25' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 26 Sınıflı</option>
                                        <option value="26" {{ $markatakipitem->hizmet_turu == '26' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 27 Sınıflı</option>
                                        <option value="27" {{ $markatakipitem->hizmet_turu == '27' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 28 Sınıflı</option>
                                        <option value="28" {{ $markatakipitem->hizmet_turu == '28' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 29 Sınıflı</option>
                                        <option value="29" {{ $markatakipitem->hizmet_turu == '29' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 30 Sınıflı</option>
                                        <option value="30" {{ $markatakipitem->hizmet_turu == '30' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 31 Sınıflı</option>
                                        <option value="31" {{ $markatakipitem->hizmet_turu == '31' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 32 Sınıflı</option>
                                        <option value="32" {{ $markatakipitem->hizmet_turu == '32' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 33 Sınıflı</option>
                                        <option value="33" {{ $markatakipitem->hizmet_turu == '33' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 34 Sınıflı</option>
                                        <option value="34" {{ $markatakipitem->hizmet_turu == '34' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 35 Sınıflı</option>
                                        <option value="35" {{ $markatakipitem->hizmet_turu == '35' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 36 Sınıflı</option>
                                        <option value="36" {{ $markatakipitem->hizmet_turu == '36' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 37 Sınıflı</option>
                                        <option value="37" {{ $markatakipitem->hizmet_turu == '37' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 38 Sınıflı</option>
                                        <option value="38" {{ $markatakipitem->hizmet_turu == '38' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 39 Sınıflı</option>
                                        <option value="39" {{ $markatakipitem->hizmet_turu == '39' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 40 Sınıflı</option>
                                        <option value="40" {{ $markatakipitem->hizmet_turu == '40' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 41 Sınıflı</option>
                                        <option value="41" {{ $markatakipitem->hizmet_turu == '41' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 42 Sınıflı</option>
                                        <option value="42" {{ $markatakipitem->hizmet_turu == '42' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 43 Sınıflı</option>
                                        <option value="43" {{ $markatakipitem->hizmet_turu == '43' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 44 Sınıflı</option>
                                        <option value="44" {{ $markatakipitem->hizmet_turu == '44' ? 'selected' : '' }}>
                                            Marka Tescil İşlemleri 45 Sınıflı</option>
                                        <option value="269" {{ $markatakipitem->hizmet_turu == '269' ? 'selected' : '' }}>
                                            Yurtdışı Marka Başvurusu (AB Ülkeleri)</option>
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
                                        class="form-control form-control-sm" value="{{$markatakipitem->basvuru_tarihi}}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="marka_islem">Marka İşlem</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="marka_islem" id="marka_islem"
                                        class="form-control form-control-sm" required>
                                        <option value="Yapıldı"
                                        {{$markatakipitem->marka_islem == 'Yapıldı' ? 'selected' : ''}}>Yapıldı</option>
                                        <option value="Yapılmadı"
                                        {{$markatakipitem->marka_islem == 'Yapılmadı' ? 'selected' : ''}}>Yapılmadı</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="marka_durum">Marka Durum</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="marka_durum" id="marka_durum"
                                        class="form-control form-control-sm" required>
                                        <option value="Süreç Devam Ediyor"
                                        {{$markatakipitem->marka_durum == 'Süreç Devam Ediyor' ? 'selected' : ''}}>Süreç Devam Ediyor</option>
                                        <option value="Tescil Edildi"
                                        {{$markatakipitem->marka_durum == 'Tescil Edildi' ? 'selected' : ''}}>Tescil Edildi</option>
                                        <option value="İptal Edildi"
                                        {{$markatakipitem->marka_durum == 'İptal Edildi' ? 'selected' : ''}}>İptal Edildi</option>
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
