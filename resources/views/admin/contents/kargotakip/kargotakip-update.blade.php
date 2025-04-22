   <!-- Modal -->
   <div class="modal fade" id="kargotakipupdateModal-{{ $kargotakipitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('kargotakip.update', ['kargotakip' => $kargotakipitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{$kargotakipitem->gonderen_ad}} Kargo Takip Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style="padding: 2%;">
                        <div class="row">

                            <div class="col-md-6">
                                <label for="gonderen_ad">Gönderen Firma/Kurum</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="gonderen_ad" id="gonderen_ad"
                                        class="form-control form-control-sm" value="{{$kargotakipitem->gonderen_ad}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="gonderi_tipi">Gönderi Tipi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="gonderi_tipi" id="gonderi_tipi"
                                        class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçiniz</option>
                                        <option value="Giden Kargo"  {{ $kargotakipitem->gonderi_tipi == 'Giden Kargo' ? 'selected' : '' }}>Giden Kargo</option>
                                        <option value="Gelen Kargo" {{ $kargotakipitem->gonderi_tipi == 'Gelen Kargo' ? 'selected' : '' }}>Gelen Kargo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="kargo_takip_no">Kargo Takip No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="kargo_takip_no" id="kargo_takip_no"
                                        class="form-control form-control-sm" value="{{$kargotakipitem->kargo_takip_no}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="gonderi_tarihi">Gönderi Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="gonderi_tarihi" id="gonderi_tarihi"
                                        class="form-control form-control-sm" value="{{$kargotakipitem->gonderi_tarihi}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hangi_kargo">Hangi Kargo</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="hangi_kargo" id="hangi_kargo"
                                        class="form-select form-select-sm" required>
                                        <option value="PTT Kargo" {{ $kargotakipitem->hangi_kargo == 'PTT Kargo' ? 'selected' : '' }}>PTT Kargo</option>
                                        <option value="Aras Kargo" {{ $kargotakipitem->hangi_kargo == 'Aras Kargo' ? 'selected' : '' }}>Aras Kargo</option>
                                        <option value="Yurt İçi Kargo" {{ $kargotakipitem->hangi_kargo == 'Yurt İçi Kargo' ? 'selected' : '' }}>Yurt İçi Kargo</option>
                                        <option value="MNG Kargo" {{ $kargotakipitem->hangi_kargo == 'MNG Kargo' ? 'selected' : '' }}>MNG Kargo</option>
                                        <option value="Sürat Kargo" {{ $kargotakipitem->hangi_kargo == 'Sürat Kargo' ? 'selected' : '' }}>Sürat Kargo</option>
                                        <option value="UPS Kargo" {{ $kargotakipitem->hangi_kargo == 'UPS Kargo' ? 'selected' : '' }}>UPS Kargo</option>
                                        <option value="Trendyol Express" {{ $kargotakipitem->hangi_kargo == 'Trendyol Express' ? 'selected' : '' }}>Trendyol Express</option>
                                        <option value="Hepsi JET" {{ $kargotakipitem->hangi_kargo == 'Hepsi JET' ? 'selected' : '' }}>Hepsi JET</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="aciklama">Kargo Açıklaması</label>
                                <textarea name="aciklama" id="aciklama" cols="20" rows="2"
                                    class="form-control form-control-sm ">{{$kargotakipitem->aciklama}}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="kargo_takip_no">Kargoyu Alan</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="kargoyu_alan" id="kargoyu_alan"
                                        class="form-control form-control-sm" value="{{$kargotakipitem->kargoyu_alan}}" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="alinan_tarih">Kargoyu Alma Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="alinan_tarih" id="alinan_tarih"
                                        class="form-control form-control-sm"  value="{{$kargotakipitem->alinan_tarih}}"  >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="kargo_durum">Kargoyu Durumu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <select name="kargo_durum" id="kargo_durum"
                                        class="form-select form-select-sm" >
                                        <option value=""></option>
                                        <option value="Alındı" {{ $kargotakipitem->kargo_durum == 'Alındı' ? 'selected' : '' }}>Alındı</option>
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
                    <button type="submit" id="submit-form"
                        class="btn btn-outline-primary btn-sm ">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
</div>
