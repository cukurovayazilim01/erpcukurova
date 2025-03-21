<!-- Modal -->
<div class="modal fade" id="isbasvuruupdateModal-{{ $isbasvuruitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('isbasvurulari.update', ['isbasvurulari' => $isbasvuruitem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{$isbasvuruitem->ad_soyad}} İŞ BAŞVURUSU GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 2%; ">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="tarih">Başvuru Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="date" name="tarih" id="tarih" value="{{$isbasvuruitem->tarih}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ad_soyad">Ad Soyadı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="ad_soyad" id="ad_soyad" value="{{$isbasvuruitem->ad_soyad}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="basvuru_pozisyon">Başvurduğu Pozisyon</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="basvuru_pozisyon" id="basvuru_pozisyon" value="{{$isbasvuruitem->basvuru_pozisyon}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="telefon">Telefon</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="number" name="telefon" id="telefon" value="{{$isbasvuruitem->telefon}}"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="meslek_kodu">Eposta</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="email" name="email" id="email" value="{{$isbasvuruitem->email}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="mezuniyet">Mezuniyet</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="mezuniyet" id="mezuniyet" class="form-select form-select-sm">
                                        <option value="Lisans" {{ $isbasvuruitem->mezuniyet == 'Lisans' ? 'selected' : '' }}>Lisans</option>
                                        <option value="Yüksek Lisans" {{ $isbasvuruitem->mezuniyet == 'Yüksek Lisans' ? 'selected' : '' }}>Yüksek Lisans</option>
                                        <option value="Ön Lisans" {{ $isbasvuruitem->mezuniyet == 'Ön Lisans' ? 'selected' : '' }}>Ön Lisans</option>
                                        <option value="Lise" {{ $isbasvuruitem->mezuniyet == 'Lise' ? 'selected' : '' }}>Lise</option>
                                        <option value="OrtaOkul" {{ $isbasvuruitem->mezuniyet == 'OrtaOkul' ? 'selected' : '' }}>OrtaOkul</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="durum">Durum</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="durum" id="durum" class="form-select form-select-sm">
                                        <option value="Olumlu" {{ $isbasvuruitem->durum == 'Olumlu' ? 'selected' : '' }}>Olumlu</option>
                                        <option value="Olumsuz" {{ $isbasvuruitem->durum == 'Olumsuz' ? 'selected' : '' }}>Olumsuz</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="dosya">Dosya</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="file" name="dosya" id="dosya" value="{{$isbasvuruitem->dosya}}"
                                        class="form-control form-control-sm" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="gorusme_notu">Görüşme Notu</label>
                                    <textarea name="gorusme_notu" id="gorusme_notu" cols="20" rows="2" class="form-control form-control-sm ">{{$isbasvuruitem->gorusme_notu}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button"  class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-success btn-sm "></i>Güncelle</button>
                </div>
            </div>
        </form>
    </div>
</div>
