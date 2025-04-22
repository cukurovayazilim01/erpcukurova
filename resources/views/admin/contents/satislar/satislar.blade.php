@extends('admin.layouts.app')
@section('title')
    SATIŞLAR
@endsection
@section('contents')
    @section('topheader')
        SATIŞLAR
    @endsection
    <div class="card radius-5">
        <div class="card-header bg-transparent">
            <div class="row g-2">
                <div class="col-12 col-lg-5">
                    <div class="d-flex flex-wrap gap-2 justify-content-start">
                        <!-- Sayfa boyutu seçici -->
                        <form method="GET" action="{{ route('satislar.index') }}" id="entriesForm">
                            <select class="form-select form-select-sm" name="entries"
                                onchange="document.getElementById('entriesForm').submit();">
                                <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>

                        <form action="{{ route('firmahrktaktarsatislar') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success ">Firma Hareketlerine Aktar</button>
                        </form>
                    </div>
                </div>
                    <!-- Arama Kutusu -->
                    <div class="col-lg-5 d-flex align-items-center mobile-erp2 justify-content-start">
                        <form class="position-relative" id="searchForm" action="{{ route('satislarsearch') }}" method="GET">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                                    class="bi bi-search"></i></div>
                            <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                                class="form-control ps-5" type="text" placeholder="Ara">
                        </form>
                    </div>

                    <div class="col-12 col-lg-1 ms-auto text-end mobile-erp3">


                        <a type="button" href="{{ route('satislar.create') }}"
                            class="btn btn-outline-dark btn-sm w-100"><i class="fa-solid fa-plus"></i>Yeni Ekle</a>

                    </div>
            </div>
        </div>
            <!-- Modal -->


            <div class="card-body" style="border-radius: 5px">
                <div class="table-responsive" style="border-radius: 5px">

                    <table class="table table-bordered table-striped" id="example2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Teklif Kodu</th>
                                <th>Satış Kodu</th>
                                <th>Firma Ünvanı</th>
                                <th>Satış Konu</th>
                                <th>Satış Tarihi</th>
                                <th>Toplam İskonto</th>
                                <th>KDV Tutar</th>
                                <th>Ara Toplam</th>
                                <th>Ödenecek Tutar</th>
                                <th>Aksiyon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($satislar as $satislaritem)
                                <tr>
                                    <th scope="row">{{ $startNumber - $loop->index }}</th>
                                    @if (!empty($satislaritem->teklif_id))
                                        <th scope="row"> <a href="{{route('teklifler.show', $satislaritem->teklif_id)}}"
                                                target="_blank">{{ $satislaritem->teklifler->teklif_kodu_text . '-' . $satislaritem->teklifler->teklif_kodu }}
                                            </a> </th>
                                    @else
                                        <th><b style="color: red">Direkt Satış</b></th>
                                    @endif
                                    <th scope="row">{{ $satislaritem->satis_kodu_text }}-{{ $satislaritem->satis_kodu }}</th>
                                    <td>{{ $satislaritem->firmaadi->firma_unvan }}</td>
                                    <td>{{ $satislaritem->satis_konu }}</td>

                                    <td>{{ $satislaritem->satis_tarihi }}</td>
                                    <td>{{ number_format($satislaritem->satis_iskonto_toplam, 2, ',', '.') }} ₺</td>
                                    <td>{{ number_format($satislaritem->satis_kdv_toplam, 2, ',', '.') }} ₺</td>
                                    <td>{{ number_format($satislaritem->satis_ara_toplam, 2, ',', '.') }} ₺</td>
                                    <td>{{ number_format($satislaritem->satis_kdvli_toplam, 2, ',', '.') }} ₺</td>


                                    <td class="text-right">
                                        <div class="databutton">
                                            <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                                                <a href="{{ route('satislar.show', ['satislar' => $satislaritem->id]) }}"
                                                    class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                                    <i style="color:#293445;  "
                                                    class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                                </a>
                                                <a href="{{ route('satislar.edit', ['satislar' => $satislaritem->id]) }}"
                                                    class="text-warning btn btn-link p-0 m-0 ">
                                                    <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                                </a>
                                                <form
                                                    action="{{ route('satislar.destroy', ['satislar' => $satislaritem->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 show_confirm">
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
                    <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
                        {{ $satislar->appends(['entries' => $perPage])->links() }}
                    </div>
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
                            url: '{{ route('satislarsearch') }}',
                            method: 'GET',
                            data: {
                                satislarsearch: ''
                            }, // Arama değeri boş olduğunda tüm veriyi yükle
                            success: function (response) {
                                // Tüm veriyi (tbody) güncelle
                                $('#example2 tbody').html(response);
                            }
                        });
                    } else {
                        $.ajax({
                            url: '{{ route('satislarsearch') }}',
                            method: 'GET',
                            data: {
                                satislarsearch: searchValue
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
