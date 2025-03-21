@extends('admin.layouts.app')
@section('title')
    GÖREV ATAMA
@endsection
@section('contents')
@section('topheader')
    GÖREV ATAMA
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#gorevatamamodal"><i class="fa-solid fa-plus"></i>Görev Ekle</button>
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

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Görevlendiren</th>
                        <th>Başlama Tarihi</th>
                        <th>Bitiş Tarihi</th>
                        <th>Görev Adı</th>
                        <th>Görev Tanımı</th>
                        <th>Derecesi</th>
                        <th>Firma Ünvanı</th>
                        <th>Görevlendirilen</th>
                        <th>Görev Tamamlanma Tarihi</th>
                        <th>Görev Sonucu Notu</th>
                        <th>Durum</th>
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gorevler as $sn => $gorevleritem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                            <td>{{ $gorevleritem->user->ad_soyad }}</td>
                            <td>{{ $gorevleritem->gorev_baslama_tarihi }}</td>
                            <td>{{ $gorevleritem->gorev_bitis_tarihi }}</td>
                            <td>{{ $gorevleritem->gorev_adi }}</td>
                            <td>{{ $gorevleritem->gorev_tanimi }}</td>
                            <td>{{ $gorevleritem->gorev_derecesi }}</td>
                            <td>{{ $gorevleritem->firmaadi->firma_unvan }}</td>
                            <td>{{ $gorevleritem->gorevlendirilen->ad_soyad }}</td>
                            <td>{{$gorevleritem->gorev_bitirme_tarihi ?? '-'}}</td>
                            <td>{{$gorevleritem->aciklama ?? '-'}}</td>
                            <td>@if ($gorevleritem->gorev_durumu === 'Yapıldı')
                                <span class="badge bg-success">{{ $gorevleritem->gorev_durumu }}</span>
                                @elseif($gorevleritem->gorev_durumu === 'Yapılmadı')
                                <span class="badge bg-danger">{{ $gorevleritem->gorev_durumu }}</span>
                                @elseif($gorevleritem->gorev_durumu === 'Beklemede')
                                <span class="badge bg-warning">{{ $gorevleritem->gorev_durumu }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">
                                        @if (Auth::check())
                                        @if (Auth::user()->id == $gorevleritem->islem_yapan)
                                            <!-- Görevi oluşturan kişi ise -->
                                            <button class="text-warning" data-bs-toggle="modal"
                                                data-bs-target="#gorevlerupdateModal-{{ $gorevleritem->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            @include('admin.contents.gorevler.gorevler-update')
                                        @else
                                            <!-- Başka bir kullanıcı ise -->
                                            <button class="text-warning" data-bs-toggle="modal"
                                                data-bs-target="#gorevlerdurumupdateModal-{{ $gorevleritem->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            @include('admin.contents.gorevler.gorevdurum-update')
                                        @endif
                                    @endif


                                        <form
                                            action="{{ route('gorevatama.destroy', ['gorevatama' => $gorevleritem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 m-0 show_confirm">
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
      <!-- Modal -->
    <div class="modal fade" id="gorevatamamodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('gorevatama.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Görev Atama Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="gorev_adi">Görev Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gorev_adi" id="gorev_adi"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="gorevlendirilen_id">Görevlendiren</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        @if (Auth::check())
                                            <input type="text" name="" id=""
                                                class="form-control form-control-sm"
                                                value="{{ Auth::user()->ad_soyad }}" readonly>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="gorevlendirilen_id">Görevlendirilen Personel</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="gorevlendirilen_id" id="gorevlendirilen_id"
                                            class="form-select form-select-sm">
                                            <option value="">Lütfen Seçim Yapınız..</option>
                                            @foreach ($user as $useritem)
                                                <option value="{{ $useritem->id }}">{{ $useritem->ad_soyad }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="gorev_tanimi">Görev Tanımı</label>
                                    <textarea name="gorev_tanimi" id="gorev_tanimi" cols="20" rows="1" class="form-control form-control-sm "></textarea>
                                </div>

                                <div class="col-md-12 select2-sm">
                                    <label for="cari_id">Firma Ünvanı</label>

                                    <select name="cari_id" id="cari_id" required
                                        style="border: none; width: 100%; height: 10px; outline: none; appearance: none; background-color: transparent; padding: 2px 0;">
                                        <!-- Dinamik veriler buraya yüklenecek -->
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorev_baslama_tarihi">Görev Başlama Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="gorev_baslama_tarihi" id="gorev_baslama_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorev_bitis_tarihi">Görev Bitiş Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="gorev_bitis_tarihi" id="gorev_bitis_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorev_derecesi">Görev Derecesi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="gorev_derecesi" id="gorev_derecesi"
                                            class="form-select form-select-sm" required>
                                            <option value="Yüksek">Yüksek</option>
                                            <option value="Orta">Orta</option>
                                            <option value="Düşük">Düşük</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorev_durumu">Görev Durumu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="gorev_durumu" id="gorev_durumu"
                                            class="form-select form-select-sm" required>
                                            <option value="Beklemede">Beklemede</option>
                                            <option value="Yapılmadı">Yapılmadı</option>
                                            <option value="Yapıldı">Yapıldı</option>
                                        </select>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit" id="submit-form"
                            class="btn btn-outline-primary btn-sm ">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $('#cari_id').select2({
            theme: 'bootstrap4',
            placeholder: "Firma Seçiniz",
            allowClear: true,
            minimumInputLength: 3,
            width: '100%',
            ajax: {
                url: '/cari-search',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.firma_unvan
                            };
                        })
                    };
                },
                cache: true
            },
            dropdownParent: $('#gorevatamamodal'),
            language: {
                inputTooShort: function() {
                    return "Lütfen en az 3 karakter girin.";
                },
                noResults: function() {
                    return "Sonuç bulunamadı.";
                }
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
@include('session.session')
@endsection
