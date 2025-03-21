@extends('admin.layouts.app')
@section('title')
KARGO TAKİP
@endsection
@section('contents')
@section('topheader')
KARGO TAKİP
@endsection

<style>
    .error {
        border: 2px solid red;
    }

    .success {
        border: 2px solid green;
    }

    .error-message {
        color: red;
        font-size: 12px;
    }
</style>
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row align-items-center g-3">

            <!-- CSS: Butonlar için stil -->
            <style>
                .table-buttons {
                    text-align: center;
                }

                .table-buttons button {
                    font-size: 11px;
                    border-radius: 5px;
                }

                /* İkon ve butonları hizalama */
                .table-buttons i {
                    margin-right: 8px;
                }
            </style>

            <!-- Yeni Ekle and Action Buttons -->
            <div class="col-md-12 text-end" style="display: flex; justify-content: flex-end  ">
                <div class="table-buttons">
                    <button class="btn btn-primary" id="copyBtn"><i class="fa fa-copy"></i> </button>
                    <button class="btn btn-success" id="excelBtn"><i class="fa fa-file-excel"></i> </button>
                    <button class="btn btn-danger" id="pdfBtn"><i class="fa fa-file-pdf"></i> </button>
                    <button class="btn btn-warning" id="printBtn"><i class="fa fa-print"></i> </button>
                    <!-- Yeni Ekle Button -->
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary px-5 ms-2" style="margin-left: 10px"
                    data-bs-toggle="modal" data-bs-target="#kargotakipmodal">
                    <i class="fa-solid fa-plus"></i> Yeni Ekle
                </button>

            </div>

            <style>
                .table-buttons {
                    justify-content: flex-end;
                    /* Butonları sağa yaslar */
                    gap: 10px;
                    /* Butonlar arasında boşluk bırakır */
                    align-items: center;
                    /* Yükseklik hizalaması için */
                }

                .table-buttons button {
                    font-size: 11px;
                    /* Buton yazı boyutunu ayarlama */
                }
            </style>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="kargotakipmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('kargotakip.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Kargo Takip Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="gonderen_ad">Gönderen Firma/Kurum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="gonderen_ad" id="gonderen_ad"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gonderi_tipi">Gönderi Tipi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="gonderi_tipi" id="gonderi_tipi"
                                            class="form-select form-select-sm" required>
                                            <option value="">Lütfen Seçiniz</option>
                                            <option value="Giden Kargo">Giden Kargo</option>
                                            <option value="Gelen Kargo">Gelen Kargo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="kargo_takip_no">Kargo Takip No</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="kargo_takip_no" id="kargo_takip_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="gonderi_tarihi">Gönderi Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="gonderi_tarihi" id="gonderi_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="hangi_kargo">Hangi Kargo</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="hangi_kargo" id="hangi_kargo"
                                            class="form-select form-select-sm" required>
                                            <option value="PTT Kargo">PTT Kargo</option>
                                            <option value="Aras Kargo">Aras Kargo</option>
                                            <option value="Yurt İçi Kargo">Yurt İçi Kargo</option>
                                            <option value="MNG Kargo">MNG Kargo</option>
                                            <option value="Sürat Kargo">Sürat Kargo</option>
                                            <option value="UPS Kargo">UPS Kargo</option>
                                            <option value="Trendyol Express">Trendyol Express</option>
                                            <option value="Hepsi JET">Hepsi JET</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="aciklama">Kargo Açıklaması</label>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2"
                                        class="form-control form-control-sm "></textarea>
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

                <table class="table align-middle mb-0 display " id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Kaydeden</th>
                            <th>Kayıt Tarihi</th>
                            <th>Gönderi Tarihi</th>
                            <th>Gönderen Ad</th>
                            <th>Kargo Takip No</th>
                            <th>Hangi Kargo</th>
                            <th>Açıklama</th>
                            <th>Kargoyu Alan</th>
                            <th>Kargo Durum</th>
                            <th>Alınan Tarih</th>
                            <th>Kargo Alındı Mı?</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kargotakip as $sn => $kargotakipitem)
                            <tr>
                                <th>{{ $sn + 1 }}</th>
                                <td>{{ $kargotakipitem->islemyapan->ad_soyad }}</td>
                                <td>{{ $kargotakipitem->islem_tarihi }}</td>
                                <td>{{ $kargotakipitem->gonderi_tarihi }}</td>
                                <td>{{ $kargotakipitem->gonderen_ad }}</td>
                                <td>{{ $kargotakipitem->kargo_takip_no }}</td>
                                <td>{{ $kargotakipitem->hangi_kargo }}</td>
                                <td class="text-wrap" style="max-width: 200px">{{ $kargotakipitem->aciklama }}</td>
                                <td>
                                    @if ($kargotakipitem->kargoyu_alan)
                                    <span  >{{$kargotakipitem->kargoyu_alan}}</span>

                                    @else
                                        <span  style="color: red">Kargoyu Alan Bilgisi Girilmedi</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($kargotakipitem->kargo_durum)
                                    <span  >{{$kargotakipitem->kargo_durum}}</span>

                                    @else
                                        <span  style="color: red">Alınmadı</span>
                                    @endif
                                </td><td>
                                    @if ($kargotakipitem->alinan_tarih)
                                    <span  >{{$kargotakipitem->alinan_tarih}}</span>

                                    @else
                                        <span  style="color: red">Kargoyu Alınan Tarihi Bilgisi Girilmedi</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm text-light btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#kargotakipupdateModal-{{ $kargotakipitem->id }}"> Kargo Alındı mı?
                                </button>
                                @include('admin.contents.kargotakip.kargotakip-update')
                                </td>
                                <td class="text-right">
                                    <div class="d-flex align-items-center">


                                        <form
                                            action="{{ route('kargotakip.destroy', ['kargotakip' => $kargotakipitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class=" text-danger show_confirm">
                                                <i class="bi bi-trash-fill"></i>
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
                        {{ $kargotakip->appends(['entries' => $perPage])->links() }}
                    </div>
                </div> --}}

            </div>

        </div>

    </div>
</div>


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
