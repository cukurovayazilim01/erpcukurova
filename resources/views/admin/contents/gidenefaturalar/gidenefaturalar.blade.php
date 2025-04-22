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
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">

                <div class=" col-md-4 mr-4 mobile-erp1 d-flex gap-2">
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

                    <div class="col-lg-4 d-flex align-items-center mobile-erp2 justify-content-center">
                        <form class="position-relative" id="searchForm" action="{{ route('carilersearch') }}"
                            method="GET">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                                    class="bi bi-search"></i></div>
                            <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                                class="form-control ps-5" type="text" placeholder="Ara">
                        </form>
                    </div>



                    <div class="col-12 col-lg-1 ms-auto text-end mobile-erp3">
                        <a href="{{ route('gidenefaturalar.create') }}" class="btn btn-outline-dark btn-sm w-100">
                            <i class="fa-solid fa-plus"></i> Fatura Oluştur
                        </a>
                    </div>


                </div>
            </div>
        </div>


    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
                <table class="table table-bordered table-striped" style="width:100%;" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead>
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
                                            <i style="font-size: 18px" class="fa fa-file-pdf"></i>
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

