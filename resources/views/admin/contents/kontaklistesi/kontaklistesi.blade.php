@extends('admin.layouts.app')
@section('title')
    KONTAK LİSTESİ
@endsection
@section('contents')
    @section('topheader')
        KONTAK LİSTESİ
    @endsection

    <div class="card radius-5">
        <div class="card-header bg-transparent">
            <div class="row ">
                <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">

                    <div class=" col-md-4 mr-4 mobile-erp1 d-flex gap-2">
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

                    <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                        <form id="searchForm" action="{{ route('kontaklarsearch') }}" method="GET"
                            class="position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                                    class="bi bi-search"></i>
                            </div>
                            <!-- Arama inputu -->
                            <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                                class="form-control ps-5" type="text" placeholder="Ara">
                        </form>
                    </div>
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">

                        <a type="button" href="{{ route('kontaklistesi.create') }}" class="btn btn-outline-dark btn-sm "><i
                                class="fa-solid fa-plus"></i>Yeni Ekle</a>
                    </div>


                </div>
            </div>
        </div>




    <div class="card-body" style="border-radius: 5px">

        <div class="table-responsive" style="border-radius: 5px">

            <table class="table table-bordered table-hover" id="example2" role="grid" aria-describedby="example_info"
                style="width:100%; cursor: pointer; ">
                <thead >
                    <tr>
                        <th style="color: white" scope="col">#</th>
                        <th style="color: white">Firma</th>
                        <th style="color: white">Yetkili Kişi</th>
                        <th style="color: white">Telefon</th>
                        <th style="color: white">E-Posta</th>
                        <th style="color: white">Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kontak as $kontakitem)
                        <tr>
                            <th scope="row">{{ $startNumber - $loop->index }}</th>
                            <td><a style="color:inherit"
                                href="{{ route('cariler.show', ['cariler' => $kontakitem->firmaadi->id]) }}">{{ $kontakitem->firmaadi->firma_unvan }}</a></td>
                            <td>{{ $kontakitem->yetkili_isim }}</td>
                            <td>{{ $kontakitem->telefon }}</td>
                            <td>{{ $kontakitem->eposta }}</td>
                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                        <button  data-bs-toggle="modal"
                                            data-bs-target="#kontakupdateModal-{{ $kontakitem->id }}">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </button>
                                        @include('admin.contents.kontaklistesi.kontaklistesi-update')
                                        <form action="{{ route('kontaklistesi.destroy', $kontakitem->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn  p-0 m-0 show_confirm">
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
        <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
            {{-- {{ $aramalar->appends(['entries' => $perPage])->links() }} --}}
        </div>
    </div>
    </div>

    @include('session.session')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('searchForm').addEventListener('submit', function (event) {
                event.preventDefault();
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#searchInput').on('input', function (event) {
                var searchValue = $(this).val();

                if (searchValue.trim() === '') {
                    // Eğer input boşsa, tüm veriyi yükle
                    $.ajax({
                        url: '{{ route('kontaklarsearch') }}',
                        method: 'GET',
                        data: {
                            kontaklarsearch: ''
                        }, // Arama değeri boş olduğunda tüm veriyi yükle
                        success: function (response) {
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
                        success: function (response) {
                            // Sadece tbody kısmını güncelle
                            $('#example2 tbody').html(response);
                        }
                    });
                }
            });
        });
    </script>
@endsection
