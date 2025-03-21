@extends('admin.layouts.app')
@section('title')
    Hizmetler Kategori
@endsection
@section('contents')
@section('topheader')
Hizmetler Kategori
@endsection
    <div class="card radius-10">
        <div class="card-header bg-transparent">
            <div class="row g-3 align-items-center">

                <div class="col">
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#hizmetlerkategorimodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>
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
        <div class="modal fade" id="hizmetlerkategorimodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('hizmetlerkategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Hizmetler Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body" style="display: flex">
                            <!-- Left Side -->
                            <div class="col-md-12" style="padding: 1%;" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="kategori_ad">Kategori Adı</label>
                                        <div class="form-group input-with-icon">
                                            <span class="icon">
                                                <i class="fa-solid fa-layer-group"></i>
                                            </span>
                                            <input type="text" name="kategori_ad" id="kategori_ad"
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
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Vazgeç</button>
                            <button type="submit" class="btn btn-outline-primary btn-sm "></i>Kaydet</button>
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
                            <th>Kategori Adı</th>
                            <th>Durum</th>
                            <th>Teklife Eklensin mi ?</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hizmetlerkategori as $sn => $hizmetlerkategoriitem)
                            <tr>
                                <th scope="row">{{ $sn + 1 }}</th>
                                <td>{{ $hizmetlerkategoriitem->kategori_ad }}</td>
                                <td>@if ($hizmetlerkategoriitem->durum === 'Aktif')
                                    <span class="badge bg-success">{{ $hizmetlerkategoriitem->durum }}</span>
                                    @elseif($hizmetlerkategoriitem->durum === 'Pasif')
                                    <span class="badge bg-danger">{{ $hizmetlerkategoriitem->durum }}</span>
                                    @endif</td>
                                <td>
                                    @if ($hizmetlerkategoriitem->teklife_ekle === 'Evet')
                                    <span class="badge bg-success">{{ $hizmetlerkategoriitem->teklife_ekle }}</span>
                                    @elseif($hizmetlerkategoriitem->teklife_ekle === 'Hayır')
                                    <span class="badge bg-danger">{{ $hizmetlerkategoriitem->teklife_ekle }}</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning" data-bs-toggle="modal"
                                                data-bs-target="#hizmetkategoriupdateModal-{{ $hizmetlerkategoriitem->id }}"><i
                                                    class="bi bi-pencil-fill"></i></button>
                                            @include('admin.contents.hizmetler.hizmetlerkategori.hizmetlerkategori-update')

                                            <form
                                                action="{{ route('hizmetlerkategori.destroy', ['hizmetlerkategori' => $hizmetlerkategoriitem->id]) }}"
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
