<!-- Modal -->
<div class="modal fade" id="aramalarModal-{{ $cariitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ $cariitem->firma_unvan }} Arama Ekleme Ekranı</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body"  >
                    <form action="{{ route('aramaEkle') }}" method="POST" enctype="multipart/form-data" id="add-form">
                    @csrf
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-6" style="display: none">
                                <label for="hatirlat_tarihi">Firma Ünvanı<code>*</code></label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </span>
                                    <input type="text" name="cari_id" id="cari_id"
                                        class="form-control form-control-sm" value="{{ $cariitem->id }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="arama_tipi">Arama Tipi<code>*</code></label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                    <select name="arama_tipi" id="arama_tipi" class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Gelen Arama">Gelen Arama</option>
                                        <option value="Giden Arama">Giden Arama</option>
                                        <option value="Müşteri Ziyareti">Müşteri Ziyareti</option>
                                        <option value="İnternet">İnternet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="hizmet_turu">Hizmet Türü<code>*</code></label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </span>
                                    <select name="hizmet_turu" id="hizmet_turu" class="form-select form-select-sm">
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Marka">Marka</option>
                                        <option value="ISO">ISO</option>
                                        <option value="WEB">WEB</option>
                                        <option value="Domain">Domain</option>
                                        <option value="ERP">ERP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="hatirlat_durumu">Hatırlatma Durumu<code>*</code></label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="hatirlat_durumu" id="hatirlat_durumu"
                                        class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Olumlu">Olumlu</option>
                                        <option value="Olumsuz">Olumsuz</option>
                                        <option value="Düşünüyor">Düşünüyor</option>
                                        <option value="Standart Kayıt">Standart Kayıt</option>
                                        <option value="Ziyaret Bekliyor">Ziyaret Bekliyor</option>
                                        <option value="Aranacak">Aranacak</option>
                                        <option value="Kara Liste">Kara Liste</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="hatirlat_tarihi">Hatırlatma Tarihi<code>*</code></label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="hatirlat_tarihi" id="hatirlat_tarihi"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="not">Görüşme Notu</label>
                                    <textarea name="not" id="not" cols="20" rows="2" class="form-control form-control-sm " required ></textarea>
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


