@extends('admin.layouts.app')
@section('title')
Yıllık İzin Hakları
@endsection
@section('contents')
@section('topheader')
Yıllık İzin Hakları
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <div class="table-buttons">
                        <button class="btn btn-primary" id="copyBtn"><i class="fa fa-copy"></i> </button>
                        <button class="btn btn-success" id="excelBtn"><i class="fa fa-file-excel"></i> </button>
                        <button class="btn btn-danger" id="pdfBtn"><i class="fa fa-file-pdf"></i> </button>
                        <button class="btn btn-warning" id="printBtn"><i class="fa fa-print"></i> </button>
                        <!-- Yeni Ekle Button -->
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#yillikizinhakkimodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>

                </div>
            </div>
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
                                <div class="form-group input-with-icon">
                                    <span class="icon">
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
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="number" name="yillik_izin_hakki" id="yillik_izin_hakki"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="bitis_tarihi">Kalan İzin Hakkı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <input type="number" name="kalan_izin_hakki" id="kalan_izin_hakki"
                                        class="form-control form-control-sm" style="pointer-events: none; cursor: not-allowed"
                                        onkeydown="return false;" readonly required >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="yili">Yılı</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
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
                                <div class="form-group input-with-icon">
                                    <span class="icon">
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

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="example2">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Adı Soyadı</th>
                        <th>Yıl</th>
                        <th>İzin Hakkı</th>
                        <th>Kalan İzin Hakkı</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($yillikizinhakki as $sn => $yillikizinhakkiitem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                            <td>{{ $yillikizinhakkiitem->personel->ad_soyad }}</td>
                            <td>{{ $yillikizinhakkiitem->yili }}</td>
                            <td>{{ $yillikizinhakkiitem->yillik_izin_hakki }} </td>
                            <td>{{ $yillikizinhakkiitem->kalan_izin_hakki }} </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('session.session')
<script>
    document.getElementById('yillik_izin_hakki').addEventListener('input', function() {
        document.getElementById('kalan_izin_hakki').value = this.value;
    });
</script>


{{-- SEARCHHHH  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
