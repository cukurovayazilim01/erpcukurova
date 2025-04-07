@extends('admin.layouts.app')
@section('title')
    Çek/Senet
@endsection
@section('contents')
    @section('topheader')
        Çek/Senet
    @endsection
    <div class="card radius-5">
        <div class="card-header bg-transparent">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                        <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                            data-bs-target="#cekseneteklemodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="cekseneteklemodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form id="add-form" action="{{ route('ceksenet.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Çek/Senet Kayıt Ekranı</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">
                                    <div class="col-md-3">
                                        <label for="cek_tipi">Çek Tipi</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <select name="cek_tipi" id="cek_tipi" class="form-control form-control-sm"
                                                required>
                                                <option value="">Lütfen Seçim Yapınız...</option>
                                                <option value="Gelen">Gelen - Tahsilat Çeki</option>
                                                <option value="Giden">Giden - Ödeme Çeki</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 select2-sm">
                                        <label for="cari_id">Firma</label>

                                        <select name="cari_id" id="cari_id" required
                                            style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                            <!-- Dinamik veriler buraya yüklenecek -->
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cek_vade_tarihi">Vade Tarihi</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-calendar-days"></i>
                                            </span>
                                            <input type="date" name="cek_vade_tarihi" id="cek_vade_tarihi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cek_no">Çek No</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-inbox"></i>
                                            </span>
                                            <input type="text" name="cek_no" id="cek_no"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="banka_adi">Banka Adı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-inbox"></i>
                                            </span>
                                            <input type="text" name="banka_adi" id="banka_adi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="sube_adi">Şube Adı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-inbox"></i>
                                            </span>
                                            <input type="text" name="sube_adi" id="sube_adi"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tutar">Çek Tutarı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-money-bill"></i>
                                            </span>
                                            <input type="text" name="tutar" id="tutar"
                                                class="form-control form-control-sm input-mask" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="hesap_no">Hesap No</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-inbox"></i>
                                            </span>
                                            <input type="text" name="hesap_no" id="hesap_no"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="cek_resim">Çek Resim</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-inbox"></i>
                                            </span>
                                            <input type="file" name="cek_resim" id="cek_resim"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="aciklama">Çek Açıklaması</label>
                                        <textarea name="aciklama" id="aciklama" cols="20" rows="2"
                                            class="form-control form-control-sm "></textarea>
                                    </div>

                                </div>
                                <div
                                    style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                                    <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                                    <button type="submit" id="submit-form" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        <div class="card-body" style="border-radius: 5px">
            <div class="table-responsive" style="border-radius: 5px">

                    <table class="table table-bordered table-hover" style="width:100%; cursor: pointer; " id="example2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>İşlem Yapan</th>
                                <th>İşlem Tarihi</th>
                                <th>Çek No</th>
                                <th>Firma Adı</th>
                                <th>Vade Tarihi</th>
                                <th>Banka Adı</th>
                                <th>Şube Adı</th>
                                <th>Hesap/IBAN No</th>
                                <th>Tutar</th>
                                <th>Dosya</th>
                                <th>Açıklama</th>
                                <th>Durum</th>
                                <th>Aksiyon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ceksenet as $sn => $ceksenetitem)
                                                <tr>
                                                    <td scope="row">{{ $startNumber - $loop->index }}</td>
                                                    <td>{{ $ceksenetitem->user->ad_soyad }}</td>
                                                    <td>{{ $ceksenetitem->islem_tarihi }}</td>
                                                    <td>{{ $ceksenetitem->cek_no }}</td>
                                                    <td>{{ $ceksenetitem->firmaadi->firma_unvan }}</td>
                                                    <td>{{ $ceksenetitem->cek_vade_tarihi }}</td>
                                                    <td>{{ $ceksenetitem->banka_adi }}</td>
                                                    <td>{{ $ceksenetitem->sube_adi }}</td>
                                                    <td>{{ $ceksenetitem->hesap_no }}</td>
                                                    <td>
                                                        {{ number_format($ceksenetitem->tutar, 2, ',', '.') }} <b style="color: red">₺</b>
                                                    </td>
                                                    <td>
                                                        @if ($ceksenetitem->cek_resim)
                                                                                    @php
                                                                                        $fileExtension = pathinfo($ceksenetitem->cek_resim, PATHINFO_EXTENSION);
                                                                                    @endphp

                                                                                    @if (strtolower($fileExtension) === 'pdf')
                                                                                        <a href="{{ asset($ceksenetitem->cek_resim) }}" target="_blank" style="color: red">
                                                                                            <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="{{ asset($ceksenetitem->cek_resim) }}" target="_blank">
                                                                                            <i class="bi bi-image"></i> Görüntüle
                                                                                        </a>
                                                                                    @endif
                                                        @else
                                                            <span class="text-muted">Resim Yok</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $ceksenetitem->aciklama }}</td>
                                                    <td>@if ($ceksenetitem->cek_tipi === 'Gelen' && $ceksenetitem->durum === '0')
                                                        <a href="{{ route('cektahsilat', $ceksenetitem->id) }}"
                                                            class="btn btn-sm bg-danger text-white text-decoration-none">
                                                            Çek Tahsilatı
                                                        </a>
                                                    @elseif ($ceksenetitem->cek_tipi === 'Gelen' && $ceksenetitem->durum === '1')
                                                        <span class="badge bg-success">Portföyde</span>
                                                    @elseif($ceksenetitem->cek_tipi === 'Giden' && $ceksenetitem->durum === '0')
                                                        <a href="{{ route('cekodeme', $ceksenetitem->id) }}"
                                                            class="btn btn-sm bg-success text-white text-decoration-none">
                                                            Çek Ödemesi
                                                        </a>
                                                        {{-- <span class="badge bg-danger">Çek Ödemesi</span> --}}
                                                    @elseif($ceksenetitem->cek_tipi === 'Giden' && $ceksenetitem->durum === '1')
                                                        <span class="badge bg-success">Portföyde</span>
                                                    @endif
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="databutton">
                                                            <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#ceksenetupdateModal-{{ $ceksenetitem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                                                @include('admin.contents.ceksenet.ceksenet-update')
                                                                <form
                                                                    action="{{ route('ceksenet.destroy', ['ceksenet' => $ceksenetitem->id]) }}"
                                                                    method="POST" style="display: inline;">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Select2 başlatma
            $('#cari_id').select2({
                theme: 'bootstrap4',  // Bootstrap 4 uyumluluğu
                placeholder: "Firma Seçiniz",
                allowClear: true,
                minimumInputLength: 3,
                width: '100%', // Select2 genişliği
                ajax: {
                    url: '/cari-search',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function (item) {
                                return { id: item.id, text: item.firma_unvan };
                            })
                        };
                    },
                    cache: true
                },
                dropdownParent: $('#cekseneteklemodal'), // Modal ID'sini burada belirtin
                language: {
                    inputTooShort: function () { return "Lütfen en az 3 karakter girin."; },
                    noResults: function () { return "Sonuç bulunamadı."; }
                }
            });
            // Select2 açıldığında arama inputuna otomatik odaklanma
            $('#cari_id').on('select2:open', function () {
                setTimeout(() => {
                    let searchField = $('.select2-container--open .select2-search__field');
                    if (searchField.length) {
                        searchField[0].focus();
                    }
                }, 150); // 50 yerine 150 ms bekleyelim
            });
        });
    </script>
@endsection
