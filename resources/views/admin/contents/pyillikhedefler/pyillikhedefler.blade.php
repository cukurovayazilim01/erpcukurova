@extends('admin.layouts.app')
@section('title')
Personel Yıllık Hedefleri
@endsection
@section('contents')
@section('topheader')
Personel Yıllık Hedefleri
@endsection
<div class="card">
    <div class="card-header bg-transparent">
        <div class="row g-3 align-items-center">
            <div class="col">
                <div class="d-flex align-items-center justify-content-between gap-3">
                    <div class="col-lg-4 col-4 col-md-4 mr-4">

                        <a href="{{route('yillikhedefkonu')}}" type="button" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-shipping-fast"></i> Yıllık Hedef Konuları
                        </a>
                    </div>
                    <div class="ms-auto">
                        <a type="button" href="{{ route('pyillikhedefler.create') }}"
                        class="btn btn-sm btn-outline-primary px-5"><i class="fa-solid fa-plus"></i>Yıllık Hedef Ekle</a>
                    </div>


                </div>
            </div>
        </div>
    </div>



    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th>Hedef Sorumlu Personel Adı</th>
                            <th>Hedef Konusu</th>
                            <th>Hedef Yılı</th>
                            <th>Hedef Mevcut Değeri</th>
                            <th>Hedeflenen Değer</th>
                            <th>Yönetici Hedeflenen Değer</th>
                            <th>Hedef Hesaplama Yönetimi</th>
                            <th>Hedef Aksiyonu</th>

                            <th>Hedef Termini</th>
                            <th>Hedef Kontrol Termini</th>
                            <th>Kontrol Sonucu</th>

                            <th>Aksiyon</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pyillikhedefler as $sn => $pyillikhedefleritem)
                            <tr>
                                <th scope="row">{{ $sn + 1 }}</th>
                                <td>{{ $pyillikhedefleritem->personel->ad_soyad }}</td>
                                <td>{{ $pyillikhedefleritem->hedefkonu->hedef_konu }}</td>
                                <td>{{ $pyillikhedefleritem->hedef_yili }}</td>
                                <td>{{ $pyillikhedefleritem->hedef_mevcut_degeri }}</td>
                                <td>{{ $pyillikhedefleritem->hedeflenen_deger }}</td>
                                <td>{{ $pyillikhedefleritem->yonetici_hedeflenen_deger }}</td>
                                <td>{{ $pyillikhedefleritem->hedef_hesaplama_yontemi }}</td>
                                <td>{{ $pyillikhedefleritem->hedef_aksiyonu }}</td>

                                <td>{{ $pyillikhedefleritem->hedef_termini }}</td>
                                <td>{{ $pyillikhedefleritem->hedef_kontrol_termini }}</td>
                                <td>{{ $pyillikhedefleritem->kontrol_sonucu }}</td>

                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning" data-bs-toggle="modal"
                                            data-bs-target="#pyillikhedefupdateModal-{{ $pyillikhedefleritem->id }}"><i
                                                class="bi bi-pencil-fill"></i></button>
                                                @include('admin.contents.pyillikhedefler.pyillikhedefler-update')
                                            <form action="{{ route('kasalar.destroy', ['kasalar' => $pyillikhedefleritem->id]) }}"
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
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                        <input type="text" name="inputs[${rowIndex}][kriter]"
                                        id="inputs[${rowIndex}][kriter]"
                                        class="form-control form-control-sm kriter">
                                    </div>
                                </div>
                                   <div class="col-md-6">
                                    <label for="durum">Durum</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
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
