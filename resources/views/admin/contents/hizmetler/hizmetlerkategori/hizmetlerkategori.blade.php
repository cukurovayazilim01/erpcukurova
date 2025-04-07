@extends('admin.layouts.app')
@section('title')
    Hizmetler Kategori
@endsection
@section('contents')
    @section('topheader')
        Hizmetler Kategori
    @endsection
    <div class="card radius-5">
        <div class="card-header bg-transparent">
            <div class="row ">
                <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                        <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                            data-bs-target="#hizmetlerkategorimodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="hizmetlerkategorimodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form action="{{ route('hizmetlerkategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header ">
                            <h5 class="modal-title">Hizmetler Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body"
                            style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                            <div class="row ">
                                <div class="col-md-12 col-sm-12">
                                    <label for="kategori_ad">Kategori Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="kategori_ad" id="kategori_ad"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="durum">Durum</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="durum" id="durum" class="form-select form-select-sm">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="teklife_ekle">Tekliflere Eklesin mi ?</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="teklife_ekle" id="teklife_ekle" class="form-select form-select-sm">
                                            <option value="Evet">Evet</option>
                                            <option value="Hayır">Hayır</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; padding: 10px 0; gap:20px; text-align: center; justify-content: end">

                                <button type="button" class="btn btn-outline-warning btn-sm py-6 w-25"
                                    data-bs-dismiss="modal">Vazgeç</button>
                                <button type="submit" id="submit-form"
                                    class="btn btn-outline-dark btn-sm py-6 w-75">Kaydet</button>

                            </div>
                        </div>

                    </div>
            </form>
        </div>
    </div>

        <div class="card-body" style="border-radius: 5px">
            <div class="table-responsive" style="border-radius: 5px">
                <table class="table table-bordered table-hover" style="width:100%;  ">
                    <thead>
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
                                @endif
                                </td>
                                <td>
                                    @if ($hizmetlerkategoriitem->teklife_ekle === 'Evet')
                                        <span class="badge bg-success">{{ $hizmetlerkategoriitem->teklife_ekle }}</span>
                                    @elseif($hizmetlerkategoriitem->teklife_ekle === 'Hayır')
                                        <span class="badge bg-danger">{{ $hizmetlerkategoriitem->teklife_ekle }}</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                            <button  data-bs-toggle="modal"
                                                data-bs-target="#hizmetkategoriupdateModal-{{ $hizmetlerkategoriitem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                            @include('admin.contents.hizmetler.hizmetlerkategori.hizmetlerkategori-update')

                                            <form
                                                action="{{ route('hizmetlerkategori.destroy', ['hizmetlerkategori' => $hizmetlerkategoriitem->id]) }}"
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
    </div>
    @include('session.session')
@endsection
