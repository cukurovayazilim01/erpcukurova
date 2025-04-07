@extends('admin.layouts.app')
@section('title')
    GÖREV ATAMA
@endsection
@section('contents')
@section('topheader')
    GÖREV ATAMA
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#gorevatamamodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table class="table table-bordered table-hover" style="width:100%;  ">
                <thead >
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
                            <td scope="row">{{ $sn + 1 }}</td>
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
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                        @if (Auth::check())
                                        @if (Auth::user()->id == $gorevleritem->islem_yapan)
                                            <!-- Görevi oluşturan kişi ise -->
                                            <button  data-bs-toggle="modal"
                                                data-bs-target="#gorevlerupdateModal-{{ $gorevleritem->id }}">
                                                <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                            </button>
                                            @include('admin.contents.gorevler.gorevler-update')
                                        @else
                                            <!-- Başka bir kullanıcı ise -->
                                            <button  data-bs-toggle="modal"
                                                data-bs-target="#gorevlerdurumupdateModal-{{ $gorevleritem->id }}">
                                                <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                            </button>
                                            @include('admin.contents.gorevler.gorevdurum-update')
                                        @endif
                                    @endif


                                        <form
                                            action="{{ route('gorevatama.destroy', ['gorevatama' => $gorevleritem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0 m-0 show_confirm">
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
      <!-- Modal -->
    <div class="modal fade" id="gorevatamamodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('gorevatama.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header ">
                        <h5 class="modal-title">Görev Atama Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                    style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                    <div class="row ">
                                <div class="col-md-4">
                                    <label for="gorev_adi">Görev Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gorev_adi" id="gorev_adi"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="gorevlendirilen_id">Görevlendiren</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
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
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <select name="gorevlendirilen_id" id="gorevlendirilen_id"
                                            class="form-control form-control-sm">
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
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                    <textarea name="gorev_tanimi" id="gorev_tanimi" cols="20" rows="1" class="form-control form-control-sm "></textarea>
                                </div>
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
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="gorev_baslama_tarihi" id="gorev_baslama_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorev_bitis_tarihi">Görev Bitiş Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="gorev_bitis_tarihi" id="gorev_bitis_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorev_derecesi">Görev Derecesi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="gorev_derecesi" id="gorev_derecesi"
                                            class="form-control form-control-sm" required>
                                            <option value="Yüksek">Yüksek</option>
                                            <option value="Orta">Orta</option>
                                            <option value="Düşük">Düşük</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="gorev_durumu">Görev Durumu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="gorev_durumu" id="gorev_durumu"
                                            class="form-control form-control-sm" required>
                                            <option value="Beklemede">Beklemede</option>
                                            <option value="Yapılmadı">Yapılmadı</option>
                                            <option value="Yapıldı">Yapıldı</option>
                                        </select>
                                    </div>
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
