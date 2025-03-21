<!-- Modal -->
<div class="modal fade" id="kontakupdateModal-{{ $kontakitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('kontaklistesi.update', ['kontaklistesi' => $kontakitem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{ $kontakitem->firmaadi->firma_unvan }} GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="cari_id">Firma</label>
                                <div class="form-group input-with-icon" style="background-color:#f8f9fa">
                                    <span class="icon" style="margin-right: 5px">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    {{ $kontakitem->firmaadi->firma_unvan ?? 'Bilinmiyor' }}
                                </div>
                                <input type="hidden" name="cari_id" value="{{ $kontakitem->cari_id }}">
                            </div>

                            <div class="col-md-4">
                                <label for="yetkili_isim">Yetkili Kişi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="yetkili_isim" id="yetkili_isim"
                                        class="form-control form-control-sm"
                                        value="{{ $kontakitem->yetkili_isim }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="telefon">Telefon</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="number" name="telefon" id="telefon"
                                        class="form-control form-control-sm no-zero"
                                        value="{{ $kontakitem->telefon }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="eposta">E-Posta</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="eposta" id="eposta"
                                        class="form-control form-control-sm " value="{{ $kontakitem->eposta }}" required>
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



