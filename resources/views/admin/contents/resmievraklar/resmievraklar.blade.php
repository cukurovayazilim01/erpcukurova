@extends('admin.layouts.app')
@section('title')
    Resmi Evraklar
@endsection
@section('contents')
    @section('topheader')
        Resmi Evraklar
    @endsection
    <div class="card radius-5">
        <div class="card-header bg-transparent">
            <div class="row ">
                <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                    <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                        <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                            data-bs-target="#resmievraklarmodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="resmievraklarmodal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <form action="{{ route('resmievraklarr.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                    @csrf
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header ">
                            <h5 class="modal-title">Resmi Evraklar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body"
                            style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                            <div class="row ">
                                <div class="col-md-6 col-sm-12">
                                    <label for="dokuman_adi">Evrak Adı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="dokuman_adi" id="dokuman_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="dokuman_yili">Evrak Yılı</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="dokuman_yili" id="dokuman_yili" class="form-control form-control-sm">
                                            <option value="">Lütfen Seçiniz</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="dokuman_yolu">Evrak</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="file" name="dokuman_yolu" id="dokuman_yolu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="dokuman_alim_tarihi">Evrak Alım Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="dokuman_alim_tarihi" id="dokuman_alim_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="dokuman_hatirlatma_tarihi">Evrak Hatırlatma Tarihi</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="dokuman_hatirlatma_tarihi" id="dokuman_hatirlatma_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="status">Durum</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="status" id="status" class="form-control form-control-sm">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="aciklama">Evrak Açıklama</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="fa-solid fa-comments"></i></span>
                                        <textarea name="aciklama" id="aciklama" cols="20" rows="2"
                                            class="form-control form-control-sm "></textarea>
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
            <div class="table-responsive"style="border-radius: 5px">
                <table class="table table-bordered table-striped" style="width:100%;  ">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th>Evrak Yılı</th>
                            <th>Evrak Adı</th>
                            <th>Evrak</th>
                            <th>Evrak Alım Tarihi</th>
                            <th>Evrak Hatırlatma Tarihi</th>
                            <th>Durum</th>
                            <th>Açıklama</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resmievraklar as $sn => $resmievraklaritem)
                                        <tr>
                                            <td>{{ $sn + 1 }}</td>
                                            <td>{{ $resmievraklaritem->dokuman_yili }}</td>
                                            <td>{{ $resmievraklaritem->dokuman_adi }}</td>
                                            <td>
                                                @if ($resmievraklaritem->dokuman_yolu)
                                                                        @php
                                                                            $fileExtension = pathinfo($resmievraklaritem->dokuman_yolu, PATHINFO_EXTENSION);
                                                                        @endphp

                                                                        @if (strtolower($fileExtension) === 'pdf')
                                                                            <a href="{{ asset($resmievraklaritem->dokuman_yolu) }}" target="_blank" style="color: red">
                                                                                <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ asset($resmievraklaritem->dokuman_yolu) }}" target="_blank">
                                                                                <i class="bi bi-image"></i> Görüntüle
                                                                            </a>
                                                                        @endif
                                                @else
                                                    <span class="text-muted">Evrak Yok</span>
                                                @endif
                                            </td>

                                            <td>{{ $resmievraklaritem->dokuman_alim_tarihi }}</td>
                                            <td>{{ $resmievraklaritem->dokuman_hatirlatma_tarihi }}</td>

                                            <td>
                                                @if ($resmievraklaritem->status == 'Aktif')
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Pasif</span>
                                                @endif
                                            </td>

                                            <td>{{ $resmievraklaritem->aciklama }}</td>

                                            <td class="text-right">
                                                <div class="databutton">
                                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                                        <button  data-bs-toggle="modal"
                                                            data-bs-target="#resmievraklarupdateModal-{{ $resmievraklaritem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                                                        @include('admin.contents.resmievraklar.resmievraklar-update')
                                                        <form
                                                            action="{{ route('resmievraklarr.destroy', ['resmievraklarr' => $resmievraklaritem->id]) }}"
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
