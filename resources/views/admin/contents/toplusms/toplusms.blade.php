@extends('admin.layouts.app')
@section('title')
Toplu SMS
@endsection
@section('contents')
@section('topheader')
Toplu SMS
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#toplusmsmodal"><i class="fa-solid fa-plus"></i>Toplu SMS Oluştur</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="toplusmsmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('toplusms.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Toplu SMS Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;" >
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="mesaj">Mesaj</label>
                                        <textarea name="mesaj" id="mesaj" cols="20" rows="2" class="form-control form-control-sm "></textarea>
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
                        <th>Tarih</th>
                        <th>Mesaj</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($toplusms as $sn => $toplusmsitem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                           <td>{{$toplusmsitem->islem_tarihi}}</td>
                           <td>{{$toplusmsitem->mesaj}}</td>
                            {{-- <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6">
                                        <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#toplusmsupdateModal-{{ $toplusmsitem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                        @include('admin.contents.toplusmsler.toplusms-update')

                                        <form
                                            action="{{ route('toplusms.destroy', ['toplusms' => $toplusmsitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 m-0 show_confirm">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('session.session')
@endsection
