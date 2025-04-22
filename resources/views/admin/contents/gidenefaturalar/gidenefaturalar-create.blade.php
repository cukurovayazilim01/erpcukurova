@extends('admin.layouts.app')
@section('title')
    FATURA OLUŞTUR
@endsection
@section('contents')
@section('topheader')
    FATURA OLUŞTUR
@endsection


<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{ route('createInvoice') }}" method="POST" id="add-form">
                @csrf
                <div class="col-md-12" style="padding: 1%; ">
                    <div class="row">

                        <div class="col-md-3 select2-sm">
                            <label for="cari_id">Firmalar</label>
                            <select name="cari_id" id="cari_id"
                                style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                <!-- Dinamik veriler buraya yüklenecek -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="firma_unvan">Firma Ünvanı</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                                <input type="text" name="firma_unvan" id="firma_unvan"
                                    class="form-control form-control-sm" required
                                    oninput="this.value = this.value.toUpperCase()">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="vergi_no" style="display: inline-block;">Vergi No</label>
                            <button type="button" onclick="vknSorgula()" class="btn btn-danger btn-sm p-0 m-0"
                                style="display: inline-block; margin-left: 10px;"><b style="font-size: 10px">Firma
                                    Bilgisi Getir</b></button>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-check"></i>
                                </span>
                                <input type="text" name="vergi_no" id="vkn" required
                                    class="form-control form-control-sm input-mask" pattern="\d{10}" inputmode="numeric"
                                    maxlength="11" minlength="10">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="tc_kimlik">T.C Kimlik No</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-check"></i>
                                </span>
                                <input type="text" name="tc_kimlik" id="tc"
                                    class="form-control form-control-sm input-mask" required pattern="\d{11}"
                                    inputmode="numeric" maxlength="11" minlength="11">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="fatura_tarihi">Fatura Tarihi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="datetime-local" name="fatura_tarihi" id="fatura_tarihi"
                                    class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="vergi_no">Vergi Dairesi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-folder-minus"></i>
                                </span>
                                <input type="text" name="vergi_dairesi" id="vergi_dairesi"
                                    class="form-control form-control-sm">
                            </div>
                        </div>



                        <div class="col-md-2">
                            <label for="il">İl</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa-solid fa-city"></i>
                                </span>

                                <input type="text" name="il" id="sehir" class="form-control form-control-sm"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="ilce">İlçe</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa-sharp fa-solid fa-city"></i>
                                </span>
                                <input type="text" name="ilce" id="ilce" class="form-control form-control-sm"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="is_tel">Telefon</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="number" name="is_tel" id="is_tel"
                                    class="form-control form-control-sm no-zero" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="eposta">E-Posta</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" name="eposta" id="eposta"
                                    class="form-control form-control-sm"
                                    oninput="this.value = this.value.toLowerCase()" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="firma_turu">Fatura Senaryosu</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-folder"></i>
                                </span>
                                <select name="fatura_turu" id="fatura_turu" class="form-select form-select-sm">
                                    <option value="">Lütfen Seçim Yapınız</option>
                                    <option value="TICARIFATURA">Ticari Fatura</option>
                                    <option value="TEMELFATURA">Temel Fatura</option>
                                    <option value="EARSIVFATURA">e-Arşiv Faturası</option>
                                    <option value="KAMU">Kamu Faturası</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="firma_turu">Fatura Tipi</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">
                                    <i class="fa fa-folder"></i>
                                </span>
                                <select name="efatura_tipi" id="efatura_tipi" class="form-select form-select-sm">
                                    <option value="SATIS">Satış Faturası</option>
                                    <option value="IADE">İade Faturası</option>
                                    <option value="ISTISNA">İstisna Faturası</option>
                                    <option value="TEVKIFAT">Tevkifatlı Fatura</option>
                                    <option value="OZELMATRAH">Özel Matrah Faturası</option>
                                    <option value="SGK">SGK Faturası</option>
                                    <option value="IHRACKAYITLI">İhraç Kayıtlı Fatura</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <label for="teklif_konu">Adres</label>
                            <input type="text" name="adres" id="adres"
                                class="form-control form-control-sm " required>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="teklif_aciklama">Açıklama</label>
                            <textarea name="teklif_aciklama" id="teklif_aciklama" cols="20" rows="2"
                                class="form-control form-control-sm "></textarea>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-12">
                    <table id="example3" class="table table-responsive" style="width: 100%; cellspacing: 0; margin-bottom: 0">
                        <thead>
                            <tr>
                                <th colspan="100%">
                                    <button type="button" id="add" class="btn btn-sm btn-primary btn-block"
                                        style="width: 100%; text-align: center;">
                                        <i class="fa fa-plus"></i> Satır Ekle
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th><b>#</b></th>

                                <th>Mal/Hizmet Adı</th>
                                <th style="width: 15%">Miktar/Birim</th>

                                <th>Birim Fiyat</th>
                                <th>Kdv/Tutar</th>
                                <th>İskonto</th>
                                <th>Ödenecek Tutar</th>
                                <th>Ekle/Çıkar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>

                                <td >
                                    <div class="input-group m-b-sm">
                                        <input type="text" name="inputs[0][hizmet_adi]"
                                            id="hizmet_adi" class="form-control form-control-sm">
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <div class="col-md-5" style="padding: 0px">
                                                <input type="text" name="inputs[0][miktar]" id="miktar"
                                                    class="form-control form-control-sm setnumber input-mask" required>
                                            </div>
                                            <div class="col-md-7" style="padding: 0px">
                                                <select name="inputs[0][birim]"
                                                    id="birim" class="form-control form-control-sm">
                                                    <option value="Adet">Adet</option>
                                                    <option value="Kg">Kg</option>
                                                    <option value="Lt">Lt</option>
                                                    <option value="Mt">Mt</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group m-b-sm">
                                        <span class="input-group-addon"></span>
                                        <input type="text" name="inputs[0][birim_fiyat]" id="birim_fiyat"
                                            class="form-control form-control-sm setnumber input-mask" >
                                    </div>
                                </td>

                                <td style="display: none">
                                    <div class="input-group m-b-sm">
                                        <input type="text" name="inputs[0][ara_toplam]"
                                            id="ara_toplam"
                                            class="form-control form-control-sm setnumber ara_toplam">
                                    </div>
                                </td>



                                <td>
                                    <div class="form-group">
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <div class="col-md-5" style="padding: 0px">
                                                <select name="inputs[0][kdv_oran]" id="kdv_oran"
                                                    class="form-control form-control-sm">
                                                    <option value="20">%20</option>
                                                    <option value="18">%18</option>
                                                    <option value="10">%10</option>
                                                    <option value="8">%8</option>
                                                    <option value="1">%1</option>
                                                    <option value="0">%0</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7" style="padding: 0px">
                                                <input type="text" class="form-control form-control-sm kdvtutar setnumber"
                                                    name="inputs[0][kdv_tutar]" id="kdv_tutar"
                                                    aria-describedby="basic-addon2" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group m-b-sm">
                                        <input type="text" name="inputs[0][iskonto]"
                                            id="iskonto"
                                            class="form-control form-control-sm setnumber iskonto input-mask">
                                    </div>
                                </td>


                                <td>
                                    <div class="input-group m-b-sm">
                                        <span class="input-group-addon"></span>
                                        <input type="text" name="inputs[0][tutar]" id="tutar"
                                            class="form-control form-control-sm setnumber tutar" readonly>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="row" style="display: flex; flex-wrap: wrap;">
                    <!-- Açıklama Alanı -->
                    <div class="col-md-6" style="flex: 1; max-width: 50%; padding: 10px;">
                        <label for="aciklama" style="display: block; margin-bottom: 5px;">Açıklama</label>
                        <textarea id="aciklama" name="aciklama" rows="5"
                            style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: none;"></textarea>
                    </div>

                    <!-- Diğer Kısımlar -->
                    <div class="col-md-6" style="flex: 1; max-width: 50%; padding: 10px;">
                        <div class="row" style="display: none;">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Ara Toplam<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="toplam_ara_toplam" id="toplam_ara_toplam"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Mal / Hizmet Toplam Tutarı<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="indirimli_tutar" id="indirimli_tutar"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Toplam İskonto Tutar<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="toplam_iskonto" id="toplam_iskonto"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Hesaplanan KDV<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="toplam_kdv_tutar" id="toplam_kdv_tutar"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1">Ödenecek Tutar<span style="color: red">*</span></label>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="toplam_tutar" id="toplam_tutar"
                                        class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12 mt-1">
                        <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                            style="float: right; margin-left: 2px;">
                            Kaydet</button>
                        <a href="{{ route('gidenefaturalar.index') }}" class="btn btn-sm btn-outline-secondary"
                            style="float: right"> Vazgeç</a>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cari_id').on('change', function() {
                var selectedCariId = $(this).val();

                $.ajax({
                    url: '/getMusteriTemsilcisi/' + selectedCariId,
                    type: 'GET',
                    dataType: 'json', // Gelen verinin JSON olduğunu belirtin
                    success: function(data) {
                        // AJAX isteği başarılı olduğunda çalışacak kod
                        $('#musteri_temsilcisi').val(data.musteri_temsilcisi);
                        $('#tc').val(data.tc);
                        $('#vkn').val(data.vkn);
                        $('#sehir').val(data.sehir);
                        $('#vergi_dairesi').val(data.vergi_dairesi);
                        $('#ilce').val(data.ilce);
                        $('#is_tel').val(data.is_tel);
                        $('#eposta').val(data.eposta);
                        $('#firma_unvan').val(data.firma_unvan);
                        $('#adres').val(data.adres);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // AJAX isteği başarısız olduğunda çalışacak kod
                        console.error('AJAX isteği başarısız: ' + textStatus);
                    }
                });
            });
        });
    </script>

    <script>
        function vknSorgula() {
            let vkn = document.getElementById('vkn').value.trim();

            if (vkn.length === 10 || vkn.length === 11) {
                fetch(`/vkn-check?vergi_no=${vkn}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Gelen JSON:", data);

                        if (data.length > 0) {
                            let firmaUnvan = data[0].title;

                            if (firmaUnvan) {
                                document.getElementById('firma_unvan').value = firmaUnvan;
                            } else {
                                alert("Firma bilgisi bulunamadı!");
                            }
                        } else {
                            alert("Geçerli firma bilgisi bulunamadı!");
                        }

                        // API sorgulaması tamamlandıktan sonra veritabanından bilgileri getir
                        getMusteriBilgileri(vkn);
                    })
                    .catch(error => console.error("Hata:", error));
            } else {
                alert("Lütfen geçerli bir VKN girin (10 veya 11 hane).");
            }
        }

        function getMusteriBilgileri(vkn) {
            $.ajax({
                url: '/getMusteri/' + vkn,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#musteri_temsilcisi').val(data.musteri_temsilcisi);
                    $('#tc').val(data.tc);
                    $('#vkn').val(data.vkn);
                    $('#sehir').val(data.sehir);
                    $('#vergi_dairesi').val(data.vergi_dairesi);
                    $('#ilce').val(data.ilce);
                    $('#is_tel').val(data.is_tel);
                    $('#eposta').val(data.eposta);
                    $('#firma_unvan').val(data.firma_unvan);
                    $('#adres').val(data.adres);
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('AJAX isteği başarısız: ' + textStatus);
                }
            });
        }

        // VKN alanında değişiklik yapıldığında otomatik çalıştır
        $(document).ready(function() {
            $('#vkn').on('change', function() {
                vknSorgula();
            });
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
    hesaplaSatir();
});
function hesaplaSatir()
{
     // Tutar hesaplamaları
     $('#example3').on('input', 'input.setnumber, select[name^="inputs["][name$="[kdv_oran]"]', function() {
        var row = $(this).closest('tr');
        var miktar = parseFloat(row.find('input[name^="inputs["][name$="[miktar]"]').val()) || 0;
        var birimFiyat = parseFloat(row.find('input[name^="inputs["][name$="[birim_fiyat]"]').val()) || 0;
        var kdvOran = parseFloat(row.find('select[name^="inputs["][name$="[kdv_oran]"]').val()) || 0;
        var iskonto = parseFloat(row.find('input[name^="inputs["][name$="[iskonto]"]').val()) || 0;

        // Tutar hesaplama
        var ara_toplam = miktar * birimFiyat;
        var totaltutar = ara_toplam - iskonto;
        var kdvTutar = (totaltutar * kdvOran) / 100;
        var tutar = totaltutar + kdvTutar;

        // Sonuçları ilgili alanlara yaz
        row.find('input[name^="inputs["][name$="[ara_toplam]"]').val(ara_toplam.toFixed(2));
        row.find('input[name^="inputs["][name$="[tutar]"]').val(tutar.toFixed(2));
        row.find('input[name^="inputs["][name$="[kdv_tutar]"]').val(kdvTutar.toFixed(2));
        hesaplaToplamTutar();
    });
}

function hesaplaToplamTutar()
                {
                    // TOPLAM TUTAR
                    var tutar = document.querySelectorAll('.tutar');
                    var toplam_tutar = 0;

                    for (var i = 0; i < tutar.length; i++) {
                        toplam_tutar += parseFloat(tutar[i].value) || 0;
                    }

                    document.getElementById('toplam_tutar').value = toplam_tutar.toFixed(2);

                    //TOPLAM KDV TUTAR
                    var kdvtutar = document.querySelectorAll('.kdvtutar');
                    var toplam_kdv_tutar = 0;

                    for (var i = 0; i < kdvtutar.length; i++) {
                        toplam_kdv_tutar += parseFloat(kdvtutar[i].value) || 0;
                    }

                    document.getElementById('toplam_kdv_tutar').value = toplam_kdv_tutar.toFixed(2);

                    //TOPLAM ARA TOPLAM
                    var ara_toplam = document.querySelectorAll('.ara_toplam');
                    var toplam_ara_toplam = 0;

                    for (var i = 0; i < ara_toplam.length; i++) {
                        toplam_ara_toplam += parseFloat(ara_toplam[i].value) || 0;
                    }

                    document.getElementById('toplam_ara_toplam').value = toplam_ara_toplam.toFixed(2);

                    //TOPLAM ARA TOPLAM
                    var iskonto = document.querySelectorAll('.iskonto');
                    var toplam_iskonto = 0;

                    for (var i = 0; i < iskonto.length; i++) {
                        toplam_iskonto += parseFloat(iskonto[i].value) || 0;
                    }

                    document.getElementById('toplam_iskonto').value = toplam_iskonto.toFixed(2);

                    var indirimli_tutar = toplam_ara_toplam - toplam_iskonto;

                    document.getElementById('indirimli_tutar').value = indirimli_tutar.toFixed(2);

                }

function inputsetnumber()
{
     // Tüm inputları seç ve her birine aynı işlemleri uygula
     document.querySelectorAll('.setnumber').forEach(function(input) {
        input.addEventListener('input', function(event) {
            let inputValue = event.target.value;

            // Virgülü noktaya çevir
            inputValue = inputValue.replace(/,/g, '.');

            // Sadece sayılar ve nokta kabul et
            inputValue = inputValue.replace(/[^0-9.]/g, '');

            // Güncellenmiş değeri geri yaz
            event.target.value = inputValue;
        });
    });
}

var i = 0;

$('#add').click(function(){
    i++;
    $('#example3').append(
        `<tr>
            <td>`+ (i + 1) +`</td>

                            <td >
                                <div class="input-group m-b-sm">
                                    <input type="text" name="inputs[`+ i +`][gider_adi]"
                                        id="gider_adi" class="form-control form-control-sm">
                                </div>
                            </td>

                            <td>
                                <div class="form-group">
                                    <div class="input-group m-b-sm">
                                        <span class="input-group-addon"></span>
                                        <div class="col-md-5" style="padding: 0px">
                                            <input type="text" name="inputs[`+ i +`][miktar]" id="miktar"
                                                class="form-control form-control-sm setnumber input-mask" required>
                                        </div>
                                        <div class="col-md-7" style="padding: 0px">
                                            <select name="inputs[`+ i +`][birim]"
                                                id="birim" class="form-control form-control-sm">
                                                <option value="Adet">Adet</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Lt">Lt</option>
                                                <option value="Mt">Mt</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="inputs[`+ i +`][birim_fiyat]" id="birim_fiyat"
                                        class="form-control form-control-sm setnumber input-mask" >
                                </div>
                            </td>

                            <td style="display: none">
                                <div class="input-group m-b-sm">
                                    <input type="text" name="inputs[`+ i +`][ara_toplam]"
                                        id="ara_toplam"
                                        class="form-control form-control-sm setnumber ara_toplam">
                                </div>
                            </td>



                            <td>
                                <div class="form-group">
                                    <div class="input-group m-b-sm">
                                        <span class="input-group-addon"></span>
                                        <div class="col-md-5" style="padding: 0px">
                                            <select name="inputs[`+ i +`][kdv_oran]" id="kdv_oran"
                                                class="form-control form-control-sm">
                                                <option value="20">%20</option>
                                                <option value="18">%18</option>
                                                <option value="10">%10</option>
                                                <option value="8">%8</option>
                                                <option value="1">%1</option>
                                                <option value="0">%0</option>
                                            </select>
                                        </div>
                                        <div class="col-md-7" style="padding: 0px">
                                            <input type="text" class="form-control form-control-sm kdvtutar setnumber"
                                                name="inputs[`+ i +`][kdv_tutar]" id="kdv_tutar"
                                                aria-describedby="basic-addon2" readonly>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <input type="text" name="inputs[`+ i +`][iskonto]"
                                        id="iskonto"
                                        class="form-control form-control-sm setnumber iskonto input-mask">
                                </div>
                            </td>


                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon"></span>
                                    <input type="text" name="inputs[`+ i +`][tutar]" id="tutar"
                                        class="form-control form-control-sm setnumber tutar" readonly>
                                </div>
                            </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
    </tr>`);
    inputsetnumber();
    hesaplaSatir();


});

$(document).on('click','.remove-table-row', function(){
$(this).parents('tr').remove();
hesaplaToplamTutar();
});



</script>
@endsection
