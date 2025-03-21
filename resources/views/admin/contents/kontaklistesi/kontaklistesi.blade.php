@extends('admin.layouts.app')
@section('title')
    KONTAK LİSTESİ
@endsection
@section('contents')
@section('topheader')
    KONTAK LİSTESİ
@endsection

<div class="card">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <div class="col-lg-2 col-6 col-md-3 text-start">
                        <form method="GET" action="{{ route('kontaklistesi.index') }}" id="entriesForm">
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
                        <a type="button" href="{{ route('kontaklistesi.create') }}"
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
            <form id="searchForm" action="{{ route('kontaklarsearch') }}" method="GET">
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
                            <th>Firma</th>
                            <th>Yetkili Kişi</th>
                            <th>Telefon</th>
                            <th>E-Posta</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kontak as $kontakitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $kontakitem->firmaadi->firma_unvan }}</td>
                                <td>{{ $kontakitem->yetkili_isim }}</td>
                                <td>{{ $kontakitem->eposta }}</td>
                                <td>{{ $kontakitem->telefon }}</td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#kontakupdateModal-{{ $kontakitem->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            @include('admin.contents.kontaklistesi.kontaklistesi-update')
                                            <form action="{{ route('kontaklistesi.destroy', $kontakitem->id) }}"
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

@include('session.session')

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
                    url: '{{ route('kontaklarsearch') }}',
                    method: 'GET',
                    data: {
                        kontaklarsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('kontaklarsearch') }}',
                    method: 'GET',
                    data: {
                        kontaklarsearch: searchValue
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
