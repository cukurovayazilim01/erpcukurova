@extends('admin.layouts.app')
@section('title')
Aktif Loglar
@endsection
@section('contents')
@section('topheader')
    Aktif Loglar
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
            <div class="col">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <div class="col-lg-1 col-1 col-md-1 text-start">
                        <form method="GET" action="{{ route('aktiflog.index') }}" id="entriesForm">
                            <select class="form-select form-select-sm" name="entries"
                                onchange="document.getElementById('entriesForm').submit();">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                    </div>




                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">


                    <form id="searchForm" action="{{ route('aktiflogsearch') }}" method="GET">
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
                {{-- <style>
                    .customclasswidth{
                        width: 100px !important;
                        border: 1px solid red;
                    }
                </style> --}}
                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>İşlem Tarihi</th>
                            <th>İşlem Yapan</th>
                            <th class="customclasswidth">Yapılan İşlem</th>
                            <th>Yapılan Güncelleme</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aktiflog as $aktiflogitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $aktiflogitem->islem_tarihi }}</td>
                                <td>{{ $aktiflogitem->adsoyad->ad_soyad }}</td>
                                <td class="text-wrap " style="max-width: 200px">{{ $aktiflogitem->islem }}</td>

                                <td class="text-wrap " style="max-width: 200px">
                                            {!! $aktiflogitem->guncellenmis_islem !!}
                                   </td>


                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
                    {{ $aktiflog->appends(['entries' => $perPage])->links() }}
                </div>
            </div>

        </div>

    </div>
</div>



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
                    url: '{{ route('aktiflogsearch') }}',
                    method: 'GET',
                    data: {
                        'aktiflogsearch': ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('aktiflogsearch') }}',
                    method: 'GET',
                    data: {
                        'aktiflogsearch': searchValue
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
