@extends('admin.layouts.app')
@section('title')
    TEKLİF OLUŞTUR
@endsection
@section('contents')
@section('topheader')
    TEKLİF OLUŞTUR
@endsection


<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{ route('teklifler.store') }}" method="POST" id="add-form">
                @csrf
                <div class="col-md-12" style="padding: 1%; ">
                    <div class="row">
                        @if ($cari)
                            <div class="col-md-8 col-sm-12">
                                <label for="cari_id">Firma Ünvanı</label>
                                <div class="input-group mb-2" style="display: flex; align-items: center;">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="cari_id" id="cari_id"
                                        class="form-control form-control-sm" value="{{ $cari->firma_unvan }}" readonly>
                                    <input type="hidden" name="cari_id" value="{{ $cari->id }}">
                                </div>
                            </div>
                        @else
                            <div class="col-md-8 col-sm-12 select2-sm">
                                <label for="cari_id">Firma Ünvanı</label>
                                <select name="cari_id" id="cari_id" required
                                    style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                </select>
                            </div>
                        @endif
                        <div class="col-md-4 col-sm-12">
                            <label for="user_id">Satış Temsilcisi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                <select name="user_id" id="user_id" class="form-control form-control-sm" required>
                                    <option value="">Lütfen Seçim Yapınız</option>
                                    @foreach ($user as $useritem)
                                        <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="teklif_tarihi">Teklif Tarihi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="datetime-local" name="teklif_tarihi" id="teklif_tarihi"
                                    class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <input type="hidden" name="teklif_kodu" id="teklif_kodu">
                        <input type="hidden" name="durum" id="durum">


                        <div class="col-md-4">
                            <label for="tescil_tl">Tescil Ücreti</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-check"></i>
                                </span>
                                <input type="text" name="tescil_tl" id="tescil_tl"
                                    class="form-control form-control-sm" value="13000">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="odeme_türü">Ödeme Planı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-money-bill"></i>
                                </span>
                                <select name="odemeplan_durum" id="odemeplan_durum" class="form-control form-control-sm"
                                    required>
                                    <option value="">Lütfen Seçim Yapınız</option>
                                    <option value="Var">Var</option>
                                    <option value="Yok">Yok</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-8">
                            <label for="teklif_konu">Teklif Konusu</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                <select name="teklif_konu" id="teklif_konu" class="form-control form-control-sm"
                                    required="">
                                    <option value="">Lütfen Teklif Konusu Seçiniz...</option>
                                    <option value="Kalite Yönetim Sistemleri Teklifi">Kalite Yönetim Sistemleri Teklifi
                                    </option>
                                    <option value="Marka Tescil Teklifi">Marka Tescil Teklifi</option>
                                    <option value="Patent Tescil Teklifi">Patent Tescil Teklifi</option>
                                    <option value="Faydalı Model Tescil Teklifi">Faydalı Model Tescil Teklifi</option>
                                    <option value="Endüstriyel Tasarım Tescil Teklifi">Endüstriyel Tasarım Tescil
                                        Teklifi</option>
                                    <option value="Barkod Tescil Teklifi">Barkod Tescil Teklifi</option>
                                    <option value="GLN  Numarası Tescil Teklifi">GLN Numarası Tescil Teklifi</option>
                                    <option value="Domain (Alan Adı) Tescil Teklifi">Domain (Alan Adı) Tescil Teklifi
                                    </option>
                                    <option value="Web Tasarım Teklifi">Web Tasarım Teklifi</option>
                                    <option value="Hosting Teklifi">Hosting Teklifi</option>
                                    <option value="Özel ERP Yazılım Teklifi">Özel ERP Yazılım Teklifi</option>
                                    <option value="Eğitim Hizmetleri Teklifi">Eğitim Hizmetleri Teklifi</option>
                                    <option value="Kurumsal Mail Teklifi">Kurumsal Mail Teklifi</option>
                                    <option value="Hibe-Kredi Proje Danışmanlık Teklifi">Hibe-Kredi Proje Danışmanlık
                                        Teklifi</option>
                                    <option value="Logo Tasarım Teklifi">Logo Tasarım Teklifi</option>
                                    <option value="Mail Hosting Teklifi">Mail Hosting Teklifi</option>
                                    <option value="Web Hizmetleri Teklifi">Web Hizmetleri Teklifi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">KDV Seçimi Yapınız<span
                                    style="color: red">*</span></label>
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                                <select name="kdv_status" id="kdv_status" class="form-control form-control-sm ">
                                    <option value="kdvli">KDV'li İşlem</option>
                                    <option value="kdvsiz">KDV'siz İşlem</option>
                                </select>
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
                        <table id="table" class="table table-bordered table-striped"
                            style="width:100% ">

                            <thead>
                                <tr>
                                    <th><b>#</b></th>
                                    <th style="width: 15%">Hizmet Türü</th>
                                    <th style="width: 15%">Hizmet / Ürün</th>
                                    <th style="width: 15%">Açıklama</th>
                                    <th style="width: 10%">Miktar / Birim</th>
                                    <th style="display: none">maliyet</th>
                                    <th style="display: none">maliyet toplam</th>
                                    <th style="width: 9%">Fiyat</th>
                                    <th id="kdv_tutar_th">Kdv / Tutar</th>
                                    <th>Toplam Fiyat</th>
                                    <th style="width: 5%">İskonto</th>
                                    <th>Ödenecek Tutar</th>
                                    <th>Ekle / Çıkar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <select name="inputs[0][hizmetlerkategori_id]"
                                            class="form-control form-control-sm hizmetlerkategori-select" required>
                                            <option value="">Hizmet Seçin</option>
                                            @foreach ($hizmetlerkategori as $hizmetlerkategoriitem)
                                                <option value="{{ $hizmetlerkategoriitem->id }}">
                                                    {{ $hizmetlerkategoriitem->kategori_ad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="inputs[0][hizmet_id]"
                                            class="form-control form-control-sm hizmet_id-select" required>
                                            <option value="">Hizmet Seçin</option>

                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[0][satir_aciklama]"
                                                id="inputs[0][satir_aciklama]"
                                                class="form-control form-control-sm satir_aciklama">
                                        </div>
                                    </td>


                                    <td>
                                        <div class="form-group">
                                            <div class="input-group m-b-sm">
                                                <span class="input-group-addon"></span>
                                                <div class="col-md-5" style="padding-right: 3px">
                                                    <input type="text" name="inputs[0][teklif_hizmet_miktar]"
                                                        class="form-control form-control-sm input-mask" required>
                                                </div>
                                                <div class="col-md-7" style="padding: 0px">
                                                    <select name="inputs[0][teklif_hizmet_birim]"
                                                        id="inputs[0][teklif_hizmet_birim]"
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
                                            <input type="text" name="inputs[0][hizmet_maliyet]"
                                                id="inputs[0][hizmet_maliyet]"
                                                class="form-control form-control-sm hizmet_maliyet">
                                        </div>
                                    </td>

                                    <td style="display: none">
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[0][maliyet_toplam_fiyat]"
                                                id="inputs[0][maliyet_toplam_fiyat]"
                                                class="form-control form-control-sm maliyet_toplam_fiyat">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <input type="text" name="inputs[0][teklif_fiyat]"
                                                class="form-control form-control-sm hizmet_satis_fiyati input-mask">
                                        </div>
                                    </td>

                                    <td id="kdv_tutar_td_0">
                                        <div class="form-group">
                                            <div class="input-group m-b-sm d-flex ">
                                                <div class="col-md-5" style="padding-right: 3px">
                                                    <select name="inputs[0][teklif_kdv_oran]"
                                                        id="inputs[0][teklif_kdv_oran]"
                                                        class="form-control form-control-sm select2-off">
                                                        <option value="0">0</option>
                                                        <option value="20">20</option>
                                                        <option value="18">18</option>
                                                        <option value="10">10</option>
                                                        <option value="8">8</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-7" style="padding: 0px">
                                                    <input type="text"
                                                        class="form-control form-control-sm teklif_kdv_tutar"
                                                        name="inputs[0][teklif_kdv_tutar]"
                                                        id="inputs[0][teklif_kdv_tutar]"
                                                        aria-describedby="basic-addon2" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <input type="text" name="inputs[0][teklif_kdvsiz_fiyat]"
                                                class="form-control form-control-sm teklif_kdvsiz_fiyat" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <input type="text" name="inputs[0][teklif_iskonto]"
                                                class="form-control form-control-sm teklif_iskonto input-mask">
                                        </div>
                                    </td>


                                    <td>
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <input type="text" name="inputs[0][teklif_toplam_fiyat]"
                                                class="form-control form-control-sm teklif_toplam_fiyat" readonly>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row px-3">
                    <!-- Açıklama Alanı -->
                    <div class="col-md-6 col-sm-12" style="  padding: 10px;">


                        <div class="col-md-12" id="odeme_tablo" style="display: none; border-radius: 5px">
                            <button type="button" id="addtaksit" class="btn btn-sm btn-primary btn-block mb-1"
                                style="width: 100%; text-align: center;">
                                <i class="fa fa-plus"></i> Taksit Ekle
                            </button>
                            <table id="odeme_table" class="table table-bordered table-striped"
                                style="width:100%; cursor: pointer; border-radius: 5px">

                                <thead style="border-radius: 5px">
                                    <tr style="border-radius: 5px">
                                        <th><b>#</b></th>
                                        <th>Ödeme Tarihi</th>
                                        <th>Tutar</th>
                                        <th>Ödeme Şekli</th>
                                        <th>Ekle/Çıkar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <span class="input-group-addon"></span>
                                                <input type="date" name="inputss[0][odeme_tarihi]"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <span class="input-group-addon"></span>
                                                <input type="text" name="inputss[0][tutar]"
                                                    class="form-control form-control-sm input-mask">
                                            </div>
                                        </td>
                                        <td>
                                            <select name="inputss[0][odeme_turu]"
                                                class="form-control form-control-sm ">
                                                <option value="">Lütfen Seçiniz</option>
                                                <option value="Nakit">Nakit</option>
                                                <option value="EFT">EFT</option>

                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <label for="aciklama" style="display: block; margin-bottom: 5px">Açıklama Ekle</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                            <textarea name="teklif_aciklama" id="teklif_aciklama" class="form-control" aria-label="With textarea"></textarea>
                        </div>

                    </div>

                    <!-- Diğer Kısımlar -->
                    <div class="col-md-6 col-sm-12" style=" padding: 10px;">


                        <div class="row">
                            <div class="col-md-12 ">
                                <label for="exampleInputEmail1">TOPLAM İSKONTO<span
                                        style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="number" name="teklif_iskonto_toplam" id="teklif_iskonto_toplam"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="exampleInputEmail1">KDV TOPLAM<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="number" name="teklif_kdv_toplam" id="teklif_kdv_toplam"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="exampleInputEmail1">ARA TOPLAM<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="number" name="teklif_ara_toplam" id="teklif_ara_toplam"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">TOPLAM TUTAR<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="number" name="teklif_kdvli_toplam" id="teklif_kdvli_toplam"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">

                        <a href="{{route('teklifler.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25"> Vazgeç</a>
                            <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75"
                               >
                                Kaydet</button>
                        </div>
                </div>



            </form>

        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const odemePlani = document.getElementById("odemeplan_durum");
            const odemeTablo = document.getElementById("odeme_tablo");

            // Sayfa yüklendiğinde ilk kontrol
            if (odemePlani.value !== "Var") {
                odemeTablo.style.display = "none";
            }

            // Seçenek değiştiğinde göster/gizle
            odemePlani.addEventListener("change", function() {
                odemeTablo.style.display = this.value === "Var" ? "block" : "none";
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- ÖDEME PLANI TAKSİT EKLEME --}}
    <script>
        var i = 0;
        $(document).on('click', '#addtaksit', function() {

            ++i;
            var newRow = $('<tr>');
            newRow.append('<td>' + i + '</td>');
            newRow.append(`
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="date" name="inputss[` + i + `][odeme_tarihi]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputss[` + i + `][tutar]" class="form-control form-control-sm input-mask" >
                                </div>
                            </td>
                             <td>
                                <select name="inputss[` + i + `][odeme_turu]" class="form-control form-control-sm" >
                                    <option value="">Lütfen Seçiniz</option>
                                    <option value="Nakit">Nakit</option>
                                    <option value="EFT">EFT</option>
                                </select>
                            </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                            `);
            $('#odeme_table').append(newRow);


        });
    </script>

    <script>
        $(document).ready(function() {
            // Select2 başlatma
            $('#cari_id').select2({
                theme: 'bootstrap4',
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%',
                dropdownParent: $('body'), // Dropdown'un doğru çalışmasını sağlar
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.firma_unvan
                                };
                            })
                        };
                    },
                    cache: true
                },
                language: {
                    inputTooShort: function() {
                        return "Lütfen en az 3 karakter girin.";
                    },
                    noResults: function() {
                        return "Sonuç bulunamadı.";
                    }
                }
            });

            // Select2 açıldığında arama inputuna otomatik odaklanma
            $('#cari_id').on('select2:open', function() {
                setTimeout(() => {
                    let searchField = $('.select2-container--open .select2-search__field');
                    if (searchField.length) {
                        searchField[0].focus();
                    }
                }, 150); // 50 yerine 150 ms bekleyelim
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var i = 0;

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

            document.getElementById('kdv_status').addEventListener('change', function() {
                // KDV statusunu kontrol et
                var kdvStatus = this.value;

                // Toplam satır sayısını al (örneğin, "table" elementinin içindeki tr sayısı)
                var totalRows = document.querySelectorAll('#table tbody tr').length;

                for (var i = 0; i < totalRows; i++) {
                    updateRow(i, kdvStatus);
                    updateCalculations(i);
                }

                // KDV tutarının başlık alanını da gizle veya göster
                var kdvTutarTh = document.getElementById('kdv_tutar_th');
                if (kdvStatus === 'kdvsiz') {
                    kdvTutarTh.style.display = 'none';
                } else {
                    kdvTutarTh.style.display = 'table-cell';
                }
            });

            function updateRow(rowIndex, kdvStatus) {
                // inputs[rowIndex][teklif_kdv_oran]'ın değerini 0 yap
                document.getElementById('inputs[' + rowIndex + '][teklif_kdv_oran]').value = '0';
                document.getElementById('inputs[' + rowIndex + '][teklif_kdv_tutar]').value = '0';

                // Gerekli alanları gizle veya göster
                var kdvTutarTd = document.getElementById('kdv_tutar_td_' + rowIndex);

                if (kdvStatus === 'kdvsiz') {
                    kdvTutarTd.style.display = 'none'; // Her satır için kdv_tutar_td_'i gizle
                } else {
                    kdvTutarTd.style.display = 'table-cell'; // Her satır için kdv_tutar_td_'i göster
                }
            }

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







            $(document).on('click', '#add', function() {
                ++i;
                var newRow = $('<tr>');
                newRow.append('<td>' + i + '</td>');
                newRow.append(`
            <td>
                                                            <select name="inputs[` + i + `][hizmetlerkategori_id]" class="form-control form-control-sm hizmetlerkategori-select" required>
                                                                <option value="">Hizmet Seçin</option>
                                                                @foreach ($hizmetlerkategori as $hizmetlerkategoriitem)
                                                                <option value="{{ $hizmetlerkategoriitem->id }}">{{ $hizmetlerkategoriitem->kategori_ad }}
                                                                </option>
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
                                                                    <div class="col-md-5" style="padding-right:2px">
                                                                        <input type="text" name="inputs[` + i + `][teklif_hizmet_miktar]" class="form-control form-control-sm input-mask" required>
                                                                    </div>
                                                                    <div class="col-md-7" style="padding: 0px">
                                                                        <select name="inputs[` + i + `][teklif_hizmet_birim]"
                                                                        id="inputs[` + i + `][teklif_hizmet_birim]"
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
                                                                <input type="text" name="inputs[` + i +
                    `][hizmet_maliyet]" id="inputs[` + i + `][hizmet_maliyet]" class="form-control form-control-sm hizmet_maliyet">
                                                            </div>
                                                        </td>

                                                        <td style="display: none">
                                                            <div class="input-group m-b-sm">
                                                                <input type="text" name="inputs[` + i +
                    `][maliyet_toplam_fiyat]" id="inputs[` + i + `][maliyet_toplam_fiyat]" class="form-control form-control-sm maliyet_toplam_fiyat">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` + i + `][teklif_fiyat]" class="form-control form-control-sm hizmet_satis_fiyati input-mask" >
                                                            </div>
                                                        </td>


                                                         <td id="kdv_tutar_td_` + i + `">
                                                            <div class="form-group">
                                                                <div class="input-group m-b-sm">
                                                                    <div class="col-md-5" style="padding-right:2px">
                                                                        <select name="inputs[` + i +
                    `][teklif_kdv_oran]" id="inputs[` + i +
                    `][teklif_kdv_oran]"
                                                                            class="form-control form-control-sm select2-off">
                                                                            <option value="20">20</option>
                                                                            <option value="18">18</option>
                                                                            <option value="10">10</option>
                                                                            <option value="8">8</option>
                                                                            <option value="1">1</option>
                                                                            <option value="0">0</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-7" style="padding: 0px">
                                                                        <input type="text" class="form-control form-control-sm  teklif_kdv_tutar" name="inputs[` +
                    i + `][teklif_kdv_tutar]" id="inputs[` + i + `][teklif_kdv_tutar]" aria-describedby="basic-addon2"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>




                                                        <td>
                                                            <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` + i + `][teklif_kdvsiz_fiyat]" class="form-control form-control-sm teklif_kdvsiz_fiyat" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` + i + `][teklif_iskonto]" class="form-control form-control-sm teklif_iskonto input-mask">
                                                            </div>
                                                        </td>


                                                        <td>
                                                            <div class="input-group m-b-sm">
                                                                <span class="input-group-addon" ></span>
                                                                <input type="text" name="inputs[` + i + `][teklif_toplam_fiyat]" class="form-control form-control-sm teklif_toplam_fiyat" readonly>
                                                            </div>
                                                        </td>
                <td><button type="button" class="btn btn-sm btn-danger remove-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
            `);
                $('#table').append(newRow);
                updateCalculations(i);
                hesaplaToplamTutar();

                var selectElement = newRow.find('.hizmet_id-select');
                var hizmetlerkategoriId = newRow.find('.hizmetlerkategori-select').val();
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
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });



            function updateCalculations(rowIndex) {
                var quantityInput = document.querySelector('input[name="inputs[' + rowIndex +
                    '][teklif_hizmet_miktar]"]');
                var unitPriceInput = document.querySelector('input[name="inputs[' + rowIndex + '][teklif_fiyat]"]');
                var hizmet_maliyetInput = document.querySelector('input[name="inputs[' + rowIndex +
                    '][hizmet_maliyet]"]');
                var vatRateSelect = document.querySelector('select[name="inputs[' + rowIndex +
                    '][teklif_kdv_oran]"]');
                var vatAmountInput = document.querySelector('input[name="inputs[' + rowIndex +
                    '][teklif_kdv_tutar]"]');
                var maliyet_toplam_fiyatInput = document.querySelector('input[name="inputs[' + rowIndex +
                    '][maliyet_toplam_fiyat]"]');
                var netPriceInput = document.querySelector('input[name="inputs[' + rowIndex +
                    '][teklif_kdvsiz_fiyat]"]');
                var discountInput = document.querySelector('input[name="inputs[' + rowIndex +
                    '][teklif_iskonto]"]');
                var totalPriceInput = document.querySelector('input[name="inputs[' + rowIndex +
                    '][teklif_toplam_fiyat]"]');

                quantityInput.addEventListener('input', function() {
                    updateValues();
                });

                unitPriceInput.addEventListener('input', function() {
                    updateValues();
                });

                hizmet_maliyetInput.addEventListener('input', function() {
                    updateValues();
                });

                vatRateSelect.addEventListener('input', function() {
                    updateValues();
                });

                discountInput.addEventListener('input', function() {
                    updateValues();
                });

                $(document).on('input', '.teklif_toplam_fiyat', function() {
                    hesaplaToplamTutar();
                });

                function updateValues() {
                    var quantity = parseFloat(quantityInput.value) || 0;
                    var unitPrice = parseFloat(unitPriceInput.value) || 0;
                    var hizmet_maliyet = parseFloat(hizmet_maliyetInput.value) || 0;
                    var vatRate = parseInt(vatRateSelect.value) || 0;
                    var discount = parseFloat(discountInput.value) || 0;

                    var netPrice = quantity * unitPrice;
                    var maliyet_toplam_fiyat = quantity * hizmet_maliyet;
                    var totalBeforeVat = netPrice - discount; // İskonto KDV'siz fiyat üzerinden yapılır.
                    var vatAmount = (totalBeforeVat * vatRate) / 100;
                    var totalWithVat = totalBeforeVat + vatAmount;

                    netPriceInput.value = netPrice.toFixed(2);
                    maliyet_toplam_fiyatInput.value = maliyet_toplam_fiyat.toFixed(2);
                    vatAmountInput.value = vatAmount.toFixed(2);
                    totalPriceInput.value = totalWithVat.toFixed(2);

                    hesaplaToplamTutar();
                }

                function hesaplaToplamTutar() {
                    //TOPLAM FİYAT TOPLAMA
                    var teklif_toplam_fiyatlar = document.querySelectorAll('.teklif_toplam_fiyat');
                    var toplam_tutar = 0;

                    for (var i = 0; i < teklif_toplam_fiyatlar.length; i++) {
                        toplam_tutar += parseFloat(teklif_toplam_fiyatlar[i].value) || 0;
                    }

                    document.getElementById('teklif_kdvli_toplam').value = toplam_tutar.toFixed(2);

                    //KDVSİZ TUTAR TOPLAMA
                    var teklif_kdvsiz_fiyatlar = document.querySelectorAll('.teklif_kdvsiz_fiyat');
                    var kdvsiz_toplam_tutar = 0;

                    for (var i = 0; i < teklif_kdvsiz_fiyatlar.length; i++) {
                        kdvsiz_toplam_tutar += parseFloat(teklif_kdvsiz_fiyatlar[i].value) || 0;
                    }

                    document.getElementById('teklif_ara_toplam').value = kdvsiz_toplam_tutar.toFixed(2);
                    //KDV TUTAR TOPLAMA
                    var teklif_kdv_tutarlar = document.querySelectorAll('.teklif_kdv_tutar');
                    var kdv_toplam_tutar = 0;

                    for (var i = 0; i < teklif_kdv_tutarlar.length; i++) {
                        kdv_toplam_tutar += parseFloat(teklif_kdv_tutarlar[i].value) || 0;
                    }

                    document.getElementById('teklif_kdv_toplam').value = kdv_toplam_tutar.toFixed(2);
                    //İSKONTO TOPLAM
                    var teklif_iskontolar = document.querySelectorAll('.teklif_iskonto');
                    var iskonto_toplam_tutar = 0;

                    for (var i = 0; i < teklif_iskontolar.length; i++) {
                        iskonto_toplam_tutar += parseFloat(teklif_iskontolar[i].value) || 0;
                    }

                    document.getElementById('teklif_iskonto_toplam').value = iskonto_toplam_tutar.toFixed(2);
                    //MALİYET TOPLAM
                    var maliyet_toplam_fiyatlar = document.querySelectorAll('.maliyet_toplam_fiyat');
                    var maliyet_kdvli_tutar = 0;

                    for (var i = 0; i < maliyet_toplam_fiyatlar.length; i++) {
                        maliyet_kdvli_tutar += parseFloat(maliyet_toplam_fiyatlar[i].value) || 0;
                    }
                    document.getElementById('maliyet_kdvli_tutar').value = maliyet_kdvli_tutar.toFixed(2);


                }



                function updateValues(selectElement) {
                    var quantity = parseFloat(quantityInput.value) || 0;
                    var unitPrice = parseFloat(unitPriceInput.value) || 0;
                    var hizmet_maliyet = parseFloat(hizmet_maliyetInput.value) || 0;
                    var vatRate = parseInt(vatRateSelect.value) || 0;
                    var discount = parseFloat(discountInput.value) || 0;

                    var netPrice = quantity * unitPrice;
                    var maliyet_toplam_fiyat = quantity * hizmet_maliyet;
                    var totalBeforeVat = netPrice - discount; // İskonto KDV'siz fiyat üzerinden yapılır.
                    var vatAmount = (totalBeforeVat * vatRate) / 100;
                    var totalWithVat = totalBeforeVat + vatAmount;

                    netPriceInput.value = netPrice.toFixed(2);
                    maliyet_toplam_fiyatInput.value = maliyet_toplam_fiyat.toFixed(2);
                    vatAmountInput.value = vatAmount.toFixed(2);
                    totalPriceInput.value = totalWithVat.toFixed(2);

                    hesaplaToplamTutar();
                }

                updateValues();
                $(document).on('click', '.remove-table-row', function() {
                    $(this).closest('tr').remove();
                    updateValues();
                });

            }

            updateCalculations(i);


        });
    </script>
@endsection
