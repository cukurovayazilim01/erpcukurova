<!-- Modal -->
<div class="modal fade" id="pyillikhedefupdateModal-{{ $pyillikhedefleritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('pyillikhedefler.update', ['pyillikhedefler' => $pyillikhedefleritem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">PERSONEL YILLIK HEDEF GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kasa_adi">Personel Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm"  value="{{$pyillikhedefleritem->personel->ad_soyad}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="kasa_adi">Hedef Konusu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" required value="{{$pyillikhedefleritem->hedefkonu->hedef_konu}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="kasa_adi">Hedef Mevcut Değeri</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" required value="{{$pyillikhedefleritem->hedef_mevcut_degeri}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="kasa_adi">Hedeflenen Değer</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="" id="" readonly
                                        class="form-control form-control-sm" required value="{{$pyillikhedefleritem->hedeflenen_deger}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="kasa_adi">Yönetici Hedeflenen Değer</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="yonetici_hedeflenen_deger" id="yonetici_hedeflenen_deger"
                                        class="form-control form-control-sm" required value="{{$pyillikhedefleritem->yonetici_hedeflenen_deger}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="kontrol_sonucu">Kontrol Sonucu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <select name="kontrol_sonucu" id="kontrol_sonucu" class="form-select form-select-sm "
                                        >
                                        <option value="">Lütfen Seçim Yapınız
                                    </option>
                                        <option value="Tamamlandi"
                                            {{ $pyillikhedefleritem->kontrol_sonucu == 'Tamamlandi' ? 'selected' : '' }}>Hedef Tamamlandı
                                        </option>
                                        <option value="Tamamlanmadı"
                                            {{ $pyillikhedefleritem->kontrol_sonucu == 'Tamamlanmadi' ? 'selected' : '' }}>Hedef Tamamlanmadı

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
