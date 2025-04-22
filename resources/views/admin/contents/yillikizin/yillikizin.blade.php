@extends('admin.layouts.app')
@section('title')
    YILLIK İZİNLER
@endsection
@section('contents')
@section('topheader')
    YILLIK İZİNLER
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
<div class="row">
    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body">
                <div class="profile-avatar text-left">
                    {{-- <img src="{{ asset('resim/1725441039-BEKİR-ÜNAL-KAYMAKÇI.jpeg') }}" class="rounded-circle shadow"
                        width="120" height="120" alt=""> --}}
                    <button type="button" class="btn btn-sm btn-outline-primary  "
                        data-bs-toggle="modal" data-bs-target="#yillikizinhakkimodal">
                        <i class="fa-solid fa-plus"></i> İzin Hakkı Ekle
                    </button>
                    <a href="{{route('yillikizinhakkilist')}}" type="button" class="btn btn-sm btn-outline-success float-end">
                         Tümünü Gör
                    </a>
                </div>
                {{-- <div class="text-center mt-4">
                    <h4 class="mb-1"></h4>
                    <p class="mb-0 text-secondary"></p>
                    <div class="mt-4"></div>
                </div> --}}
                <hr>
                <div class="text-start">
                    <h5>Personel Kalan İzin Hakları</h5>
                </div>
                    <!-- Başlık Satırı -->
                    <div class="d-flex justify-content-between align-items-center bg-light border-bottom p-2 mb-2">
                        <span class="text-truncate fw-bold" style="flex: 1 1 40%; max-width: 40%;">İsim</span>
                        <span class="text-center fw-bold" style="flex: 1 1 20%; max-width: 20%;">Yıl</span>
                        <span class="text-center fw-bold" style="flex: 1 1 20%; max-width: 20%;">İzin Hakkı</span>
                        <span class="text-center fw-bold" style="flex: 1 1 20%; max-width: 20%;">Kalan Hak</span>
                    </div>

                    <!-- Liste -->
                    <ul class="list-group list-group-flush">
                        @foreach ($yillikizinhakki as $yillikizinhakkiitem)
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-light border-top">
                                <!-- İsim için sabit genişlik -->
                                <span class="text-truncate" style="flex: 1 1 40%; max-width: 40%;">{{$yillikizinhakkiitem->personel->ad_soyad}}</span>
                                <!-- Diğer sütunlar için sabit genişlik -->
                                <span class="text-center" style="flex: 1 1 20%; max-width: 20%;"><b style="color: #007bff;">{{$yillikizinhakkiitem->yili}}</b></span>
                                <span class="text-center" style="flex: 1 1 20%; max-width: 20%;"><b style="color: #28a745;">{{$yillikizinhakkiitem->yillik_izin_hakki}} Gün</b></span>
                                <span class="text-center" style="flex: 1 1 20%; max-width: 20%;"><b style="color: #dc3545;">{{$yillikizinhakkiitem->kalan_izin_hakki}} Gün</b></span>
                            </li>
                        @endforeach
                    </ul>
            </div>

        </div>
    </div>

    <div class="col-md-9">
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
                    <div class="col-md-4">
                        {{-- <a href="{{ route('yillikizin.show', ['yillikizin' => 1]) }}" target="_blank"
                            class="btn btn-sm btn-outline-primary px-5 ms-2">
                            Yıllık İzin Planı
                        </a> --}}
                        <a href="javascript:void(0);"
                        class="btn btn-sm btn-outline-primary px-5 ms-2 openPdfModal"
                        data-url="{{ route('yillikizin.show', ['yillikizin' => 1]) }}">
                        Yıllık İzin Planı
                     </a>

                        {{-- <button type="button" class="btn btn-sm btn-outline-primary px-5 ms-2"
                            style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#yillikizinPlani">
                            <i class="fa-solid fa-plus"></i> Yıllık İzin Planı
                        </button> --}}

                     <!-- PDF Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" src="" style="width: 100%; height: 500px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
                    </div>
                    <!-- Yeni Ekle and Action Buttons -->
                    <div class="col-md-8 text-end" style="display: flex; justify-content: flex-end  ">
                        {{-- <form id="searchForm" action="{{ route('yillikizinsearch') }}"  method="GET">
                            <div class="ms-auto position-relative">
                                <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"><i class="bi bi-search"></i></div>
                                <input class="form-control ps-5" id="searchInput" type="text" placeholder="Genel Arama">
                              </div>
                            </form> --}}
                        <div class="table-buttons">
                            <button class="btn btn-primary" id="copyBtn"><i class="fa fa-copy"></i> </button>
                            <button class="btn btn-success" id="excelBtn"><i class="fa fa-file-excel"></i> </button>
                            <button class="btn btn-danger" id="pdfBtn"><i class="fa fa-file-pdf"></i> </button>
                            <button class="btn btn-warning" id="printBtn"><i class="fa fa-print"></i> </button>
                            <!-- Yeni Ekle Button -->
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-primary px-5 ms-2"
                            style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#yillikizinmodal">
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
            <!--YILLIK İZİN HAKKI EKLE Modal -->
            <div class="modal fade" id="yillikizinhakkimodal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog ">
                    <form id="add-form" action="{{ route('izinhakkipost') }}" method="POST" id="add-form">
                        @csrf
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Yıllık İzin Hakkı Ekleme Ekranı</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body" style="display: flex; padding: 2%;">
                                <!-- Left Side -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="personel_id">Personel Adı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <select name="personel_id" id="personel_id"
                                                class="form-select form-select-sm" required>
                                                <option value="">Lütfen Seçiniz</option>
                                                @foreach ($personel as $personelitem)
                                                    <option value="{{ $personelitem->id }}">
                                                        {{ $personelitem->ad_soyad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="yillik_izin_hakki">Yıllık İzin Hakkı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="number" name="yillik_izin_hakki" id="yillik_izin_hakki"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bitis_tarihi">Kalan İzin Hakkı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="number" name="kalan_izin_hakki" id="kalan_izin_hakki"
                                                class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed"
                                                onkeydown="return false;" readonly required >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="yili">Yılı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <select name="yili" id="yili" class="form-select form-select-sm"
                                                required>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="hangi_ay">Durum</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <select name="durum" id="durum" class="form-select form-select-sm"
                                                required>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Pasif">Pasif</option>
                                            </select>
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
            <!--YILLIK İZİN EKLE Modal -->
            <div class="modal fade" id="yillikizinmodal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form id="add-form" action="{{ route('yillikizin.store') }}" method="POST" id="add-form">
                        @csrf
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Yıllık İzin Ekleme Ekranı</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body" style="display: flex; padding: 2%;">
                                <!-- Left Side -->
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="personel_id">Personel Adı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <select name="personel_id" id="personel_id"
                                                class="form-select form-select-sm personel_id" required>
                                                <option value="">Lütfen Seçiniz</option>
                                                @foreach ($personel as $personelitem)
                                                    <option value="{{ $personelitem->id }}">
                                                        {{ $personelitem->ad_soyad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="yili">Yılı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <select name="yili" id="yili" class="form-select form-select-sm yili"
                                                required>
                                                <option value="">Lütfen Seçiniz</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="yillik_izin_hakki">Yıllık İzin Hakkı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="number" name="yillik_izin_hakki" id="yillik_izin_hakki"
                                                class="form-control form-control-sm yillik_izin_hakki" style="pointer-events: none; cursor: not-allowed"
                                                onkeydown="return false;" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bitis_tarihi">Kalan İzin Hakkı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="number" name="kalan_izin_hakki" id="kalan_izin_hakki"
                                                class="form-control form-control-sm kalan_izin_hakki" style="pointer-events: none; cursor: not-allowed"
                                                onkeydown="return false;" readonly required >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" name="baslangic_tarihi" id="baslangic_tarihi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bitis_tarihi">Bitiş Tarihi</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" name="bitis_tarihi" id="bitis_tarihi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <label for="izin_gun">İzin Gün</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="text" name="izin_gun" id="izin_gun"
                                                class="form-control form-control-sm"
                                                style="pointer-events: none; cursor: not-allowed"
                                                onkeydown="return false;" readonly required required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="hangi_ay">Hangi Ay</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <select name="hangi_ay" id="hangi_ay" class="form-select form-select-sm"
                                                required>
                                                <option value="Ocak">Ocak</option>
                                                <option value="Şubat">Şubat</option>
                                                <option value="Mart">Mart</option>
                                                <option value="Nisan">Nisan</option>
                                                <option value="Mayıs">Mayıs</option>
                                                <option value="Haziran">Haziran</option>
                                                <option value="Temmuz">Temmuz</option>
                                                <option value="Ağustos">Ağustos</option>
                                                <option value="Eylül">Eylül</option>
                                                <option value="Ekim">Ekim</option>
                                                <option value="Kasım">Kasım</option>
                                                <option value="Aralık">Aralık</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="izin_aciklama">Geçirilecek Adres</label>
                                        <textarea name="gecirilecek_adres" id="gecirilecek_adres" cols="20" rows="2"
                                            class="form-control form-control-sm "></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="izin_aciklama">İzin Açıklaması</label>
                                        <textarea name="izin_aciklama" id="izin_aciklama" cols="20" rows="2"
                                            class="form-control form-control-sm "></textarea>
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


                            <form id="searchForm" action="{{ route('yillikizinsearch') }}" method="GET">
                                @csrf
                                <div class="ms-auto position-relative" style="margin-bottom: 10px">
                                    <!-- Arama ikonu -->
                                    <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"
                                        style="color: blue;">
                                        <i class="bi bi-search"></i>
                                    </div>
                                    <!-- Arama inputu -->
                                    <input type="text" id="searchInput" class="form-control ps-5"
                                        style="border: 1px solid blue; height: 38px;"
                                        placeholder="Lütfen Arama Terimi Giriniz">
                                </div>
                            </form>


                        </div>
                        <table class="table align-middle mb-0  " id="example2">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Başlangıç Tarihi</th>
                                    <th>Bitiş Tarihi</th>
                                    <th>Personel Adı</th>
                                    {{-- <th>İzin Hakkı</th> --}}
                                    <th>Kullanılan İzin</th>
                                    <th>Hangi Ay</th>
                                    <th>Geçirilecek Adres</th>
                                    <th>Açıklama</th>
                                    <th>Aksiyon</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($yillikizin as $sn => $yillikizinitem)
                                    <tr>
                                        <th>{{ $sn + 1 }}</th>
                                        <td>{{ $yillikizinitem->baslangic_tarihi }}</td>
                                        <td>{{ $yillikizinitem->bitis_tarihi }}</td>
                                        <td>{{ $yillikizinitem->personel->ad_soyad }}</td>
                                        {{-- <td>{{ $yillikizinitem->izin_hakki }} Gün</td> --}}
                                        <td>{{ $yillikizinitem->izin_gun }} Gün</td>
                                        <td>{{ $yillikizinitem->hangi_ay }}</td>
                                        <td>{{ $yillikizinitem->gecirilecek_adres }}</td>
                                        <td>{{ $yillikizinitem->izin_aciklama }}</td>

                                        <td class="text-right">
                                            <div class="d-flex align-items-center">
                                                <button class=" btn btn-sm btn-link text-warning p-0 m-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#yillikizinupdateModal-{{ $yillikizinitem->id }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                @include('admin.contents.yillikizin.yillikizin-update')
                                                {{-- <a href="{{ route('yillikizin.show', ['yillikizin' => $yillikizinitem->id]) }}"
                                                    class="text-primary btn btn-link p-0 m-0 ">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a> --}}
                                                <form
                                                    action="{{ route('yillikizin.destroy', ['yillikizin' => $yillikizinitem->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm p-0 m-0 btn-link text-danger show_confirm">
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
                                {{ $yillikizin->appends(['entries' => $perPage])->links() }}
                            </div>
                        </div> --}}

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('yillik_izin_hakki').addEventListener('input', function() {
        document.getElementById('kalan_izin_hakki').value = this.value;
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".openPdfModal").forEach(button => {
            button.addEventListener("click", function () {
                let pdfUrl = this.getAttribute("data-url");
                let pdfFrame = document.getElementById("pdfFrame");
                pdfFrame.src = pdfUrl; // PDF kaynağını değiştir

                let pdfModal = new bootstrap.Modal(document.getElementById("pdfModal"));
                pdfModal.show(); // Modalı aç
            });
        });
    });
    </script>

{{-- SEARCHHHH  --}}
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
                    url: '{{ route('yillikizinsearch') }}',
                    method: 'GET',
                    data: {
                        yillikizinsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('yillikizinsearch') }}',
                    method: 'GET',
                    data: {
                        yillikizinsearch: searchValue
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
    $(document).ready(function () {
    $('.personel_id, .yili').change(function () {
        let personel_id = $('.personel_id').val();
        let yili = $('.yili').val();

        if (personel_id && yili) {
            $.ajax({
                url: '/get-izin-hakki',
                type: 'GET',
                data: { personel_id: personel_id, yili: yili },
                dataType: 'json',
                success: function (response) {
                    $('.yillik_izin_hakki').val(response.yillik_izin_hakki);
                    $('.kalan_izin_hakki').val(response.kalan_izin_hakki);
                },
                error: function () {
                    console.log("Veri getirilemedi.");
                }
            });
        } else {
            $('#yillik_izin_hakki, #kalan_izin_hakki').val('');
        }
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
                        columns: [0, 1, 2, 3, 4, 5, 6] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: '<i class="fa fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: '<i class="fa fa-file-pdf"></i> PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6] // Sadece istediğiniz kolonları seçin
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-warning',
                    text: '<i class="fa fa-print"></i> Yazdır',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6] // Sadece istediğiniz kolonları seçin
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

{{-- <script>
    $(document).ready(function() {
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('yillikizinsearch') }}',
                    method: 'GET',
                    data: {
                        yillikizinsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('yillikizinsearch') }}',
                    method: 'GET',
                    data: {
                        yillikizinsearch: searchValue
                    }, // Arama değeri
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
                    $('#tc').val(data.tc);
                    $('#ticari_unvan').val(data.ticari_unvan);
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
@include('session.session')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function hesaplaIzin() {
            let baslangic = new Date(document.getElementById("baslangic_tarihi").value);
            let bitis = new Date(document.getElementById("bitis_tarihi").value);

            if (isNaN(baslangic) || isNaN(bitis) || bitis < baslangic) {
                document.getElementById("izin_gun").value = "";
                return;
            }

            let toplamGun = 0;
            let mevcutTarih = new Date(baslangic);

            while (mevcutTarih <= bitis) { // Bitiş tarihini de dahil ediyoruz
                let gun = mevcutTarih.getDay(); // 0 = Pazar, 6 = Cumartesi

                if (gun !== 0 && gun !== 6) { // Hafta içi günleri say (Pazartesi - Cuma)
                    toplamGun++;
                }

                mevcutTarih.setDate(mevcutTarih.getDate() + 1);
            }

            document.getElementById("izin_gun").value = toplamGun;
        }

        document.getElementById("baslangic_tarihi").addEventListener("change", hesaplaIzin);
        document.getElementById("bitis_tarihi").addEventListener("change", hesaplaIzin);
    });
</script>
@endsection
