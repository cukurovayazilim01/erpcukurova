@extends('admin.layouts.app')
@section('title')
    Alışlar
@endsection
@section('contents')
@section('topheader')
    Alışlar
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row g-2">
            <div class="col-12 col-lg-5">
                <div class="d-flex flex-wrap gap-2 justify-content-start">
                     <!-- Sayfa boyutu seçici -->
                     <form method="GET" action="{{ route('alislar.index') }}" id="entriesForm">
                        <select class="form-select form-select-sm" name="entries"
                            onchange="document.getElementById('entriesForm').submit();">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <form action="{{ route('firmahrktaktaralislar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success ">Firma Hareketlerine Aktar</button>
                    </form>

                </div>
            </div>
             <!-- Arama Kutusu -->
             <div class="col-lg-5 d-flex align-items-center mobile-erp2 justify-content-start">
                <form class="position-relative" id="searchForm" action="{{ route('alislarsearch') }}" method="GET">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                            class="bi bi-search"></i></div>
                    <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                        class="form-control ps-5" type="text" placeholder="Ara">
                </form>
            </div>
            <div class="col-12 col-lg-1 ms-auto text-end mobile-erp3">

            <a type="button" href="{{ route('alislar.create') }}"
            class="btn btn-outline-dark btn-sm w-100"><i class="fa-solid fa-plus"></i>Yeni Ekle</a>
        </div>
    </div>
    </div>
    <!-- Modal -->


    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">

            <table class="table table-bordered table-hover" id="example2">
                <thead>
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
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                        <a href="{{ route('alislar.show', ['alislar' => $alislaritem->id]) }}"
                                            class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                            <i style="color:#293445;  "
                                                    class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                        </a>
                                        <a href="{{ route('alislar.edit', ['alislar' => $alislaritem->id]) }}"
                                            class="text-warning btn btn-link p-0 m-0 ">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </a>
                                        <form
                                            action="{{ route('alislar.destroy', ['alislar' => $alislaritem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-link text-danger p-0 m-0 show_confirm">
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
