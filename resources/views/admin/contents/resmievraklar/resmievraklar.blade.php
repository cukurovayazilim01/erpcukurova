@extends('admin.layouts.app')
@section('title')
    Resmi Evraklar
@endsection
@section('contents')
@section('topheader')
    Resmi Evraklar
@endsection
<div class="card radius-10">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">

            <div class="col">
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <button type="button" class="btn btn-sm btn-outline-primary px-5" data-bs-toggle="modal"
                        data-bs-target="#resmievraklarmodal"><i class="fa-solid fa-plus"></i>Yeni Ekle</button>
                    <div class="dropdown">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="resmievraklarmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('resmievraklarr.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Resmi Evraklar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="display: flex">
                        <!-- Left Side -->
                        <div class="col-md-12" style="padding: 3%;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="dokuman_adi">Evrak Adı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="text" name="dokuman_adi" id="dokuman_adi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="dokuman_yili">Evrak Yılı</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="dokuman_yili" id="dokuman_yili"
                                            class="form-select form-select-sm">
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
                                <div class="col-md-6">
                                    <label for="dokuman_yolu">Evrak</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="file" name="dokuman_yolu" id="dokuman_yolu"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="dokuman_alim_tarihi">Evrak Alım Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="dokuman_alim_tarihi" id="dokuman_alim_tarihi"
                                            class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="dokuman_hatirlatma_tarihi">Evrak Hatırlatma Tarihi</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-layer-group"></i>
                                        </span>
                                        <input type="date" name="dokuman_hatirlatma_tarihi"
                                            id="dokuman_hatirlatma_tarihi" class="form-control form-control-sm"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="status" id="status" class="form-select form-select-sm">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="aciklama">Evrak Açıklama</label>
                                    <textarea name="aciklama" id="aciklama" cols="20" rows="2" class="form-control form-control-sm "></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Vazgeç</button>
                        <button type="submit" class="btn btn-outline-primary btn-sm "></i>Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-light">
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
                                        <a href="{{ asset($resmievraklaritem->dokuman_yolu) }}" target="_blank"
                                            style="color: red">
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
                                    <div class="d-flex align-items-center fs-6">
                                        <button class="text-warning" data-bs-toggle="modal"
                                        data-bs-target="#resmievraklarupdateModal-{{ $resmievraklaritem->id }}"><i
                                            class="bi bi-pencil-fill"></i></button>
                                    @include('admin.contents.resmievraklar.resmievraklar-update')
                                        <form action="{{ route('resmievraklarr.destroy', ['resmievraklarr' => $resmievraklaritem->id]) }}"
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
</div>
@include('session.session')
@endsection
