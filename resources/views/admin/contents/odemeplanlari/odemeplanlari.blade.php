@extends('admin.layouts.app')
@section('title')
Ödeme Planları
@endsection
@section('contents')
@section('topheader')
Ödeme Planları
@endsection
<div class="card">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <div class="col-lg-1 col-1 col-md-1 text-start">
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
                    <div class="ms-auto">
                        <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal" data-bs-target="#odemeplanlarieklemodal">
                            <i class="fa-solid fa-plus"></i> Yeni Ekle
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="odemeplanlarieklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog ">
            <form id="add-form" action="{{ route('odemeplanlari.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Ödeme Planı Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 3%; ">
                            <div class="row">

                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id" >Firma Ünvanı</label>

                                      <select name="cari_id" id="cari_id" required style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                      </select>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="tarih">Tarih</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="tarih" id="tarih"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                  <div class="col-md-6">
                                    <label for="vade_tarih">Vade Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="vade_tarih" id="vade_tarih" min="2025-01-01" onfocus="this.min=getTomorrowDate()"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="odeme_tutar">Ödeme Tutar</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="odeme_tutar" id="odeme_tutar"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="durum">Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="durum" id="durum"
                                            class="form-select form-select-sm" required>
                                            <option value="">Lütfen Seçim Yapınız...</option>
                                            <option value="Yapıldı">Ödeme Yapıldı</option>
                                            <option value="Yapılmadı">Ödeme Yapılmadı</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label for="aciklama">Açıklama</label>
                                        <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit"  id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead class="table-light">
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
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#odemeplanlariupdateModal-{{ $odemeplanlariitem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>

                                      

                                        @include('admin.contents.odemeplanlari.odemeplanlari-update')

                                            <form action="{{ route('odemeplanlari.destroy', ['odemeplanlari' => $odemeplanlariitem->id]) }}"
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
