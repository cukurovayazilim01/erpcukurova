   <!-- Modal -->
   <div class="modal fade" id="tahsilatplanupdateModal-{{ $tahsilatplanitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('tahsilatplan.update', ['tahsilatplan' => $tahsilatplanitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">{{$tahsilatplanitem->firmaadi->firma_unvan}} Tahsilat Planı Güncelleme Ekranı</h5>
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
                                           value="{{ $tahsilatplanitem->firmaadi->firma_unvan }}" readonly>
                                    <input type="hidden" name="cari_id" value="{{ $tahsilatplanitem->firmaadi->id }}">
                                </div>
                            </div>
                              <div class="col-md-6">
                                <label for="tarih">Tarih</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="tarih" id="tarih" value="{{$tahsilatplanitem->tarih}}"
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
                                        class="form-control form-control-sm" required value="{{$tahsilatplanitem->vade_tarih}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tahsilat_tutar">Tahsilat Tutar</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="tahsilat_tutar" id="tahsilat_tutar"
                                        class="form-control form-control-sm" required value="{{$tahsilatplanitem->tahsilat_tutar}}">
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
                                        <option value="Edildi"{{ $tahsilatplanitem->durum == 'Edildi' ? 'selected' : '' }}>Tahsil Edildi</option>
                                        <option value="Edilmedi"{{ $tahsilatplanitem->durum == 'Edilmedi' ? 'selected' : '' }}>Tahsil Edilmedi</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <label for="aciklama">Açıklama</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm ">{{$tahsilatplanitem->aciklama}}</textarea>
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
