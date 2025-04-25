@extends('admin.layouts.app')
@section('title')
{{$gelenefatura->fatura_no}} Nolu {{$gelenefatura->musteri_adi}} Faturayı Alışa Aktar
@endsection
@section('contents')
@section('topheader')
{{$gelenefatura->fatura_no}} Nolu {{$gelenefatura->musteri_adi}} Faturayı Alışa Aktar
@endsection


<div class="card radius-5">
    <div class="card-body" style="border-radius: 5px; padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

        <div class="row">
            <form action="{{route('gelenfaturayialisaktarPOST',$gelenefatura->id)}}" method="POST" id="add-form">
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
                            <input type="date" name="fis_tarihi" id="fis_tarihi" readonly  style="cursor: not-allowed"
                                            onkeydown="return false;"
                                class="form-control form-control-sm" value="{{$gelenefatura->issue_date}}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="fis_no">Fatura/Fiş No</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa-solid fa-hashtag"></i>
                            </span>
                            <input type="text" name="fis_no" id="fis_no" value="{{$gelenefatura->fatura_no}}" style="cursor: not-allowed"
                                            onkeydown="return false;" readonly
                                class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <input type="hidden" name="alis_kodu" id="alis_kodu">
                    <div class="col-md-3">
                        <label for="tahsil_eden">Tahsil Eden</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" name="tahsil_eden" id="tahsil_eden"
                                class="form-control form-control-sm " required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="odeme_turu">Ödeme Türü</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                        <select name="odeme_turu" id="odeme_turu" class="form-control form-control-sm" required>
                            <option value="">Lütfen Seçim Yapınız</option>
                            <option value="EFT">EFT</option>
                            <option value="Havale">Havale</option>
                            <option value="Nakit">Nakit</option>
                        </select>
                    </div>

                    </div>

                    <div class="col-md-3">
                        <label for="odeme_tipi">Ödeme Yöntemi</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                        <select name="odeme_tipi" id="odeme_tipi" class="form-control form-control-sm" required >
                            <option value="">Lütfen Seçim Yapınız</option>
                            <option value="Kasa">Kasa</option>
                            <option value="Banka">Banka</option>
                        </select>
                    </div>

                    </div>

                    <div class="col-md-3">
                        <label id="kasa_banka_label"></label>
                        <div class="input-group mb-2" style="border: 1px solid #ced4da;border-radius: 7px;">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                            <select name="kasa_id" id="kasa_id" class="form-control form-control-sm" style="display: none;">
                                <option value="">Lütfen Seçim Yapınız</option>
                                @foreach ($kasalar as $item)
                                <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                @endforeach
                            </select>
                            <select name="banka_id" id="banka_id" class="form-control form-control-sm" style="display: none;">
                                <option value="">Lütfen Seçim Yapınız</option>
                                @foreach ($bankalar as $banka)
                                <option value="{{ $banka->id }}">{{ $banka->banka_adi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <label for="odeme_tutar">Ödeme Tutarı</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                            <input type="text" name="odeme_tutar" id="odeme_tutar"
                                class="form-control form-control-sm input-mask" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table id="example3" class="table table-responsive" style="width: 100%; cellspacing: 0; margin-bottom: 0">

                    <thead>
                        <tr>
                            <th><b>#</b></th>
                            <th>Gider Kategori</th>
                            <th>Giderlist</th>
                            <th>Gider Adı</th>
                            <th>Mal/Hizmet</th>
                            <th>Ürün Açıklama</th>
                            <th style="width: 15%">Miktar/Birim</th>
                            <th style="display: none">maliyet</th>
                            <th style="display: none">maliyet toplam</th>
                            <th>Birim Fiyat</th>
                            <th>Kdv Oran</th>
                            <th>Kdv Tutar</th>
                            <th>İskonto</th>
                            <th>Ödenecek Tutar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $json_data = json_decode($gelenefatura->json_data);
                        $lines = $json_data->lines ?? [];

                        @endphp

                        {{-- @dd($json_data); --}}
                        @foreach ($lines as $key => $linesitem)
                        <tr>
                            <td></td>
                            <td>
                                <select name="inputs[{{$key}}][giderkategori_id]"
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
                                <select name="inputs[{{$key}}][gider_id]" id="gider_id" class="form-control form-control-sm" required>
                                    <option value="">Lütfen Seçim Yapınız...</option>

                                </select>
                            </td>
                            <td >
                                <div class="input-group m-b-sm">
                                    <input type="text" name="inputs[{{$key}}][gider_adi]"
                                        id="gider_adi" class="form-control form-control-sm">
                                </div>
                            </td>
                            <td style=" align-items: center;">
                                {{ $linesitem->name }}
                            </td>
                            @if(isset($linesitem->brand) )
                            <td>
                                {{ $linesitem->brand }}
                            </td>
                        @else
                            <td>-</td>
                        @endif
                            <td>
                                {{ $linesitem->quantity }}
                                @if($linesitem->quantity_unit == 'NIU')
                                    Adet
                                @else
                                    {{ $linesitem->quantity_unit }}
                                @endif
                            </td>
                            <td>
                                {{ number_format($linesitem->price, 2, ',', '.') }} {{ $linesitem->price_currency }}
                            </td>
                            @if(isset($linesitem->tax) && isset($linesitem->tax->subtotals[0]->percent))
                            <td>
                                {{ $linesitem->tax->subtotals[0]->percent }}%
                            </td>
                        @else
                            <td>0%</td>
                        @endif


                        <td>
                            @if(isset($linesitem->tax->subtotals[0]))
                                {{ number_format($linesitem->tax->subtotals[0]->amount, 2, ',', '.') }} {{ $linesitem->tax->subtotals[0]->amount_currency }}
                            @else
                                0,00 TRY
                            @endif
                        </td>
                        <td>
                            @if(isset($json_data->allowance))
                                {{ number_format($json_data->allowance, 2, ',', '.') }} {{ $json_data->allowance_currency ?? 'TRY' }}
                            @else
                                0,00 TRY
                            @endif
                        </td>


                            <td>
                                {{ number_format($linesitem->extension_amount, 2, ',', '.') }} {{ $linesitem->extension_amount_currency }}
                            </td>
                        </tr>
@endforeach
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
                                <input type="text" name="toplam_ara_toplam" id="toplam_ara_toplam" value="{{$json_data->line_extension}}"
                                    class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Mal Hizmet Toplam Tutarı<span style="color: red">*</span></label>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="indirimli_tutar" id="indirimli_tutar" value="{{$json_data->line_extension}}"
                                    class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Toplam İskonto Tutar<span style="color: red">*</span></label>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="toplam_iskonto" id="toplam_iskonto" value="{{ isset($json->allowance) ? number_format($json->allowance, 2, '.', '') : '0.00' }}"
                                    class="form-control form-control-sm" readonly>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Toplam Kdv Tutar<span style="color: red">*</span></label>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="toplam_kdv_tutar" id="toplam_kdv_tutar" value="{{$json_data->tax_totals[0]->amount }}"
                                    class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Ödenecek Tutar<span style="color: red">*</span></label>
                            <div class="input-group m-b-sm">
                                <span class="input-group-addon"></span>
                                <input type="text" name="toplam_tutar" id="toplam_tutar" value="{{$json_data->payable}}"
                                    class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-1">
                    <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                        style="float: right; margin-left: 2px;">
                        Kaydet</button>
                    <a href="{{route('alislar.index')}}" class="btn btn-sm btn-outline-secondary" style="float: right"> Vazgeç</a>
                </div>
            </div>

        </form>


        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const odemeTuruSelect = document.getElementById("odeme_turu");
        const odemeTipiSelect = document.getElementById("odeme_tipi");
        const kasaBankaLabel = document.getElementById("kasa_banka_label");
        const kasaSelect = document.getElementById("kasa_id");
        const bankaSelect = document.getElementById("banka_id");

        function disableOdemeTipi() {
            odemeTipiSelect.style.pointerEvents = "none"; // Kullanıcı değiştiremesin
            odemeTipiSelect.readOnly = true;
        }

        function enableOdemeTipi() {
            odemeTipiSelect.style.pointerEvents = ""; // Kullanıcı değiştirebilsin
            odemeTipiSelect.readOnly = false;
        }

        function handleOdemeTuruChange() {
            const odemeTuru = odemeTuruSelect.value;

            if (odemeTuru === "EFT" || odemeTuru === "Havale") {
                odemeTipiSelect.value = "Banka"; // Otomatik olarak Banka seçilir
                disableOdemeTipi();
                kasaBankaLabel.textContent = "Bankalar";
                bankaSelect.style.display = "block";
                bankaSelect.required = true;
                kasaSelect.style.display = "none";
                kasaSelect.required = false;
            } else if (odemeTuru === "Nakit") {
                odemeTipiSelect.value = "Kasa"; // Otomatik olarak Kasa seçilir
                disableOdemeTipi();
                kasaBankaLabel.textContent = "Kasalar";
                kasaSelect.style.display = "block";
                kasaSelect.required = true;
                bankaSelect.style.display = "none";
                bankaSelect.required = false;
            } else {
                odemeTipiSelect.value = ""; // Varsayılan duruma döndür
                enableOdemeTipi();
                kasaBankaLabel.textContent = "";
                kasaSelect.style.display = "none";
                kasaSelect.required = false;
                bankaSelect.style.display = "none";
                bankaSelect.required = false;
            }
        }

        odemeTuruSelect.addEventListener("change", handleOdemeTuruChange);
    });
    </script>
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
