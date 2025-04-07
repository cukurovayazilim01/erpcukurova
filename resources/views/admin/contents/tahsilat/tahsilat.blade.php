@extends('admin.layouts.app')
@section('title')
    Tahsilat
@endsection
@section('contents')
@section('topheader')
Tahsilat
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">

            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class=" col-md-4 mr-4 mobile-erp1 d-flex gap-2">
                    <form action="{{ route('firmahrktaktartahsilat') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success ">Firma Hareketlerine Aktar</button>
                    </form>
                </div>

                <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                    <form class="position-relative" id="searchForm" action="{{route('tahsilatsearch')}}" method="GET">
                        <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                            class="bi bi-search"></i></div>
                    <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                        class="form-control ps-5" type="text" placeholder="Ara">
                    </form>
                </div>

                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <a type="button" href="{{ route('tahsilat.create') }}"
                    class="btn btn-outline-dark btn-sm "><i class="fa-solid fa-plus"></i>Yeni Ekle</a>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->


    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table class="table table-bordered table-hover" style="width:100%;" id="example2">
                <thead >
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
                        <td scope="row">{{ $startNumber - $loop->index }}</td>
                        <td>
                            {{$tahsilatitem->tahsilat_kodu_text}}-{{ $tahsilatitem->tahsilat_kodu }}
                        </td>
                        <td>{{ $tahsilatitem->tarih }}</td>

                        <td>{{ $tahsilatitem->firmaadi->firma_unvan }}</td>
                        <td>{{ $tahsilatitem->odeme_turu }}</td>
                        <td>{{ number_format($tahsilatitem->tahsilat_tutar, 2, ',', '.') }} <b style="color: red">₺</b></td>


                        <td class="text-right">
                            <div class="databutton">
                                <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                                    <a href="{{ route('tahsilat.show', ['tahsilat' => $tahsilatitem->id]) }}"
                                        class=" btn btn-link p-0 m-0 " target="_blank">
                                        <i style="color:#293445;  "
                                        class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                    </a>

                                    <form
                                        action="{{ route('tahsilat.destroy', ['tahsilat' => $tahsilatitem->id]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn  p-0 m-0 show_confirm">
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
