<!-- Modal -->
<div class="modal fade" id="giderupdateModal-{{ $gideritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('gider.update', ['gider' => $gideritem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
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
                                <label for="giderkategori_id">Gider Kategori Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="giderkategori_id" id="giderkategori_id" class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçim Yapınız..</option>
                                        @foreach ($giderkategori as $item)
                                            <option value="{{ $item->id }}"
                                                @if (isset($gideritem) && $gideritem->giderkategori_id == $item->id) selected @endif>
                                                {{ $item->gider_kategori_adi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="gider_kodu">Gider Kodu</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="gider_kodu" id="gider_kodu"
                                        class="form-control form-control-sm" required value="{{$gideritem->gider_kodu}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="gider_adi">Gider Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="gider_adi" id="gider_adi"
                                        class="form-control form-control-sm" required value="{{$gideritem->gider_adi}}">
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
                                            {{ $gideritem->durum == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Pasif"
                                            {{ $gideritem->durum == 'Pasif' ? 'selected' : '' }}>
                                            Pasif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button"  class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-success btn-sm "></i>Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>
