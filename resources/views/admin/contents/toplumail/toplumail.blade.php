@extends('admin.layouts.app')
@section('title')
Toplu MAİL
@endsection
@section('contents')
@section('topheader')
Toplu MAİL
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#toplumailmodal"><i class="fa-solid fa-plus"></i>Toplu MAİL Oluştur</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="toplumailmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('toplumail.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Toplu MAİL Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 2%;" >
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="konu">Konu</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="konu" id="konu"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="mesaj">Mesaj</label>
                                        <textarea name="mesaj" id="mesaj" cols="20" rows="2" class="form-control form-control-sm ckeditor"></textarea>
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
                        <th>Konu</th>
                        <th>Mesaj</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($toplumail as $sn => $toplumailitem)
                        <tr>
                            <th scope="row">{{ $sn + 1 }}</th>
                           <td>{{$toplumailitem->islem_tarihi}}</td>
                           <td>{{$toplumailitem->konu}}</td>
                           <td>{{$toplumailitem->mesaj}}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('session.session')
@endsection
