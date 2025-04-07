<!-- Modal -->
<div class="modal fade" id="giderkategoriupdateModal-{{ $giderkategoriitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('giderkategori.update', ['giderkategori' => $giderkategoriitem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <h5 class="modal-title">{{ $giderkategoriitem->gider_kategori_adi }} - Gider Kategori Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                            <div class="col-md-6">
                                <label for="gider_kategori_kodu">Kategori Kodu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="gider_kategori_kodu" id="gider_kategori_kodu"
                                        class="form-control form-control-sm" required
                                        value="{{ $giderkategoriitem->gider_kategori_kodu }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="durum">Durum</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="durum" id="durum" class="form-control form-control-sm "
                                        required>
                                        <option value="Aktif"
                                            {{ $giderkategoriitem->durum == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Pasif"
                                            {{ $giderkategoriitem->durum == 'Pasif' ? 'selected' : '' }}>
                                            Pasif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="gider_kategori_adi">Kategori Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="gider_kategori_adi" id="gider_kategori_adi"
                                        class="form-control form-control-sm" required
                                        value="{{ $giderkategoriitem->gider_kategori_adi }}">
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

