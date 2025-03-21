@extends('admin.layouts.app')
@section('title')
    GİDERLER
@endsection
@section('contents')
@section('topheader')
GİDERLER
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#gidermodal"><i class="fa-solid fa-plus"></i>Gider Ekle</button>
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
    <div class="modal fade" id="gidermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('gider.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Gider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="giderkategori_id">Gider Kategori Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="giderkategori_id" id="giderkategori_id" class="form-select form-select-sm">
                                            <option value="">Lütfen Seçim Yapınız..</option>
                                            @foreach ($giderkategori as $item)
                                            <option value="{{$item->id}}">{{$item->gider_kategori_adi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gider_kodu">Gider Kodu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gider_kodu" id="gider_kodu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gider_adi">Gider Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gider_adi" id="gider_adi"
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
                        <th>Gider Kategori Adı</th>
                        <th>Gider Kodu</th>
                        <th>Gider Adı</th>
                        <th>Durum</th>
                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gider as $sn => $gideritem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                            <td>{{ $gideritem->giderkategori->gider_kategori_adi }}</td>
                            <td>{{ $gideritem->gider_kodu }}</td>
                            <td>{{ $gideritem->gider_adi }}</td>
                            <td>@if ($gideritem->durum === 'Aktif')
                                <span class="badge bg-success">{{ $gideritem->durum }}</span>
                                @elseif($gideritem->durum === 'Pasif')
                                <span class="badge bg-danger">{{ $gideritem->durum }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">
                                        <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#giderupdateModal-{{ $gideritem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                        @include('admin.contents.giderler.gider-update')

                                        <form
                                            action="{{ route('gider.destroy', ['gider' => $gideritem->id]) }}"
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
