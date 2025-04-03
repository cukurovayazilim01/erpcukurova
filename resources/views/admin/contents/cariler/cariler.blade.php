@extends('admin.layouts.app')
@section('title')
    Cariler
@endsection
@section('contents')
@section('topheader')
    Cariler
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
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">

                <div class=" col-md-4 mr-4 mobile-erp1 d-flex gap-2">

                    <form method="GET" action="{{ route('cariler.index') }}" id="entriesForm">
                        <select class="form-select form-select-sm" name="entries"
                            onchange="document.getElementById('entriesForm').submit();">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>

                    <a href="{{ route('cariler.index') }}">
                        <button type="button" class="btn btn-dark btn-sm px-3"><i
                                class="fa-solid fa-user"></i>Müşteriler</button>
                    </a>
                    <a href="{{ route('tedarikciler') }}">
                        <button type="button" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-users"></i>
                            Tedarikçiler</button>
                    </a>
                </div>

                <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                    <form class="position-relative" id="searchForm" action="{{ route('tekliflersearch') }}"
                        method="GET">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                                class="bi bi-search"></i></div>
                        <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                            class="form-control ps-5" type="text" placeholder="Ara">
                    </form>
                </div>
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#carilermodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>

                </div>

            </div>

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="carilermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('cariler.store') }}" method="POST">
                @csrf
                <div class="modal-content">

                    <div class="modal-header">
                        <h2 class="modal-title">Cari Kayıt </h2>
                        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">

                            <div class="col-md-6 col-sm-12 ">
                                <label for="firma_unvan">Firma Unvanı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    <input type="text" name="firma_unvan" id="firma_unvan"
                                        class="form-control form-control-sm" required
                                        oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="ticari_unvan">Ticari Unvanı</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                    <input type="text" name="ticari_unvan" id="ticari_unvan"
                                        class="form-control form-control-sm" required
                                        oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                            {{-- =============================== --}}


                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="is_tel">İş Telefonu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                                    <input type="number" name="is_tel" id="is_tel"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="eposta">E-Posta</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    <input type="email" name="eposta" id="eposta"
                                        class="form-control form-control-sm"
                                        oninput="this.value = this.value.toLowerCase()" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="yetkili_kisi">Yetkili Kişi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-user-tie"></i>
                                    </span>
                                    <input type="text" name="yetkili_kisi" id="yetkili_kisi"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label for="yetkili_kisi_tel">Yetkili Kişi Telefon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                                    <input type="number" name="yetkili_kisi_tel" id="yetkili_kisi_tel"
                                        class="form-control form-control-sm no-zero" required>
                                </div>
                            </div>

                            {{-- ================================= --}}




                            <div class="col-md-6 col-lg-4 col-xl-6">
                                <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    <select name="musteri_temsilcisi" id="musteri_temsilcisi"
                                        class="form-control form-control-sm" required>
                                        <option value="">Müşteri Temsilcisi Seçiniz</option>
                                        @foreach ($user as $cariitem)
                                            <option value="{{ $cariitem->ad_soyad }}">{{ $cariitem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-6">
                                <label for="firma_turu">Firma Türü</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                                    <select name="firma_turu" id="firma_turu" class="form-control form-control-sm">
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Şahıs">Şahıs</option>
                                        <option value="Tüzel">Tüzel</option>
                                    </select>
                                </div>
                            </div>


                            {{-- ================================= --}}


                            <div class="col-md-6">
                                <label for="adres">Adres</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-map-location-dot"></i></span>
                                    <textarea name="adres" id="adres" class="form-control" aria-label="With textarea"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="aciklama">Açıklama</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                    <textarea name="aciklama" id="aciklama" class="form-control" aria-label="With textarea"></textarea>
                                </div>
                            </div>


                            {{-- =================================== --}}
                            <div class="title mt-4 text-center">
                                <h6>Firma Vergilendirme</h6>
                            </div>
                            {{-- =========================== --}}

                            <div class="col-md-3">
                                <label for="vergi_no">Vergi No</label>
                                <button type="button" onclick="vknSorgula()" class="btn btn-danger btn-sm p-0 m-0"
                                    style="display: inline-block; margin-left: 10px;"><b style="font-size: 10px">Firma
                                        Bilgisi Getir</b></button>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-receipt"></i></span>
                                    <input type="text" name="vergi_no" id="vergi_no"
                                        class="form-control form-control-sm input-mask" pattern="^\d{10,11}$"
                                        inputmode="numeric" maxlength="11" minlength="10" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="vergi_dairesi">Vergi Dairesi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i
                                            class="fa-solid fa-house-chimney-user"></i></span>
                                    <input type="text" name="vergi_dairesi" id="vergi_dairesi"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">T.C Kimlik No</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card-clip"></i></span>
                                    <input type="text" name="tc_kimlik" id="tc_kimlik"
                                        class="form-control form-control-sm input-mask" pattern="\d{11}"
                                        inputmode="numeric" maxlength="11" minlength="11">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="firma_tipi">Firma Tipi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-building"></i>
                                    </span>
                                    <select name="firma_tipi" id="firma_tipi" class="form-control form-control-sm">
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Müşteri">Müşteri</option>
                                        <option value="Tedarikçi">Tedarikçi</option>
                                        <option value="Çözüm Ortağı">Çözüm Ortağı</option>
                                    </select>
                                </div>
                            </div>
                            {{-- ================================= --}}

                            <div class="col-md-3">
                                <label for="">İl</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-city"></i></span>
                                    <select name="il" id="firma_il" class="form-control form-control-sm"
                                        onchange="firma_ilceListele()">
                                        <option value="">İl Seçin</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="ilce">İlçe</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-tree-city"></i></span>
                                    <select name="ilce" id="firma_ilce" class="form-control form-control-sm">
                                        <option value="">İlçe Seçin</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="web_adres">Web Adresi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="fa-solid fa-globe"></i></span>
                                    <input type="text" name="web_adres" id="web_adres"
                                        class="form-control form-control-sm"
                                        oninput="this.value = this.value.toLowerCase()">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Firma Durumu</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"> <i class="fa fa-building"></i>
                                    </span>
                                    <select name="firma_durumu" id="firma_durumu"
                                        class="form-control form-control-sm">
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        <option value="Olumlu">Olumlu</option>
                                        <option value="Olumsuz">Olumsuz</option>
                                        <option value="Düşünüyor">Düşünüyor</option>
                                        <option value="Standart Kayıt">Standart Kayıt</option>
                                        <option value="Ziyaret Bekliyor">Ziyaret Bekliyor</option>
                                        <option value="Aranacak">Aranacak</option>
                                        <option value="Kara Liste">Kara Liste</option>
                                        <option value="Sözleşme Yapıldı">Sözleşme Yapıldı</option>
                                        <option value="Kaybedilen">Kaybedilen</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div
                            style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table id="example2" class="table table-bordered table-hover" style="width:100%; cursor: pointer; ">
                <thead>
                    <tr>
                        <th style="color: white" scope="col">#</th>
                        <th style="color: white">Firma Ünvan</th>
                        <th style="color: white; text-align: center">Sektör</th>
                        <th style="color: white; text-align: center">Yetkili Kişi</th>
                        <th style="color: white; text-align: center">Telefon</th>
                        <th style="color: white; text-align: center">E-Posta</th>
                        <th style="color: white; text-align: center">Müşteri Temsilcisi</th>
                        <th style="color: white; text-align: center">Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cariler as $cariitem)
                        <tr>
                            <th scope="row">{{ $startNumber - $loop->index }}</th>
                            <td><a style="color:inherit"
                                    href="{{ route('cariler.show', ['cariler' => $cariitem->id]) }}">{{ $cariitem->firma_unvan }}
                                </a> </td>
                            <td style="text-align: center">{{ $cariitem->firma_sektor }}</td>
                            <td style="text-align: center">{{ $cariitem->yetkili_kisi }}</td>
                            <td style="text-align: center">{{ $cariitem->yetkili_kisi_tel }}</td>
                            <td style="text-align: center">{{ $cariitem->eposta }}</td>
                            <td style="text-align: center">{{ $cariitem->musteri_temsilcisi }}</td>

                            <td class="text-right">
                                <div class="databutton ">
                                    <div class="d-flex align-items-center fs-6"
                                        style="justify-content: space-evenly; ">
                                        @include('admin.contents.cariler.aramalar.cari-aramalar')
                                        <a href="{{ route('cariler.show', ['cariler' => $cariitem->id]) }}"
                                            class=" btn btn-link p-0 m-0 ">
                                            <i style="color:#293445;  "
                                                class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                        </a>
                                        <button class="open-modal-btn" data-bs-toggle="modal"
                                            data-bs-target="#dokumanModal-{{ $cariitem->id }}">
                                            <i style="color:#293445" class="fa-solid fa-file-pdf fs-6"></i>
                                        </button>
                                        @include('admin.contents.cariler.dokuman.cari-dokuman')
                                        <button class=" open-modal-btn" data-bs-toggle="modal"
                                            data-bs-target="#aramalarModal-{{ $cariitem->id }}">
                                            <i style="color:rgb(88, 134, 88)"
                                                class="fa-solid fa-square-phone-flip fs-6"></i>
                                        </button>

                                        <button class="" data-bs-toggle="modal"
                                            data-bs-target="#carilerupdateModal-{{ $cariitem->id }}">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </button>
                                        @include('admin.contents.cariler.cariler-update')

                                        <form action="{{ route('cariler.destroy', ['cariler' => $cariitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn  p-0 m-0 show_confirm ">
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
            <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
                {{ $cariler->appends(['entries' => $perPage])->links() }}
            </div>
        </div>
    </div>






</div>

<script src="{{ asset('custom/customjs/city.js') }}"></script>


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



{{-- SEARCHHHH  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function vknSorgula() {
        let vkn = document.getElementById('vergi_no').value.trim();

        if (vkn.length === 10 || vkn.length === 11) {
            fetch(`/vkn-check?vergi_no=${vkn}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Gelen JSON:", data); // Gelen JSON'u konsola yazdır

                    // JSON içindeki ilk öğeyi alıyoruz
                    if (data.length > 0) {
                        let firmaUnvan = data[0].title; // İlk öğenin "title" alanını alıyoruz

                        if (firmaUnvan) {
                            document.getElementById('firma_unvan').value =
                                firmaUnvan; // Firma unvanını inputa yazıyoruz
                        } else {
                            alert("Firma bilgisi bulunamadı!");
                        }
                    } else {
                        alert("Geçerli firma bilgisi bulunamadı!");
                    }
                })
                .catch(error => console.error("Hata:", error));
        } else {
            alert("Lütfen geçerli bir VKN girin (10 veya 11 hane).");
        }
    }
</script>

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
                    url: '{{ route('carilersearch') }}',
                    method: 'GET',
                    data: {
                        carilersearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('carilersearch') }}',
                    method: 'GET',
                    data: {
                        carilersearch: searchValue
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
@endsection
