@extends('admin.layouts.app')
@section('title')
    Hizmetler
@endsection
@section('contents')
@section('topheader')
Hizmetler
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#hizmetlermodal"><i class="fa-solid fa-plus"></i>Hizmet Ekle</button>
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
    <div class="modal fade" id="hizmetlermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('hizmetler.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Hizmetler</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="hizmetler_kategori_id">Hizmet Kategori Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="hizmetler_kategori_id" id="hizmetler_kategori_id" class="form-select form-select-sm">
                                            <option value="">Lütfen Seçim Yapınız..</option>
                                            @foreach ($hizmetlerkategori as $item)
                                            <option value="{{$item->id}}">{{$item->kategori_ad}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="hizmet_ad">Hizmet Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="hizmet_ad" id="hizmet_ad"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="hizmet_maliyet">Hizmet Maliyet</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </span>
                                        <input type="number" name="hizmet_maliyet" id="hizmet_maliyet"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="hizmet_satis_fiyati">Hizmet Fiyatı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </span>
                                        <input type="number" name="hizmet_satis_fiyati" id="hizmet_satis_fiyati"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="durum">Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="durum" id="durum" class="form-select form-select-sm">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="teklife_ekle">Tekliflere Eklesin mi ?</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="teklife_ekle" id="teklife_ekle" class="form-select form-select-sm">
                                            <option value="Evet">Evet</option>
                                            <option value="Hayır">Hayır</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="hizmet_aciklama">Hizmet Açıklaması</label>
                                        <textarea name="hizmet_aciklama" id="hizmet_aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button"  class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit" id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th>Hizmet Kategori Adı</th>
                        <th>Hizmet Adı</th>
                        <th>Maliyet</th>
                        <th>Fiyat</th>
                        <th>Durum</th>
                        <th>Teklife Eklensin mi ?</th>
                        <th>Açıklama</th>
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hizmetler as $sn => $hizmetleritem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                            <td>{{ $hizmetleritem->hizmetlerkategori->kategori_ad }}</td>
                            <td>{{ $hizmetleritem->hizmet_ad }}</td>
                            <td>{{number_format($hizmetleritem->hizmet_maliyet, 2, ',', '.')  }} ₺</td>
                            <td>{{number_format($hizmetleritem->hizmet_satis_fiyati, 2, ',', '.')  }} ₺</td>
                            <td>@if ($hizmetleritem->durum === 'Aktif')
                                <span class="badge bg-success">{{ $hizmetleritem->durum }}</span>
                                @elseif($hizmetleritem->durum === 'Pasif')
                                <span class="badge bg-danger">{{ $hizmetleritem->durum }}</span>
                                @endif</td>
                            <td>
                                @if ($hizmetleritem->teklife_ekle === 'Evet')
                                <span class="badge bg-success">{{ $hizmetleritem->teklife_ekle }}</span>
                                @elseif($hizmetleritem->teklife_ekle === 'Hayır')
                                <span class="badge bg-danger">{{ $hizmetleritem->teklife_ekle }}</span>
                                @endif
                            </td>
                            <td>{{ $hizmetleritem->hizmet_aciklama }}</td>

                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">
                                        <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#hizmetlerupdateModal-{{ $hizmetleritem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                        @include('admin.contents.hizmetler.hizmetler-update')

                                        <form
                                            action="{{ route('hizmetler.destroy', ['hizmetler' => $hizmetleritem->id]) }}"
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
</div>
@include('session.session')
@endsection
