@extends('admin.layouts.app')
@section('title')
    Yıllık Hedef Oluştur
@endsection
@section('contents')
    @section('topheader')
        Yıllık Hedef Oluştur
    @endsection


    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="{{ route('pyillikhedefler.store') }}" method="POST" id="add-form">
                    @csrf

                    <div class="col-md-12">
                        <table id="table" class="table table-responsive"
                            style="width: 100%; cellspacing: 0; margin-bottom: 0">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <button type="button" id="add" class="btn btn-sm btn-primary btn-block"
                                            style="width: 100%; text-align: center;">
                                            <i class="fa fa-plus"></i> Yıllık Hedef Ekle
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th style=" color: white;"><b>#</b></th>
                                    <th style="width: 15% ; color: white;">Personel Adı</th>
                                    <th style="width: 20% ; color: white;">Hedef Konusu</th>
                                    <th style="width: 20% ; color: white;">Hedef Yılı</th>
                                    <th style="width: 10% ; color: white;">Hedef Mevcut Değeri</th>
                                    <th style="width: 10% ; color: white;">Hedeflenen Değer</th>
                                    <th style="width: 9% ; color: white;">Hedef Hesaplama Yöntemi</th>
                                    <th style="width: 9% ; color: white;">Hedef Aksiyonu</th>
                                    <th style="width: 9% ; color: white;">Hedef Termini</th>
                                    <th style="width: 9% ; color: white;">Hedef Kontrol Termini</th>
                                    {{-- <th style="width: 9%">Kontrol Sonucu</th> --}}

                                    <th style=" color: white;">Ekle/Çıkar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="" readonly id=""
                                                value="@if(Auth::check()){{ Auth::user()->ad_soyad }}@endif"
                                                class="form-control form-control-sm ">
                                        </div>
                                        <input type="hidden" name="inputs[0][personel_id]" id="inputs[0][personel_id]"
                                            value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <select name="inputs[0][hedef_konusu_id]" class="form-control form-control-sm"
                                                required>
                                                <option value="">Konu Seçin</option>
                                                @foreach ($yillikhedefkonu as $yillikhedefkonuitem)
                                                    <option value="{{ $yillikhedefkonuitem->id }}">
                                                        {{ $yillikhedefkonuitem->hedef_konu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <select name="inputs[0][hedef_yili]" class="form-control form-control-sm"
                                                required>
                                                <option value="">Yıl Seçiniz</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[0][hedef_mevcut_degeri]"
                                                id="inputs[0][hedef_mevcut_degeri]" class="form-control form-control-sm ">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[0][hedeflenen_deger]"
                                                id="inputs[0][hedeflenen_deger]" class="form-control form-control-sm ">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[0][hedef_hesaplama_yontemi]"
                                                id="inputs[0][hedef_hesaplama_yontemi]"
                                                class="form-control form-control-sm ">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <input type="text" name="inputs[0][hedef_aksiyonu]"
                                                id="inputs[0][hedef_aksiyonu]" class="form-control form-control-sm ">
                                        </div>
                                    </td>


                                    <td>
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <input type="date" name="inputs[0][hedef_termini]" readonly
                                                class="form-control form-control-sm yearEndDate">
                                        </div>


                                    </td>
                                    <td>
                                        <div class="input-group m-b-sm">
                                            <span class="input-group-addon"></span>
                                            <input type="date" name="inputs[0][hedef_kontrol_termini]"
                                                class="form-control form-control-sm  ">
                                        </div>
                                    </td>



                                </tr>

                            </tbody>
                        </table>
                    </div>



                    <div class="row">
                        <div class="col-md-12 mt-1">
                            <button type="submit" id="submit-form" class="btn btn-sm btn-outline-primary"
                                style="float: right; margin-left: 2px;">
                                Kaydet</button>
                            <a href="{{ route('pyillikhedefler.index') }}" class="btn btn-sm btn-outline-secondary"
                                style="float: right"> Vazgeç</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>
            $(document).ready(function () {
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
                        data: function (params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(function (item) {
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
                        inputTooShort: function () {
                            return "Lütfen en az 3 karakter girin.";
                        },
                        noResults: function () {
                            return "Sonuç bulunamadı.";
                        }
                    }
                });

                // Select2 açıldığında arama inputuna otomatik odaklanma
                $('#cari_id').on('select2:open', function () {
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
            $(document).ready(function () {
                var i = 0;



                $(document).on('click', '#add', function () {
                    ++i;
                    var newRow = $('<tr>');
                    newRow.append('<td>' + i + '</td>');
                    newRow.append(`
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <input type="text" name="" readonly
                                                    id="" value="@if(Auth::check()){{ Auth::user()->ad_soyad }}@endif"
                                                    class="form-control form-control-sm ">
                                            </div>
                                                <input type="hidden" name="inputs[` + i + `][personel_id]" id="inputs[` + i + `][personel_id]" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                                        </td>
                                         <td>
                                            <div class="input-group m-b-sm">
                                                <select name="inputs[` + i + `][hedef_konusu_id]"
                                                class="form-control form-control-sm" required>
                                                <option value="">Konu Seçin</option>
                                                @foreach ($yillikhedefkonu as $yillikhedefkonuitem)
                                                    <option value="{{ $yillikhedefkonuitem->id }}">
                                                        {{ $yillikhedefkonuitem->hedef_konu }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </td>
                                         <td>
                                            <div class="input-group m-b-sm">
                                                    <select name="inputs[` + i + `][hedef_yili]"  class="form-control form-control-sm"
                                                    required>
                                                    <option value="">Yıl Seçiniz</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <input type="text" name="inputs[` + i + `][hedef_mevcut_degeri]"
                                                    id="inputs[` + i + `][hedef_mevcut_degeri]"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <input type="text" name="inputs[` + i + `][hedeflenen_deger]"
                                                    id="inputs[` + i + `][hedeflenen_deger]"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <input type="text" name="inputs[` + i + `][hedef_hesaplama_yontemi]"
                                                    id="inputs[` + i + `][hedef_hesaplama_yontemi]"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </td>
                                          <td>
                                            <div class="input-group m-b-sm">
                                                <input type="text" name="inputs[` + i + `][hedef_aksiyonu]"
                                                    id="inputs[` + i + `][hedef_aksiyonu]"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </td>


                                        <td>
                                            <div class="input-group m-b-sm">
                                                <span class="input-group-addon"></span>
                                                <input type="date" name="inputs[` + i + `][hedef_termini]"
                                                       class="form-control form-control-sm yearEndDate" >
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group m-b-sm">
                                                <span class="input-group-addon"></span>
                                                <input type="date" name="inputs[` + i + `][hedef_kontrol_termini]"
                                                    class="form-control form-control-sm  ">
                                            </div>
                                        </td>

                        <td><button type="button" class="btn btn-sm btn-danger remove-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                    `);
                    $('#table').append(newRow);


                });



                // Satır Silme (Event Delegation)
                $(document).on('click', '.remove-table-row', function () {
                    $(this).closest('tr').remove();
                    updateRowNumbers(); // Satır numaralarını yeniden düzenle
                });

                // Satır Numaralarını Güncelle
                function updateRowNumbers() {
                    $('#table tr').each(function (index) {
                        $(this).find('td:first').text(index);
                    });
                }


            });
        </script>
        <script>
       document.addEventListener("DOMContentLoaded", function() {
    // Tüm yearEndDate class'ına sahip inputları seç
    document.querySelectorAll('.yearEndDate').forEach(function(input) {
        // Input yüklendiğinde varsayılan değeri ayarla
        const currentYear = new Date().getFullYear();
        const yearEndDate = currentYear + '-12-31';
        input.value = yearEndDate;

        // Kullanıcı değişiklik yapmaya çalıştığında
        input.addEventListener('input', function(event) {
            // Eğer readonly ise işlem yapma
            if(input.readOnly) return;

            let inputValue = event.target.value;

            // Geçerli bir tarih mi kontrol et
            const date = new Date(inputValue);
            if(isNaN(date.getTime())) {
                // Geçersiz tarihse eski değere dön
                event.target.value = yearEndDate;
                return;
            }

            // Yıl kısmını al, ay ve günü 31 Aralık yap
            const year = date.getFullYear();
            event.target.value = year + '-12-31';
        });
    });
});


        </script>
@endsection
