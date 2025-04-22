@extends('admin.layouts.app')
@section('title')
    Gider Kategori
@endsection
@section('contents')
@section('topheader')
Gider Kategori
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#giderkategorimodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="giderkategorimodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form action="{{ route('giderkategori.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                    @csrf
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Gider Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body" style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <label for="gider_kategori_kodu">Gider Kategori Kodu</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-layer-group"></i>
                                            </span>
                                            <input type="text" name="gider_kategori_kodu" id="gider_kategori_kodu"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="durum">Durum</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                            <select name="durum" id="durum" class="form-control form-control-sm">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Pasif">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="gider_kategori_adi">Gider Kategori Adı</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-layer-group"></i>
                                            </span>
                                            <input type="text" name="gider_kategori_adi" id="gider_kategori_adi"
                                                class="form-control form-control-sm" required>
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

        <div class="card-body" style="border-radius: 5px">
            <div class="table-responsive" style="border-radius: 5px">
                <table class="table table-bordered table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Kategori Kodu</th>
                            <th>Kategori Adı</th>
                            <th>Durum</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($giderkategori as $sn => $giderkategoriitem)
                            <tr>
                                <td scope="row">{{ $sn + 1 }}</td>
                                <td>{{ $giderkategoriitem->gider_kategori_kodu }}</td>
                                <td>{{ $giderkategoriitem->gider_kategori_adi }}</td>
                                <td>@if ($giderkategoriitem->durum === 'Aktif')
                                    <span class="badge bg-success">{{ $giderkategoriitem->durum }}</span>
                                    @elseif($giderkategoriitem->durum === 'Pasif')
                                    <span class="badge bg-danger">{{ $giderkategoriitem->durum }}</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                            <button class="text-warning" data-bs-toggle="modal"
                                                data-bs-target="#giderkategoriupdateModal-{{ $giderkategoriitem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                            @include('admin.contents.giderler.giderkategori.giderkategori-update')

                                            <form
                                                action="{{ route('giderkategori.destroy', ['giderkategori' => $giderkategoriitem->id]) }}"
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
