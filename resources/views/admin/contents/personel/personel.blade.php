@extends('admin.layouts.app')
@section('title')
    Personel Özlük Dosyası
@endsection
@section('contents')
@section('topheader')
    Personel Özlük Dosyası
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class="col-lg-10 d-flex align-items-center mobile-erp2 justify-content-lg-start">
                    <form class="position-relative" id="searchForm" action="{{ route('personelozluksearch') }}"
                        method="GET">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                                class="bi bi-search"></i></div>
                        <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                            class="form-control ps-5" type="text" placeholder="Ara">
                    </form>
                </div>
                <div class="col-lg-2 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#personelmodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>

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
                    <div class="modal-header">
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

                                <div class="col-md-3">
                                    <label for="ayak_no">Ayak No</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="ayak_no" id="ayak_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="beden">Beden</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="beden" id="beden"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ev_gsm">Ev Telefonu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="number" name="ev_gsm" id="ev_gsm"
                                            class="form-control form-control-sm no-zero" required>
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
                                    <label for="ise_giris_tarihi">İşten Çıkış Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="isten_cikis_tarihi" id="isten_cikis_tarihi"
                                            class="form-control form-control-sm" required>
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
                            <div class="mobile-footer"
                                style="display: flex;  gap:20px; text-align: center; justify-content: end; ">

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
            <table class="table table-bordered table-hover" style="width: 100%" id="example2">
                <thead >
                    <tr>
                        <th scope="col">#</th>
                        <th>Adı Soyadı</th>
                        <th>Askerlik Durumu</th>
                        <th>Doğum Yeri</th>
                        <th>Doğum Tarihi</th>
                        <th>Medeni Hali</th>
                        <th>Eğitimler</th>
                        <th>Evraklar</th>

                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personel as $sn => $personelitem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                            <td>{{ $personelitem->ad_soyad }}</td>
                            <td>{{ $personelitem->askerlik_durumu }}</td>
                            <td>{{ $personelitem->dogum_yeri }} </td>
                            <td>{{ $personelitem->dogum_tarihi }} </td>
                            <td>{{ $personelitem->medeni_hali }} </td>
                            <td><button class=" text-success open-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#perseonelegitimModal-{{ $personelitem->id }}">
                                <i style="color:#293445;  "
                                            class="fa-solid fa-award fs-6"></i>
                                </button>
                                @include('admin.contents.personel.personelegitim.personelegitim')
                            </td>
                            <td><button class="text-purple open-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#perseoneldokumanModal-{{ $personelitem->id }}">
                                <i style="color:#293445;  " class="fa-solid fa-file fs-6"></i>
                                </button>
                                @include('admin.contents.personel.personeldokuman.personeldokuman')</td>


                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">

                                        <button data-bs-toggle="modal"
                                            data-bs-target="#personelupdateModal-{{ $personelitem->id }}"> <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                        @include('admin.contents.personel.personel-update')
                                        <a href="{{ route('personell.show', ['personell' => $personelitem
                                        ->id]) }}"
                                            class=" btn btn-link p-0 m-0 ">
                                            <i style="color:#293445;  "
                                            class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                        </a>
                                        <form
                                            action="{{ route('personell.destroy', ['personell' => $personelitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn  p-0 m-0 show_confirm">
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
        </div>
    </div>
</div>
@include('session.session')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('personelozluksearch') }}',
                    method: 'GET',
                    data: {
                        personelozluksearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('personelozluksearch') }}',
                    method: 'GET',
                    data: {
                        personelozluksearch: searchValue
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
