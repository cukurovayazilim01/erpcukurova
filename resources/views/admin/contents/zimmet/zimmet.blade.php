@extends('admin.layouts.app')
@section('title')
ZİMMET
@endsection
@section('contents')
@section('topheader')
ZİMMET
@endsection


<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class=" col-md-4 mr-4  d-flex gap-2">
                        <button class="btn btn-outline-dark" id="copyBtn"><i class="fa-solid fa-clone"></i> </button>
                        <button class="btn btn-outline-dark" id="excelBtn"><i class="fa-solid fa-file-excel"></i> </button>
                        <button class="btn btn-outline-dark" id="pdfBtn"><i class="fa-solid fa-file-pdf"></i> </button>
                        <button class="btn btn-outline-dark" id="printBtn"><i class="fa fa-print"></i> </button>
                        <!-- Yeni Ekle Button -->
                </div>
                <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                    <form id="searchForm" action="{{ route('zimmetsearch') }}"  method="GET">
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-input-group-text px-3"><i class="bi bi-search"></i></div>
                            <input class="form-control ps-5" id="searchInput" type="text" placeholder="Genel Arama">
                          </div>
                        </form>
                </div>
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm mx-0 mx-lg-2"  data-bs-toggle="modal"
                    data-bs-target="#zimmetmodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>
                </div>


        </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="zimmetmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('zimmet.store') }}" method="POST" id="add-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Zimmet Takip Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="personel_id">Personel Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="personel_id" id="personel_id" class="form-control form-control-sm" required>
                                            <option value="">Lütfen Seçiniz</option>
                                            @foreach ($personel as $personelitem)
                                                <option value="{{ $personelitem->id }}">{{ $personelitem->ad_soyad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 5px">
                                    <button type="button" id="addzimmet" class="btn btn-sm btn-primary btn-block mb-1"
                                    style="width: 100%; text-align: center;">
                                    <i class="fa fa-plus"></i> <span>Hizmet Ekle</span>
                                </button>
                                <table id="odeme_table" class="table table-responsive table-bordered table-striped" style="width: 100%; ">

                                    <thead>
                                        <tr>
                                            <th><b>#</b></th>
                                            <th>Zimmet Tarihi</th>
                                            <th>Marka</th>
                                            <th>Model</th>
                                            <th>Miktar</th>
                                            <th>Birim</th>
                                            <th>Teslim Edilen Resim</th>
                                            <th>Ekle/Çıkar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="date" name="inputss[0][verilme_tarihi]"
                                                        class="form-control form-control-sm " >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[0][marka]"
                                                        class="form-control form-control-sm " >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[0][model]"
                                                        class="form-control form-control-sm " >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" name="inputss[0][miktar]"
                                                        class="form-control form-control-sm " >
                                                </div>
                                            </td>
                                            <td>
                                                <select name="inputss[0][birim]"
                                                    class="form-control form-control-sm " required>
                                                    <option value="Adet">Adet</option>
                                                    <option value="Metre">Metre (m)</option>
                                                    <option value="Kilogram">Kilogram (kg)</option>
                                                    <option value="Santimetre">Santimetre (cm)</option>
                                                    <option value="Litre">Litre (L)</option>
                                                    <option value="Derece">Derece (°C)</option>
                                                    <option value="Saniye">Saniye (s)</option>
                                                    <option value="Milimetre">Milimetre (mm)</option>
                                                    <option value="Gram">Gram (g)</option>
                                                    <option value="Mililitre">Mililitre (mL)</option>
                                                    <option value="Radyan">Radyan (rad)</option>
                                                    <option value="Hektar">Hektar (ha)</option>
                                                    <option value="Ton">Ton (t)</option>
                                                    <option value="Küp Metre">Küp Metre (m³)</option>
                                                    <option value="Fahrenheit">Fahrenheit (°F)</option>

                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group m-b-sm">
                                                    <span class="input-group-addon"></span>
                                                    <input type="file" name="inputss[0][verme_dosya]"
                                                        class="form-control form-control-sm " >
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">

                <table class="table dataTable table-striped table-bordered " id="example2">
                    <thead >
                        <tr>
                            <th>#</th>
                            <th>İşlem Tarihi</th>
                            <th>Adı Soyadı</th>
                            <th>Sigorta Sicil No</th>
                            <th>İşe Başlama Tarihi</th>
                            <th>Pdf</th>
                            <th>Teslim Alma</th>

                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($zimmet as $sn => $zimmetitem)
                            <tr>
                                <th>{{ $sn + 1 }}</th>
                                <td>{{ $zimmetitem->islem_tarihi }}</td>
                                <td>{{ $zimmetitem->personel->ad_soyad }}</td>
                                <td>{{ $zimmetitem->personel->sigorta_sicil_no }}</td>
                                <td>{{ $zimmetitem->personel->ise_giris_tarihi }}</td>

                                <td>
                                    <a href="{{route('zimmet.show',['zimmet'=>$zimmetitem->id])}}" target="_blank"
                                         class="btn btn-sm text-light btn-danger"> <i class="fa fa-file-pdf"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('zimmet.edit', ['zimmet' => $zimmetitem->id]) }}"
                                        class="btn btn-sm  "><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i> Teslim Alma
                                    </a>
                                </td>
                                <td class="text-right">
                                    <div class="d-flex align-items-center">


                                        <form
                                            action="{{ route('zimmet.destroy', ['zimmet' => $zimmetitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class=" text-danger show_confirm">
                                                <i style="color: rgb(180, 68, 34)"
                                                        class="fa-solid fa-trash-can fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="row">
                    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
                        {{ $zimmet->appends(['entries' => $perPage])->links() }}
                    </div>
                </div> --}}

            </div>

        </div>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('zimmetsearch') }}',
                    method: 'GET',
                    data: {
                        zimmetsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('zimmetsearch') }}',
                    method: 'GET',
                    data: {
                        zimmetsearch: searchValue
                    }, // Arama değeri
                    success: function(response) {
                        // Sadece tbody kısmını güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            }
        });
    });
</script>
<script>
    var i = 0;
      $(document).on('click', '#addzimmet', function() {

            ++i;
            var newRow = $('<tr>');
            newRow.append('<td>' + i + '</td>');
            newRow.append(`
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="date" name="inputss[` + i + `][verilme_tarihi]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputss[` + i + `][marka]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputss[` + i + `][model]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="text" name="inputss[` + i + `][miktar]" class="form-control form-control-sm " >
                                </div>
                            </td>
                             <td>
                                <select name="inputss[` + i + `][birim]" class="form-control form-control-sm" required>
                                    <option value="Adet">Adet</option>
                                                    <option value="Metre">Metre (m)</option>
                                                    <option value="Kilogram">Kilogram (kg)</option>
                                                    <option value="Santimetre">Santimetre (cm)</option>
                                                    <option value="Litre">Litre (L)</option>
                                                    <option value="Derece">Derece (°C)</option>
                                                    <option value="Saniye">Saniye (s)</option>
                                                    <option value="Milimetre">Milimetre (mm)</option>
                                                    <option value="Gram">Gram (g)</option>
                                                    <option value="Mililitre">Mililitre (mL)</option>
                                                    <option value="Radyan">Radyan (rad)</option>
                                                    <option value="Hektar">Hektar (ha)</option>
                                                    <option value="Ton">Ton (t)</option>
                                                    <option value="Küp Metre">Küp Metre (m³)</option>
                                                    <option value="Fahrenheit">Fahrenheit (°F)</option>

                                </select>
                            </td>
                            <td>
                                <div class="input-group m-b-sm">
                                    <span class="input-group-addon" ></span>
                                    <input type="file" name="inputss[` + i + `][verme_dosya]" class="form-control form-control-sm " >
                                </div>
                            </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-table-row" style="--bs-btn-padding-y: 0.12rem">-</button></td>
                            `);
            $('#odeme_table').append(newRow);

            $(document).on('click', '.remove-table-row', function() {
                $(this).closest('tr').remove();
                updateValues();
            });
      });
</script>
<!-- JavaScript: DataTable Yapılandırma -->
<script>
    $(document).ready(function() {
        var table = $("#example2").DataTable({
            responsive: true,
            lengthChange: false, // Sayfa uzunluğu değişikliğini kaldır
            autoWidth: false, // Otomatik genişlik ayarlamasını kaldır
            pageLength: 10000, // Sayfa başına gösterilecek kayıt sayısını artır (örneğin 10000)
            dom: 'frtip', // Sadece butonları gösterecek
            language: {
                url: "{{ asset('vendor/tr.json') }}" // Dil dosyasını ekleyin
            },
            ordering: false, // Sıralamayı devre dışı bırak
            buttons: [{
                    extend: 'copyHtml5',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-copy"></i> Kopyala',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'pdfHtml5',
                className: 'btn btn-danger',
                text: '<i class="fa fa-file-pdf"></i> PDF',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                },
                // customize: function(doc) {
                //     // HTML içeriğini eklemek için manuel yapı oluştur
                //     var customHtml = '<p style="color: red; font-size: 16px;"><strong>Özel Başlık</strong></p>' +
                //                      '<p>Bu benim özel HTML formatım.</p>';

                //     // HTML içeriğini PDF'ye metin olarak ekle
                //     doc.content.unshift({
                //         text: customHtml,
                //         margin: [0, 0, 0, 10],
                //         alignment: 'left'
                //     });

                //     // Alternatif: HTML'yi PDF içeriğine çevirmek için parse edilmesi gerekebilir
                //     doc.content.unshift({
                //         text: "Özel HTML Formatınız Buraya Gelecek",
                //         fontSize: 12,
                //         alignment: 'center',
                //         bold: true
                //     });
                // }
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i> Yazdır',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
                }
            ]
        });

        // Butonları tıklamak yerine DataTable'ın kendi butonlarını kullanacağız
        $("#copyBtn").click(function() {
            table.button('.buttons-copy').trigger();
        });

        $("#excelBtn").click(function() {
            table.button('.buttons-excel').trigger();
        });

        $("#pdfBtn").click(function() {
            table.button('.buttons-pdf').trigger();
        });

        $("#printBtn").click(function() {
            table.button('.buttons-print').trigger();
        });
    });
</script>
@include('session.session')
@endsection
