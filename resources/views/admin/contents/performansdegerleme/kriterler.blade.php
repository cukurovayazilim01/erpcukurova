@extends('admin.layouts.app')
@section('title')
Değerlendirme Kriterleri
@endsection
@section('contents')
@section('topheader')
Değerlendirme Kriterleri
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
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <label for="durum">Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="inputs[0][durum]" id="inputs[0][durum]" class="form-select form-select-sm">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
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
                            <th>Kriterler</th>

                            <th>Durum</th>
                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($degerlemekriter as $sn => $degerlemekriteritem)
                            <tr>
                                <th scope="row">{{ $sn + 1 }}</th>
                                <td>{{ $degerlemekriteritem->kriter }}</td>
                                <td>@if ($degerlemekriteritem->durum === 'Aktif')
                                    <span class="badge bg-success">{{ $degerlemekriteritem->durum }}</span>
                                    @elseif($degerlemekriteritem->durum === 'Pasif')
                                    <span class="badge bg-danger">{{ $degerlemekriteritem->durum }}</span>
                                    @endif</td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#kriterlerupdateModal-{{ $degerlemekriteritem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                                @include('admin.contents.performansdegerleme.kriterler-update')
                                            <form action="{{ route('kasalar.destroy', ['kasalar' => $degerlemekriteritem->id]) }}"
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
<script>
    // Başlangıç dizini
    let rowIndex = 1;

    // Add new row
    document.getElementById("addRow").addEventListener("click", function() {
        let container = document.getElementById("hizmetlerContainer");

        let newRow = document.createElement("div");
        newRow.classList.add("hizmet-item", "d-flex", "align-items-center");

        newRow.innerHTML = `
             <div class="col-md-6">
                                    <label for="hizmet_adi">Kriter</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                        <input type="text" name="inputs[${rowIndex}][kriter]"
                                        id="inputs[${rowIndex}][kriter]"
                                        class="form-control form-control-sm kriter">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <label for="durum">Durum</label>
                                    <div class="form-group input-with-icon">
                                        <span class="icon">
                                            <i class="fa-solid fa-check"></i>
                                        </span>
                                        <select name="inputs[${rowIndex}][durum]" id="inputs[${rowIndex}][durum]" class="form-select form-select-sm">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Pasif">Pasif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button"
                                        class="btn btn-sm btn-danger removeRow mt-3">Sil</button>
                                </div>
        `;

        container.appendChild(newRow);

        // Artırılacak olan indeks
        rowIndex++;
    });

    // Remove row
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("removeRow")) {
            e.target.closest(".hizmet-item").remove();
        }
    });
</script>
@endsection
