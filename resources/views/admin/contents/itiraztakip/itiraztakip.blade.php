@extends('admin.layouts.app')
@section('title')
    İtiraz Takip
@endsection
@section('contents')
@section('topheader')
    İtiraz Takip
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
        <div class="row g-3 align-items-center">

            <div class="col-lg-1 col-1 col-md-1">
                <form method="GET" action="{{ route('itiraztakipp.index') }}" id="entriesForm">
                    <select class="form-select form-select-sm" name="entries"
                        onchange="document.getElementById('entriesForm').submit();">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>
            <div class="col-md-2 col-6 text-start">
                <button type="button" style="border-radius: 3px" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#itiraztakipfilmodal">
                    Filtrele
                </button>
            </div>

            <div class="col-md-9 text-end">
                <a href="{{ route('pdf.download', ['type' => 'itiraz']) }}" class="btn btn-sm btn-danger"><i
                        class="fa-solid fa-file-pdf" style="font-size: 18px"></i></a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#itiraztakipfilexcelmodal"
                    class="btn btn-sm btn-success">
                    <i class="fa-solid fa-file-excel" style="font-size: 18px"></i>
                </button>
                <a href="javascript:;" onclick="customPrint()" class="btn btn-sm btn-secondary"><i
                        class="bi bi-printer-fill" style="font-size: 15px"></i></a>

                <button type="button" class="btn btn-sm btn-outline-primary px-5" style="margin-left: 10px" data-bs-toggle="modal"
                    data-bs-target="#itiraztakipmodal">
                    <i class="fa-solid fa-plus"></i> Yeni Ekle
                </button>
            </div>
            {{-- <div class="dropdown">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" hrefjava="script:;">Action</a></li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                        </ul>
                    </div> --}}
        </div>
    </div>


    <!--FİLTRELEMEEXCELL Modal -->
    <div class="modal fade" id="itiraztakipfilexcelmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('excel.export', ['type' => 'itiraztakip']) }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">İtiraz Excel İndirme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="firma_adi" id="cari_id_2"
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
                                        <select name="satis_temsilcisi" id=""
                                            class="form-select form-select-sm">
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->ad_soyad }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label for="ilk_tarih">Tebliğ Bitiş İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Tebliğ Bitiş Son Tarih</label>
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
                        <button type="submit" id="submit-form" class="btn btn-outline-success btn-sm" >İndir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--İTİRAZTAKİP FİLTRELEME Modal -->
    <div class="modal fade" id="itiraztakipfilmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('itiraztakipfiltre.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">İtiraz Filtreleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">
                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma</label>
                                    <select name="firma_adi" id="cari_id_1"
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
                                        <select name="satis_temsilcisi" id=""
                                            class="form-select form-select-sm">
                                            <option value="">Lütfen Seçim Yapınız</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->ad_soyad }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label for="ilk_tarih">Tebliğ Bitiş İlk Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="ilk_tarih" id="ilk_tarih"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="son_tarih">Tebliğ Bitiş Son Tarih</label>
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
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="itiraztakipmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('itiraztakipp.store') }}" method="POST" id="add-form"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">İtiraz Ekleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row">
                                <div class="col-md-4 select2-sm">
                                    <label for="markatakip_id">Başvuru No</label>

                                    <select name="markatakip_id" id="markatakip_id" required
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="marka_adi">Marka Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="marka_adi" id="marka_adi"
                                            class="form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="firma_adi">Firma Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="firma_adi" id="firma_adi"
                                            class="form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="referans_no">Referans No</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="referans_no" id="referans_no"
                                            class="form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                            class="form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="satis_temsilcisi">Satış Temsilcisi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="satis_temsilcisi" id="satis_temsilcisi"
                                            class="form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="teblig_tarihi">Tebliğ Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="teblig_tarihi" id="teblig_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="bakanlik_karari">Bakanlık Kararı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="bakanlik_karari" id="bakanlik_karari"
                                            class="form-select form-select-sm" required>
                                            <option value="">Seçim Yapınız</option>
                                            <option value="Başvuru Noksan">Başvuru Noksan</option>
                                            <option value="Marka Kısmi Red Kararı">Marka Kısmi Red Kararı</option>
                                            <option value="Marka Red Kararı">Marka Red Kararı</option>
                                            <option value="Yayına İtiraz">Yayına İtiraz</option>
                                            <option value="Yayına İkinci İtiraz">Yayına İkinci İtiraz</option>
                                            <option value="Yayına İtirazlar Red">Yayına İtirazlar Red</option>
                                            <option value="Yayına İtirazlar Kısmi Kabul">Yayına İtirazlar Kısmi Kabul
                                            </option>
                                            <option value="Yayına İtirazlar Kabul-Tam Red">Yayına İtirazlar Kabul-Tam
                                                Red</option>
                                            <option value="Yayıma İtiraz Kabul">Yayıma İtiraz Kabul</option>
                                            <option value="Yayıma İtiraz Kısmi Kabul">Yayıma İtiraz Kısmi Kabul
                                            </option>
                                            <option value="Yayıma İtiraz Red">Yayıma İtiraz Red</option>
                                            <option value="Yidk İtiraz Kabul">Yidk İtiraz Kabul</option>
                                            <option value="Yidk İtiraz Kısmi Kabul">Yidk İtiraz Kısmi Kabul</option>
                                            <option value="Yidk İtiraz Red">Yidk İtiraz Red</option>
                                            <option value="İşlemden Kaldırma Yazısı">İşlemden Kaldırma Yazısı</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="itiraz_islem">İşlem Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" id="islem_adi" name="itiraz_islem"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="itiraz_durum">İtiraz Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="itiraz_durum" id="itiraz_durum"
                                            class="form-select form-select-sm" required>
                                            <option value="Yapıldı">Yapıldı</option>
                                            <option value="Beklemede">Beklemede</option>
                                            <option value="Yapılmadı">Yapılmadı</option>
                                            <option value="İptal">İptal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="teblig_bitis_tarihi">Tebliğ Bitiş Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="teblig_bitis_tarihi" id="teblig_bitis_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <label for="teblig_bitis_tarihi">Tebliğ Bitiş Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="teblig_bitis_tarihi" id="teblig_bitis_tarihi"
                                            class="form-control form-control-sm"
                                            style="pointer-events: none; cursor: not-allowed"
                                            onkeydown="return false;" required readonly>
                                    </div>
                                </div> --}}

                                <div class="col-md-4">
                                    <label for="ucret">Ücret</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-money-bill"></i>
                                        </span>
                                        <input type="number" name="ucret" id="ucret"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <label for="itiraz_dosya">İtiraz Dosya</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <input type="file" name="itiraz_dosya" id="itiraz_dosya"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="itiraz_aciklama">İtiraz Açıklama</label>
                                    <textarea name="itiraz_aciklama" id="itiraz_aciklama" cols="20" rows="2"
                                        class="form-control form-control-sm "></textarea>
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


                    <form id="searchForm" action="{{ route('itiraztakipsearch') }}" method="GET">
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
                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Başvuru No</th>
                            <th>Referans No</th>
                            <th>Bakanlık Kararı</th>
                            <th>İtiraz İşlem</th>
                            <th>Marka Adı</th>
                            <th>Firma Adı</th>
                            <th>Müşteri Temsilcisi</th>
                            <th>İşlem Yapan</th>
                            <th>Tebliğ Tarihi</th>
                            <th>Tebliğ Bitiş Tarihi</th>
                            <th>Ücret</th>
                            <th>Durum</th>
                            <th>İşlem Tarihi</th>
                            <th>Dosya</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itiraztakip as $itiraztakipitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $itiraztakipitem->referansno->basvuru_no }}</td>
                                <td>{{ $itiraztakipitem->referans_no }}</td>
                                <td class="text-wrap" style="max-width:100px">{{ $itiraztakipitem->bakanlik_karari }}
                                </td>
                                <td>{{ $itiraztakipitem->itiraz_islem }}</td>
                                <td>{{ $itiraztakipitem->marka_adi }}</td>
                                <td>{{ $itiraztakipitem->firma_adi }}</td>
                                <td>{{ $itiraztakipitem->musteri_temsilcisi }}</td>
                                <td>{{ $itiraztakipitem->satis_temsilcisi }}</td>
                                <td>{{ $itiraztakipitem->teblig_tarihi }}</td>
                                <td>{{ $itiraztakipitem->teblig_bitis_tarihi }}</td>
                                <td>{{ number_format($itiraztakipitem->ucret, 2, ',', '.') }} <b style="color: red">
                                        ₺</b></td>
                                <td>
                                    @if ($itiraztakipitem->itiraz_durum === 'Yapıldı')
                                        <span class="badge bg-success" style="font-size: 12px;"><i
                                                class="fa fa-check"></i></span>
                                    @elseif($itiraztakipitem->itiraz_durum === 'İptal')
                                        <span class="badge bg-danger" style="font-size: 12px;"><i
                                                class="fa fa-times"></i></span>
                                    @elseif($itiraztakipitem->itiraz_durum === 'Beklemede')
                                        <span class="badge bg-warning" style="font-size: 12px;"><i
                                                class="fa fa-spinner"></i></span>
                                    @endif
                                </td>
                                <td>{{ $itiraztakipitem->islem_tarihi }}</td>

                                <td>
                                    @if ($itiraztakipitem->itiraz_dosya)
                                        @php
                                            $fileExtension = pathinfo(
                                                $itiraztakipitem->itiraz_dosya,
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp

                                        @if (strtolower($fileExtension) === 'pdf')
                                            <a href="{{ asset($itiraztakipitem->itiraz_dosya) }}" target="_blank"
                                                style="color: red">
                                                <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                            </a>
                                        @else
                                            <a href="{{ asset($itiraztakipitem->itiraz_dosya) }}" target="_blank">
                                                <i class="bi bi-image"></i> Görüntüle
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-muted">Dosya Yok</span>
                                    @endif
                                </td>

                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">


                                            <a href="{{ route('itiraztakipp.edit', ['itiraztakipp' => $itiraztakipitem->id]) }}"
                                                class="text-warning btn btn-link p-0 m-0 ">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form
                                                action="{{ route('itiraztakipp.destroy', ['itiraztakipp' => $itiraztakipitem->id]) }}"
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
                        {{ $itiraztakip->appends(['entries' => $perPage])->links() }}
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<div id="printArea" style="display: none;">
    <h1 style="text-align: center;">İtiraz Takip Raporu</h1>
    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa; text-align: left;">
                <th>#</th>
                <th>Başvuru No</th>
                <th>Referans No</th>
                <th>Bakanlık Kararı</th>
                <th>İtiraz İşlem</th>
                <th>Marka Adı</th>
                <th>Firma Adı</th>
                <th>Müşteri Temsilcisi</th>
                <th>İşlem Yapan</th>
                <th>Tebliğ Tarihi</th>
                <th>Tebliğ Bitiş Tarihi</th>
                <th>Ücret</th>
                <th>Durum</th>
                <th>İşlem Tarihi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itiraztakip as $itiraztakipitem)
                <tr>
                    <td>{{ $startNumber - $loop->index }}</td>
                    <td>{{ $itiraztakipitem->referansno->basvuru_no }}</td>
                    <td>{{ $itiraztakipitem->referans_no }}</td>
                    <td>{{ $itiraztakipitem->bakanlik_karari }}</td>
                    <td>{{ $itiraztakipitem->itiraz_islem }}</td>
                    <td>{{ $itiraztakipitem->marka_adi }}</td>
                    <td>{{ $itiraztakipitem->firma_adi }}</td>
                    <td>{{ $itiraztakipitem->musteri_temsilcisi }}</td>
                    <td>{{ $itiraztakipitem->satis_temsilcisi }}</td>
                    <td>{{ $itiraztakipitem->teblig_tarihi }}</td>
                    <td>{{ $itiraztakipitem->teblig_bitis_tarihi }}</td>
                    <td>{{ number_format($itiraztakipitem->ucret, 2, ',', '.') }} ₺</td>
                    <td>{{ $itiraztakipitem->itiraz_durum }}</td>
                    <td>{{ $itiraztakipitem->islem_tarihi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function printItirazTable() {
        var printContents = document.getElementById('printItirazTable').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // Sayfayı yenileyerek eski haline döndürür
    }
</script>
<script>
    document.getElementById('bakanlik_karari').addEventListener('change', function() {
        const selectedValue = this.value;
        const islemAdiInput = document.getElementById('islem_adi');

        // İşlem adı eşleştirmeleri
        const islemAdlari = {
            'Başvuru Noksan': 'Noksan Tamamlama',
            'Marka Kısmi Red Kararı': 'Kısmi Red Kararına İtiraz',
            'Marka Red Kararı': 'Red Kararına İtiraz',
            'Yayına İtiraz': 'Görüş Dosyası',
            'Yayına İkinci İtiraz': 'UİDD Görüş Bildirme',
            'Yayına İtirazlar Red': 'İşlem Yapılmaz',
            'Yayına İtirazlar Kısmi Kabul': 'Karara İtiraz',
            'Yayına İtirazlar Kabul-Tam Red': 'Karara İtiraz',
            'Yayıma İtiraz Kabul': 'Karara İtiraz',
            'Yayıma İtiraz Kısmi Kabul': 'Karara İtiraz',
            'Yayıma İtiraz Red': 'Karara İtiraz',
            'Yidk İtiraz Kabul': 'Nihai Karar',
            'Yidk İtiraz Kısmi Kabul': 'Nihai Karar',
            'Yidk İtiraz Red': 'Nihai Karar',
            'İşlemden Kaldırma Yazısı': 'Karşılığı Yok'
        };

        // Seçim değerine göre işlem adını belirle
        islemAdiInput.value = islemAdlari[selectedValue] || ''; // Eşleşme yoksa boş bırak
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
        });
    });
</script>
<script>
    // Sayfa yüklendiğinde itiraz_islem selectini disabled yap
    document.addEventListener("DOMContentLoaded", function() {
        var itirazIslemSelect = document.getElementById("itiraz_islem");
        itirazIslemSelect.disabled = true;
    });

    // Teblig tarihi inputunu seç
    var tebligTarihiInput = document.getElementById("teblig_tarihi");

    // İtiraz işlem selectini seç
    var itirazIslemSelect = document.getElementById("itiraz_islem");

    // Teblig tarihi inputunun değeri değiştiğinde kontrol eden bir event listener ekleyelim
    tebligTarihiInput.addEventListener("change", function() {
        // Eğer teblig_tarihi inputunda bir değer yoksa
        if (!tebligTarihiInput.value) {
            // itiraz_islem selectini disabled hale getir
            itirazIslemSelect.disabled = true;
        } else {
            // teblig_tarihi inputunda bir değer varsa itiraz_islem selectini etkin hale getir
            itirazIslemSelect.disabled = false;
        }
    });
</script>

<script>
    document.getElementById('bakanlik_karari').addEventListener('change', function() {
        const selectedOption = this.value;
        const tebligTarihiInput = document.getElementById('teblig_tarihi');
        const tebligBitisTarihiInput = document.getElementById('teblig_bitis_tarihi');

        // Tebliğ tarihi boşsa işlem yapılmasın
        if (!tebligTarihiInput.value) {
            tebligBitisTarihiInput.value = '';
            return;
        }

        const tebligTarihi = new Date(tebligTarihiInput.value);

        // İşlem türlerine göre gün ekleme kuralları
        const gunEklemeKurallari = {
            'Başvuru Noksan': 60,
            'Marka Kısmi Red Kararı': 60,
            'Marka Red Kararı': 60,
            'Yayına İtirazlar Red': 60,
            'Yayına İtirazlar Kısmi Kabul': 60,
            'Yayına İtirazlar Kabul-Tam Red': 60,
            'Yayıma İtiraz Kabul': 60,
            'Yayıma İtiraz Kısmi Kabul': 60,
            'Yayıma İtiraz Red': 60,
            'Yayına İtiraz': 30,
            'Yayına İkinci İtiraz': 30,
            'Yidk Nihai Karar': 1,
        };

        // Seçilen opsiyon için gün ekleme değerini al
        const gunEkle = gunEklemeKurallari[selectedOption];

        if (gunEkle !== undefined) {
            // Tebliğ tarihine gün ekle
            const tebligBitisTarihi = new Date(tebligTarihi);
            tebligBitisTarihi.setDate(tebligBitisTarihi.getDate() + gunEkle);

            // YYYY-MM-DD formatında tarihi alıp inputa yaz
            const formattedDate = tebligBitisTarihi.toISOString().split('T')[0];
            tebligBitisTarihiInput.value = formattedDate;
        } else {
            // Belirtilen bir işlem yoksa bitiş tarihini temizle
            tebligBitisTarihiInput.value = '';
        }
    });
</script>
{{-- SEARCHHHH  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('itiraztakipsearch') }}',
                    method: 'GET',
                    data: {
                        itiraztakipsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('itiraztakipsearch') }}',
                    method: 'GET',
                    data: {
                        itiraztakipsearch: searchValue
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
    $(document).ready(function() {
        $('#markatakip_id').on('change', function() {
            var selectedCariId = $(this).val();

            $.ajax({
                url: '/getMarkabilgi/' + selectedCariId,
                type: 'GET',
                dataType: 'json', // Gelen verinin JSON olduğunu belirtin
                success: function(data) {
                    // AJAX isteği başarılı olduğunda çalışacak kod
                    $('#marka_adi').val(data.marka_adi);
                    $('#firma_adi').val(data.firma_adi);
                    $('#referans_no').val(data.referans_no);
                    $('#musteri_temsilcisi').val(data.musteri_temsilcisi);
                    $('#satis_temsilcisi').val(data.satis_temsilcisi);

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
        // Select2 başlatma
        $('#markatakip_id').select2({
            theme: 'bootstrap4', // Bootstrap 4 uyumluluğu
            placeholder: "Başvuru No Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%', // Select2 genişliği
            ajax: {
                url: '/basvuruno-search',
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
                                text: item.basvuru_no
                            };
                        })
                    };
                },
                cache: true
            },
            dropdownParent: $('#itiraztakipmodal'), // Modal ID'sini burada belirtin
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
          $('#markatakip_id').on('select2:open', function() {
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
                                id: item.firma_unvan,
                                text: item.firma_unvan
                            };
                        })
                    };
                },
                cache: true
            },
            dropdownParent: $('#itiraztakipfilmodal'),
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
        $('#cari_id_1').on('select2:open', function() {
            setTimeout(() => {
                let searchField = $('.select2-container--open .select2-search__field');
                if (searchField.length) {
                    searchField[0].focus();
                }
            }, 150); // 50 yerine 150 ms bekleyelim
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
            dropdownParent: $('#itiraztakipfilexcelmodal'),
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
         $('#cari_id_2').on('select2:open', function() {
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
@endsection
