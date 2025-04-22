<!-- Modal -->
<div class="modal fade" id="dokumanModal-{{ $cariitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $cariitem->firma_unvan }} Doküman Ekleme Ekranı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dokuman.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <!-- Modal Body -->
                <div class="modal-body"
                    style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">
                    <div class="row ">
                        <div class="col-md-12" style="display: none">
                            <label for="hatirlat_tarihi">Cariid</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <input type="text" name="cari_id" id="cari_id" class="form-control form-control-sm"
                                    value="{{ $cariitem->id }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dosya_adi">Doküman Adı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-calendar"></i></span>
                                <input type="text" name="dosya_adi" id="dosya_adi" class="form-control form-control-sm"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="dosya_yolu">Doküman</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-folder-open"></i></span>
                                <input type="file" name="dosya_yolu" id="dosya_yolu"
                                    class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="not">Doküman Açıklaması</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                <textarea name="aciklama" id="aciklama" cols="20" rows="2"
                                    class="form-control form-control-sm "></textarea>
                            </div>

                        </div>
                        <div style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25"
                                data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
