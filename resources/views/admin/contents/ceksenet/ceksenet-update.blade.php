<div class="modal fade" id="ceksenetupdateModal-{{ $ceksenetitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="update-form" action="{{ route('ceksenet.update', $ceksenetitem->id) }}" method="POST" enctype="multipart/form-data" id="add-form">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Çek/Senet Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style="padding: 1%;">
                        <div class="row">
                            {{-- <div class="col-md-3">
                                <label for="cek_tipi">Çek Tipi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="cek_tipi" id="cek_tipi" class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçim Yapınız...</option>
                                        <option value="Gelen" {{ $ceksenetitem->cek_tipi == 'Gelen' ? 'selected' : '' }}>Gelen - Tahsilat Çeki</option>
                                        <option value="Giden" {{ $ceksenetitem->cek_tipi == 'Giden' ? 'selected' : '' }}>Giden - Ödeme Çeki</option>
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label for="cari_id">Firma</label>
                                <div class="form-group input-with-icon" style="display: flex; align-items: center;">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="cari_unvan" id="cari_unvan"
                                        class="form-control form-control-sm" value="{{ $cariler->firma_unvan }}" readonly>
                                    <input type="hidden" name="cari_id" value="{{ $cariler->id }}">
                                </div>
                            </div> --}}
                            <div class="col-md-3">
                                <label for="cek_vade_tarihi">Vade Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="cek_vade_tarihi" id="cek_vade_tarihi" class="form-control form-control-sm" value="{{ $ceksenetitem->cek_vade_tarihi }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="cek_no">Çek No</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="cek_no" id="cek_no" class="form-control form-control-sm" value="{{ $ceksenetitem->cek_no }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="banka_adi">Banka Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="banka_adi" id="banka_adi" class="form-control form-control-sm" value="{{ $ceksenetitem->banka_adi }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="cek_resim">Çek Resim</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="file" name="cek_resim" id="cek_resim" class="form-control form-control-sm" value="{{ $ceksenetitem->cek_resim }}">
                                    {{-- @if($ceksenetitem->cek_resim)
                                        <small class="text-muted">{{ $ceksenetitem->cek_resim }}</small>
                                    @endif --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="sube_adi">Şube Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="sube_adi" id="sube_adi" class="form-control form-control-sm" value="{{ $ceksenetitem->sube_adi }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="tutar">Çek Tutarı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="number" name="tutar" id="tutar" class="form-control form-control-sm" value="{{ $ceksenetitem->tutar }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hesap_no">Hesap No</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="hesap_no" id="hesap_no" class="form-control form-control-sm" value="{{ $ceksenetitem->hesap_no }}" required>
                                </div>
                            </div>



                            <div class="col-md-12">
                                <label for="aciklama">Çek Açıklaması</label>
                                <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm">{{ $ceksenetitem->aciklama }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-primary btn-sm">Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
      // Select2 başlatma
      $('#cari_id').select2({
        theme: 'bootstrap4',  // Bootstrap 4 uyumluluğu
        placeholder: "Firma Seçiniz",
        allowClear: true,
        minimumInputLength: 3,
        width: '100%', // Select2 genişliği
        ajax: {
          url: '/cari-search',
          type: 'GET',
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return { q: params.term };
          },
          processResults: function(data) {
            return {
              results: data.map(function(item) {
                return { id: item.id, text: item.firma_unvan };
              })
            };
          },
          cache: true
        },
        dropdownParent: $('#cekseneteklemodal'), // Modal ID'sini burada belirtin
        language: {
          inputTooShort: function() { return "Lütfen en az 3 karakter girin."; },
          noResults: function() { return "Sonuç bulunamadı."; }
        }
      });
    });
    </script>
