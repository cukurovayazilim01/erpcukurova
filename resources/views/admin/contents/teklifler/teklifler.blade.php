@extends('admin.layouts.app')
@section('title')
    TEKLİFLER
@endsection
@section('contents')
@section('topheader')
    TEKLİFLER
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col-lg-1 col-1 col-md-1 text-start">
                <form method="GET" action="{{ route('teklifler.index') }}" id="entriesForm">
                    <select class="form-select form-select-sm" name="entries"
                        onchange="document.getElementById('entriesForm').submit();">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div>
            <div class="col-md-6" style="display: flex; ">
                <a href="{{ route('teklifler.index') }}"
                    class="btn btn-sm {{ request()->routeIs('teklifler.index') ? 'btn-primary' : 'btn-outline-primary' }}"
                    style="margin-right: 5px;">
                    <i class="fa-solid fa-plus"></i> Tüm Teklifler
                </a>

                <a href="{{ route('bekleyenteklifler') }}"
                    class="btn btn-sm {{ request()->routeIs('bekleyenteklifler') ? 'btn-warning' : 'btn-outline-warning' }}"
                    style="margin-right: 5px;">
                    <i class="fa-solid fa-plus"></i> Bekleyen Teklifler
                </a>

                <a href="{{ route('onaylananteklifler') }}"
                    class="btn btn-sm {{ request()->routeIs('onaylananteklifler') ? 'btn-success' : 'btn-outline-success' }}"
                    style="margin-right: 5px;">
                    <i class="fa-solid fa-plus"></i> Onaylanan Teklifler
                </a>

                <a href="{{ route('onaylanmayanteklifler') }}"
                    class="btn btn-sm {{ request()->routeIs('onaylanmayanteklifler') ? 'btn-danger' : 'btn-outline-danger' }}"
                    style="margin-right: 5px;">
                    <i class="fa-solid fa-plus"></i> Onaylanmayan Teklifler
                </a>
            </div>

            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <a type="button" href="{{ route('teklifler.create') }}"
                        class="btn btn-sm btn-outline-primary px-5"><i class="fa-solid fa-plus"></i>Teklif Ekle</a>
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

                <form id="searchForm" action="{{ route('tekliflersearch') }}" method="GET">
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
                        <th>Tarih</th>
                        <th>Firma Ünvanı</th>
                        <th>Teklif Konu</th>
                        <th>Toplam İskonto</th>
                        <th>KDV Tutar</th>
                        <th>Ara Toplam</th>
                        <th>Ödenecek Tutar</th>
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teklifler as $teklifleritem)
                        <tr>
                            <th scope="row">{{ $startNumber - $loop->index }}</th>
                            <th scope="row">{{ $teklifleritem->teklif_kodu_text }}-{{ $teklifleritem->teklif_kodu }}</th>
                            <td>{{ $teklifleritem->islem_tarihi }}</td>
                            <td>{{ $teklifleritem->firmaadi->firma_unvan }}</td>
                            <td>{{ $teklifleritem->teklif_konu }}</td>
                            <td>{{ number_format($teklifleritem->teklif_iskonto_toplam, 2, ',', '.') }} ₺</td>
                            <td>{{ number_format($teklifleritem->teklif_kdv_toplam, 2, ',', '.') }} ₺</td>
                            <td>{{ number_format($teklifleritem->teklif_ara_toplam, 2, ',', '.') }} ₺</td>
                            <td>{{ number_format($teklifleritem->teklif_kdvli_toplam, 2, ',', '.') }} ₺</td>


                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">
                                        @if (!Request::is('teklifler') && !Request::is('onaylananteklifler') && !Request::is('onaylanmayanteklifler'))
                                            <button class="btn btn-sm btn-outline-success open-modal-btn"
                                                style="margin-right: 3px" data-bs-toggle="modal"
                                                data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">Teklif İşlemleri</button>
                                            @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')
                                        @endif
                                        @if ( $teklifleritem->satis_durum == '0'  && Request::is('onaylananteklifler') || Request::is('onaylanmayanteklifler'))
                                            <button class="btn btn-sm btn-outline-danger open-modal-btn"
                                                style="margin-right: 3px" data-bs-toggle="modal"
                                                data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">İptal Et</button>
                                            @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')

                                        @endif
                                        @if (Request::is('onaylananteklifler') && $teklifleritem->satis_durum == '0')
                                        <a href="{{route('satisafisineaktar',['id'=>$teklifleritem->id])}}" class="btn btn-sm btn-outline-success open-modal-btn"
                                                style="margin-right: 3px" >Satışa Aktar</a>
                                        @elseif (Request::is('onaylananteklifler') && $teklifleritem->satis_durum == '1')
                                            <a href="#" class="btn btn-sm btn-success open-modal-btn"
                                                style="margin-right: 3px" >Satışa Aktarıldı</a>
                                        @endif

                                        <a href="{{ route('teklifler.show', ['teklifler' => $teklifleritem->id]) }}"
                                            class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('teklifler.edit', ['teklifler' => $teklifleritem->id]) }}"
                                            class="text-warning btn btn-link p-0 m-0 ">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form
                                            action="{{ route('teklifler.destroy', ['teklifler' => $teklifleritem->id]) }}"
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
            <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
                {{ $teklifler->appends(['entries' => $perPage])->links() }}
            </div>
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
                    url: '{{ route('tekliflersearch') }}',
                    method: 'GET',
                    data: {
                        tekliflersearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('tekliflersearch') }}',
                    method: 'GET',
                    data: {
                        tekliflersearch: searchValue
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






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
</script>
@endsection
