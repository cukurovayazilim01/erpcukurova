@extends('admin.layouts.app')
@section('title')
İZİNLER
@endsection
@section('contents')
@section('topheader')
İZİNLER
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
                    data-bs-toggle="modal" data-bs-target="#izinlermodal">
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
    <div class="modal fade" id="izinlermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog ">
            <form id="add-form" action="{{ route('izinler.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">İzin Ekleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex; padding: 2%;">
                        <!-- Left Side -->
                        <div class="row">
                            <div class="col-md-12">
                                <label for="personel_id">Personel Adı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="personel_id" id="personel_id" class="form-select form-select-sm" required>
                                        <option value="">Lütfen Seçiniz</option>
                                        @foreach ($personel as $personelitem)
                                            <option value="{{ $personelitem->id }}">{{ $personelitem->ad_soyad }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="baslangic_tarihi">Başlangıç Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="datetime-local" name="baslangic_tarihi" id="baslangic_tarihi"
                                        class="form-control form-control-sm"
                                         required >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="bitis_tarihi">Bitiş Tarihi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input type="datetime-local" name="bitis_tarihi" id="bitis_tarihi"
                                        class="form-control form-control-sm"
                                         required >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="izin_gun">İzin Gün / Saat</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="text" name="izin_gun" id="izin_gun"
                                        class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed"
                                        onkeydown="return false;" readonly required required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="izin_turu">İzin Türü</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <select name="izin_turu" id="izin_turu" class="form-select form-select-sm" required>
                                        <option value="Ücretsiz İzin">Ücretsiz İzin</option>
                                        <option value="İdari İzin">İdari İzin</option>
                                        <option value="Mazeret İzni">Mazeret İzni</option>
                                        <option value="Doğum İzni">Doğum İzni</option>
                                        <option value="Süt İzni">Süt İzni</option>
                                        <option value="Yıllık İzin">Yıllık İzin</option>
                                        <option value="Evlilik İzni">Evlilik İzni</option>
                                        <option value="Vefat İzni">Vefat İzni</option>
                                        <option value="Sağlık Rapor İzni">Sağlık Rapor İzni</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="izin_aciklama">İzin Açıklaması</label>
                                    <textarea name="izin_aciklama" id="izin_aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
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

{{--
                    <form id="searchForm" action="{{ route('izinlersearch') }}" method="GET">
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
                    </form> --}}


                </div>
                <table class="table align-middle mb-0 display " id="example2">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Başlangıç Tarihi</th>
                            <th>Bitiş Tarihi</th>
                            <th>Personel Adı</th>
                            <th>İzin Gün / Saat</th>
                            <th>İzin Türü</th>
                            <th>Açıklama</th>

                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinler as $sn => $izinleritem)
                            <tr>
                                <th>{{ $sn + 1 }}</th>
                                <td>{{ $izinleritem->baslangic_tarihi }}</td>
                                <td>{{ $izinleritem->bitis_tarihi }}</td>
                                <td>{{ $izinleritem->personel->ad_soyad }}</td>
                                <td>{{ $izinleritem->izin_gun }}</td>
                                <td>{{ $izinleritem->izin_turu }}</td>
                                <td>{{ $izinleritem->izin_aciklama }}</td>

                                <td class="text-right">
                                    <div class="d-flex align-items-center">
                                        {{-- <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#izinlerupdateModal-{{ $izinleritem->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        @include('admin.contents.izinler.izinler-update')--}}
                                        <a href="{{ route('izinler.show', ['izinler' => $izinleritem->id]) }}"
                                            class="text-primary btn btn-link p-0 m-0 ">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <form
                                            action="{{ route('izinler.destroy', ['izinler' => $izinleritem->id]) }}"
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
                {{-- <div class="row">
                    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
                        {{ $izinler->appends(['entries' => $perPage])->links() }}
                    </div>
                </div> --}}

            </div>

        </div>

    </div>
</div>


{{-- SEARCHHHH  --}}
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,
                            9] // Sadece istediğiniz kolonları seçin
                    }
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

{{-- <script>
    $(document).ready(function() {
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('izinlersearch') }}',
                    method: 'GET',
                    data: {
                        izinlersearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('izinlersearch') }}',
                    method: 'GET',
                    data: {
                        izinlersearch: searchValue
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
    document.addEventListener("DOMContentLoaded", function () {
        function hesaplaIzin() {
            let baslangic = new Date(document.getElementById("baslangic_tarihi").value);
            let bitis = new Date(document.getElementById("bitis_tarihi").value);

            if (isNaN(baslangic) || isNaN(bitis) || bitis <= baslangic) {
                document.getElementById("izin_gun").value = "";
                return;
            }

            let mesaiBaslangic = 9; // 09:00
            let mesaiBitis = 18; // 18:00
            let toplamSaat = 0;

            let mevcutTarih = new Date(baslangic);

            while (mevcutTarih < bitis) {
                let saat = mevcutTarih.getHours();
                let gun = mevcutTarih.getDay(); // 0 = Pazar, 6 = Cumartesi

                let isHaftaIci = gun !== 0 && gun !== 6; // Cumartesi ve Pazar'ı hariç tut
                let isMesaiSaatinde = saat >= mesaiBaslangic && saat < mesaiBitis;

                if (isHaftaIci && isMesaiSaatinde) {
                    toplamSaat++;
                }

                mevcutTarih.setHours(mevcutTarih.getHours() + 1);
            }

            let izinGun = Math.floor(toplamSaat / 9); // 1 gün = 9 saat mesai
            let izinSaat = toplamSaat % 9;

            document.getElementById("izin_gun").value = izinGun > 0 ? `${izinGun} gün ${izinSaat} saat` : `${izinSaat} saat`;
        }

        document.getElementById("baslangic_tarihi").addEventListener("change", hesaplaIzin);
        document.getElementById("bitis_tarihi").addEventListener("change", hesaplaIzin);
    });
    </script>




@endsection
