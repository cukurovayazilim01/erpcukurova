 <!-- Modal -->
 <div class="modal fade" id="markatakipupdateModal-{{ $markatakipitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="add-form" action="{{ route('markatakip.update',['markatakip'=>$markatakipitem->id]) }}" method="POST" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Marka Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row" >
                            {{-- <div class="col-md-12 select2-sm">
                                <label for="cari_id" >Firma</label>

                                  <select name="cari_id" id="cari_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                    <!-- Dinamik veriler buraya yüklenecek -->
                                  </select>
                              </div> --}}
                              <div class="col-md-6">
                                <label for="cari_id">Firma</label>
                                <div class="form-group input-with-icon" style="display: flex; align-items: center;">
                                    <span class="icon" >
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="cari_unvan" id="cari_unvan" class="form-control form-control-sm"
                                           value="{{ $markatakipitem->firmaadi->firma_unvan }}" readonly>
                                    <input type="hidden" name="cari_id" value="{{ $markatakipitem->firmaadi->id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                        class="form-control form-control-sm" value="{{$markatakipitem->musteri_temsilcisi}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="satis_temsilcisi" id="satis_temsilcisi"
                                        class="form-select form-select-sm" required>
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
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    <input type="text" name="tc" id="tc"
                                        class="form-control form-control-sm" value="{{$markatakipitem->tc}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="vkn">VKN</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    <input type="text" name="vkn" id="vkn"
                                        class="form-control form-control-sm" value="{{$markatakipitem->vkn}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="sehir">Şehir</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-city"></i>
                                    </span>
                                    <input type="text" name="sehir" id="sehir"
                                        class="form-control form-control-sm" value="{{$markatakipitem->sehir}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="basvuru_no">Başvuru No</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="basvuru_no" id="basvuru_no"
                                        class="form-control form-control-sm" value="{{$markatakipitem->basvuru_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="referans_no">Referans No</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="referans_no" id="referans_no"
                                        class="form-control form-control-sm" value="{{$markatakipitem->referans_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="marka_adi">Marka Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="marka_adi" id="marka_adi"
                                        class="form-control form-control-sm" value="{{$markatakipitem->marka_adi}}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="marka_sinif">Marka Sınıfı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="marka_sinif" id="marka_sinif"
                                        class="form-control form-control-sm" value="{{$markatakipitem->marka_sinif}}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="hizmet_turu">Marka Hizmet</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="hizmet_turu" id="hizmet_turu" class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        @foreach ($hizmetler as $hizmetleritem)
                                            <option value="{{ $hizmetleritem->id }}"
                                                {{ old('hizmet_turu', $markatakipitem->hizmet_turu) == $hizmetleritem->id ? 'selected' : '' }}>
                                                {{ $hizmetleritem->hizmet_ad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="basvuru_tarihi">Başvuru Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="basvuru_tarihi" id="basvuru_tarihi"
                                        class="form-control form-control-sm" value="{{$markatakipitem->basvuru_tarihi}}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="marka_islem">Marka İşlem</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="marka_islem" id="marka_islem"
                                        class="form-select form-select-sm" required>
                                        <option value="Yapıldı"
                                        {{$markatakipitem->marka_islem == 'Yapıldı' ? 'selected' : ''}}>Yapıldı</option>
                                        <option value="Yapılmadı"
                                        {{$markatakipitem->marka_islem == 'Yapılmadı' ? 'selected' : ''}}>Yapılmadı</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="marka_durum">Marka Durum</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="marka_durum" id="marka_durum"
                                        class="form-select form-select-sm" required>
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
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit"  id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>

                </div>
            </div>
        </form>
    </div>
</div>
