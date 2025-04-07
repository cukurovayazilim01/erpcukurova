   <!-- Modal -->
   <div class="modal fade" id="odemeplanlariupdateModal-{{ $odemeplanlariitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('odemeplanlari.update', ['odemeplanlari' => $odemeplanlariitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <h5 class="modal-title">{{$odemeplanlariitem->firmaadi->firma_unvan}} Ödeme Planı Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">
                <div class="row ">
                            <div class="col-md-12">
                                <label for="cari_id">Firma Ünvanı</label>
                                <div class="input-group mb-2" style="display: flex; align-items: center;">
                                    <span class="input-group-text" >
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text"  class="form-control form-control-sm"
                                           value="{{ $odemeplanlariitem->firmaadi->firma_unvan }}" readonly>
                                    <input type="hidden" name="cari_id" value="{{ $odemeplanlariitem->firmaadi->id }}">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <label for="tarih">Tarih</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="tarih" id="tarih" value="{{$odemeplanlariitem->tarih}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                              <div class="col-md-6">
                                <label for="vade_tarih">Vade Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="vade_tarih" id="vade_tarih" min="2025-01-01" onfocus="this.min=getTomorrowDate()"
                                        class="form-control form-control-sm" required value="{{$odemeplanlariitem->vade_tarih}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="odeme_tutar">Ödeme Tutar</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="odeme_tutar" id="odeme_tutar"
                                        class="form-control form-control-sm" required value="{{$odemeplanlariitem->odeme_tutar}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="durum">Durum</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="durum" id="durum"
                                        class="form-control form-control-sm" required>
                                        <option value="">Lütfen Seçim Yapınız...</option>
                                        <option value="Yapıldı"{{ $odemeplanlariitem->durum == 'Yapıldı' ? 'selected' : '' }}>Ödeme Yapıldı</option>
                                        <option value="Yapılmadı"{{ $odemeplanlariitem->durum == 'Yapılmadı' ? 'selected' : '' }}>Ödeme Yapılmadı</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="aciklama">Açıklama</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm ">{{$odemeplanlariitem->aciklama}}</textarea>
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
