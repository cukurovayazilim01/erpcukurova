<!-- Modal -->
<div class="modal fade" id="kontakupdateModal-{{ $kontakitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('kontaklistesi.update', ['kontaklistesi' => $kontakitem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">{{ $kontakitem->firmaadi->firma_unvan }} GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                            <div class="col-md-6 col-sm-12 ">
                                <label for="cari_id">Firma</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    <input type="text" value="{{ $kontakitem->firmaadi->firma_unvan ?? 'Bilinmiyor' }}"
                                    class="form-control form-control-sm" readonly>
                                </div>

                                <input type="hidden" name="cari_id" value="{{ $kontakitem->cari_id }}">
                            </div>

                            <div class="col-md-6 col-sm-12 ">
                                <label for="yetkili_isim">Yetkili Kişi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                                    <input type="text" name="yetkili_isim" id="yetkili_isim"
                                        class="form-control form-control-sm"
                                        value="{{ $kontakitem->yetkili_isim }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12 ">
                                <label for="telefon">Telefon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="number" name="telefon" id="telefon"
                                        class="form-control form-control-sm no-zero"
                                        value="{{ $kontakitem->telefon }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 ">
                                <label for="eposta">E-Posta</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="eposta" id="eposta"
                                        class="form-control form-control-sm " value="{{ $kontakitem->eposta }}" required>
                                </div>
                            </div>
                        </div>
                        <div
                            style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



