<!-- Modal -->
<div class="modal fade" id="kasalarupdateModal-{{ $kasalaritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('kasalar.update', ['kasalar' => $kasalaritem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">KASALAR GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kasa_adi">Kasa Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="kasa_adi" id="kasa_adi"
                                        class="form-control form-control-sm" required value="{{$kasalaritem->kasa_adi}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="acilis_bakiye">Açılış Bakiye</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="text" name="acilis_bakiye" id="acilis_bakiye"
                                        class="form-control form-control-sm input-mask" required value="{{$kasalaritem->acilis_bakiye}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="doviz">Para Birimi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="doviz" id="doviz" class="form-select form-select-sm "
                                        required>
                                        <option value="TL"
                                            {{ $kasalaritem->doviz == 'TL' ? 'selected' : '' }}>TL
                                        </option>
                                        <option value="DOLAR"
                                            {{ $kasalaritem->doviz == 'DOLAR' ? 'selected' : '' }}>
                                            DOLAR
                                        </option>
                                        <option value="EURO"
                                            {{ $kasalaritem->doviz == 'EURO' ? 'selected' : '' }}>
                                            EURO
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="acilis_bakiye_tarih">Kasa Açılış Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="acilis_bakiye_tarih" id="acilis_bakiye_tarih"
                                        class="form-control form-control-sm" required value="{{$kasalaritem->acilis_bakiye_tarih}}">
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
                                            {{ $kasalaritem->durum == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Pasif"
                                            {{ $kasalaritem->durum == 'Pasif' ? 'selected' : '' }}>
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
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-success btn-sm "></i>Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>
