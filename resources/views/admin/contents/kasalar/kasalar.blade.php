@extends('admin.layouts.app')
@section('title')
    Kasalar
@endsection
@section('contents')
@section('topheader')
    Kasalar
@endsection
<div class="card">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-between gap-3">

                    <div class="ms-auto">
                        <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal" data-bs-target="#kasaeklemodal">
                            <i class="fa-solid fa-plus"></i> Yeni Ekle
                        </button>
                    </div>

                    <div class="dropdown">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="kasaeklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add-form" action="{{ route('kasalar.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Kasa Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row" >
                                <div class="col-md-6">
                                    <label for="kasa_adi">Kasa Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="kasa_adi" id="kasa_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="acilis_bakiye">Açılış Bakiye</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </span>
                                        <input type="text" name="acilis_bakiye" id="acilis_bakiye"
                                            class="form-control form-control-sm input-mask" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="doviz">Para Birimi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="doviz" id="doviz"
                                            class="form-select form-select-sm" required>
                                            <option value="TL">TL</option>
                                            <option value="DOLAR">DOLAR</option>
                                            <option value="EURO">EURO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="acilis_bakiye_tarih">Kasa Açılış Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                        <input type="date" name="acilis_bakiye_tarih" id="acilis_bakiye_tarih"
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
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit"  id="submit-form" class="btn btn-outline-primary btn-sm ">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table align-middle mb-0 dataTable" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead class="table-light">
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
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#kasalarupdateModal-{{ $kasalaritem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                        @include('admin.contents.kasalar.kasalar-update')
                                            <form action="{{ route('kasalar.destroy', ['kasalar' => $kasalaritem->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger p-0 m-0 show_confirm">
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

        <div class="col-sm-4 col-md-5 " style=" float: right; margin-top: 20px; ">
            {{-- {{ $aramalar->appends(['entries' => $perPage])->links() }} --}}
        </div>
    </div>
</div>
@include('session.session')
@endsection
