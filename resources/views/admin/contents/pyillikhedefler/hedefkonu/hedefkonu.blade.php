@extends('admin.layouts.app')
@section('title')
Yıllık Hedef Konu
@endsection
@section('contents')
@section('topheader')
Yıllık Hedef Konu
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

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="kasaeklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add-form" action="{{ route('yillikhedefkonuPOST') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Yıllık Hedef Konuları Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style=" padding: 1%; ">
                            <div class="row" >
                                <div class="col-md-6">
                                    <label for="hedef_konu">Hedef Konu Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-inbox"></i>
                                        </span>
                                        <input type="text" name="hedef_konu" id="hedef_konu"
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
                            <th>Hedef Konu Adı</th>
                            <th>Durum</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($yillikhedefkonu as $sn => $yillikhedefkonuitem)
                            <tr>
                                <th scope="row">{{ $sn + 1 }}</th>
                                <td>{{ $yillikhedefkonuitem->hedef_konu }}</td>


                                <td>@if ($yillikhedefkonuitem->durum === 'Aktif')
                                    <span class="badge bg-success">{{ $yillikhedefkonuitem->durum }}</span>
                                    @elseif($yillikhedefkonuitem->durum === 'Pasif')
                                    <span class="badge bg-danger">{{ $yillikhedefkonuitem->durum }}</span>
                                    @endif</td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#kasalarupdateModal-{{ $yillikhedefkonuitem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                        {{-- @include('admin.contents.kasalar.kasalar-update') --}}
                                            <form action="{{ route('kasalar.destroy', ['kasalar' => $yillikhedefkonuitem->id]) }}"
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
