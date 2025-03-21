@extends('admin.layouts.app')
@section('title')
    Tahsilat
@endsection
@section('contents')
@section('topheader')
Tahsilat
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">

            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <form action="{{ route('firmahrktaktartahsilat') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success ">Firma Hareketlerine Aktar</button>
                    </form>
                    <a type="button" href="{{ route('tahsilat.create') }}"
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

                <form id="searchForm" action="{{route('tahsilatsearch')}}" method="GET">
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
                        <th>Tahsilat Kodu</th>
                        <th>Tarih</th>
                        <th>Firma</th>
                        <th>Ödeme Türü</th>
                        <th>Tahsilat Tutar</th>
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tahsilat as $tahsilatitem)
                    <tr>
                        <th scope="row">{{ $startNumber - $loop->index }}</th>
                        <th>
                            {{$tahsilatitem->tahsilat_kodu_text}}-{{ $tahsilatitem->tahsilat_kodu }}
                        </th>
                        <td>{{ $tahsilatitem->tarih }}</td>

                        <td>{{ $tahsilatitem->firmaadi->firma_unvan }}</td>
                        <td>{{ $tahsilatitem->odeme_turu }}</td>
                        <td>{{ number_format($tahsilatitem->tahsilat_tutar, 2, ',', '.') }} <b style="color: red">₺</b></td>


                        <td class="text-right">
                            <div class="databutton">
                                <div class="d-flex align-items-center fs-6">


                                    <a href="{{ route('tahsilat.show', ['tahsilat' => $tahsilatitem->id]) }}"
                                        class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    {{-- <a href="{{ route('tahsilat.edit', ['tahsilat' => $tahsilatitem->id]) }}"
                                        class="text-warning btn btn-link p-0 m-0 ">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a> --}}
                                    <form
                                        action="{{ route('tahsilat.destroy', ['tahsilat' => $tahsilatitem->id]) }}"
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
                    url: '{{ route('tahsilatsearch') }}',
                    method: 'GET',
                    data: {
                        tahsilatsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('tahsilatsearch') }}',
                    method: 'GET',
                    data: {
                        tahsilatsearch: searchValue
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
