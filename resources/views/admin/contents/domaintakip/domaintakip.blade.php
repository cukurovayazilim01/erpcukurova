@extends('admin.layouts.app')
@section('title')
    DOMAİN TAKİP
@endsection
@section('contents')
@section('topheader')
    DOMAİN TAKİP
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
            <!-- Entries Dropdown -->
            <div class="col-md-1 col-1 col-lg-1">
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

            <!-- Filtrele Button -->
            <div class="col-md-2 col-6 text-start">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#domaintakipfilmodal" style="border-radius: 3px;">
                    Filtrele
                </button>
            </div>

            <!-- Yeni Ekle and Action Buttons -->
            <div class="col-md-9 text-end">
                <!-- Action Buttons -->
                <a href="{{ route('pdf.download', ['type' => 'marka']) }}" class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-file-pdf" style="font-size: 18px"></i>
                </a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#domaintakipfilexcelmodal"
                    class="btn btn-sm btn-success">
                    <i class="fa-solid fa-file-excel" style="font-size: 18px"></i>
                </button>
                <a href="javascript:;" onclick="customPrint()" class="btn btn-sm btn-secondary">
                    <i class="bi bi-printer-fill" style="font-size: 15px"></i>
                </a>
                <!-- Yeni Ekle Button -->
                <button type="button" class="btn btn-sm btn-outline-primary px-5" style="margin-left: 10px"
                    data-bs-toggle="modal" data-bs-target="#domaintakipmodal">
                    <i class="fa-solid fa-plus"></i> Yeni Ekle
                </button>
            </div>
        </div>
    </div>

    <!--FİLTRELEMEEXCELL Modal -->
    {{-- <div class="modal fade" id="domaintakipfilexcelmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="add-form" action="{{ route('excel.export', ['type' => 'marka']) }}" method="GET">
            @csrf
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Marka Excel İndirme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 3%; ">
                        <div class="row">
                            <div class="col-md-12 select2-sm">
                                <label for="cari_id_3">Firma</label>
                                <select name="cari_id_3" id="cari_id_3_2"
                                    style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                    <!-- Dinamik veriler buraya yüklenecek -->
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="satis_temsilcisi" id="satis_temsilcisi" class="form-select form-select-sm" >
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        @foreach ($user as $useritem)
                                            <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="sehir">Şehir</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-city"></i>
                                    </span>
                                    <input type="text" name="sehir" id=""
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="ilk_tarih">Başvuru İlk Tarih</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="ilk_tarih" id="ilk_tarih"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="son_tarih">Başvuru Son Tarih</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="son_tarih" id="son_tarih"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-success btn-sm ">İndir</button>
                </div>
            </div>
        </form>
    </div>
</div>


        <!--FİLTRELEME Modal -->
<div class="modal fade" id="domaintakipfilmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="add-form" action="{{ route('domaintakipfiltre.index') }}" method="GET">
            @csrf
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Marka Filtreleme Ekranı</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="display: flex">
                    <!-- Left Side -->
                    <div class="col-md-12" style=" padding: 3%; ">
                        <div class="row">
                            <div class="col-md-12 select2-sm">
                                <label for="cari_id_3">Firma</label>
                                <select name="cari_id_3" id="cari_id_3_1"
                                    style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                    <!-- Dinamik veriler buraya yüklenecek -->
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <select name="satis_temsilcisi" id="satis_temsilcisi" class="form-select form-select-sm" >
                                        <option value="">Lütfen Seçim Yapınız</option>
                                        @foreach ($user as $useritem)
                                            <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="sehir">Şehir</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa fa-city"></i>
                                    </span>
                                    <input type="text" name="sehir" id=""
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="ilk_tarih">Başvuru İlk Tarih</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="ilk_tarih" id="ilk_tarih"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="son_tarih">Başvuru Son Tarih</label>
                                <div class="form-group input-with-icon">
                                    <span class="icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="son_tarih" id="son_tarih"
                                        class="form-control form-control-sm">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" id="submit-form" class="btn btn-outline-primary btn-sm ">Sorgula</button>
                </div>
            </div>
        </form>
    </div>
</div> --}}
    <!-- Modal -->
    <div class="modal fade" id="domaintakipmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('domaintakip.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Domain Ekleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row">
                                <div class="col-md-6 select2-sm">
                                    <label for="cari_id_3">Firma</label>

                                    <select name="cari_id" id="cari_id_3_3" required
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="satis_temsilcisi" id="satis_temsilcisi"
                                            class="form-select form-select-sm" required>
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
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-file"></i>
                                        </span>
                                        <input type="text" name="telefon_no" id="telefon_no"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="domain_adi">Domain Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="domain_adi" id="domain_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="domain_tutar">Domain Tutarı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="text" name="domain_tutar" id="domain_tutar"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
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
                                            <option value="Domain">Domain</option>
                                            <option value="Domain,Mail">Domain,Mail</option>
                                            <option value="Domain,Hosting">Domain,Hosting</option>
                                            <option value="Domain,Hosting,Mail">Domain,Hosting,Mail</option>
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
                                            class="form-control form-control-sm" required>
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
                                        <input type="text" name="hosting_platform" id="platform" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="aciklama">Açıklama</label>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                                </div> --}}





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
                                <td>{{ $domaintakipitem->bitis_tarihi }}</td>
                                <td>{{ $domaintakipitem->firmaadi->firma_unvan }}</td>
                                <td>{{ $domaintakipitem->firmaadi->yetkili_kisi }}</td>
                                <td>{{ $domaintakipitem->firmaadi->yetkili_kisi_tel }}</td>
                                {{-- <td>{{ $domaintakipitem->user->ad_soyad }}</td> --}}
                                <td>{{ $domaintakipitem->tutar }}</td>
                                <td>{{ $domaintakipitem->marka_sinif }}</td>
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
                                        <div class="d-flex align-items-center fs-6">


                                            <button class="text-warning" data-bs-toggle="modal"
                                                data-bs-target="#domaintakipupdateModal-{{ $domaintakipitem->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            {{-- @include('admin.contents.domaintakip.domaintakip-update') --}}

                                            <form
                                                action="{{ route('domaintakip.destroy', ['domaintakip' => $domaintakipitem->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger p-0 m-0 show_confirm">
                                                    <i class="bi bi-trash-fill"></i>
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

{{-- <div id="printArea" style="display: none;">
    <h1 style="text-align: center;">Marka Takip Raporu</h1>
    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa; text-align: left;">
                <th>#</th>
                <th>İşlem Tarihi</th>
                <th>Başvuru Tarihi</th>
                <th>Yenileme Tarihi</th>
                <th>Referans No</th>
                <th>Firma Adı</th>
                <th>Firma GSM</th>
                <th>Marka Adı</th>
                <th>Marka Sınıf</th>
                <th>Başvuru No</th>
                <th>Hizmet Türü</th>
                <th>VKN</th>
                <th>TC</th>
                <th>Şehir</th>
                <th>Marka İşlem</th>
                <th>Marka Durum</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($domaintakip as $domaintakipitem)
                <tr>
                    <td>{{ $startNumber - $loop->index }}</td>
                    <td>{{ $domaintakipitem->islem_tarihi }}</td>
                    <td>{{ $domaintakipitem->basvuru_tarihi }}</td>
                    <td>{{ $domaintakipitem->yenileme_tarih }}</td>
                    <td>{{ $domaintakipitem->referans_no }}</td>
                    <td>{{ $domaintakipitem->firmaadi->firma_unvan }}</td>
                    <td>{{ $domaintakipitem->firmaadi->yetkili_kisi_tel }}</td>
                    <td>{{ $domaintakipitem->marka_adi }}</td>
                    <td>{{ $domaintakipitem->marka_sinif }}</td>
                    <td>{{ $domaintakipitem->basvuru_no }}</td>
                    <td>{{ $domaintakipitem->hizmet->hizmet_ad }}</td>
                    <td>{{ $domaintakipitem->vkn }}</td>
                    <td>{{ $domaintakipitem->tc }}</td>
                    <td>{{ $domaintakipitem->sehir }}</td>
                    <td>{{ $domaintakipitem->marka_islem }}</td>
                    <td>{{ $domaintakipitem->marka_durum }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

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
@include('session.session')
@endsection
