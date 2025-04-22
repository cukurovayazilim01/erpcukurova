@extends('admin.layouts.app')
@section('title')
    GİDERLER
@endsection
@section('contents')
@section('topheader')
GİDERLER
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#gidermodal"> <i class="fa-solid fa-plus"></i> Gider Ekle</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="gidermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('gider.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Gider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                    style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                    <div class="row ">
                                <div class="col-md-6">
                                    <label for="giderkategori_id">Gider Kategori Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <select name="giderkategori_id" id="giderkategori_id" class="form-control form-control-sm">
                                            <option value="">Lütfen Seçim Yapınız..</option>
                                            @foreach ($giderkategori as $item)
                                            <option value="{{$item->id}}">{{$item->gider_kategori_adi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gider_kodu">Gider Kodu</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gider_kodu" id="gider_kodu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gider_adi">Gider Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="gider_adi" id="gider_adi"
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
            <table class="table table-bordered table-striped" style="width:100%;  ">
                <thead>
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
                            <td scope="row">{{ $sn + 1 }}</td>
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
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                        <button data-bs-toggle="modal"
                                            data-bs-target="#giderupdateModal-{{ $gideritem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                        @include('admin.contents.giderler.gider-update')

                                        <form
                                            action="{{ route('gider.destroy', ['gider' => $gideritem->id]) }}"
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
    </div>
</div>
@include('session.session')
@endsection
