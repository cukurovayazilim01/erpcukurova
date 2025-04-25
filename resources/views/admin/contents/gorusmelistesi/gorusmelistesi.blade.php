@extends('admin.layouts.app')
@section('title')
    GÖRÜŞME LİSTESİ
@endsection
@section('contents')
    @section('topheader')
        GÖRÜŞME LİSTESİ
    @endsection
    <div class="card radius-5">
        <div class="card-header bg-transparent">
            <div class="row ">
                <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                    <div class=" col-md-4 mr-4 mobile-erp1 d-flex gap-2">
                        <form method="GET" action="{{ route('gorusmelistesi.index') }}" id="entriesForm">
                            <select class="form-select form-select-sm" name="entries"
                                onchange="document.getElementById('entriesForm').submit();">
                                <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                        <form id="searchForm" action="{{ route('aramalarsearch') }}" method="GET" class="position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                                    class="bi bi-search"></i></div>
                            <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                                class="form-control ps-5" type="text" placeholder="Ara">
                        </form>
                    </div>
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                        <a type="button" href="{{ route('gorusmelistesi.create') }}" class="btn btn-outline-dark btn-sm"><i
                                class="fa-solid fa-plus"></i>Yeni Ekle</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-body" style="border-radius: 5px">
            <div class="table-responsive" style="border-radius: 5px">
                    <table class="table table-bordered table-striped" id="example2" role="grid"
                        aria-describedby="example_info" style="width:100%;  ">
                        <thead>
                            <tr>
                                <th style="color: white" scope="col">#</th>
                                <th style="color: white">Tarih/Saat</th>
                                <th style="color: white">Aramayı Yapan</th>
                                <th style="color: white">Firma</th>
                                <th style="color: white">Arama Tipi</th>
                                <th style="color: white">Konu</th>
                                <th style="color: white">Görüşme Notu</th>
                                <th style="color: white">Hatırlatma Durumu</th>
                                <th style="color: white">Hatırlatma Tarihi</th>
                                <th style="color: white">Aksiyon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aramalar as $aramalaritem)
                                <tr>
                                    <th scope="row">{{ $startNumber - $loop->index }}</th>
                                    <td>{{ $aramalaritem->islem_tarihi }}</td>
                                    <td>{{ $aramalaritem->adsoyad->ad_soyad ?? '-' }}</td>
                                    <td class="text-wrap" style="max-width: 400px">{{ $aramalaritem->cariler->firma_unvan }}</td>
                                    <td>{{ $aramalaritem->arama_tipi }}</td>
                                    <td>{{ $aramalaritem->hizmet_turu }}</td>
                                    <td class="text-wrap" style="max-width: 700px">{{ $aramalaritem->not }}
                                    </td>
                                    <td >{{ $aramalaritem->hatirlat_durumu }}</td>
                                    <td>{{ $aramalaritem->hatirlat_tarihi }}</td>
                                    <td class="text-right">
                                        <div class="databutton">
                                            <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">

                                                <form action="{{ route('aramalar.destroy', ['id' => $aramalaritem->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0 m-0 show_confirm">
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
                {{ $aramalar->appends(['entries' => $perPage])->links() }}
            </div>
        </div>
    </div>
    {{-- SEARCHHHH --}}
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
                        url: '{{ route('aramalarsearch') }}',
                        method: 'GET',
                        data: {
                            aramalarsearch: ''
                        }, // Arama değeri boş olduğunda tüm veriyi yükle
                        success: function (response) {
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
                        success: function (response) {
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
