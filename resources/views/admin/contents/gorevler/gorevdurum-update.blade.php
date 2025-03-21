<!-- Modal -->
<div class="modal fade" id="gorevlerdurumupdateModal-{{ $gorevleritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('gorevatama.update', ['gorevatama' => $gorevleritem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">GÖREV ATAMA GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 1%; ">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="gorev_adi">Görev Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="gorev_adi" id="gorev_adi"
                                        class="form-control form-control-sm" value="{{$gorevleritem->gorev_adi}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="gorevlendirilen_id">Görevlendiren</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    @if (Auth::check())
                                        <input type="text" name="" id=""
                                            class="form-control form-control-sm"
                                            value="{{ Auth::user()->ad_soyad }}" readonly>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="gorevlendirilen_id">Görevlendirilen Personel</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="gorevlendirilen_id" id="gorevlendirilen_id"
                                        class="form-select form-select-sm" readonly disabled>
                                        <option value="">Lütfen Seçim Yapınız..</option>
                                        @foreach ($user as $useritem)
                                        <option value="{{ $useritem->id }}"
                                            {{ old('gorevlendirilen_id', $gorevleritem->gorevlendirilen_id) == $useritem->id ? 'selected' : '' }}>
                                            {{ $useritem->ad_soyad }}
                                        </option>
                                    @endforeach
                                <input type="hidden" name="gorevlendirilen_id" value="{{ $gorevleritem->gorevlendirilen_id }}">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="gorev_tanimi">Görev Tanımı</label>
                                <textarea name="gorev_tanimi" id="gorev_tanimi" cols="20" rows="1" class="form-control form-control-sm" readonly>{{$gorevleritem->gorev_tanimi}}</textarea>
                            </div>
                            <div class="col-md-12 select2-sm">
                                <label for="cari_id">Firma Ünvanı</label>
                                <div class="form-group input-with-icon" style="background-color:#f8f9fa">
                                    <span class="icon" style="margin-right: 5px">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    {{ $gorevleritem->firmaadi->firma_unvan ?? 'Bilinmiyor' }}
                                </div>
                                <input type="hidden" name="cari_id" value="{{ $gorevleritem->cari_id }}">
                            </div>
                            <div class="col-md-3">
                                <label for="gorev_baslama_tarihi">Görev Başlama Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="date" name="gorev_baslama_tarihi" id="gorev_baslama_tarihi" readonly value="{{$gorevleritem->gorev_baslama_tarihi}}"
                                        class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed"
                                        onkeydown="return false;" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="gorev_bitis_tarihi">Görev Bitiş Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="date" name="gorev_bitis_tarihi" id="gorev_bitis_tarihi" readonly value="{{$gorevleritem->gorev_bitis_tarihi}}"
                                        class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed"
                                        onkeydown="return false;" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="gorev_derecesi">Görev Derecesi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="gorev_derecesi" id="gorev_derecesi" class="form-select form-select-sm" required disabled>
                                        <option value="Yüksek" {{ $gorevleritem->gorev_derecesi == 'Yüksek' ? 'selected' : '' }}>Yüksek</option>
                                        <option value="Orta" {{ $gorevleritem->gorev_derecesi == 'Orta' ? 'selected' : '' }}>Orta</option>
                                        <option value="Düşük" {{ $gorevleritem->gorev_derecesi == 'Düşük' ? 'selected' : '' }}>Düşük</option>
                                    </select>
                                    <input type="hidden" name="gorev_derecesi" id="hidden_gorev_derecesi" value="{{ $gorevleritem->gorev_derecesi }}">
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var selectElement = document.getElementById('gorev_derecesi');
                                    var hiddenInput = document.getElementById('hidden_gorev_derecesi');
                                    hiddenInput.value = selectElement.value;
                                });
                            </script>
                            <div class="col-md-3">
                                <label for="gorev_durumu">Görev Durumu</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="gorev_durumu" id="gorev_durumu"
                                        class="form-select form-select-sm" required  >
                                        <option value="Beklemede"
                                            {{ $gorevleritem->gorev_durumu == 'Beklemede' ? 'selected' : '' }} >Beklemede
                                        </option>
                                        <option value="Yapılmadı"
                                            {{ $gorevleritem->gorev_durumu == 'Yapılmadı' ? 'selected' : '' }} >
                                            Yapılmadı
                                        </option>
                                        <option value="Yapıldı"
                                            {{ $gorevleritem->gorev_durumu == 'Yapıldı' ? 'selected' : '' }} >
                                            Yapıldı
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="aciklama">Görev Sonucu Notu</label>
                                <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
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
