<!-- Modal -->
<div class="modal fade" id="kasalarupdateModal-{{ $kasalaritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('kasalar.update', ['kasalar' => $kasalaritem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{$kasalaritem->kasa_adi}} -  Adlı Kasayı Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                            <div class="col-md-6">
                                <label for="kasa_adi">Kasa Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="kasa_adi" id="kasa_adi"
                                        class="form-control form-control-sm" required value="{{$kasalaritem->kasa_adi}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="acilis_bakiye">Açılış Bakiye</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="text" name="acilis_bakiye" id="acilis_bakiye" readonly
                                        class="form-control form-control-sm input-mask" required value="{{$kasalaritem->acilis_bakiye}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="doviz">Para Birimi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>

                                    <input type="text" name="doviz" id="doviz" readonly
                                        class="form-control form-control-sm " required value="{{$kasalaritem->doviz}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="acilis_bakiye_tarih">Kasa Açılış Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="acilis_bakiye_tarih" id="acilis_bakiye_tarih" readonly onkeydown="return false;"
                                        class="form-control form-control-sm" required value="{{$kasalaritem->acilis_bakiye_tarih}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="durum">Durum</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="durum" id="durum" class="form-control form-control-sm "
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
