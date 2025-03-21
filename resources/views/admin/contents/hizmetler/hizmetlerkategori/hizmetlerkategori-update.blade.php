<!-- Modal -->
<div class="modal fade" id="hizmetkategoriupdateModal-{{ $hizmetlerkategoriitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog ">
        <form action="{{ route('hizmetlerkategori.update', ['hizmetlerkategori' => $hizmetlerkategoriitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">HİZMETLER KATEGORİ GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="kategori_ad">Kategori Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="kategori_ad" id="kategori_ad"
                                        class="form-control form-control-sm" required
                                        value="{{ $hizmetlerkategoriitem->kategori_ad }}">
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
                                            {{ $hizmetlerkategoriitem->durum == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Pasif"
                                            {{ $hizmetlerkategoriitem->durum == 'Pasif' ? 'selected' : '' }}>
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
                                            {{ $hizmetlerkategoriitem->teklife_ekle == 'Evet' ? 'selected' : '' }}>Evet
                                        </option>
                                        <option value="Hayır"
                                            {{ $hizmetlerkategoriitem->teklife_ekle == 'Hayır' ? 'selected' : '' }}>
                                            Hayır
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
