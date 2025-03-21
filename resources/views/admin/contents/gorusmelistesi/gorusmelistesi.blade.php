@extends('admin.layouts.app')
@section('title')
    GÖRÜŞME LİSTESİ
@endsection
@section('contents')
@section('topheader')
    GÖRÜŞME LİSTESİ
@endsection
<div class="card">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <div class="col-lg-2 col-6 col-md-3 text-start">
                        <form method="GET" action="{{ route('gorusmelistesi.index') }}" id="entriesForm">
                            <select class="form-select form-select-sm" name="entries"
                                onchange="document.getElementById('entriesForm').submit();">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                    </div>

                    <div class="ms-auto">
                        <a type="button" href="{{ route('gorusmelistesi.create') }}"
                            class="btn btn-sm btn-outline-primary px-5"><i class="fa-solid fa-plus"></i>Yeni Ekle</a>
                    </div>

                    <div class="dropdown">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <form id="searchForm" action="{{ route('aramalarsearch') }}" method="GET">
                <div class="ms-auto position-relative" style="margin-bottom: 10px">
                    <!-- Arama ikonu -->
                    <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3" style="color: blue;">
                        <i class="bi bi-search"></i>
                    </div>
                    <!-- Arama inputu -->
                    <input type="text" id="searchInput" class="form-control ps-5"
                        style="border: 1px solid blue; height: 38px;" placeholder="Lütfen Arama Terimi Giriniz">
                </div>
            </form>
            <div class="col-md-12">
                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Tarih/Saat</th>
                            <th>Aramayı Yapan</th>
                            <th>Firma</th>
                            <th>Arama Tipi</th>
                            <th>Konu</th>
                            <th>Görüşme Notu</th>
                            <th>Hatırlatma Durumu</th>
                            <th>Hatırlatma Tarihi</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aramalar as $aramalaritem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $aramalaritem->islem_tarihi }}</td>
                                <td>{{ $aramalaritem->adsoyad->ad_soyad }}</td>
                                <td>{{ $aramalaritem->cariler->firma_unvan }}</td>
                                <td>{{ $aramalaritem->arama_tipi }}</td>
                                <td>{{ $aramalaritem->hizmet_turu }}</td>
                                <td class="text-wrap" style="max-width: 400px">{{ $aramalaritem->not }}
                                </td>
                                <td>{{ $aramalaritem->hatirlat_durumu }}</td>
                                <td>{{ $aramalaritem->hatirlat_tarihi }}</td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">

                                            <form action="{{ route('aramalar.destroy', ['id' => $aramalaritem->id]) }}"
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
            </div>
        </div>

        <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
            {{-- {{ $aramalar->appends(['entries' => $perPage])->links() }} --}}
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
                    url: '{{ route('aramalarsearch') }}',
                    method: 'GET',
                    data: {
                        aramalarsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('aramalarsearch') }}',
                    method: 'GET',
                    data: {
                        aramalarsearch: searchValue
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
@include('session.session')
@endsection
