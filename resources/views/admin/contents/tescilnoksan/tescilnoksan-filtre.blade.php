@extends('admin.layouts.app')
@section('title')
    Tescil Noksan
@endsection
@section('contents')
@section('topheader')
    Tescil Noksan
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
            <div class="col-lg-1 col-1 col-md-1 text-start">
                <form method="GET" action="{{ route('tescilnoksan.index') }}" id="entriesForm">
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
                    data-bs-target="#tescilnoksanfilmodal">
                    Filtrele
                </button>
                <a href="{{ route('tescilnoksan.index') }}" type="button" style="border-radius: 3px"
                    class="btn btn-sm btn-danger">
                    Temizle</a>
            </div>
            <div class="col-md-9 text-md-end">
                <a href="{{ route('tescilnoksan.pdf') }}?{{ request()->getQueryString() }}" class="btn btn-sm btn-danger"><i
                        class="fa-solid fa-file-pdf" style="font-size: 18px"></i></a>
                        <a href="{{ route('tescilnoksan.excel') }}?{{ request()->getQueryString() }}"
                            class="btn btn-sm btn-success">
                            <i class="fa-solid fa-file-excel" style="font-size: 18px"></i>
                        </a>
                <a href="javascript:;" onclick="customPrint()" class="btn btn-sm btn-secondary"><i
                        class="bi bi-printer-fill" style="font-size: 15px"></i></a>
                <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                    data-bs-target="#tescilnoksanmodal">
                    <i class="fa-solid fa-plus"></i> Yeni Ekle
                </button>
            </div>
        </div>
    </div>
    <!--TESCİLNOKSAN FİLTRELEME Modal -->
    <div class="modal fade" id="tescilnoksanfilmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" action="{{ route('tescilnoksanfiltre.index') }}" method="GET">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tescil Noksan Filtreleme Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <button type="submit" id="submit-form" class="btn btn-outline-primary btn-sm ">Sorgula</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tescilnoksanmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('tescilnoksan.store') }}" method="POST" id="add-form"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tescil Noksan Ekleme Ekranı</h5>
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
                                <div class="col-md-3">
                                    <label for="referans_no">Referans No</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="referans_no" id="referans_no"
                                            class="form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="musteri_temsilcisi">Müşteri Temsilcisi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <input type="text" name="musteri_temsilcisi" id="musteri_temsilcisi"
                                            class="form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                                    <label for="tn_durum">İtiraz Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="tn_durum" id="tn_durum" class="form-select form-select-sm"
                                            required>
                                            <option value="Yapıldı">Yapıldı</option>
                                            <option value="Beklemede">Beklemede</option>
                                            <option value="Yapılmadı">Yapılmadı</option>
                                            <option value="İptal">İptal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="teblig_tarihi">Tebliğ Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" name="teblig_tarihi" id="teblig_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                        <label for="bakanlik_karari">Bakanlık Kararı</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <select name="bakanlik_karari" id="bakanlik_karari"
                                                class="form-select form-select-sm" required>
                                                <option value="Tam Red Kararı">Tam Red Kararı</option>
                                                <option value="Kısmi Red Kararı">Kısmi Red Kararı</option>
                                                <option value="Yayına İtiraz Kararı">Yayına İtiraz Kararı</option>
                                                <option value="Noksan Evrak Yazısı">Noksan Evrak Yazısı</option>
                                                <option value="Yayına 2. İtiraz">Yayına 2. İtiraz</option>
                                                <option value="Yayına İtirazlar Red">Yayına İtirazlar Red</option>
                                                <option value="Yayına İtirazlar Kısmi Kabul">Yayına İtirazlar Kısmi Kabul</option>
                                                <option value="Yayına İtirazlar Kısmi Kabul">Yayına İtirazlar Kısmi Kabul</option>
                                                <option value="Yayına İtirazlar Kabul-Tam Red">Yayına İtirazlar Kabul-Tam Red</option>
                                                <option value="Marka Yayına İtiraz-Red">Marka Yayına İtiraz-Red</option>
                                                <option value="Marka Yayına İtiraz-Kısmi Red">Marka Yayına İtiraz Kabul-Tam Red</option>
                                                <option value="Yidk İtirazlar Red Yazısı">Yidk İtirazlar Red Yazısı</option>
                                                <option value="Yidk İtirazlar Kısmi Kabul Yazısı">Yidk İtirazlar Kısmi Kabul Yazısı</option>
                                                <option value="Yidk İtirazlar Kabul-Tam Red">Yidk İtirazlar Kabul-Tam Red</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="itiraz_islem">İşlem Adı</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <select name="itiraz_islem" id="itiraz_islem"
                                                class="form-select form-select-sm" required>
                                                <option value="">Lütfen Seçim Yapınız</option>
                                                <option value="Tam Red İtiraz">Tam Red İtiraz</option>
                                                <option value="Kısmi Red İtiraz">Kısmi Red İtiraz</option>
                                                <option value="Yayıma İtiraz Kararı">Yayıma İtiraz Kararı</option>
                                                <option value="Görüş Bildirme">Görüş Bildirme</option>
                                                <option value="Başvuru Noksan Tamamlama">Başvuru Noksan Tamamlama</option>
                                                <option value="Yidd Görüş Bildirme">Yidd Görüş Bildirme</option>
                                                <option value="Yayıma İtirazın Kararına İtiraz">Yayıma İtirazın Kararına İtiraz</option>
                                                <option value="Yidk Nihai Karar">Yidk Nihai Karar</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                <div class="col-md-4">
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
                                </div>
                                <div class="col-md-4">
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


                    <form id="searchForm" action="{{ route('tescilnoksansearch') }}" method="GET">
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
                            <th>Marka Adı</th>
                            <th>Firma Adı</th>
                            <th>Müşteri Temsilcisi</th>
                            <th>Satış Temsilcisi</th>
                            <th>Tebliğ Tarihi</th>
                            <th>Tebliğ Bitiş Tarihi</th>
                            <th>Durum</th>
                            <th>İşlem Tarihi</th>
                            <th>Dosya</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tescilnoksan as $tescilnoksanitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $tescilnoksanitem->referansno->basvuru_no }}</td>
                                <td>{{ $tescilnoksanitem->referans_no }}</td>
                                <td>{{ $tescilnoksanitem->marka_adi }}</td>
                                <td>{{ $tescilnoksanitem->firma_adi }}</td>
                                <td>{{ $tescilnoksanitem->musteri_temsilcisi }}</td>
                                <td>{{ $tescilnoksanitem->satis_temsilcisi }}</td>
                                <td>{{ $tescilnoksanitem->teblig_tarihi }}</td>
                                <td>{{ $tescilnoksanitem->teblig_bitis_tarihi }}</td>
                                <td>
                                    @if ($tescilnoksanitem->tn_durum === 'Yapıldı')
                                        <span class="badge bg-success">{{ $tescilnoksanitem->tn_durum }}</span>
                                    @elseif($tescilnoksanitem->tn_durum === 'Yapılmadı')
                                        <span class="badge bg-danger">{{ $tescilnoksanitem->tn_durum }}</span>
                                    @elseif ($tescilnoksanitem->tn_durum === 'Beklemede')
                                        <span class="badge bg-warning">{{ $tescilnoksanitem->tn_durum }}</span>
                                    @else
                                        {{ $tescilnoksanitem->tn_durum }}
                                    @endif
                                </td>
                                <td>{{ $tescilnoksanitem->islem_tarihi }}</td>

                                <td>
                                    @if ($tescilnoksanitem->itiraz_dosya)
                                        @php
                                            $fileExtension = pathinfo(
                                                $tescilnoksanitem->itiraz_dosya,
                                                PATHINFO_EXTENSION,
                                            );
                                        @endphp

                                        @if (strtolower($fileExtension) === 'pdf')
                                            <a href="{{ asset($tescilnoksanitem->itiraz_dosya) }}" target="_blank"
                                                style="color: red">
                                                <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                            </a>
                                        @else
                                            <a href="{{ asset($tescilnoksanitem->itiraz_dosya) }}" target="_blank">
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



                                            <a href="{{ route('tescilnoksan.edit', ['tescilnoksan' => $tescilnoksanitem->id]) }}"
                                                class="text-warning btn btn-link p-0 m-0 ">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form
                                                action="{{ route('tescilnoksan.destroy', ['tescilnoksan' => $tescilnoksanitem->id]) }}"
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
                        {{ $tescilnoksan->appends(['entries' => $perPage])->links() }}
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<div id="printArea" style="display: none;">
    <h1 style="text-align: center;">Tescil Noksan Raporu</h1>
    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa; text-align: left;">
                <th scope="col">#</th>
                <th>Başvuru No</th>
                <th>Referans No</th>
                <th>Marka Adı</th>
                <th>Firma Adı</th>
                <th>Müşteri Temsilcisi</th>
                <th>İşlem Yapan</th>
                <th>Tebliğ Tarihi</th>
                <th>Tebliğ Bitiş Tarihi</th>
                <th>Durum</th>
                <th>İşlem Tarihi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tescilnoksan as $tescilnoksanitem)
                <tr>
                    <th scope="row">{{ $startNumber - $loop->index }}</th>
                    <td>{{ $tescilnoksanitem->referansno->basvuru_no }}</td>
                    <td>{{ $tescilnoksanitem->referans_no }}</td>
                    <td>{{ $tescilnoksanitem->marka_adi }}</td>
                    <td>{{ $tescilnoksanitem->firma_adi }}</td>
                    <td>{{ $tescilnoksanitem->musteri_temsilcisi }}</td>
                    <td>{{ $tescilnoksanitem->satis_temsilcisi }}</td>
                    <td>{{ $tescilnoksanitem->teblig_tarihi }}</td>
                    <td>{{ $tescilnoksanitem->teblig_bitis_tarihi }}</td>
                    <td>{{ $tescilnoksanitem->tn_durum }}</td>
                    <td>{{ $tescilnoksanitem->islem_tarihi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tebligTarihiInput = document.getElementById("teblig_tarihi");
        var tebligBitisTarihiInput = document.getElementById("teblig_bitis_tarihi");

        tebligTarihiInput.addEventListener("change", function() {
            // Seçilen tarihi al
            var selectedDate = new Date(tebligTarihiInput.value);

            // 2 ay ekleyerek yeni tarihi hesapla
            var yeniTarih = new Date(selectedDate);
            yeniTarih.setMonth(selectedDate.getMonth() + 2);

            // Yeni tarihi "YYYY-MM-DD" formatına çevir
            var yeniTarihFormatli = yeniTarih.toISOString().split('T')[0];

            // Sonucu teblig_bitis_tarihi inputuna yaz
            tebligBitisTarihiInput.value = yeniTarihFormatli;
        });
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
                    url: '{{ route('tescilnoksansearch') }}',
                    method: 'GET',
                    data: {
                        tescilnoksansearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('tescilnoksansearch') }}',
                    method: 'GET',
                    data: {
                        tescilnoksansearch: searchValue
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
            dropdownParent: $('#tescilnoksanmodal'), // Modal ID'sini burada belirtin
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
                                id: item.firma_unvan,
                                text: item.firma_unvan
                            };
                        })
                    };
                },
                cache: true
            },
            dropdownParent: $('#tescilnoksanfilmodal'),
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
