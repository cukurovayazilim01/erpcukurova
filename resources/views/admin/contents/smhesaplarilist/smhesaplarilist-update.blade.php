<!-- Modal -->
<div class="modal fade" id="smhesaplarilistupdateModal-{{ $smhesaplarilistitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('kasalar.update', ['kasalar' => $smhesaplarilistitem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{$smhesaplarilistitem->hesap_adi}} -  Adlı Hesabı Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                            <div class="col-md-6">
                                <label for="hesap_adi">Hesap Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="hesap_adi" id="hesap_adi" value="{{$smhesaplarilistitem->hesap_adi}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="acilis_tarihi">Açılış Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="acilis_tarihi" id="acilis_tarihi"
                                        class="form-control form-control-sm" required value="{{$smhesaplarilistitem->acilis_tarihi}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="platform">Hesap Platformu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="platform" id="platform"
                                        class="form-control form-control-sm" required>
                                        <option value="">Lütfen Seçiniz</option>
                                        <option value="İnstagram" {{ $smhesaplarilistitem->platform == 'İnstagram' ? 'selected' : '' }}>İnstagram</option>
                                        <option value="Facebook" {{ $smhesaplarilistitem->platform == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                        <option value="X" {{ $smhesaplarilistitem->platform == 'X' ? 'selected' : '' }}>X</option>
                                        <option value="LinkedIn" {{ $smhesaplarilistitem->platform == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="mail">Bağlı Mail</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="mail" name="mail" id="mail" value="{{$smhesaplarilistitem->mail}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="telefon">Bağlı Telefon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                    <input type="number" name="telefon" id="telefon" value="{{$smhesaplarilistitem->telefon}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="personel_id">Sorumlu Personel</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="personel_id" id="personel_id" class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçiniz</option>
                                        @foreach ($personel as $personelitem)
                                            <option value="{{ $personelitem->id }}" {{ old('personel_id', $smhesaplarilistitem->personel_id) == $personelitem->id ? 'selected' : '' }}>
                                                {{ $personelitem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="durum">Durum</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="durum" id="durum" class="form-control form-control-sm">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Pasif">Pasif</option>
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
