@extends('admin.layouts.app')
@section('title')
GİDEN E-FATURALAR
@endsection
@section('contents')
@section('topheader')
GİDEN E-FATURALAR
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
                        <form method="GET" action="{{ route('gidenefaturalar.index') }}" id="entriesForm">
                            <select class="form-select form-select-sm" name="entries"
                                onchange="document.getElementById('entriesForm').submit();">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                    </div>

                    {{-- <div class="col-lg-4 col-4 col-md-4 mr-4">
                        <a href="{{route('cariler.index')}}" type="button" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-user"></i> Müşteriler
                        </a>
                        <a href="{{route('tedarikciler')}}" type="button" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-shipping-fast"></i> Tedarikçiler
                        </a>
                    </div> --}}


                    <div class="ms-auto">
                        <a href="{{route('gidenefaturalar.create')}}" type="button" class="btn btn-sm btn-outline-primary px-5"
                            >
                            <i class="fa-solid fa-plus"></i> Fatura Oluştur
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                <div class="row">


                    <form id="searchForm" action="{{ route('carilersearch') }}" method="GET">
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
                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th>Fatura</th>
                            <th>Alıcı</th>
                            <th>Tarih</th>
                            <th>Tutar</th>

                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($gidenefaturalar as $key => $gidenefaturalaritem)

                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td><i class="fa-solid fa-hashtag fa-sm"></i> <b>{{$gidenefaturalaritem->fatura_no}}</b><br>
                                    @if ($gidenefaturalaritem->type_code == 'ISTISNA')
                                    <span class="badge bg-warning">{{$gidenefaturalaritem->type_code}}
                                    </span> |
                                    @else
                                    <span class="badge bg-success">{{$gidenefaturalaritem->type_code}}
                                    </span> |
                                    @endif

                                     @if ($gidenefaturalaritem->profile_id == 'TICARIFATURA')
                                     <span class="badge bg-info">{{$gidenefaturalaritem->profile_id}}</span></td>
                                @else
                                <span class="badge bg-secondary">{{$gidenefaturalaritem->profile_id}}</span></td>

                                @endif
                                <td><b>{{$gidenefaturalaritem->receiver_name}}</b><br>{{$gidenefaturalaritem->receiver_vkn_tckn}}</td>
                                <td><b>Fatura: </b>{{$gidenefaturalaritem->issue_date}}<br><b>Zarf: </b> </td>
                                <td><b>Toplam: </b>{{number_format($gidenefaturalaritem->payable, 2, ',', '.')}} {{$gidenefaturalaritem->payable_currency}}<br><b>Vergi:</b>  {{ number_format($gidenefaturalaritem->tax_amount, 2, ',', '.') }} {{ $gidenefaturalaritem->tax_amount_currency }}  </td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">

                                            <a href="javascript:void(0);"
                                            class="text-danger btn btn-link p-0 m-0 openPdfModal"
                                            data-url="{{ route('invoices.pdf', $gidenefaturalaritem->uuid ?? '') }}">
                                            <i class="fa fa-file-pdf"></i>
                                         </a>
                                         @if ($gidenefaturalaritem->alis_aktarilma_durum == 'Aktarıldı')
                                         <a  class="btn btn-sm btn-primary  "
                                            style="margin-right: 3px" >Aktarıldı</a>
                                         @else
                                         <a href="{{route('gelenfaturayialisaktar',$gidenefaturalaritem->id)}}" class="btn btn-sm btn-outline-success open-modal-btn"
                                            style="margin-right: 3px" >Alışlara Aktar</a>
                                         @endif

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
<!-- PDF Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" src="" style="width: 100%; height: 500px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
                </table>
                <div class="col-sm-4 col-md-5 textw" style=" float: right; margin-top: 20px; ">
                    {{ $gidenefaturalar->appends(['entries' => $perPage])->links() }}
                </div>
            </div>

        </div>

    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".openPdfModal").forEach(button => {
            button.addEventListener("click", function () {
                let pdfUrl = this.getAttribute("data-url");
                let pdfFrame = document.getElementById("pdfFrame");
                pdfFrame.src = pdfUrl; // PDF kaynağını değiştir

                let pdfModal = new bootstrap.Modal(document.getElementById("pdfModal"));
                pdfModal.show(); // Modalı aç
            });
        });
    });
    </script>
@include('session.session')
{{-- SEARCHHHH  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function vknSorgula() {
        let vkn = document.getElementById('vergi_no').value.trim();

        if (vkn.length === 10 || vkn.length === 11) {
            fetch(`/vkn-check?vergi_no=${vkn}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Gelen JSON:", data); // Gelen JSON'u konsola yazdır

                    // JSON içindeki ilk öğeyi alıyoruz
                    if (data.length > 0) {
                        let firmaUnvan = data[0].title; // İlk öğenin "title" alanını alıyoruz

                        if (firmaUnvan) {
                            document.getElementById('firma_unvan').value = firmaUnvan; // Firma unvanını inputa yazıyoruz
                        } else {
                            alert("Firma bilgisi bulunamadı!");
                        }
                    } else {
                        alert("Geçerli firma bilgisi bulunamadı!");
                    }
                })
                .catch(error => console.error("Hata:", error));
        } else {
            alert("Lütfen geçerli bir VKN girin (10 veya 11 hane).");
        }
    }
    </script>

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
                    url: '{{ route('carilersearch') }}',
                    method: 'GET',
                    data: {
                        carilersearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('carilersearch') }}',
                    method: 'GET',
                    data: {
                        carilersearch: searchValue
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

