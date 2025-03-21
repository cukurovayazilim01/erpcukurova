@extends('admin.layouts.app')
@section('title')
    Alışlar
@endsection
@section('contents')
@section('topheader')
    Alışlar
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">

            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3 ">
                    <form action="{{ route('firmahrktaktaralislar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success ">Firma Hareketlerine Aktar</button>
                    </form>
                    <a type="button" href="{{ route('alislar.create') }}"
                        class="btn btn-sm btn-outline-primary px-5"><i class="fa-solid fa-plus"></i>Yeni Ekle</a>
                    <div class="dropdown">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->


    <div class="card-body">
        <div class="table-responsive">
            <div class="row">
                {{-- {{ route(Route::currentRouteName()) }} --}}

                <form id="searchForm" action="{{route('alislarsearch')}}" method="GET">
                    <div class="ms-auto position-relative" style="margin-bottom: 10px">
                        <!-- Arama ikonu -->
                        <div class="position-absolute top-50 translate-middle-y search-icon fs-5 px-3"
                            style="color: blue;">
                            <i class="bi bi-search"></i>
                        </div>
                        <!-- Arama inputu -->
                        <input type="text" id="searchInput" class="form-control ps-5"
                            style="border: 1px solid blue; height: 38px;" placeholder="Lütfen Arama Terimi Giriniz">
                    </div>
                </form>


            </div>
            <table class="table align-middle mb-0" id="example2">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Alış Kodu</th>
                        <th>Tarih</th>
                        <th>Fatura/Fiş No</th>
                        <th>Firma</th>
                        <th>Genel Toplam</th>
                        <th>Açıklama</th>
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alislar as $alislaritem)
                        <tr>
                            <th scope="row">{{ $startNumber - $loop->index }}</th>
                            <th scope="row">{{ $alislaritem->alis_kodu_text }}-{{ $alislaritem->alis_kodu }}</th>
                            <td scope="row">{{ $alislaritem->fis_tarihi }}</td>
                            <td>{{ $alislaritem->fis_no }}</td>
                            <td>{{ $alislaritem->firmaadi->firma_unvan }}</td>
                            <td>{{ number_format($alislaritem->toplam_tutar, 2, ',', '.') }} ₺</td>
                            <td>{{ $alislaritem->aciklama }} </td>
                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">
                                        <a href="{{ route('alislar.show', ['alislar' => $alislaritem->id]) }}"
                                            class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('alislar.edit', ['alislar' => $alislaritem->id]) }}"
                                            class="text-warning btn btn-link p-0 m-0 ">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form
                                            action="{{ route('alislar.destroy', ['alislar' => $alislaritem->id]) }}"
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
                    url: '{{ route('alislarsearch') }}',
                    method: 'GET',
                    data: {
                        alislarsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('alislarsearch') }}',
                    method: 'GET',
                    data: {
                        alislarsearch: searchValue
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
