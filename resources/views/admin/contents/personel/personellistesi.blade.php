@extends('admin.layouts.app')
@section('title')
Personel Listesi
@endsection
@section('contents')
@section('topheader')
Personel Listesi
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
                    <form id="searchForm" action="{{ route('personelsearch') }}"  method="GET">
                        <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-input-group-text px-3"><i class="bi bi-search"></i></div>
                            <input class="form-control ps-5" id="searchInput" type="text" placeholder="Genel Arama">
                          </div>
                        </form>
                </div>
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm mx-0 mx-lg-2"  data-bs-toggle="modal"
                    data-bs-target="#personelmodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>
                </div>


        </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="personelmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('personell.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header ">
                        <h5 class="modal-title">Personel Özlük Dosyası</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">

                                <div class="col-md-3">
                                    <label for="ad_soyad">Ad Soyad</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="ad_soyad" id="ad_soyad"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="tc">TC Kimlik No</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="tc" id="tc"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="sigorta_sicil_no">Sigorta Sicil No</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="sigorta_sicil_no" id="sigorta_sicil_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="sigorta_giris_tarihi">Sigorta Giriş Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="sigorta_giris_tarihi" id="sigorta_giris_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="meslek_kodu">Meslek Kodu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="meslek_kodu" id="meslek_kodu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="okul">Okulu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="okul" id="okul"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="mezuniyet">Mezuniyet</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="mezuniyet" id="mezuniyet" class="form-control form-control-sm">
                                            <option value="Lisans">Lisans</option>
                                            <option value="Yüksek Lisans">Yüksek Lisans</option>
                                            <option value="Ön Lisans">Ön Lisans</option>
                                            <option value="Lise">Lise</option>
                                            <option value="OrtaOkul">OrtaOkul</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="meslegi">Mesleği</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="meslegi" id="meslegi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="departman">Departman</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="departman" id="departman"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="dogum_yeri">Doğum Yeri</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="dogum_yeri" id="dogum_yeri"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="dogum_tarihi">Doğum Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar"></i>
                                        </span>
                                        <input type="date" name="dogum_tarihi" id="dogum_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gsm">Cep Telefonu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-phone"></i>
                                        </span>
                                        <input type="number" name="gsm" id="gsm"
                                            class="form-control form-control-sm no-zero" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="mail">E-Posta</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="email" name="mail" id="mail"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ise_giris_tarihi">İşe Giriş Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="ise_giris_tarihi" id="ise_giris_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorevi">Görevi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gorevi" id="gorevi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="kidem_yili">Kıdem Yılı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="kidem_yili" id="kidem_yili"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="medeni_hali">Medeni Hali</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="medeni_hali" id="medeni_hali" class="form-control form-control-sm">
                                            <option value="Evli">Evli</option>
                                            <option value="Bekar">Bekâr</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="kan_grubu">Kan Grubu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="kan_grubu" id="kan_grubu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="askerlik_durumu">Askerlik Durumu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="askerlik_durumu" id="askerlik_durumu" class="form-control form-control-sm">
                                            <option value="Yapıldı">Yapıldı</option>
                                            <option value="Yapılmadı">Yapılmadı</option>
                                            <option value="Tecilli">Tecilli</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="personel_resim">Personel Resmi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="file" name="personel_resim" id="personel_resim"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ehliyet_sinif">Ehliyet Sınfı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="ehliyet_sinif" id="ehliyet_sinif"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ehliyet_tarihi">Ehliyet Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="ehliyet_tarihi" id="ehliyet_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="baba_adi">Baba Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="baba_adi" id="baba_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="baba_meslegi">Baba Mesleği</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="baba_meslegi" id="baba_meslegi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="ayak_no">Ayak No</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="ayak_no" id="ayak_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="beden">Beden</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="beden" id="beden"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="ev_gsm">Ev Telefonu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="ev_gsm" id="ev_gsm"
                                            class="form-control form-control-sm no-zero" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ev_adresi">Ev Adresi</label>
                                    <textarea name="ev_adresi" id="ev_adresi" cols="20" rows="2"
                                        class="form-control form-control-sm "></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="acil_durum_kisi">Acil Durum Kişisi</label>
                                    <textarea name="acil_durum_kisi" id="acil_durum_kisi" cols="20" rows="2"
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
        <div class="table-responsive" style="border-radius: 5px">
            <table id="example2" class="table table-bordered table-striped" style="width:100%;  ">
                <thead >
                    <tr>
                        <th scope="col">#</th>
                        <th>Adı Soyadı</th>
                        <th>Bölümü</th>
                        <th>TC Kimlik No</th>
                        <th>SGK No</th>
                        <th>Doğum Yeri</th>
                        <th>Doğum Tarihi</th>
                        <th>İşe Giriş Tarihi</th>
                        <th>Bedeni</th>
                        <th>Ayak No</th>
                        <th>Acil Durum Kişi</th>
                        <th>Adres</th>
                        <th>Telefon</th>
                        <th>Kan Grubu</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($personel as $sn => $personelitem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                            <td>{{ $personelitem->ad_soyad }}</td>
                            <td>{{ $personelitem->meslegi }}</td>
                            <td>{{ $personelitem->tc }} </td>
                            <td>{{ $personelitem->sigorta_sicil_no }} </td>
                            <td>{{ $personelitem->dogum_yeri }} </td>
                            <td>{{ $personelitem->dogum_tarihi }} </td>
                            <td>{{ $personelitem->ise_giris_tarihi }} </td>
                            <td>{{ $personelitem->beden }} </td>
                            <td>{{ $personelitem->ayak_no }} </td>
                            <td class="text-wrap" style="max-width:170px">{{ $personelitem->acil_durum_kisi }} </td>
                            <td>{{ $personelitem->ev_adresi }} </td>
                            <td>{{ $personelitem->gsm }} </td>
                            <td>{{ $personelitem->kan_grubu }} </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('session.session')
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
                    url: '{{ route('personelsearch') }}',
                    method: 'GET',
                    data: {
                        personelsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('personelsearch') }}',
                    method: 'GET',
                    data: {
                        personelsearch: searchValue
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
@endsection
