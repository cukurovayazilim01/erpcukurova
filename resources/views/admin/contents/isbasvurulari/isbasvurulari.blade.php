@extends('admin.layouts.app')
@section('title')
    İş Başvuruları
@endsection
@section('contents')
    @section('topheader')
        İş Başvuruları
    @endsection
    <d+iv class="card radius-10">
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
                    <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-end">
                        <a href="{{asset('gereklidosyalar/isbasvuruformu.doc')}}" download="" type="button"
                            class="btn btn-sm btn-outline-danger">
                            <i class="fa-solid fa-file-pdf"></i>İş Başvuru Formu İndir</a>
                        <a href="{{route('isbasvurularilist')}}" type="button" class="btn btn-sm btn-outline-success">Tüm İş
                            Başvuruları</a>
                    </div>
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                        <a type="button" href="{{ route('isbasvurulari.create') }}"
                            class="btn btn-outline-dark btn-sm mx-0 mx-lg-2"><i class="fa-solid fa-plus"></i>İş Başvurusu
                            Ekle</a>
                    </div>
                </div>
            </div>
        </div>


    <div class="card-body">
        <div class="table-responsive" style="border-radius: 5px">
            <table id="example2" class="table table-bordered table-striped" style="width:100%;  ">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th>Başvuru Tarihi</th>
                            <th>Adı Soyadı</th>
                            <th>Başvurduğu Pozisyon</th>
                            <th>Telefon</th>
                            <th>Mail</th>
                            <th>Mezuniyet</th>
                            <th>Görüşme Notu</th>
                            <th>Durum</th>
                            <th>Dosya</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($isbasvuru as $sn => $isbasvuruitem)
                                        <tr>
                                            <th scope="row">{{ $sn + 1 }}</th>
                                            <td>{{ $isbasvuruitem->tarih }}</td>
                                            <td>{{ $isbasvuruitem->ad_soyad }}</td>
                                            <td>{{ $isbasvuruitem->basvuru_pozisyon }} </td>
                                            <td>{{ $isbasvuruitem->telefon }} </td>
                                            <td>{{ $isbasvuruitem->email }} </td>
                                            <td>{{ $isbasvuruitem->mezuniyet }} </td>
                                            <td>{{ $isbasvuruitem->gorusme_notu }} </td>
                                            <td>{{ $isbasvuruitem->durum }} </td>
                                            <td>
                                                @if ($isbasvuruitem->dosya)
                                                                        @php
                                                                            $fileExtension = pathinfo(
                                                                                $isbasvuruitem->dosya,
                                                                                PATHINFO_EXTENSION,
                                                                            );
                                                                        @endphp

                                                                        @if (strtolower($fileExtension) === 'pdf')
                                                                            <a href="{{ asset($isbasvuruitem->dosya) }}" target="_blank" style="color: red">
                                                                                <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ asset($isbasvuruitem->dosya) }}" target="_blank">
                                                                                <i class="bi bi-image"></i> Görüntüle
                                                                            </a>
                                                                        @endif
                                                @else
                                                    <span class="text-muted">Dosya Yok</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="d-flex align-items-center" style="justify-content: space-evenly; ">
                                                    @if($isbasvuruitem->personel_aktarma_durum == 1)
                                                        <button class="btn btn-sm btn-outline-secondary px-2" disabled>
                                                            <i class="fa-solid fa-check"></i> Aktarıldı
                                                        </button>
                                                    @else
                                                        <form action="{{ route('personeleaktar', ['id' => $isbasvuruitem->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-success personel_aktar px-2">
                                                                <i class="fa-solid fa-plus"></i> Personel Listesine Aktar
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="{{ route('isbasvurulari.show', ['isbasvurulari' => $isbasvuruitem->id]) }}"
                                                        class=" btn btn-link p-0 m-0 ">
                                                        <i style="color:#293445;  "
                                                        class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                                    </a>
                                                    <a href="{{ route('isbasvurulari.edit', ['isbasvurulari' => $isbasvuruitem->id]) }}"
                                                        class="text-warning">
                                                        <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('isbasvurulari.destroy', ['isbasvurulari' => $isbasvuruitem->id]) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-sm text-danger show_confirm">
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
            </div>
        </div>
    </d+iv>
    @include('session.session')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.personel_aktar').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const form = this.closest("form");

                    Swal.fire({
                        title: 'Personel Listesine Aktarmak istediğinizden emin misiniz?',
                        text: "Bu işlem geri alınamaz!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Evet, Aktar!',
                        cancelButtonText: 'Hayır'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var i = 0;
        $(document).on('click', '#addtaksit', function () {

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
    <!-- JavaScript: DataTable Yapılandırma -->
    <script>
        $(document).ready(function () {
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7
                            ] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    orientation: 'landscape', // Yatay mod
                    pageSize: 'A4', // Sayfa boyutu
                    customize: function (doc) {
                        // Yazı tipi ekleme
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 12;
                        doc.styles.tableHeader.fillColor = '#343a40'; // Başlık arka plan rengi
                        doc.styles.tableHeader.color = 'white'; // Başlık yazı rengi
                        doc.styles.title.fontSize = 14;
                        doc.styles.title.alignment = 'center';

                        // Sayfa başlığı ekleme
                        doc.content.splice(0, 0, {
                            text: 'isbasvuru LİSTESİ',
                            fontSize: 16,
                            bold: true,
                            margin: [0, 0, 0, 10],
                            alignment: 'center'
                        });

                        // Sayfa numarası ve tarih ekleme
                        doc.footer = function (currentPage, pageCount) {
                            return {
                                text: "Sayfa " + currentPage + " / " + pageCount,
                                alignment: 'center',
                                fontSize: 9,
                                margin: [0, 10, 0, 0]
                            };
                        };

                        // Otomatik sütun genişliği ayarlama
                        var objLayout = {};
                        objLayout['hLineWidth'] = function () { return 0.5; };
                        objLayout['vLineWidth'] = function () { return 0.5; };
                        objLayout['hLineColor'] = function () { return '#aaa'; };
                        objLayout['vLineColor'] = function () { return '#aaa'; };
                        objLayout['paddingLeft'] = function () { return 8; };
                        objLayout['paddingRight'] = function () { return 8; };
                        doc.content[1].layout = objLayout;
                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7] // Kolonları belirle
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i> Yazdır',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7] // Sadece istediğiniz kolonları seçin
                    }
                }
                ]
            });

            // Butonları tıklamak yerine DataTable'ın kendi butonlarını kullanacağız
            $("#copyBtn").click(function () {
                table.button('.buttons-copy').trigger();
            });

            $("#excelBtn").click(function () {
                table.button('.buttons-excel').trigger();
            });

            $("#pdfBtn").click(function () {
                table.button('.buttons-pdf').trigger();
            });

            $("#printBtn").click(function () {
                table.button('.buttons-print').trigger();
            });
        });
    </script>
@endsection
