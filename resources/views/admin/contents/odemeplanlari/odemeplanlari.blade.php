@extends('admin.layouts.app')
@section('title')
Ödeme Planları
@endsection
@section('contents')
@section('topheader')
Ödeme Planları
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">

                <div class=" col-md-4 mr-4 mobile-erp1 d-flex gap-2">

                        <form method="GET" action="{{ route('odemeplanlari.index') }}" id="entriesForm">
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
                        <form class="position-relative" id="searchForm" action="{{ route('odemeplanlarisearch') }}"
                            method="GET">
                            <div class="position-absolute top-50 translate-middle-y search-input-group-text px-3 "><i
                                    class="bi bi-search"></i></div>
                            <input style="height: 27px;  border-radius: 5px; border-color:#293445 " id="searchInput"
                                class="form-control ps-5" type="text" placeholder="Ara">
                        </form>
                    </div>
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                        <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                            data-bs-target="#odemeplanlarieklemodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>

                    </div>

                </div>
            </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="odemeplanlarieklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('odemeplanlari.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Ödeme Planı Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                        style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                        <div class="row ">

                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id" >Firma Ünvanı</label>

                                      <select name="cari_id" id="cari_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                      </select>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="tarih">Tarih</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="tarih" id="tarih"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                  <div class="col-md-6">
                                    <label for="vade_tarih">Vade Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="vade_tarih" id="vade_tarih" min="2025-01-01" onfocus="this.min=getTomorrowDate()"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="odeme_tutar">Ödeme Tutar</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="odeme_tutar" id="odeme_tutar"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="durum">Durum</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="durum" id="durum"
                                            class="form-control form-control-sm" required>
                                            <option value="">Lütfen Seçim Yapınız...</option>
                                            <option value="Yapıldı">Ödeme Yapıldı</option>
                                            <option value="Yapılmadı">Ödeme Yapılmadı</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="aciklama">Açıklama</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                        <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                                </div>
                            </div>

                        </div>
                        <div
                            style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                            <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">

                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Tarih</th>
                            <th>Firma Adı</th>
                            <th>Vade Tarihi</th>
                            <th>Ödeme Tutar</th>
                            <th>Durum</th>
                            <th>Açıklama</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($odemeplanlari as $sn => $odemeplanlariitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $odemeplanlariitem->tarih }}</td>

                                <td>{{ $odemeplanlariitem->firmaadi->firma_unvan }}</td>
                                <td>{{ $odemeplanlariitem->vade_tarih }}</td>
                                <td>{{ number_format($odemeplanlariitem->odeme_tutar , 2, ',', '.')}} ₺</td>

                                <td>
                                    @if ($odemeplanlariitem->durum == 'Yapıldı')
                                    <span class="badge bg-success">Ödeme Yapıldı</span>

                                    @else
                                    <span class="badge bg-danger">Ödeme Yapılmadı</span>

                                    @endif
                                </td>

                                <td>{{ $odemeplanlariitem->aciklama }}</td>

                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                            <button data-bs-toggle="modal"
                                            data-bs-target="#odemeplanlariupdateModal-{{ $odemeplanlariitem->id }}"> <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>



                                        @include('admin.contents.odemeplanlari.odemeplanlari-update')

                                            <form action="{{ route('odemeplanlari.destroy', ['odemeplanlari' => $odemeplanlariitem->id]) }}"
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

        <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
            {{ $odemeplanlari->appends(['entries' => $perPage])->links() }}
        </div>
    </div>
</div>
@include('session.session')

<script>
    function getTomorrowDate() {
      const today = new Date(); // Bugünün tarihini al
      const tomorrow = new Date(today); // Bugünün tarihini kopyala
      tomorrow.setDate(today.getDate() + 1); // Bir gün ekle (yarın)
      return tomorrow.toISOString().split('T')[0]; // YYYY-MM-DD formatında döndür
    }
  </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function(event) {
            var searchValue = $(this).val();

            if (searchValue.trim() === '') {
                // Eğer input boşsa, tüm veriyi yükle
                $.ajax({
                    url: '{{ route('odemeplanlarisearch') }}',
                    method: 'GET',
                    data: {
                        odemeplanlarisearch: ''
                    }, // Arama değeri boş olduğunda tüm veriyi yükle
                    success: function(response) {
                        // Tüm veriyi (tbody) güncelle
                        $('#example2 tbody').html(response);
                    }
                });
            } else {
                $.ajax({
                    url: '{{ route('odemeplanlarisearch') }}',
                    method: 'GET',
                    data: {
                        odemeplanlarisearch: searchValue
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
<script>
    $(document).ready(function() {
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
          data: function(params) {
            return { q: params.term };
          },
          processResults: function(data) {
            return {
              results: data.map(function(item) {
                return { id: item.id, text: item.firma_unvan };
              })
            };
          },
          cache: true
        },
        dropdownParent: $('#odemeplanlarieklemodal'), // Modal ID'sini burada belirtin
        language: {
          inputTooShort: function() { return "Lütfen en az 3 karakter girin."; },
          noResults: function() { return "Sonuç bulunamadı."; }
        }
      });
        // Select2 açıldığında arama inputuna otomatik odaklanma
        $('#cari_id').on('select2:open', function() {
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
