@extends('admin.layouts.app')
@section('title')
PERSONEL PERFORMANS DEĞERLEME
@endsection
@section('contents')
@section('topheader')
PERSONEL PERFORMANS DEĞERLEME
@endsection
<div class="card">
    {{-- <div class="card-header bg-transparent">
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
    </div> --}}
    <!-- Modal -->
    <div class="modal fade" id="kasaeklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add-form" action="{{ route('performansdegerleme.store') }}" method="POST" id="add-form">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Değerleme Kriterleri Kayıt Ekranı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex; padding: 2%;">
                        <!-- Left Side -->
                        <div class="row">
                        <div id="hizmetlerContainer">
                            <div class="hizmet-item d-flex align-items-center">
                                <div class="col-md-12">
                                    <label for="hizmet_adi">Kriter</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                        <input type="text" name="inputs[0][kriter]"
                                        id="inputs[0][kriter]"
                                        class="form-control form-control-sm kriter">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button" id="addRow"
                                        class="btn btn-sm btn-primary mt-3">Kriter Ekle</button>
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
                            <th>Personel Adı</th>
                            <th>Değerleme Formu</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personel as $sn => $personelitem)

                            <tr>
                                <th scope="row">{{ $sn + 1 }}</th>
                                <td>{{ $personelitem->ad_soyad }}</td>
                                <td> <a href="{{route('degerlemeformu',['id'=>$personelitem->id])}}"
                                    class="text-primary btn btn-link p-0 m-0 ">
                                    <i class="bi bi-eye-fill"></i>
                                </a></td>
                                <td> <a href="{{route('degerlemeformuSHOW',['id'=>$personelitem->id])}}"
                                    class="text-danger btn btn-link p-0 m-0 ">
                                    <i class="fa fa-file-pdf"></i>
                                </a></td>
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


@endsection
