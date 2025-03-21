@extends('admin.layouts.app')
@section('title')
{{$domaintakip->domain_adi}} DOMAİN HİZMETLERİ
@endsection
@section('contents')
@section('topheader')
{{$domaintakip->domain_adi}} DOMAİN HİZMETLERİ
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




            <!-- Yeni Ekle and Action Buttons -->
            <div class="col-md-12 text-end">

                <!-- Yeni Ekle Button -->
                <button type="button" class="btn btn-sm btn-outline-primary px-5" style="margin-left: 10px"
                    data-bs-toggle="modal" data-bs-target="#domainhizmeteklemodal">
                    <i class="fa-solid fa-plus"></i> Yeni Ekle
                </button>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="domainhizmeteklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('domainhizmet.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">{{$domaintakip->domain_adi}} Hizmet Ekleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row">
                                <input type="hidden" name="domaintakip_id" value="{{ $domaintakip->id }}">

                                <div class="col-md-3">
                                    <label for="basvuru_tarihi">Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="tarih" id="tarih"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="hizmet_turu">Hizmet Türü</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="hizmet_turu" id="hizmet_turu"
                                            class="form-select form-select-sm" required>
                                            <option value="">Seçim Yapınız</option>
                                            <option value="Mail Hosting">Mail Hosting</option>
                                            <option value="Web Hosting">Web Hosting</option>
                                            <option value="Web,Mail Hosting">Web,Mail Hosting</option>
                                            <option value="Workspace">Workspace</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="domain_suresi">Domain Süresi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="domain_suresi" id="domain_suresi"
                                            class="form-select form-select-sm" required>
                                            <option value="">Seçim Yapınız</option>

                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="resim">Resim</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="file" name="resim" id="resim"
                                            class="form-control form-control-sm" >
                                    </div>
                                </div>


                                <!-- Mail Adet Input -->
                                <div class="col-md-3" id="mail_adet_div" style="display: none;">
                                    <label for="mail_adet">Mail Adet</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="number" name="mail_adet" id="mail_adet" class="form-control">
                                    </div>
                                </div>
                                 <!-- Mail Adet Input -->
                                 <div class="col-md-3" id="mail_platform_div" style="display: none;">
                                    <label for="mail_adet">Mail Platform</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <select name="mail_platform" id="mail_platform" class="form-select form-select-sm">
                                            <option value="">Seçiniz</option>
                                            <option value="Yandex">Yandex</option>
                                            <option value="Sunucu">Sunucu</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Sunucu Bizde mi? Select -->
                                <div class="col-md-3" id="sunucu_div" style="display: none;">
                                    <label for="sunucu">Sunucu Bizde mi?</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    <select name="sunucu" id="sunucu" class="form-select form-select-sm">
                                        <option value="">Seçiniz</option>
                                        <option value="Evet">Evet</option>
                                        <option value="Hayır">Hayır</option>
                                    </select>
                                </div>

                                </div>

                                <!-- VDS Seçimi -->
                                <div class="col-md-3" id="vds_div" style="display: none;">
                                    <label for="vds">VDS Seçimi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    <select name="hosting_platform" id="vds" class="form-select form-select-sm">
                                        <option value="">Seçiniz</option>
                                        <option value="VDS4">VDS4</option>
                                        <option value="VDS6">VDS6</option>
                                    </select>
                                </div>
                            </div>

                                <!-- Platform Input -->
                                <div class="col-md-3" id="platform_div" style="display: none;">
                                    <label for="platform">Platform</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-server"></i>
                                        </span>
                                        <input type="text" name="hosting_platform_iki" id="platform" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="tutar">Tutar</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-money-bill"></i>
                                        </span>
                                        <input type="text" name="tutar" id="tutar"
                                            class="form-control form-control-sm input-mask" required>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="aciklama">Açıklama</label>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
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
                <div class="row">


                    {{-- <form id="searchForm" action="{{ route('domaintakipsearch') }}" method="GET">
                            @csrf
                            <div class="ms-auto position-relative" style="margin-bottom: 10px">
                                <!-- Arama ikonu -->
                                <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3" style="color: blue;">
                                    <i class="bi bi-search"></i>
                                </div>
                                <!-- Arama inputu -->
                                <input type="text" id="searchInput" class="form-control ps-5" style="border: 1px solid blue; height: 38px;" placeholder="Lütfen Arama Terimi Giriniz">
                            </div>
                        </form> --}}


                </div>
                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Domain Adı</th>
                            <th>Bitiş Tarihi</th>
                            <th>Firma Adı</th>
                            <th>Müşteri Temsilcisi</th>
                            <th>Telefon</th>
                            <th>Hizmet</th>
                            <th>Hosting Platform</th>
                            <th>Mail Adet</th>
                            <th>Mail Platform</th>
                            <th>Tutar</th>
                            <th>Açıklama</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($domaintakipdata as $sn => $domaintakipdataitem)
                        <tr>
                            <th scope="row">{{$sn + 1}}</th>
                            {{-- <td>{{ $domaintakipdataitem->islem_tarihi }}</td> --}}
                            <td>{{ $domaintakipdataitem->domain->domain_adi }}</td>
                            <td>{{ $domaintakipdataitem->bitis_tarihi }}</td>
                            <td>{{ $domaintakipdataitem->domain->firmaadi->firma_unvan }}</td>
                            <td>{{ $domaintakipdataitem->domain->firmaadi->yetkili_kisi }}</td>
                            <td>{{ $domaintakipdataitem->domain->firmaadi->yetkili_kisi_tel }}</td>

                            <td>{{ $domaintakipdataitem->hizmet_turu }}</td>
                            <td>{{ $domaintakipdataitem->hosting_platform ?? '-' }}</td>
                            <td>{{ $domaintakipdataitem->mail_adet ?? '-' }}</td>
                            <td>{{ $domaintakipdataitem->mail_platform ?? '-' }}</td>
                            <td>{{ $domaintakipdataitem->tutar }}</td>
                            {{-- <td class="text-wrap" style="max-width:100px">
                                {{ $domaintakipdataitem->hizmet->hizmet_ad }}</td>

                            <td style="text-align: center">
                                @if ($domaintakipdataitem->marka_islem === 'Yapıldı')
                                    <span class="badge bg-success">{{ $domaintakipdataitem->marka_islem }}</span>
                                @elseif($domaintakipdataitem->marka_islem === 'Yapılmadı')
                                    <span class="badge bg-danger">{{ $domaintakipdataitem->marka_islem }}</span>
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if ($domaintakipdataitem->marka_durum === 'Tescil Edildi')
                                    <span class="badge bg-success" style="font-size: 12px;"><i
                                            class="fa fa-check"></i></span>
                                @elseif($domaintakipdataitem->marka_durum === 'İptal Edildi')
                                    <span class="badge bg-danger" style="font-size: 12px;"><i
                                            class="fa fa-times"></i></span>
                                @elseif($domaintakipdataitem->marka_durum === 'Süreç Devam Ediyor')
                                    <span class="badge bg-warning" style="font-size: 12px;"><i
                                            class="fa fa-spinner"></i></span>
                                @endif
                            </td> --}}

                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">

{{--
                                        <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#domaintakipdataupdateModal-{{ $domaintakipdataitem->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <form
                                            action="{{ route('domaintakipdata.destroy', ['domaintakipdata' => $domaintakipdataitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-link text-danger p-0 m-0 show_confirm">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {{-- <div class="row">
                    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
                        {{ $domaintakip->appends(['entries' => $perPage])->links() }}
                    </div>
                </div> --}}

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

    });
</script>

<script>
    $(document).ready(function() {
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
            if (hizmetTuru === "Mail Hosting") {
                mailAdetDiv.style.display = "block";
                mailPlatformDiv.style.display = "block";
            } else if (hizmetTuru === "Web Hosting") {
                sunucuDiv.style.display = "block";
            } else if (hizmetTuru === "Web,Mail Hosting") {
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


<script>
    function validateRequiredFields() {
        var requiredFields = document.querySelectorAll('[required]');
        var isValid = true;

        requiredFields.forEach(function(field) {
            if (field.value.trim() === '') {
                isValid = false;
                field.style.borderColor = 'red';
            }
        });

        return isValid;
    }

    var addRowButton = document.getElementById('submit-form');
    var isButtonDisabled = localStorage.getItem('isButtonDisabled');

    if (isButtonDisabled === 'true') {
        addRowButton.disabled = true;
        addRowButton.innerHTML =
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"><path d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z" stroke="currentColor" stroke-width="1.5"></path><path d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22" stroke="currentColor" stroke-width="1.5"></path><path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path></svg>İşlem devam ediyor...';
    }

    addRowButton.addEventListener('click', function() {
        if (validateRequiredFields()) {
            this.disabled = true;
            this.innerHTML =
                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"><path d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z" stroke="currentColor" stroke-width="1.5"></path><path d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22" stroke="currentColor" stroke-width="1.5"></path><path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path></svg>İşlem devam ediyor...';
            document.getElementById('add-form').submit();
            localStorage.setItem('isButtonDisabled', 'true');
        }
    });

    window.addEventListener('beforeunload', function() {
        localStorage.removeItem('isButtonDisabled');
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Sayfa başına gösterilecek giriş sayısı seçim menüsü
        const entriesForm = document.getElementById("entriesForm");
        const entriesSelect = entriesForm.querySelector("select[name='entries']");

        // Seçim değiştirildiğinde form gönderiliyor
        entriesSelect.addEventListener("change", function() {
            entriesForm.submit();
        });
    });
</script>
@include('session.session')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
        });
    });
</script>
@endsection
