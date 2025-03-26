@extends('admin.layouts.app')
@section('title')
    PANO
@endsection
@section('contents')
@section('topheader')
PANO
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

    @foreach ($pano as $panoitem)

    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body">


                <hr>
                <div class="text-start">
                    <h5>{{$panoitem->liste_adi}}</h5>
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
                        {{-- @foreach ($yillikizinhakki as $yillikizinhakkiitem)
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-light border-top">
                                <!-- İsim için sabit genişlik -->
                                <span class="text-truncate" style="flex: 1 1 40%; max-width: 40%;">{{$yillikizinhakkiitem->personel->ad_soyad}}</span>
                                <!-- Diğer sütunlar için sabit genişlik -->
                                <span class="text-center" style="flex: 1 1 20%; max-width: 20%;"><b style="color: #007bff;">{{$yillikizinhakkiitem->yili}}</b></span>
                                <span class="text-center" style="flex: 1 1 20%; max-width: 20%;"><b style="color: #28a745;">{{$yillikizinhakkiitem->yillik_izin_hakki}} Gün</b></span>
                                <span class="text-center" style="flex: 1 1 20%; max-width: 20%;"><b style="color: #dc3545;">{{$yillikizinhakkiitem->kalan_izin_hakki}} Gün</b></span>
                            </li>
                        @endforeach --}}
                    </ul>
            </div>

        </div>
    </div>
    @endforeach
    <div class="col-12 col-sm-6 col-md-3 col-lg-3">
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-body">
                <div class="text-start">
                    <a href="javascript:void(0);" id="showInput"><i class="fa-solid fa-plus"></i>
                        <h6>Başka Liste Ekleyin</h6>
                    </a>
                </div>

                <!-- Gizli Input Alanı -->
                <div id="inputContainer" style="display: none; margin-top: 10px;">
                    <input type="text" id="listeAdi" class="form-control" placeholder="Liste Adı Girin">
                    <button id="saveListe" class="btn btn-primary btn-sm mt-2">Kaydet</button>
                </div>
            </div>
        </div>
    </div>


</div>




{{-- SEARCHHHH  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#showInput').on('click', function() {
        $('#inputContainer').slideToggle(); // Input alanını aç/kapat
    });

    $('#saveListe').on('click', function() {
        var listeAdi = $('#listeAdi').val();

        if(listeAdi.trim() === '') {
            alert('Liste adı boş olamaz!');
            return;
        }

        $.ajax({
            url: "{{ route('pano.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                liste_ad: listeAdi
            },
            success: function(response) {
                alert('Liste başarıyla eklendi!');
                $('#listeAdi').val('');
                $('#inputContainer').slideUp(); // Kaydettikten sonra gizle
            },
            error: function(xhr) {
                alert('Liste eklenirken hata oluştu!');
            }
        });
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
