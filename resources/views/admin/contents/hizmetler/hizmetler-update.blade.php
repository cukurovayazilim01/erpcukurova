<!-- Modal -->
<div class="modal fade" id="hizmetlerupdateModal-{{ $hizmetleritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('hizmetler.update', ['hizmetler' => $hizmetleritem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">HİZMETLER GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kategori_ad">Kategori Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                <select name="hizmetler_kategori_id" id="hizmetler_kategori_id" class="form-select form-select-sm" required>
                                    <option>Lütfen Kategori Seçiniz...</option>
                                    @foreach ($hizmetlerkategori as $item)
                                    <option value="{{ $item->id }}" {{ old('hizmetler_kategori_id', $item->id == $hizmetleritem->hizmetler_kategori_id ? 'selected' : '') }}>{{ $item->kategori_ad }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="hizmet_ad">Hizmet Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="hizmet_ad" id="hizmet_ad"
                                        class="form-control form-control-sm" required value="{{$hizmetleritem->hizmet_ad}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="hizmet_maliyet">Hizmet Maliyet</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="number" name="hizmet_maliyet" id="hizmet_maliyet"
                                        class="form-control form-control-sm" required value="{{$hizmetleritem->hizmet_maliyet}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="hizmet_satis_fiyati">Hizmet Fiyatı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="number" name="hizmet_satis_fiyati" id="hizmet_satis_fiyati"
                                        class="form-control form-control-sm" required value="{{$hizmetleritem->hizmet_maliyet}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="durum">Durum</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="durum" id="durum" class="form-select form-select-sm "
                                        required>
                                        <option value="Aktif"
                                            {{ $hizmetleritem->durum == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Pasif"
                                            {{ $hizmetleritem->durum == 'Pasif' ? 'selected' : '' }}>
                                            Pasif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="teklife_ekle">Teklife Eklensin mi ?</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="teklife_ekle" id="teklife_ekle" class="form-select form-select-sm "
                                        required>
                                        <option value="Evet"
                                            {{ $hizmetleritem->teklife_ekle == 'Evet' ? 'selected' : '' }}>Evet
                                        </option>
                                        <option value="Hayır"
                                            {{ $hizmetleritem->teklife_ekle == 'Hayır' ? 'selected' : '' }}>
                                            Hayır
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="hizmet_aciklama">Hizmet Açıklaması</label>

                                    <textarea name="hizmet_aciklama" id="hizmet_aciklama" cols="20" rows="1" class="form-control form-control-sm ">{{$hizmetleritem->hizmet_aciklama}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn btn-outline-success btn-sm "></i>Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>
