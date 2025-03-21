<!-- Modal -->
<div class="modal fade" id="bankalarupdateModal-{{ $bankalaritem->id }}" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <form action="{{ route('bankalar.update', ['bankalar' => $bankalaritem->id]) }}" method="POST" id="add-form"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Banka Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="banka_adi">Banka Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="banka_adi" id="banka_adi"
                                        class="form-control form-control-sm" required value="{{$bankalaritem->banka_adi}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="sube_adi">Şube Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="sube_adi" id="sube_adi"
                                        class="form-control form-control-sm" required value="{{$bankalaritem->sube_adi}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="sube_kodu">Şube Kodu</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="sube_kodu" id="sube_kodu"
                                        class="form-control form-control-sm" required value="{{$bankalaritem->sube_kodu}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hesap_adi">Hesap Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="hesap_adi" id="hesap_adi"
                                        class="form-control form-control-sm" required value="{{$bankalaritem->hesap_adi}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="iban">IBAN</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="iban" id="iban"
                                        class="form-control form-control-sm" required value="{{$bankalaritem->iban}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="hesap_no">Hesap No</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="hesap_no" id="hesap_no"
                                        class="form-control form-control-sm" required value="{{$bankalaritem->hesap_no}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="user_id">Yetkili Kişi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="user_id" id="user_id" class="form-select form-select-sm" required>
                                        <option value="">Müşteri Temsilcisi Seçiniz</option>
                                        @foreach ($user as $useritem)
                                            <option value="{{ $useritem->id }}"
                                                @if (isset($bankalaritem) && $bankalaritem->user_id == $useritem->id) selected @endif>
                                                {{ $useritem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="acilis_bakiyesi">Açılış Bakiye</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </span>
                                    <input type="text" name="acilis_bakiyesi" id="acilis_bakiyesi"
                                        class="form-control form-control-sm input-mask" required value="{{$bankalaritem->acilis_bakiyesi}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="kart_turu">Kart Türü</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="kart_turu" id="kart_turu" class="form-select form-select-sm "
                                        required>
                                        <option value="Hesap Kartı"
                                            {{ $bankalaritem->kart_turu == 'Hesap Kartı' ? 'selected' : '' }}>Hesap Kartı
                                        </option>
                                        <option value="Kredi Kartı"
                                            {{ $bankalaritem->kart_turu == 'Kredi Kartı' ? 'selected' : '' }}>
                                            Kredi Kartı
                                        </option>
                                        <option value="Sanal Kart"
                                            {{ $bankalaritem->kart_turu == 'Sanal Kart' ? 'selected' : '' }}>
                                            Sanal Kart
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="doviz">Para Birimi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="doviz" id="doviz" class="form-select form-select-sm "
                                        required>
                                        <option value="TL"
                                            {{ $bankalaritem->doviz == 'TL' ? 'selected' : '' }}>TL
                                        </option>
                                        <option value="DOLAR"
                                            {{ $bankalaritem->doviz == 'DOLAR' ? 'selected' : '' }}>
                                            DOLAR
                                        </option>
                                        <option value="EURO"
                                            {{ $bankalaritem->doviz == 'EURO' ? 'selected' : '' }}>
                                            EURO
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="acilis_bakiye_tarih">Kasa Açılış Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="acilis_bakiye_tarih" id="acilis_bakiye_tarih"
                                        class="form-control form-control-sm" required value="{{$bankalaritem->acilis_bakiye_tarih}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="durum">Durum</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="durum" id="durum" class="form-select form-select-sm "
                                        required>
                                        <option value="Aktif"
                                            {{ $bankalaritem->durum == 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Pasif"
                                            {{ $bankalaritem->durum == 'Pasif' ? 'selected' : '' }}>
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
