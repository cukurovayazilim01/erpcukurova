@extends('admin.layouts.app')
@section('title')
    SATIŞLAR
@endsection
@section('contents')
@section('topheader')
SATIŞLAR
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">

            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <form action="{{ route('firmahrktaktarsatislar') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success ">Firma Hareketlerine Aktar</button>
                    </form>
                    <a type="button" href="{{ route('satislar.create') }}"
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

                <form id="searchForm" action="{{ route('satislarsearch') }}" method="GET">
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
                        <th scope="row"> <a href="{{route('teklifler.show',$satislaritem->teklif_id)}}" target="_blank">{{ $satislaritem->teklifler->teklif_kodu_text .'-'. $satislaritem->teklifler->teklif_kodu }} </a> </th>
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
                                <div class="d-flex align-items-center fs-6">


                                    <a href="{{ route('satislar.show', ['satislar' => $satislaritem->id]) }}"
                                        class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('satislar.edit', ['satislar' => $satislaritem->id]) }}"
                                        class="text-warning btn btn-link p-0 m-0 ">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form
                                        action="{{ route('satislar.destroy', ['satislar' => $satislaritem->id]) }}"
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
                    url: '{{ route('satislarsearch') }}',
                    method: 'GET',
                    data: {
                        satislarsearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
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
                    success: function(response) {
                        // Sadece tbody kısmını güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            }
        });
    });
</script>






{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    async function handleTeklifAction(event, id, actionType) {
        event.preventDefault(); // Varsayılan form davranışını engelle

        let titleText, confirmButtonText, confirmButtonColor, actionURL;

        // İşlem tipine göre ayarlar
        if (actionType === 'onay') {
            titleText = 'Teklifi Onaylamak Üzeresiniz!';
            confirmButtonText = 'Evet, Onayla!';
            confirmButtonColor = '#28a745';
            actionURL = `/teklif/onayla/${id}`; // Laravel route
        } else if (actionType === 'red') {
            titleText = 'Teklifi Reddetmek Üzeresiniz!';
            confirmButtonText = 'Evet, Reddet!';
            confirmButtonColor = '#dc3545';
            actionURL = `/teklif/reddet/${id}`;
        } else if (actionType === 'iptal') {
            titleText = 'Teklif İptal Edilecek!';
            confirmButtonText = 'Evet, İptal Et!';
            confirmButtonColor = '#ffc107';
            actionURL = `/teklif/iptalet/${id}`; // Laravel route
        }

        // SweetAlert ile onaylama
        const result = await Swal.fire({
            icon: 'warning',
            title: titleText,
            text: 'Bu işlemi gerçekleştirmek istiyor musunuz?',
            showCancelButton: true,
            confirmButtonText: confirmButtonText,
            confirmButtonColor: confirmButtonColor,
            cancelButtonText: 'İptal',
            padding: '2em',
        });

        if (result.isConfirmed) {
            // Onaylanırsa formu gönder
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = actionURL;
            form.style.display = 'none';

            // CSRF token ekle
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;

            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script> --}}
@endsection
