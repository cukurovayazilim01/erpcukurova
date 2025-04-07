<!-- Modal -->
<div class="modal fade" id="hizmetlerupdateModal-{{ $hizmetleritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('hizmetler.update', ['hizmetler' => $hizmetleritem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">HİZMETLER GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                            <div class="col-md-6 col-sm-12">
                                <label for="kategori_ad">Kategori Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                <select name="hizmetler_kategori_id" id="hizmetler_kategori_id" class="form-control form-control-sm" required>
                                    <option>Lütfen Kategori Seçiniz...</option>
                                    @foreach ($hizmetlerkategori as $item)
                                    <option value="{{ $item->id }}" {{ old('hizmetler_kategori_id', $item->id == $hizmetleritem->hizmetler_kategori_id ? 'selected' : '') }}>{{ $item->kategori_ad }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="hizmet_ad">Hizmet Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="hizmet_ad" id="hizmet_ad"
                                        class="form-control form-control-sm" required value="{{$hizmetleritem->hizmet_ad}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="hizmet_maliyet">Hizmet Maliyet</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="number" name="hizmet_maliyet" id="hizmet_maliyet"
                                        class="form-control form-control-sm" required value="{{$hizmetleritem->hizmet_maliyet}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="hizmet_satis_fiyati">Hizmet Fiyatı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="number" name="hizmet_satis_fiyati" id="hizmet_satis_fiyati"
                                        class="form-control form-control-sm" required value="{{$hizmetleritem->hizmet_maliyet}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="durum">Durum</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="durum" id="durum" class="form-control form-control-sm "
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
                            <div class="col-md-6 col-sm-12">
                                <label for="teklife_ekle">Teklife Eklensin mi ?</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="teklife_ekle" id="teklife_ekle" class="form-control form-control-sm "
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
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                    <textarea name="hizmet_aciklama" id="hizmet_aciklama" cols="20" rows="1" class="form-control form-control-sm ">{{$hizmetleritem->hizmet_aciklama}}</textarea>
                            </div>
                        </div>
                    </div>
                        <div
                            style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">Güncelle</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
