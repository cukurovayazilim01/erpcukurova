@extends('admin.layouts.app')
@section('title')
İş Başvuruları
@endsection
@section('contents')
@section('topheader')
İş Başvuruları
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <a href="{{asset('gereklidosyalar/isbasvuruformu.doc')}}" download="" type="button" class="btn btn-sm btn-outline-danger">
                    <i class="fa-solid fa-file-pdf"></i>İş Başvuru Formu İndir</a>
                <a href="{{route('isbasvurularilist')}}"  type="button" class="btn btn-sm btn-outline-success">Tüm İş Başvuruları</a></div>

            <div class="col-md-9">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <div class="table-buttons">
                        <button class="btn btn-primary" id="copyBtn"><i class="fa fa-copy"></i> </button>
                        <button class="btn btn-success" id="excelBtn"><i class="fa fa-file-excel"></i> </button>
                        <button class="btn btn-danger" id="pdfBtn"><i class="fa fa-file-pdf"></i> </button>
                        <button class="btn btn-warning" id="printBtn"><i class="fa fa-print"></i> </button>
                        <!-- Yeni Ekle Button -->
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#isbasvurumodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="isbasvurumodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('isbasvurulari.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">İş Başvuru Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;">
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="tarih">Başvuru Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="tarih" id="tarih"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ad_soyad">Ad Soyadı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="ad_soyad" id="ad_soyad"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="basvuru_pozisyon">Başvurduğu Pozisyon</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="basvuru_pozisyon" id="basvuru_pozisyon"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="telefon">Telefon</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="number" name="telefon" id="telefon"
                                            class="form-control form-control-sm no-zero" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="meslek_kodu">Eposta</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="email" name="email" id="email"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="mezuniyet">Mezuniyet</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="mezuniyet" id="mezuniyet" class="form-select form-select-sm">
                                            <option value="Lisans">Lisans</option>
                                            <option value="Yüksek Lisans">Yüksek Lisans</option>
                                            <option value="Ön Lisans">Ön Lisans</option>
                                            <option value="Lise">Lise</option>
                                            <option value="OrtaOkul">OrtaOkul</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="durum">Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="durum" id="durum" class="form-select form-select-sm">
                                            <option value="Olumlu">Olumlu</option>
                                            <option value="Olumsuz">Olumsuz</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="dosya">Dosya</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="file" name="dosya" id="dosya"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="gorusme_notu">Görüşme Notu</label>
                                        <textarea name="gorusme_notu" id="gorusme_notu" cols="20" rows="2" class="form-control form-control-sm "></textarea>
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
            <table class="table align-middle mb-0" id="example2">
                <thead class="table-light">
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
                                        <a href="{{ asset($isbasvuruitem->dosya) }}" target="_blank"
                                            style="color: red">
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
                                <div class="d-flex align-items-center">
                                    <button class="text-warning" data-bs-toggle="modal"
                                        data-bs-target="#isbasvuruupdateModal-{{ $isbasvuruitem->id }}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    @include('admin.contents.isbasvurulari.isbasvurulari-update')
                                    {{-- <a href="{{ route('izinler.show', ['izinler' => $isbasvuruitem->id]) }}"
                                        class="text-primary btn btn-link p-0 m-0 ">
                                        <i class="bi bi-eye-fill"></i>
                                    </a> --}}
                                    <form
                                        action="{{ route('isbasvurulari.destroy', ['isbasvurulari' => $isbasvuruitem->id]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-sm text-danger show_confirm">
                                            <i class="bi bi-trash-fill"></i>
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
</div>
@include('session.session')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            9,10,11,12,13] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9,10,11,12,13] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    orientation: 'landscape', // Yatay mod
                    pageSize: 'A4', // Sayfa boyutu
                    customize: function(doc) {
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
                        doc.footer = function(currentPage, pageCount) {
                            return {
                                text: "Sayfa " + currentPage + " / " + pageCount,
                                alignment: 'center',
                                fontSize: 9,
                                margin: [0, 10, 0, 0]
                            };
                        };

                        // Otomatik sütun genişliği ayarlama
                        var objLayout = {};
                        objLayout['hLineWidth'] = function() { return 0.5; };
                        objLayout['vLineWidth'] = function() { return 0.5; };
                        objLayout['hLineColor'] = function() { return '#aaa'; };
                        objLayout['vLineColor'] = function() { return '#aaa'; };
                        objLayout['paddingLeft'] = function() { return 8; };
                        objLayout['paddingRight'] = function() { return 8; };
                        doc.content[1].layout = objLayout;
                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13] // Kolonları belirle
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i> Yazdır',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9,10,11,12,13] // Sadece istediğiniz kolonları seçin
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
@endsection
