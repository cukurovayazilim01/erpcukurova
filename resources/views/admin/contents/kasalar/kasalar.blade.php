@extends('admin.layouts.app')
@section('title')
    Kasalar
@endsection
@section('contents')
@section('topheader')
    Kasalar
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#kasaeklemodal"> <i class="fa-solid fa-plus"></i> Kasa Ekle</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="kasaeklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('kasalar.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Kasa Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                    style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                    <div class="row ">
                                <div class="col-md-6">
                                    <label for="kasa_adi">Kasa Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="kasa_adi" id="kasa_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="acilis_bakiye">Açılış Bakiye</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </span>
                                        <input type="text" name="acilis_bakiye" id="acilis_bakiye"
                                            class="form-control form-control-sm input-mask" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="doviz">Para Birimi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="doviz" id="doviz"
                                            class="form-control form-control-sm" required>
                                            <option value="TL">TL</option>
                                            <option value="DOLAR">DOLAR</option>
                                            <option value="EURO">EURO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="acilis_bakiye_tarih">Kasa Açılış Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="acilis_bakiye_tarih" id="acilis_bakiye_tarih"
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
                            <th>Kasa Adı</th>
                            <th>Açılış Tarihi</th>
                            <th>Açılış Bakiye</th>
                            <th>Bakiye</th>
                            <th>Durum</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kasalar as $sn => $kasalaritem)
                            <tr>
                                <th scope="row">{{ $sn + 1 }}</th>
                                <td>{{ $kasalaritem->kasa_adi }}</td>
                                <td>{{ $kasalaritem->acilis_bakiye_tarih }}</td>
                                <td>@if ($kasalaritem->doviz === 'TL')
                                    {{ number_format($kasalaritem->acilis_bakiye, 2, ',', '.') }} <b style="color: red">₺</b>
                                    @elseif($kasalaritem->doviz === 'DOLAR')
                                    {{ number_format($kasalaritem->acilis_bakiye, 2, ',', '.') }} <b style="color: blue">$</b>
                                    @elseif($kasalaritem->doviz === 'EURO')
                                    {{ number_format($kasalaritem->acilis_bakiye, 2, ',', '.') }} <b style="color: rgb(43, 255, 0)">€</b>
                                    @endif
                                </td>
                                <td>@if ($kasalaritem->doviz === 'TL')
                                    {{ number_format($kasalaritem->bakiye, 2, ',', '.') }} <b style="color: red">₺</b>
                                    @elseif($kasalaritem->doviz === 'DOLAR')
                                    {{ number_format($kasalaritem->bakiye, 2, ',', '.') }} <b style="color: blue">$</b>
                                    @elseif($kasalaritem->doviz === 'EURO')
                                    {{ number_format($kasalaritem->bakiye, 2, ',', '.') }} <b style="color: rgb(43, 255, 0)">€</b>
                                    @endif
                                </td>

                                <td>@if ($kasalaritem->durum === 'Aktif')
                                    <span class="badge bg-success">{{ $kasalaritem->durum }}</span>
                                    @elseif($kasalaritem->durum === 'Pasif')
                                    <span class="badge bg-danger">{{ $kasalaritem->durum }}</span>
                                    @endif</td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                            <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#kasalarupdateModal-{{ $kasalaritem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                        @include('admin.contents.kasalar.kasalar-update')
                                            <form action="{{ route('kasalar.destroy', ['kasalar' => $kasalaritem->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn p-0 m-0 show_confirm">
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

        <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
            {{-- {{ $aramalar->appends(['entries' => $perPage])->links() }} --}}
        </div>
    </div>
</div>
@include('session.session')
@endsection
