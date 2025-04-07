<!-- Modal -->
<div class="modal fade" id="gorevlerupdateModal-{{ $gorevleritem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('gorevatama.update', ['gorevatama' => $gorevleritem->id]) }}" method="POST"
            enctype="multipart/form-data" id="add-form">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header ">
                    <h5 class="modal-title">GÖREV ATAMA GÜNCELLE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                            <div class="col-md-4">
                                <label for="gorev_adi">Görev Adı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="text" name="gorev_adi" id="gorev_adi"
                                        class="form-control form-control-sm" value="{{$gorevleritem->gorev_adi}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="gorevlendirilen_id">Görevlendiren</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
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
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="gorevlendirilen_id" id="gorevlendirilen_id" class="form-control form-control-sm">
                                        <option value="">Lütfen Seçim Yapınız..</option>
                                        @foreach ($user as $useritem)
                                            <option value="{{ $useritem->id }}"
                                                {{ old('gorevlendirilen_id', $gorevleritem->gorevlendirilen_id) == $useritem->id ? 'selected' : '' }}>
                                                {{ $useritem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <label for="gorev_tanimi">Görev Tanımı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                <textarea name="gorev_tanimi" id="gorev_tanimi" cols="20" rows="1" class="form-control form-control-sm ">{{$gorevleritem->gorev_tanimi}}</textarea>
                            </div>
                        </div>

                            <div class="col-md-12 select2-sm">
                                <label for="cari_id">Firma Ünvanı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <input type="" name="gorev_baslama_tarihi" id="gorev_baslama_tarihi" value="{{ $gorevleritem->firmaadi->firma_unvan ?? 'Bilinmiyor' }}"
                                        class="form-control form-control-sm" required readonly>
                                </div>
                                <input type="hidden" name="cari_id" value="{{ $gorevleritem->cari_id }}">

                            </div>

                            <div class="col-md-3">
                                <label for="gorev_baslama_tarihi">Görev Başlama Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="gorev_baslama_tarihi" id="gorev_baslama_tarihi" value="{{$gorevleritem->gorev_baslama_tarihi}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="gorev_bitis_tarihi">Görev Bitiş Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="gorev_bitis_tarihi" id="gorev_bitis_tarihi" value="{{$gorevleritem->gorev_bitis_tarihi}}"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="gorev_derecesi">Görev Derecesi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="gorev_derecesi" id="gorev_derecesi"
                                        class="form-control form-control-sm" required>

                                        <option value="Yüksek"
                                            {{ $gorevleritem->gorev_derecesi == 'Yüksek' ? 'selected' : '' }}>Yüksek
                                        </option>
                                        <option value="Orta"
                                            {{ $gorevleritem->gorev_derecesi == 'Orta' ? 'selected' : '' }}>
                                            Orta
                                        </option>
                                        <option value="Düşük"
                                            {{ $gorevleritem->gorev_derecesi == 'Düşük' ? 'selected' : '' }}>
                                            Düşük
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="gorev_durumu">Görev Durumu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </span>
                                    <select name="gorev_durumu" id="gorev_durumu"
                                        class="form-control form-control-sm" required>

                                        <option value="Beklemede"
                                            {{ $gorevleritem->gorev_derecesi == 'Beklemede' ? 'selected' : '' }}>Beklemede
                                        </option>
                                        <option value="Yapılmadı"
                                            {{ $gorevleritem->gorev_derecesi == 'Yapılmadı' ? 'selected' : '' }}>
                                            Yapılmadı
                                        </option>
                                        <option value="Yapıldı"
                                            {{ $gorevleritem->gorev_derecesi == 'Yapıldı' ? 'selected' : '' }}>
                                            Yapıldı
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div
                            style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                        </div>
                    </div>
                    </div>
            </form>
        </div>
    </div>
