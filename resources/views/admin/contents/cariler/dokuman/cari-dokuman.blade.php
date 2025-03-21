<!-- Modal -->
<div class="modal fade" id="dokumanModal-{{ $cariitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $cariitem->firma_unvan }} Doküman Ekleme Ekranı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body"  >
                    <form action="{{ route('dokuman.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                    @csrf
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-12" style="display: none">
                                <label for="hatirlat_tarihi">Cariid</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </span>
                                    <input type="text" name="cari_id" id="cari_id"
                                        class="form-control form-control-sm" value="{{ $cariitem->id }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="dosya_adi">Doküman Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-file"></i>
                                    </span>
                                    <input type="text" name="dosya_adi" id="dosya_adi"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="dosya_yolu">Doküman</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-file"></i>
                                    </span>
                                    <input type="file" name="dosya_yolu" id="dosya_yolu"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="not">Doküman Açıklaması</label>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                            </div>

                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit" id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


