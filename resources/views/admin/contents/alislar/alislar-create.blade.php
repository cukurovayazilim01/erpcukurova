@extends('admin.layouts.app')
@section('title')
    Alış OLUŞTUR
@endsection
@section('contents')
@section('topheader')
GİDER OLUŞTUR
@endsection


<div class="card">
    <div class="card-body">
        <div class="row">
            <form action="{{route('alislar.store')}}" method="POST" id="add-form">
                @csrf
            <div class="col-md-12" style="padding: 1%; ">
                <div class="row">

                    <div class="col-md-3 select2-sm">
                        <label for="cari_id" >Firma</label>

                          <select name="cari_id" id="cari_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                            <!-- Dinamik veriler buraya yüklenecek -->
                          </select>
                      </div>

                    <div class="col-md-3">
                        <label for="fis_tarihi">Fiş Tarih</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input type="datetime-local" name="fis_tarihi" id="fis_tarihi"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="fis_no">Fatura/Fiş No</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-hashtag"></i>
                            </span>
                            <input type="text" name="fis_no" id="fis_no"
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <input type="hidden" name="alis_kodu" id="alis_kodu">
                    {{-- <input type="hidden" name="durum" id="durum"> --}}

                    <div class="col-md-3">
                        <label for="doviz">Para Birimi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-building"></i>
                            </span>
                            <select name="doviz" id="doviz"
                                class="form-control form-control-sm" required>
                                <option value="TL">TL</option>
                                <option value="DOLAR">DOLAR</option>
                                <option value="EURO">EURO</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="border-radius: 5px">
                <button type="button" id="add" class="btn btn-sm btn-primary btn-block mb-1"
                style="width: 100%; text-align: center;">
                <i class="fa fa-plus"></i> <span>Satır Ekle</span>
            </button>
            <div class="table-responsive" style="border-radius: 5px">
                <table id="example3" class="table table-bordered table-hover" style="width: 100%;">

                    <thead>
                        <tr>
                            <th><b>#</b></th>
                            <th>Gider Kategori</th>
                            <th>Giderlist</th>
                            <th>Gider Adı</th>
                            <th style="width: 15%">Miktar/Birim</th>
                            <th style="display: none">maliyet</th>
                            <th style="display: none">maliyet toplam</th>
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
                            <td>
                                <select name="inputs[0][giderkategori_id]"
                                    class="form-control form-control-sm " id="giderkategori_id" required>
                                    <option value="">Lütfen Seçim Yapınız...</option>
                                    @foreach ($giderkategori as $giderkategoriitem)
                                        <option value="{{ $giderkategoriitem->id }}">
                                            {{ $giderkategoriitem->gider_kategori_adi }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="inputs[0][gider_id]" id="gider_id" class="form-control form-control-sm" required>
                                    <option value="">Lütfen Seçim Yapınız...</option>

                                </select>
                            </td>
                            <td >
                                <div class="input-group m-b-sm">
                                    <input type="text" name="inputs[0][gider_adi]"
                                        id="gider_adi" class="form-control form-control-sm">
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
                <div class="col-md-6" style=" padding: 10px;">
                    <label for="aciklama" style="display: block; margin-bottom: 5px;">Açıklama</label>
                    <textarea id="aciklama" name="aciklama" rows="5"
                        style="width: 100%; height: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: none;"></textarea>
                </div>

                <!-- Diğer Kısımlar -->
                <div class="col-md-6" style=" padding: 10px;">
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
                            <label for="exampleInputEmail1">Toplam İskonto Tutar<span style="color: red">*</span></label>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="toplam_iskonto" id="toplam_iskonto"
                                    class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">İndirimli Tutar<span style="color: red">*</span></label>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="indirimli_tutar" id="indirimli_tutar"
                                    class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Toplam Kdv Tutar<span style="color: red">*</span></label>
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
            </div>
        </div>

        <div style="display: flex; padding: 10px; gap:20px; text-align: center; justify-content: end">

            <a href="{{route('alislar.index')}}" class="btn btn-outline-warning btn-sm py-6 w-25"> Vazgeç</a>
                <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75"
                   >
                    Kaydet</button>
            </div>

        </form>


        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Select2 başlatma
  $('#cari_id').select2({
    theme: 'bootstrap4',  // Bootstrap 4 uyumluluğu
    placeholder: "Firma Seçiniz",
    allowClear: true,
    minimumInputLength: 3,
    width: '100%', // Select2 genişliği
    ajax: {
      url: '/cari-search-alislar',
      type: 'GET',
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return { q: params.term };
      },
      processResults: function(data) {
        return {
          results: data.map(function(item) {
            return { id: item.id, text: item.firma_unvan };
          })
        };
      },
      cache: true
    },
    language: {
      inputTooShort: function() { return "Lütfen en az 3 karakter girin."; },
      noResults: function() { return "Sonuç bulunamadı."; }
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
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
 var giderKategoriSelect = document.getElementById("giderkategori_id");
 var giderListSelect = document.getElementById("gider_id");

 // Sayfa yüklendiğinde giderlist_id select kutusunu temizle
 giderListSelect.innerHTML = '<option value="">Lütfen Seçim Yapınız...</option>';

 // Tüm "giderkategori_id" değişikliklerini dinle
 document.addEventListener("change", function (event) {
     // Eğer değişiklik giderkategori_id üzerinde yapıldıysa
     if (event.target && event.target.id === "giderkategori_id") {
         var selectGiderKategoriID = event.target.value;
         var currentGiderListSelect = event.target.closest('tr').querySelector('#gider_id');

         if (selectGiderKategoriID) {
             fetch('/get-giderler-by-kategori/' + selectGiderKategoriID)
                 .then((response) => response.json())
                 .then((data) => {
                     currentGiderListSelect.innerHTML = '<option value="">Lütfen Seçim Yapınız...</option>';
                     data.forEach(function (item) {
                         var option = document.createElement('option');
                         option.value = item.id;
                         option.textContent =  item.gider_adi;
                         currentGiderListSelect.appendChild(option);
                     });
                 })
                 .catch((error) => console.error('Error:', error));
         } else {
             currentGiderListSelect.innerHTML = '<option value="">Lütfen Seçim Yapınız...</option>';
         }
     }
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
                            <td>
                                <select name="inputs[`+ i +`][giderkategori_id]"
                                    class="form-control form-control-sm " id="giderkategori_id" required>
                                    <option value="">Lütfen Seçim Yapınız...</option>
                                    @foreach ($giderkategori as $giderkategoriitem)
                                        <option value="{{ $giderkategoriitem->id }}">
                                            {{ $giderkategoriitem->gider_kategori_adi }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="inputs[`+ i +`][gider_id]" id="gider_id" class="form-control form-control-sm" required>
                                    <option value="">Lütfen Seçim Yapınız...</option>

                                </select>
                            </td>
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
