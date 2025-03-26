   <!-- Modal -->
   <div class="modal fade" id="yillikizinupdateModal-{{ $yillikizinitem->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('yillikizin.update',['yillikizin' => $yillikizinitem->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">{{$yillikizinitem->personel->ad_soyad}} Yıllık İzin Güncelleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style="padding: 2%;">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="personel_id">Personel Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="personel_id" id="personel_id" class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçiniz</option>
                                        @foreach ($personel as $personelitem)
                                            <option value="{{ $personelitem->id }}" {{ old('personel_id', $yillikizinitem->personel_id) == $personelitem->id ? 'selected' : '' }}>
                                                {{ $personelitem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="baslangic_tarihi" id="baslangic_tarihi" value="{{$yillikizinitem->baslangic_tarihi}}"
                                        class="form-control form-control-sm"
                                         required >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="bitis_tarihi">Bitiş Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="date" name="bitis_tarihi" id="bitis_tarihi" value="{{$yillikizinitem->bitis_tarihi}}"
                                        class="form-control form-control-sm"
                                         required >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="izin_hakki">İzin Hakkı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="number" name="izin_hakki" id="izin_hakki" value="{{$yillikizinitem->izin_hakki}}"
                                        class="form-control form-control-sm"
                                         required >
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="izin_gun">İzin Gün</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="izin_gun" id="izin_gun" value="{{$yillikizinitem->izin_gun}}"
                                        class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed"
                                        onkeydown="return false;" readonly required >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="hangi_ay">Hangi Ay</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="hangi_ay" id="hangi_ay" class="form-select form-select-sm" required>
                                        <option value="Ocak"  {{$yillikizinitem->hangi_ay == 'Ocak' ? 'selected' : ''}}>Ocak</option>
                                        <option value="Şubat"  {{$yillikizinitem->hangi_ay == 'Şubat' ? 'selected' : ''}}>Şubat</option>
                                        <option value="Mart"  {{$yillikizinitem->hangi_ay == 'Mart' ? 'selected' : ''}}>Mart</option>
                                        <option value="Nisan"  {{$yillikizinitem->hangi_ay == 'Nisan' ? 'selected' : ''}}>Nisan</option>
                                        <option value="Mayıs"  {{$yillikizinitem->hangi_ay == 'Mayıs' ? 'selected' : ''}}>Mayıs</option>
                                        <option value="Haziran"  {{$yillikizinitem->hangi_ay == 'Haziran' ? 'selected' : ''}}>Haziran</option>
                                        <option value="Temmuz"  {{$yillikizinitem->hangi_ay == 'Temmuz' ? 'selected' : ''}}>Temmuz</option>
                                        <option value="Ağustos"  {{$yillikizinitem->hangi_ay == 'Ağustos' ? 'selected' : ''}}>Ağustos</option>
                                        <option value="Eylül"  {{$yillikizinitem->hangi_ay == 'Eylül' ? 'selected' : ''}}>Eylül</option>
                                        <option value="Ekim"  {{$yillikizinitem->hangi_ay == 'Ekim' ? 'selected' : ''}}>Ekim</option>
                                        <option value="Kasım"  {{$yillikizinitem->hangi_ay == 'Kasım' ? 'selected' : ''}}>Kasım</option>
                                        <option value="Aralık"  {{$yillikizinitem->hangi_ay == 'Aralık' ? 'selected' : ''}}>Aralık</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="izin_aciklama">İzin Açıklaması</label>
                                    <textarea name="izin_aciklama" id="izin_aciklama" cols="20" rows="2" class="form-control form-control-sm ">{{$yillikizinitem->izin_aciklama}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">Vazgeç</button>
                    <button type="submit" id="submit-form"
                        class="btn btn-outline-primary btn-sm ">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
</div>
