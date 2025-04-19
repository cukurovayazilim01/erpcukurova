@extends('admin.layouts.app')
@section('title')
    TEKLİFLER
@endsection
@section('contents')
@section('topheader')
    TEKLİFLER
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row g-2">
            <div class="col-12 col-lg-5">
                <div class="d-flex flex-wrap gap-2 justify-content-start">
                    <!-- Sayfa boyutu seçici -->
                    <form method="GET" action="{{ route('teklifler.index') }}" id="entriesForm">
                        <select class="form-select form-select-sm" name="entries"
                            onchange="document.getElementById('entriesForm').submit();">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>

                    <!-- Teklif durum butonları -->
                    <a href="{{ route('teklifler.index') }}"
                        class="btn btn-sm flex-fill flex-md-grow-0 px-2 {{ request()->routeIs('teklifler.index') ? 'btn-dark' : 'btn-outline-dark' }}">
                        Tümü
                    </a>

                    <a href="{{ route('bekleyenteklifler') }}"
                        class="btn btn-sm flex-fill flex-md-grow-0 px-2 {{ request()->routeIs('bekleyenteklifler') ? 'btn-warning' : 'btn-outline-warning' }}">
                        Bekleyen
                    </a>

                    <a href="{{ route('onaylananteklifler') }}"
                        class="btn btn-sm flex-fill flex-md-grow-0 px-2 {{ request()->routeIs('onaylananteklifler') ? 'btn-success' : 'btn-outline-success' }}">
                        Onaylanan
                    </a>

                    <a href="{{ route('onaylanmayanteklifler') }}"
                        class="btn btn-sm flex-fill flex-md-grow-0 px-2 {{ request()->routeIs('onaylanmayanteklifler') ? 'btn-danger' : 'btn-outline-danger' }}">
                        Red Edilen
                    </a>
                </div>
            </div>

            <!-- Arama Kutusu -->
            <div class="col-lg-5 d-flex align-items-center mobile-erp2 justify-content-start">
                <form class="position-relative" id="searchForm" action="{{ route('tekliflersearch') }}"
                    method="GET">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3 "><i
                            class="bi bi-search"></i></div>
                    <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                        class="form-control ps-5" type="text" placeholder="Ara">
                </form>
            </div>

            <!-- Teklif Ekle Butonu -->
            <div class=" col-lg-1 col-md-2 ms-auto text-end mobile-erp3">
                <a href="{{ route('teklifler.create') }}" class="btn btn-outline-dark btn-sm w-100">
                    <i class="fa-solid fa-plus"></i> Teklif Ekle
                </a>
            </div>

        </div>
    </div>

    <!-- Modal -->


    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table id="example2" class="table table-bordered table-hover" style="width:100%;  ">
                <thead>
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
                            @if ($teklifleritem->teklif_kodu_text!= 'ÇT')
                            <th scope="row">
                                {{ $teklifleritem->teklif_kodu_text }}</th>
                            @else
                            <th scope="row">
                                {{ $teklifleritem->teklif_kodu_text }}-{{ $teklifleritem->teklif_kodu }}</th>
                            @endif

                            <td>{{ $teklifleritem->islem_tarihi }}</td>
                            <td>{{ $teklifleritem->firmaadi->firma_unvan }}</td>
                            <td>{{ $teklifleritem->teklif_konu }}</td>
                            <td>{{ number_format($teklifleritem->teklif_iskonto_toplam, 2, ',', '.') }} ₺</td>
                            <td>{{ number_format($teklifleritem->teklif_kdv_toplam, 2, ',', '.') }} ₺</td>
                            <td>{{ number_format($teklifleritem->teklif_ara_toplam, 2, ',', '.') }} ₺</td>
                            <td>{{ number_format($teklifleritem->teklif_kdvli_toplam, 2, ',', '.') }} ₺</td>


                            <td class="text-right" >
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6"  style="justify-content: space-evenly; ">
                                        @if (!Request::is('teklifler') && !Request::is('onaylananteklifler') && !Request::is('onaylanmayanteklifler'))
                                            <button class="btn btn-sm btn-outline-success open-modal-btn"
                                                style="margin-right: 3px" data-bs-toggle="modal"
                                                data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">Teklif
                                                İşlemleri</button>
                                            @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')
                                        @endif
                                        @if (($teklifleritem->satis_durum == '0' && Request::is('onaylananteklifler')) || Request::is('onaylanmayanteklifler'))
                                            <button class="btn btn-sm btn-outline-danger open-modal-btn"
                                                style="margin-right: 3px" data-bs-toggle="modal"
                                                data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">İptal
                                                Et</button>
                                            @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')
                                        @endif
                                        @if (Request::is('onaylananteklifler') && $teklifleritem->satis_durum == '0')
                                            <a href="{{ route('satisafisineaktar', ['id' => $teklifleritem->id]) }}"
                                                class="btn btn-sm btn-outline-success open-modal-btn"
                                                style="margin-right: 3px">Satışa Aktar</a>
                                        @elseif (Request::is('onaylananteklifler') && $teklifleritem->satis_durum == '1')
                                            <a href="#" class="btn btn-sm btn-success open-modal-btn"
                                                style="margin-right: 3px">Satışa Aktarıldı</a>
                                        @endif

                                        <a href="{{ route('teklifler.show', ['teklifler' => $teklifleritem->id]) }}"
                                            class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                            <i style="color:#293445;  "
                                            class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                        </a>
                                        <a href="{{ route('teklifler.edit', ['teklifler' => $teklifleritem->id]) }}"
                                            class="text-warning btn btn-link p-0 m-0 ">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </a>
                                        <form
                                            action="{{ route('teklifler.destroy', ['teklifler' => $teklifleritem->id]) }}"
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
