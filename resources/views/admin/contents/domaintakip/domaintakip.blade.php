@extends('admin.layouts.app')
@section('title')
    DOMAİN TAKİP
@endsection
@section('contents')
@section('topheader')
    DOMAİN TAKİP
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

                        <form method="GET" action="{{ route('domaintakip.index') }}" id="entriesForm">
                            <select class="form-select form-select-sm" name="entries"
                                onchange="document.getElementById('entriesForm').submit();">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                </div>
                <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                    <form id="searchForm" action="{{ route('personelsearch') }}"  method="GET">
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-input-group-text px-3"><i class="bi bi-search"></i></div>
                            <input class="form-control ps-5" id="searchInput" type="text" placeholder="Genel Arama">
                          </div>
                        </form>
                </div>
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">

                    <button type="button" class="btn btn-outline-dark btn-sm mx-0 mx-lg-2"  data-bs-toggle="modal"
                    data-bs-target="#domaintakipmodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="domaintakipmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('domaintakip.store') }}" method="POST" >
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Domain Ekleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                                <div class="col-md-6 select2-sm">
                                    <label for="cari_id_3">Firma</label>

                                    <select name="cari_id" id="cari_id_3_3" required
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="satis_temsilcisi" id="satis_temsilcisi"
                                            class="form-control form-control-sm" required>
                                            <option value="">Satış Temsilcisi Seçiniz</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->ad_soyad }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="vkn">Telefon No</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <input type="text" name="telefon_no" id="telefon_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="domain_adi">Domain Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="domain_adi" id="domain_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="domain_tutar">Domain Tutarı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="domain_tutar" id="domain_tutar"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>





                            </div>
                            <div class="mobile-footer"
                                style="display: flex;  gap:20px; text-align: center; justify-content: end; ">

                                <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                                <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>




    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">

                <table class="table dataTable table-striped table-bordered" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th>Domain Adı</th>
                            <th>Bitiş Tarihi</th>
                            <th>Firma Adı</th>
                            <th>Yetkili Kişi</th>
                            <th>Telefon</th>
                            <th>Müşteri Temsilcisi</th>
                            <th>Tutar</th>
                            <th>Hizmet</th>
                            <th>Açıklama</th>
                            <th>İşlem</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($domaintakip as $domaintakipitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                {{-- <td>{{ $domaintakipitem->islem_tarihi }}</td> --}}
                                <td>{{ $domaintakipitem->domain_adi }}</td>
                                <td>
                                    {{ $domaintakipitem->domaindata->pluck('bitis_tarihi')->implode(', ') }}
                                </td>
                                <td>{{ $domaintakipitem->firmaadi->firma_unvan ?? '-'}}</td>
                                <td>{{ $domaintakipitem->firmaadi->yetkili_kisi ?? '-'}}</td>
                                <td>{{ $domaintakipitem->firmaadi->yetkili_kisi_tel?? '-' }}</td>
                                <td>{{ $domaintakipitem->firmaadi->user->ad_soyad?? '-' }}</td>
                                {{-- <td>{{ $domaintakipitem->user->ad_soyad }}</td> --}}
                                <td>
                                    {{ $domaintakipitem->domaindata->pluck('tutar')->implode(', ') }} + KDV
                                </td>
                                    @php
                                    $hizmetler = $domaintakipitem->domaindata->pluck('hizmet_turu')->filter()->implode(', ');
                                @endphp

                                <td>{{ $hizmetler ?: 'Domain' }}</td>
                                <td>{{ $domaintakipitem->basvuru_no }}</td>
                                {{-- <td class="text-wrap" style="max-width:100px">
                                    {{ $domaintakipitem->hizmet->hizmet_ad }}</td>

                                <td style="text-align: center">
                                    @if ($domaintakipitem->marka_islem === 'Yapıldı')
                                        <span class="badge bg-success">{{ $domaintakipitem->marka_islem }}</span>
                                    @elseif($domaintakipitem->marka_islem === 'Yapılmadı')
                                        <span class="badge bg-danger">{{ $domaintakipitem->marka_islem }}</span>
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    @if ($domaintakipitem->marka_durum === 'Tescil Edildi')
                                        <span class="badge bg-success" style="font-size: 12px;"><i
                                                class="fa fa-check"></i></span>
                                    @elseif($domaintakipitem->marka_durum === 'İptal Edildi')
                                        <span class="badge bg-danger" style="font-size: 12px;"><i
                                                class="fa fa-times"></i></span>
                                    @elseif($domaintakipitem->marka_durum === 'Süreç Devam Ediyor')
                                        <span class="badge bg-warning" style="font-size: 12px;"><i
                                                class="fa fa-spinner"></i></span>
                                    @endif
                                </td> --}}
                                <td>
                                    {{-- <a href="{{ route('domainhizmet', ['id' => $domaintakipitem->id]) }}"
                                        class="text-warning btn btn-link p-0 m-0 ">
                                        Hizmetler
                                    </a> --}}
                                    <a type="button" class="btn btn-sm btn-primary " style="margin-left: 10px"
                                    href="{{ route('domainhizmet', ['id' => $domaintakipitem->id]) }}">
                    <i class="fa-solid fa-plus"></i> Hizmetler
                </a>
                                </td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                                            <button class="text-warning" data-bs-toggle="modal"
                                                data-bs-target="#domaintakipupdateModal-{{ $domaintakipitem->id }}">
                                                <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                            </button>
                                            {{-- @include('admin.contents.domaintakip.domaintakip-update') --}}

                                            <form
                                                action="{{ route('domaintakip.destroy', ['domaintakip' => $domaintakipitem->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger p-0 m-0 show_confirm">
                                                    <i style="color: rgb(180, 68, 34)"
                                                    class="fa-solid fa-trash-can fs-6"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
                        {{ $domaintakip->appends(['entries' => $perPage])->links() }}
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>



{{-- SEARCHHHH  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $(document).ready(function(){
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('domaintakipsearch') }}',
                    method: 'GET',
                    data: { domaintakipsearch: '' }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('domaintakipsearch') }}',
                    method: 'GET',
                    data: { domaintakipsearch: searchValue }, // Arama değeri
                    success: function(response) {
                        // Sadece tbody kısmını güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            }
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('#cari_id_3_3').on('change', function() {
            var selectedCariId = $(this).val();

            $.ajax({
                url: '/getMusteriTemsilcisi/' + selectedCariId,
                type: 'GET',
                dataType: 'json', // Gelen verinin JSON olduğunu belirtin
                success: function(data) {
                    // AJAX isteği başarılı olduğunda çalışacak kod
                    $('#musteri_temsilcisi').val(data.musteri_temsilcisi);
                    $('#telefon_no').val(data.telefon_no);
                    $('#vkn').val(data.vkn);
                    $('#sehir').val(data.sehir);
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
    $(document).ready(function() {
        // Birinci modal için Select2
        $('#cari_id_3_1').select2({
            theme: 'bootstrap4',
            placeholder: "Firma Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%',
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
            dropdownParent: $('#domaintakipfilmodal'),
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
        $('#cari_id_3_1').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });

        // İkinci modal için Select2
        $('#cari_id_3_2').select2({
            theme: 'bootstrap4',
            placeholder: "Firma Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%',
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
            dropdownParent: $('#domaintakipfilexcelmodal'),
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
            $('#cari_id_3_2').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
        });
        // İkinci modal için Select2
        $('#cari_id_3_3').select2({
            theme: 'bootstrap4',
            placeholder: "Firma Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%',
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
            dropdownParent: $('#domaintakipmodal'),
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
            $('#cari_id_3_3').on('select2:open', function() {
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
    document.addEventListener("DOMContentLoaded", function () {
        const hizmetTuruSelect = document.getElementById("hizmet_turu");
        const mailAdetDiv = document.getElementById("mail_adet_div");
        const mailPlatformDiv = document.getElementById("mail_platform_div");
        const platformDiv = document.getElementById("platform_div");
        const sunucuDiv = document.getElementById("sunucu_div");
        const vdsDiv = document.getElementById("vds_div");
        const sunucuSelect = document.getElementById("sunucu");
        const vdsSelect = document.getElementById("vds");
        const mailAdetInput = document.getElementById("mail_adet");
        const platformInput = document.getElementById("platform");
        const mailPlatformSelect = document.getElementById("mail_platform");

        function resetInputs() {
            mailAdetInput.value = "";
            platformInput.value = "";
            if (sunucuSelect) sunucuSelect.value = "";
            if (vdsSelect) vdsSelect.value = "";
            if (mailPlatformSelect) mailPlatformSelect.value = "";
        }

        function handleHizmetTuruChange() {
            resetInputs();
            const hizmetTuru = hizmetTuruSelect.value;

            // Tüm inputları gizle
            mailAdetDiv.style.display = "none";
            mailPlatformDiv.style.display = "none";
            platformDiv.style.display = "none";
            sunucuDiv.style.display = "none";
            vdsDiv.style.display = "none";

            // Seçilen hizmet türüne göre ilgili inputları göster
            if (hizmetTuru === "Domain,Mail") {
                mailAdetDiv.style.display = "block";
                mailPlatformDiv.style.display = "block";
            } else if (hizmetTuru === "Domain,Hosting") {
                sunucuDiv.style.display = "block";
            } else if (hizmetTuru === "Domain,Hosting,Mail") {
                mailAdetDiv.style.display = "block";
                mailPlatformDiv.style.display = "block";
                sunucuDiv.style.display = "block";
            }
        }

        function handleSunucuChange() {
            vdsSelect.value = ""; // VDS seçimini sıfırla
            platformInput.value = ""; // Platform girişini sıfırla

            if (sunucuSelect.value === "Evet") {
                vdsDiv.style.display = "block";
                platformDiv.style.display = "none";
            } else {
                vdsDiv.style.display = "none";
                platformDiv.style.display = "block";
            }
        }

        hizmetTuruSelect.addEventListener("change", handleHizmetTuruChange);
        sunucuSelect.addEventListener("change", handleSunucuChange);
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
                            text: 'PERSONEL LİSTESİ',
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
@include('session.session')
@endsection
