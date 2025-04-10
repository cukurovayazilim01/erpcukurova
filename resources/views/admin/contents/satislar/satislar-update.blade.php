@extends('admin.layouts.app')
@section('title')
    SATIŞ FATURASI GÜNCELLE
@endsection
@section('contents')
@section('topheader')
    {{ $satislar->firmaadi->firma_unvan }} SATIŞ FATURASI GÜNCELLE
@endsection


<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{ route('satislar.update', ['satislar' => $satislar->id]) }}" method="POST" id="add-form">
                @csrf
                @method('put')
                <div class="col-md-12" style="padding: 1%; ">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="cari_id">Firma</label>
                            <div class="form-group input-with-icon" style="display: flex; align-items: center;">
                                <span class="icon" >
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="cari_unvan" id="cari_unvan" class="form-control form-control-sm"
                                       value="{{ $cariler->firma_unvan }}" readonly>
                                <input type="hidden" name="cari_id" value="{{ $cariler->id }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="user_id">Satış Temsilcisi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <select name="user_id" id="user_id" class="form-select form-select-sm" required>
                                    <option value="">Lütfen Seçim Yapınız</option>
                                    @foreach ($user as $useritem)
                                        <option value="{{ $useritem->id }}"
                                            {{ old('user_id', $satislar->user_id) == $useritem->id ? 'selected' : '' }}>
                                            {{ $useritem->ad_soyad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="satis_tarihi">Satış Tarihi</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="date" name="satis_tarihi" id="satis_tarihi"
                                    class="form-control form-control-sm" required
                                    value="{{ $satislar->satis_tarihi }}">
                            </div>
                        </div>


                        <div class="col-md-8">
                            <label for="satis_konu">Satış Konusu</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                <select name="satis_konu" id="satis_konu" class="form-control form-control-sm"
                                    required="">
                                    <option value="">Lütfen Teklif Konusu Seçiniz...</option>
                                    <option value="Kalite Yönetim Sistemleri Satışı" {{ $satislar->satis_konu == 'Kalite Yönetim Sistemleri Satışı' ? 'selected' : '' }}>Kalite Yönetim Sistemleri Satışı
                                    </option>
                                    <option value="Marka Tescil Satışı" {{ $satislar->satis_konu == 'Marka Tescil Satışı' ? 'selected' : '' }}>Marka Tescil Satışı</option>
                                    <option value="Patent Tescil Satışı" {{ $satislar->satis_konu == 'Patent Tescil Satışı' ? 'selected' : '' }}>Patent Tescil Satışı</option>
                                    <option value="Faydalı Model Tescil Satışı" {{ $satislar->satis_konu == 'Faydalı Model Tescil Satışı' ? 'selected' : '' }}>Faydalı Model Tescil Satışı</option>
                                    <option value="Endüstriyel Tasarım Tescil Satışı" {{ $satislar->satis_konu == 'Endüstriyel Tasarım Tescil Satışı' ? 'selected' : '' }}>Endüstriyel Tasarım Tescil
                                        Satışı</option>
                                    <option value="Barkod Tescil Satışı" {{ $satislar->satis_konu == 'Barkod Tescil Satışı' ? 'selected' : '' }}>Barkod Tescil Satışı</option>
                                    <option value="GLN  Numarası Tescil Satışı" {{ $satislar->satis_konu == 'GLN Numarası Tescil Satışı' ? 'selected' : '' }}>GLN Numarası Tescil Satışı</option>
                                    <option value="Domain (Alan Adı) Tescil Satışı" {{ $satislar->satis_konu == 'Domain (Alan Adı) Tescil Satışı' ? 'selected' : '' }}>Domain (Alan Adı) Tescil Satışı
                                    </option>
                                    <option value="Web Tasarım Satışı" {{ $satislar->satis_konu == 'Web Tasarım Satışı' ? 'selected' : '' }}>Web Tasarım Satışı</option>
                                    <option value="Hosting Satışı" {{ $satislar->satis_konu == 'Hosting Satışı' ? 'selected' : '' }}>Hosting Satışı</option>
                                    <option value="Özel ERP Yazılım Satışı" {{ $satislar->satis_konu == 'Özel ERP Yazılım Satışı' ? 'selected' : '' }}>Özel ERP Yazılım Satışı</option>
                                    <option value="Eğitim Hizmetleri Satışı" {{ $satislar->satis_konu == 'Eğitim Hizmetleri Satışı' ? 'selected' : '' }}>Eğitim Hizmetleri Satışı</option>
                                    <option value="Kurumsal Mail Satışı" {{ $satislar->satis_konu == 'Kurumsal Mail Satışı' ? 'selected' : '' }}>Kurumsal Mail Satışı</option>
                                    <option value="Hibe-Kredi Proje Danışmanlık Satışı" {{ $satislar->satis_konu == 'Hibe-Kredi Proje Danışmanlık Satışı' ? 'selected' : '' }}>Hibe-Kredi Proje Danışmanlık
                                        Satışı</option>
                                    <option value="Logo Tasarım Satışı" {{ $satislar->satis_konu == 'Logo Tasarım Satışı' ? 'selected' : '' }}>Logo Tasarım Satışı</option>
                                    <option value="Mail Hosting Satışı" {{ $satislar->satis_konu == 'Mail Hosting Satışı' ? 'selected' : '' }}>Mail Hosting Satışı</option>
                                    <option value="Web Hizmetleri Satışı" {{ $satislar->satis_konu == 'Web Hizmetleri Satışı' ? 'selected' : '' }}>Web Hizmetleri Satışı</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="tescil_tl">Tescil Ücreti</label>
                            <div class="form-group input-with-icon">
                                <span class="icon">
                                    <i class="fa fa-check"></i>
                                </span>
                                <input type="text" name="tescil_tl" id="tescil_tl"
                                    class="form-control form-control-sm" value="{{$satislar->tescil_tl}}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="border-radius: 5px">
                    <button type="button" id="add" class="btn btn-sm btn-primary btn-block mb-1"
                    style="width: 100%; text-align: center;">
                    <i class="fa fa-plus"></i> <span>Hizmet Ekle</span>
                </button>
                <div class="table-responsive" style="border-radius: 5px">
                    <table id="example3" class="table table-bordered table-hover"
                    style="width:100% ">

                        <thead>
                            <tr>
                                <th><b>#</b></th>
                                <th style="width: 15%">Hizmet Türü</th>
                                <th style="width: 15%">Hizmet/Ürün</th>
                                <th style="width: 15%">Açıklama</th>
                                <th style="width: 10%">Miktar/Birim</th>
                                <th style="display: none">maliyet</th>
                                <th style="display: none">maliyet toplam</th>
                                <th style="width: 9%">Fiyat</th>
                                <th>Kdv/Tutar</th>
                                <th>Toplam Fiyat</th>
                                <th style="width: 5%">İskonto</th>
                                <th>Ödenecek Tutar</th>
                                <th>Ekle/Çıkar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($satislardata as $key => $satislardataitem)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <select name="inputs[{{ $key }}][hizmetlerkategori_id]"
                                            class="form-control form-control-sm hizmetlerkategori-select" required>
                                            <option value="">Hizmet Seçin</option>
                                            @foreach ($hizmetlerkategori as $hizmetlerkategoriitem)
                                                <option value="{{ $hizmetlerkategoriitem->id }}"
                                                    {{ $satislardataitem->hizmetlerkategori_id == $hizmetlerkategoriitem->id ? 'selected' : '' }}>
                                                    {{ $hizmetlerkategoriitem->kategori_ad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="inputs[{{ $key }}][hizmet_id]"
                                            class="form-control form-control-sm hizmet_id-select" required>
                                            <option value="">Hizmet Seçin</option>
                                            @foreach ($satislardata as $item)
                                                <option value="{{ $item->hizmet_id }}"
                                                    {{ $satislardataitem->hizmet_id == $item->hizmet_id ? 'selected' : '' }}>
                                                    {{ $item->hizmetler->hizmet_ad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[{{ $key }}][satir_aciklama]"
                                                id="inputs[{{ $key }}][satir_aciklama]"
                                                class="form-control form-control-sm satir_aciklama" value="{{$satislardataitem->satir_aciklama}}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group m-b-sm">
                                                <div class="col-md-5" style="padding-right: 3px">
                                                    <input type="text"
                                                        name="inputs[{{ $key }}][satis_hizmet_miktar]"
                                                        class="form-control form-control-sm satis_hizmet_miktar input-mask"
                                                        value="{{ $satislardataitem->satis_hizmet_miktar }}"
                                                        required>
                                                </div>
                                                <div class="col-md-7" style="padding: 0px">
                                                    <select name="inputs[{{ $key }}][satis_hizmet_birim]"
                                                        class="form-control form-control-sm">
                                                        <option value="Adet"
                                                            {{ $satislardataitem->satis_hizmet_birim == 'Adet' ? 'selected' : '' }}>
                                                            Adet</option>
                                                        <option value="Kg"
                                                            {{ $satislardataitem->satis_hizmet_birim == 'Kg' ? 'selected' : '' }}>
                                                            Kg</option>
                                                        <option value="Lt"
                                                            {{ $satislardataitem->satis_hizmet_birim == 'Lt' ? 'selected' : '' }}>
                                                            Lt</option>
                                                        <option value="Mt"
                                                            {{ $satislardataitem->satis_hizmet_birim == 'Mt' ? 'selected' : '' }}>
                                                            Mt</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="display: none">
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[{{ $key }}][hizmet_maliyet]"
                                                class="form-control form-control-sm hizmet_maliyet"
                                                value="{{ $satislardataitem->hizmet_maliyet }}">
                                        </div>
                                    </td>
                                    <td style="display: none">
                                        <div class="input-group m-b-sm">
                                            <input type="text"
                                                name="inputs[{{ $key }}][maliyet_toplam_fiyat]"
                                                class="form-control form-control-sm maliyet_toplam_fiyat"
                                                value="{{ $satislardataitem->maliyet_toplam_fiyat }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[{{ $key }}][satis_fiyat]"
                                                class="form-control form-control-sm hizmet_satis_fiyati input-mask"
                                                value="{{ $satislardataitem->satis_fiyat }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group m-b-sm">
                                                <div class="col-md-5" style="padding-right: 3px">
                                                    <select name="inputs[{{ $key }}][satis_kdv_oran]"
                                                        class="form-control form-control-sm satis_kdv_oran" required>
                                                        <option value="20"
                                                            {{ $satislardataitem->satis_kdv_oran == 20 ? 'selected' : '' }}>
                                                            %20</option>
                                                        <option value="18"
                                                            {{ $satislardataitem->satis_kdv_oran == 18 ? 'selected' : '' }}>
                                                            %18</option>
                                                        <option value="10"
                                                            {{ $satislardataitem->satis_kdv_oran == 10 ? 'selected' : '' }}>
                                                            %10</option>
                                                        <option value="8"
                                                            {{ $satislardataitem->satis_kdv_oran == 8 ? 'selected' : '' }}>
                                                            %8</option>
                                                        <option value="1"
                                                            {{ $satislardataitem->satis_kdv_oran == 1 ? 'selected' : '' }}>
                                                            %1</option>
                                                        <option value="0"
                                                            {{ $satislardataitem->satis_kdv_oran == 0 ? 'selected' : '' }}>
                                                            %0</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-7" style="padding: 0px">
                                                    <input type="text"
                                                        name="inputs[{{ $key }}][satis_kdv_tutar]"
                                                        class="form-control form-control-sm satis_kdv_tutar" readonly
                                                        value="{{ $satislardataitem->satis_kdv_tutar }}">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text"
                                                name="inputs[{{ $key }}][satis_kdvsiz_fiyat]"
                                                class="form-control form-control-sm satis_kdvsiz_fiyat" readonly
                                                value="{{ $satislardataitem->satis_kdvsiz_fiyat }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[{{ $key }}][satis_iskonto]"
                                                class="form-control form-control-sm satis_iskonto input-mask"
                                                value="{{ $satislardataitem->satis_iskonto }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text"
                                                name="inputs[{{ $key }}][satis_toplam_fiyat]"
                                                class="form-control form-control-sm satis_toplam_fiyat" readonly
                                                value="{{ $satislardataitem->satis_toplam_fiyat }}">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-sm btn-danger remove-table-row" style="--bs-btn-padding-y: 0.12rem">-</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row" style="display: flex; flex-wrap: wrap;">
                <!-- Açıklama Alanı -->
                <div class="col-md-6" style=" padding: 10px;">
                    <label for="aciklama" style="display: block; margin-bottom: 5px;">Açıklama</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                    <textarea id="aciklama" name="aciklama" class="form-control"
                        >{{$satislar->aciklama}}</textarea>
                </div>
            </div>

                    <!-- Diğer Kısımlar -->
                    <div class="col-md-6 col-sm-12"  style=" padding: 10px;">

                        <div class="row" style="display: none;">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">TOPLAM MALİYET<span
                                        style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="maliyet_kdvli_tutar" id="maliyet_kdvli_tutar"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">TOPLAM İSKONTO<span
                                        style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="satis_iskonto_toplam" id="satis_iskonto_toplam"
                                        class="form-control form-control-sm" readonly
                                        value="{{ $satislar->satis_iskonto_toplam }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">KDV TOPLAM<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="satis_kdv_toplam" id="satis_kdv_toplam"
                                        class="form-control form-control-sm" readonly
                                        value="{{ $satislar->satis_kdv_toplam }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">ARA TOPLAM<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="satis_ara_toplam" id="satis_ara_toplam"
                                        class="form-control form-control-sm" readonly
                                        value="{{ $satislar->satis_ara_toplam }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">TOPLAM TUTAR<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="satis_kdvli_toplam" id="satis_kdvli_toplam"
                                        class="form-control form-control-sm" readonly
                                        value="{{ $satislar->satis_kdvli_toplam }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">

                <a href="{{route('satislar.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25"> Vazgeç</a>
                    <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75"
                       >
                        Güncelle</button>
                </div>

            </form>


        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var i = $('#example3 tbody tr').length;

        $(document).on('input', '.input-mask', function(event) {
            let inputValue = event.target.value;

            // Virgülü noktaya çevir
            inputValue = inputValue.replace(/,/g, '.');

            // İlk noktadan sonrasındaki tüm noktaları kaldır
            let parts = inputValue.split('.');
            if (parts.length > 2) {
                inputValue = parts[0] + '.' + parts.slice(1).join('');
            }

            // Sadece sayılar ve noktayı kabul et
            inputValue = inputValue.replace(/[^0-9.]/g, '');

            // Güncellenmiş değeri geri yaz
            event.target.value = inputValue;
        });

        // Fiyat ve maliyet bilgilerini seçilen hizmete göre getirir
        $(document).on('change', '.hizmet_id-select', function() {
            var row = $(this).closest('tr');
            var hizmetId = $(this).val();
            var fiyatElement = row.find('.hizmet_satis_fiyati');
            var maliyetElement = row.find('.hizmet_maliyet');

            if (hizmetId) {
                $.ajax({
                    url: '/hizmetler/fiyat/' + hizmetId,
                    type: 'GET',
                    success: function(response) {
                        fiyatElement.val(response.hizmet_satis_fiyati || 0);
                        maliyetElement.val(response.hizmet_maliyet || 0);
                        updateRowCalculations(row); // Satırdaki hesaplamaları güncelle
                    },
                    error: function() {
                        alert('Hizmet fiyatı ve maliyeti alınırken bir hata oluştu.');
                    }
                });
            } else {
                fiyatElement.val('');
                maliyetElement.val('');
                updateRowCalculations(row);
            }
        });

        // Hizmet kategorisine göre hizmet listesini doldurur
        $(document).on('change', '.hizmetlerkategori-select', function() {
            var selectElement = $(this).closest('tr').find('.hizmet_id-select');
            var hizmetlerkategoriId = $(this).val();
            if (hizmetlerkategoriId) {
                $.ajax({
                    url: '/get-hizmetler-by-kategori/' + hizmetlerkategoriId,
                    type: 'GET',
                    success: function(data) {
                        selectElement.empty();
                        selectElement.append('<option value="">Hizmet Seçin</option>');
                        data.forEach(function(hizmet) {
                            selectElement.append('<option value="' + hizmet.id +
                                '">' + hizmet.hizmet_ad + '</option>');
                        });
                    },
                    error: function() {
                        alert('Hizmet listesi yüklenirken bir hata oluştu.');
                    }
                });
            } else {
                selectElement.empty();
                selectElement.append('<option value="">Hizmet Seçin</option>');
            }
        });

        // Yeni satır ekleme işlemi
        $(document).on('click', '#add', function() {
            i++;
            var newRow = $('<tr>');
            newRow.append(`
                <td>` + (i) + `</td>
                <td>
                    <select name="inputs[` + i + `][hizmetlerkategori_id]" class="form-control form-control-sm hizmetlerkategori-select" required>
                        <option value="">Hizmet Seçin</option>
                        @foreach ($hizmetlerkategori as $hizmetlerkategoriitem)
                            <option value="{{ $hizmetlerkategoriitem->id }}">{{ $hizmetlerkategoriitem->kategori_ad }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="inputs[` + i + `][hizmet_id]" class="form-control form-control-sm hizmet_id-select" required>
                        <option value="">Hizmet Seçin</option>
                    </select>
                </td>
                                <td>
                                                            <div class="input-group m-b-sm">
                                                                <input type="text" name="inputs[` + i +
                `][satir_aciklama]" id="inputs[` + i + `][satir_aciklama]" class="form-control form-control-sm satir_aciklama">
                                                            </div>
                                                        </td>
                <td>
                     <div class="form-group">
                                                                <div class="input-group m-b-sm">
                                                                    <span class="input-group-addon" ></span>
                                                                    <div class="col-md-5" style="padding: 0px">
                                                                        <input type="text" name="inputs[` +
                i +
                `][satis_hizmet_miktar]" class="form-control form-control-sm satis_hizmet_miktar input-mask" required>
                                                                    </div>
                                                                    <div class="col-md-7" style="padding: 0px">
                                                                        <select name="inputs[` +
                i +
                `][satis_hizmet_birim]"
                                                                        id="inputs[` +
                i +
                `][satis_hizmet_birim]"
                                                                        class="form-control form-control-sm">
                                                                        <option value="Adet">Adet</option>
                                                                        <option value="Kg">Kg</option>
                                                                        <option value="Lt">Lt</option>
                                                                        <option value="Mt">Mt</option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                </td>
                 <td style="display: none">
                                                            <div class="input-group m-b-sm">
                                                                <input type="text" name="inputs[` +
                i +
                `][hizmet_maliyet]" id="inputs[` +
                i +
                `][hizmet_maliyet]" class="form-control form-control-sm hizmet_maliyet">
                                                            </div>
                                                        </td>

                                                        <td style="display: none">
                                                            <div class="input-group m-b-sm">
                                                                <input type="text" name="inputs[` +
                i +
                `][maliyet_toplam_fiyat]" id="inputs[` +
                i +
                `][maliyet_toplam_fiyat]" class="form-control form-control-sm maliyet_toplam_fiyat">
                                                            </div>
                                                        </td>

                <td>
                      <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` +
                i +
                `][satis_fiyat]" class="form-control form-control-sm hizmet_satis_fiyati input-mask" >
                                                            </div>
                </td>
                <td>
                                                            <div class="form-group">
                                                                <div class="input-group m-b-sm">
                                                                    <span class="input-group-addon" ></span>
                                                                    <div class="col-md-5" style="padding: 0px">
                                                                        <select name="inputs[` +
                i +
                `][satis_kdv_oran]" id="inputs[` +
                i +
                `][satis_kdv_oran]"
                                                                            class="form-control form-control-sm satis_kdv_oran">
                                                                             <option value="20">%20</option>
                                                                            <option value="18">%18</option>
                                                                            <option value="10">%10</option>
                                                                            <option value="8">%8</option>
                                                                            <option value="1">%1</option>
                                                                            <option value="0">%0</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-7" style="padding: 0px">
                                                                        <input type="text" class="form-control form-control-sm satis_kdv_tutar" name="inputs[` +
                i +
                `][satis_kdv_tutar]" id="inputs[` +
                i +
                `][satis_kdv_tutar]" aria-describedby="basic-addon2"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                      <td>
                                                            <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` +
                i +
                `][satis_kdvsiz_fiyat]" class="form-control form-control-sm satis_kdvsiz_fiyat" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` +
                i +
                `][satis_iskonto]" class="form-control form-control-sm satis_iskonto input-mask">
                                                            </div>
                                                        </td>


                                                        <td>
                                                            <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` +
                i +
                `][satis_toplam_fiyat]" class="form-control form-control-sm satis_toplam_fiyat" readonly>
                                                            </div>
                                                        </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-table-row" style="--bs-btn-padding-y: 0.12rem">-</button>
                </td>
            `);
            $('#example3').append(newRow);
            updateCalculations(i);
            hesaplaToplamTutar();
        });

        $(document).on('click', '.remove-table-row', function() {
            $(this).closest('tr').remove(); // Satırı sil
            i--; // Toplam satır sayısını azalt
            yenidenNumaralandir(); // Satır numaralarını güncelle
            hesaplaToplamTutar(); // Toplam hesaplamaları tekrar yap
        });

        // Satır numaralarını güncelleme fonksiyonu
        function yenidenNumaralandir() {
            $('#example3 tbody tr').each(function(index) {
                $(this).find('td:first').text(index + 1); // İlk sütunu (numara) güncelle
            });
        }

        // Miktar, fiyat veya KDV değiştiğinde hesaplama işlemleri
        $(document).on('input change',
            '.satis_hizmet_miktar, .hizmet_satis_fiyati, .hizmet_maliyet, .satis_kdv_oran, .satis_iskonto, .hizmet_id-select, .hizmetlerkategori-select',
            function() {
                var row = $(this).closest('tr');
                updateRowCalculations(row);
            });

        function updateRowCalculations(row) {


            // Girdileri satıra göre al
            var quantityInput = row.find('.satis_hizmet_miktar');
            var unitPriceInput = row.find('.hizmet_satis_fiyati');
            var hizmet_maliyetInput = row.find('.hizmet_maliyet');
            var vatRateSelect = row.find('.satis_kdv_oran');
            var discountInput = row.find('.satis_iskonto');

            var netPriceInput = row.find('.satis_kdvsiz_fiyat');
            var maliyet_toplam_fiyatInput = row.find('.maliyet_toplam_fiyat');
            var vatAmountInput = row.find('.satis_kdv_tutar');
            var totalPriceInput = row.find('.satis_toplam_fiyat');

            // Girdilerin değerlerini al
            var quantity = parseFloat(quantityInput.val()) || 0;
            var unitPrice = parseFloat(unitPriceInput.val()) || 0;
            var hizmet_maliyet = parseFloat(hizmet_maliyetInput.val()) || 0;
            var vatRate = parseFloat(vatRateSelect.val()) || 0;
            var discount = parseFloat(discountInput.val()) || 0;

            // Hesaplamalar
            var netPrice = quantity * unitPrice; // KDV'siz toplam fiyat
            var maliyet_toplam_fiyat = quantity * hizmet_maliyet; // Toplam maliyet
            var totalBeforeVat = netPrice - discount; // İskonto sonrası KDV'siz fiyat
            var vatAmount = (totalBeforeVat * vatRate) / 100; // KDV miktarı
            var totalWithVat = totalBeforeVat + vatAmount; // KDV dahil toplam fiyat

            // Hesaplama sonuçlarını güncelle
            netPriceInput.val(netPrice.toFixed(2)); // KDV'siz fiyat
            maliyet_toplam_fiyatInput.val(maliyet_toplam_fiyat.toFixed(2)); // Toplam maliyet
            vatAmountInput.val(vatAmount.toFixed(2)); // KDV tutarı
            totalPriceInput.val(totalWithVat.toFixed(2)); // Toplam fiyat (KDV dahil)

            hesaplaToplamTutar(); // Genel toplamı güncelle
        }

        // Toplam tutar hesaplama
        function hesaplaToplamTutar() {
            var genelToplam = 0; // KDV dahil toplam
            var genelMaliyet = 0; // Toplam maliyet
            var toplamIskonto = 0; // Toplam iskonto
            var toplamKdv = 0; // Toplam KDV
            var araToplam = 0; // KDV'siz toplam

            $('#example3 tbody tr').each(function() {
                var toplamFiyat = parseFloat($(this).find('.satis_toplam_fiyat').val()) ||
                    0; // KDV dahil fiyat
                var toplamMaliyet = parseFloat($(this).find('.maliyet_toplam_fiyat').val()) || 0;
                var iskonto = parseFloat($(this).find('.satis_iskonto').val()) || 0;
                var kdvTutar = parseFloat($(this).find('.satis_kdv_tutar').val()) || 0;
                var kdvsizFiyat = parseFloat($(this).find('.satis_kdvsiz_fiyat').val()) ||
                    0; // KDV'siz fiyat

                genelToplam += toplamFiyat;
                genelMaliyet += toplamMaliyet;
                toplamIskonto += iskonto;
                toplamKdv += kdvTutar;
                araToplam += kdvsizFiyat;
            });

            // Güncellenen toplam değerleri ilgili alanlara yaz
            $('#satis_kdvli_toplam').val(genelToplam.toFixed(2)); // KDV dahil toplam
            $('#toplam_maliyet').val(genelMaliyet.toFixed(2)); // Toplam maliyet
            $('#satis_iskonto_toplam').val(toplamIskonto.toFixed(2)); // Toplam iskonto
            $('#satis_kdv_toplam').val(toplamKdv.toFixed(2)); // Toplam KDV
            $('#satis_ara_toplam').val(araToplam.toFixed(2)); // KDV'siz toplam
        }

        // Foreach ile gelen verilerde hesaplama
        $('#example3 tbody tr').each(function() {
            updateRowCalculations($(this));
        });
    });
</script>


@endsection
