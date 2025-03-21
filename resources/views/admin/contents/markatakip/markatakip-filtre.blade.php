@extends('admin.layouts.app')
@section('title')
    Marka Takip
@endsection
@section('contents')
@section('topheader')
Marka Takip
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
                <div class="col-md-1 col-1">
                    <form method="GET" action="{{ route('markatakip.index') }}" id="entriesForm">
                        <select class="form-select form-select-sm" name="entries" onchange="document.getElementById('entriesForm').submit();">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>

                <!-- Filtrele Button -->
                <div class="col-md-2 col-6 text-start">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#markatakipfilmodal" style="border-radius: 3px;">
                        Filtrele
                    </button>
                    <a href="{{ route('markatakip.index') }}" type="button" style="border-radius: 3px"
                    class="btn btn-sm btn-danger">
                    Temizle</a>
                </div>


                <!-- Action Buttons -->
                <div class="col-md-9 text-md-end">
                    <a href="{{ route('markatakip.pdf') }}?{{ request()->getQueryString() }}" class="btn btn-sm btn-danger">
                        <i class="fa-solid fa-file-pdf" style="font-size: 18px"></i>
                    </a>
                    <a href="{{ route('markatakip.excel') }}?{{ request()->getQueryString() }}" class="btn btn-sm btn-success">
                        <i class="fa-solid fa-file-excel" style="font-size: 18px"></i>
                    </a>
                    {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#markatakipfilexcelmodal" class="btn btn-sm btn-success">
                                    <i class="fa-solid fa-file-excel" style="font-size: 18px"></i>
                                </button> --}}
                    <a href="javascript:;" onclick="customPrint()" class="btn btn-sm btn-secondary">
                        <i class="bi bi-printer-fill" style="font-size: 15px"></i>
                    </a>


                <!-- Yeni Ekle Button -->
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" style="margin-left: 10px" data-bs-toggle="modal" data-bs-target="#markatakipmodal">
                        <i class="fa-solid fa-plus"></i> Yeni Ekle
                    </button>
                </div>
            </div>
        </div>
          <!--FİLTRELEMEEXCELL Modal -->
<div class="modal fade" id="markatakipfilexcelmodal" tabindex="-1" aria-hidden="true">
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
                                <label for="cari_id">Firma</label>
                                <select name="cari_id" id="cari_id_2"
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
<div class="modal fade" id="markatakipfilmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="add-form" action="{{ route('markatakipfiltre.index') }}" method="GET">
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
                                <label for="cari_id">Firma</label>
                                <select name="cari_id" id="cari_id_1"
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
</div>
        <!-- Modal -->
        <div class="modal fade" id="markatakipmodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form id="add-form" action="{{ route('markatakip.store') }}" method="POST" id="add-form">
                    @csrf
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Marka Ekleme Ekranı</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body" style="display: flex">
                            <!-- Left Side -->
                            <div class="col-md-12" style=" padding: 1%; ">
                                <div class="row" >
                                    <div class="col-md-12 select2-sm">
                                        <label for="cari_id" >Firma</label>

                                          <select name="cari_id" id="cari_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                            <!-- Dinamik veriler buraya yüklenecek -->
                                          </select>
                                      </div>
                                    <div class="col-md-6">
                                        <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <select name="satis_temsilcisi" id="satis_temsilcisi"
                                                class="form-select form-select-sm" required>
                                                <option value="">Satış Temsilcisi Seçiniz</option>
                                                @foreach ($user as $markatakipitem)
                                                    <option value="{{ $markatakipitem->id }}">{{ $markatakipitem->ad_soyad }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tc">TC</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-file"></i>
                                            </span>
                                            <input type="text" name="tc" id="tc"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="vkn">VKN</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-file"></i>
                                            </span>
                                            <input type="text" name="vkn" id="vkn"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sehir">Şehir</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-city"></i>
                                            </span>
                                            <input type="text" name="sehir" id="sehir"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="basvuru_no">Başvuru No</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="text" name="basvuru_no" id="basvuru_no"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="referans_no">Referans No</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="text" name="referans_no" id="referans_no"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="marka_adi">Marka Adı</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="text" name="marka_adi" id="marka_adi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="marka_sinif">Marka Sınıfı</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <input type="text" name="marka_sinif" id="marka_sinif"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="hizmet_turu">Marka Hizmet</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <select name="hizmet_turu" id="hizmet_turu"
                                                class="form-select form-select-sm" required>
                                                <option value="">Lütfen Seçim Yapınız</option>
                                                @foreach ($hizmetler as $item)
                                                <option value="{{ $item->id }}">{{ $item->hizmet_ad }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="basvuru_tarihi">Başvuru Tarihi</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="date" name="basvuru_tarihi" id="basvuru_tarihi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="marka_islem">Marka İşlem</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <select name="marka_islem" id="marka_islem"
                                                class="form-select form-select-sm" required>
                                                <option value="Yapıldı">Yapıldı</option>
                                                <option value="Yapılmadı">Yapılmadı</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="marka_durum">Marka Durum</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <select name="marka_durum" id="marka_durum"
                                                class="form-select form-select-sm" required>
                                                <option value="Süreç Devam Ediyor">Süreç Devam Ediyor</option>
                                                <option value="Tescil Edildi">Tescil Edildi</option>
                                                <option value="İptal Edildi">İptal Edildi</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit"  id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">


                        <form id="searchForm" action="{{ route('markatakipsearch') }}" method="GET">
                            @csrf
                            <div class="ms-auto position-relative" style="margin-bottom: 10px">
                                <!-- Arama ikonu -->
                                <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3" style="color: blue;">
                                    <i class="bi bi-search"></i>
                                </div>
                                <!-- Arama inputu -->
                                <input type="text" id="searchInput" class="form-control ps-5" style="border: 1px solid blue; height: 38px;" placeholder="Lütfen Arama Terimi Giriniz">
                            </div>
                        </form>


                    </div>
                    <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                        aria-describedby="example_info" >
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                {{-- <th>İşlem Tarihi</th> --}}
                                <th>Başvuru Tarihi</th>
                                <th>Yenileme Tarihi</th>
                                <th>Referans No</th>
                                <th>Firma Adı</th>
                                <th>Firma GSM</th>
                                <th>Satış Temsilcisi</th>
                                <th>Marka Adı</th>
                                <th>Marka Sınıf</th>
                                <th>Başvuru No</th>
                                <th>Hizmet Türü</th>
                                <th>VKN</th>
                                <th>TC</th>
                                <th>Şehir</th>
                                <th>Marka İşlem</th>
                                <th>Marka Durum</th>
                                <th>Aksiyon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($markatakip as $markatakipitem)
                                <tr>
                                    <th scope="row">{{ $startNumber - $loop->index }}</th>
                                    {{-- <td>{{ $markatakipitem->islem_tarihi }}</td> --}}
                                    <td>{{ $markatakipitem->basvuru_tarihi }}</td>
                                    <td>{{ $markatakipitem->yenileme_tarih }}</td>
                                    <td>{{ $markatakipitem->referans_no }}</td>
                                    <td>{{ $markatakipitem->firmaadi->firma_unvan }}</td>
                                    <td>{{ $markatakipitem->firmaadi->yetkili_kisi_tel }}</td>
                                    <td>{{ $markatakipitem->satistemsilcisi->ad_soyad }}</td>
                                    <td>{{ $markatakipitem->marka_adi }}</td>
                                    <td>{{ $markatakipitem->marka_sinif }}</td>
                                    <td>{{ $markatakipitem->basvuru_no }}</td>
                                    <td class="text-wrap" style="max-width:100px">{{ $markatakipitem->hizmet->hizmet_ad }}</td>
                                    <td>{{ $markatakipitem->vkn }}</td>
                                    <td>{{ $markatakipitem->tc }}</td>
                                    <td>{{ $markatakipitem->sehir }}</td>
                                    <td style="text-align: center">
                                        @if ($markatakipitem->marka_islem === 'Yapıldı')
                                        <span class="badge bg-success">{{ $markatakipitem->marka_islem }}</span>
                                        @elseif($markatakipitem->marka_islem === 'Yapılmadı')
                                        <span class="badge bg-danger">{{ $markatakipitem->marka_islem }}</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if ($markatakipitem->marka_durum === 'Tescil Edildi')
                                        <span class="badge bg-success" style="font-size: 12px;"><i class="fa fa-check"></i></span>
                                        @elseif($markatakipitem->marka_durum === 'İptal Edildi')
                                        <span class="badge bg-danger" style="font-size: 12px;"><i class="fa fa-times"></i></span>
                                        @elseif($markatakipitem->marka_durum === 'Süreç Devam Ediyor')
                                        <span class="badge bg-warning" style="font-size: 12px;"><i class="fa fa-spinner"></i></span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="databutton">
                                            <div class="d-flex align-items-center fs-6">


                                                <button class="text-warning" data-bs-toggle="modal"
                                                    data-bs-target="#markatakipupdateModal-{{ $markatakipitem->id }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                @include('admin.contents.markatakip.markatakip-update')

                                                <form
                                                    action="{{ route('markatakip.destroy', ['markatakip' => $markatakipitem->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 show_confirm">
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
                            {{ $markatakip->appends(['entries' => $perPage])->links() }}
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div id="printArea" style="display: none;">
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
                @foreach ($markatakip as $markatakipitem)
                <tr>
                    <td>{{ $startNumber - $loop->index }}</td>
                    <td>{{ $markatakipitem->islem_tarihi }}</td>
                    <td>{{ $markatakipitem->basvuru_tarihi }}</td>
                    <td>{{ $markatakipitem->yenileme_tarih }}</td>
                    <td>{{ $markatakipitem->referans_no }}</td>
                    <td>{{ $markatakipitem->firmaadi->firma_unvan }}</td>
                    <td>{{ $markatakipitem->firmaadi->yetkili_kisi_tel }}</td>
                    <td>{{ $markatakipitem->marka_adi }}</td>
                    <td>{{ $markatakipitem->marka_sinif }}</td>
                    <td>{{ $markatakipitem->basvuru_no }}</td>
                    <td>{{ $markatakipitem->hizmet->hizmet_ad }}</td>
                    <td>{{ $markatakipitem->vkn }}</td>
                    <td>{{ $markatakipitem->tc }}</td>
                    <td>{{ $markatakipitem->sehir }}</td>
                    <td>{{ $markatakipitem->marka_islem }}</td>
                    <td>{{ $markatakipitem->marka_durum }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

 {{-- SEARCHHHH  --}}
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    $(document).ready(function(){
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('markatakipsearch') }}',
                    method: 'GET',
                    data: { markatakipsearch: '' }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('markatakipsearch') }}',
                    method: 'GET',
                    data: { markatakipsearch: searchValue }, // Arama değeri
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
    $(document).ready(function() {
        $('#cari_id').on('change', function() {
            var selectedCariId = $(this).val();

            $.ajax({
                url: '/getMusteriTemsilcisi/' + selectedCariId,
                type: 'GET',
                dataType: 'json', // Gelen verinin JSON olduğunu belirtin
                success: function(data) {
                    // AJAX isteği başarılı olduğunda çalışacak kod
                    $('#musteri_temsilcisi').val(data.musteri_temsilcisi);
                    $('#tc').val(data.tc);
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
        $('#cari_id_1').select2({
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
            dropdownParent: $('#markatakipfilmodal'),
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
        $('#cari_id_2').select2({
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
            dropdownParent: $('#markatakipfilexcelmodal'),
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
         $('#cari_id_1').select2({
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
            dropdownParent: $('#markatakipfilmodal'),
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
    addRowButton.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"><path d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z" stroke="currentColor" stroke-width="1.5"></path><path d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22" stroke="currentColor" stroke-width="1.5"></path><path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path></svg>İşlem devam ediyor...';
}

addRowButton.addEventListener('click', function () {
    if (validateRequiredFields()) {
        this.disabled = true;
        this.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2"><path d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z" stroke="currentColor" stroke-width="1.5"></path><path d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22" stroke="currentColor" stroke-width="1.5"></path><path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path></svg>İşlem devam ediyor...';
        document.getElementById('add-form').submit();
        localStorage.setItem('isButtonDisabled', 'true');
    }
});

window.addEventListener('beforeunload', function () {
    localStorage.removeItem('isButtonDisabled');
});
        </script>

<script>
        document.addEventListener("DOMContentLoaded", function () {
            // Sayfa başına gösterilecek giriş sayısı seçim menüsü
            const entriesForm = document.getElementById("entriesForm");
            const entriesSelect = entriesForm.querySelector("select[name='entries']");

            // Seçim değiştirildiğinde form gönderiliyor
            entriesSelect.addEventListener("change", function () {
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
