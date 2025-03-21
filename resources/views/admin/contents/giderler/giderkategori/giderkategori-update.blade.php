<!-- Modal -->
<div class="modal fade" id="giderkategoriupdateModal-{{ $giderkategoriitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
        <form action="{{ route('giderkategori.update', ['giderkategori' => $giderkategoriitem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Gider Kategori Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="gider_kategori_kodu">Kategori Kodu</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="gider_kategori_kodu" id="gider_kategori_kodu"
                                        class="form-control form-control-sm" required
                                        value="{{ $giderkategoriitem->gider_kategori_kodu }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="durum">Durum</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
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
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="gider_kategori_adi" id="gider_kategori_adi"
                                        class="form-control form-control-sm" required
                                        value="{{ $giderkategoriitem->gider_kategori_adi }}">
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
