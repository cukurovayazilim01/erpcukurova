@extends('admin.layouts.app')
@section('title')
    Virman
@endsection
@section('contents')
@section('topheader')
    Virman
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">
            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">
                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <button type="button" class="btn btn-outline-dark btn-sm " data-bs-toggle="modal"
                        data-bs-target="#virmaneklemodal"> <i class="fa-solid fa-plus"></i> Yeni Ekle</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="virmaneklemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="add-form" action="{{ route('virman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Virman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body"
                    style="padding: 20px; background-position:center; background-repeat: no-repeat; background-size: cover;  background-image: url('{{ asset('resim/modal7.png') }}') ">

                    <div class="row ">
                            <div class="col-md-6">
                                <label for="tarih">Virman Tarihi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                    <input type="date" name="tarih" id="tarih"
                                        class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="virman_tutar">Virman Tutar</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-inbox"></i>
                                    </span>
                                    <input type="text" name="virman_tutar" id="virman_tutar"
                                        class="form-control form-control-sm input-mask" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="secimislemi">Virman İşlemi</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <select name="secimislemi" id="secimislemi" class="form-control form-control-sm"
                                        required>
                                        <option value="">Lütfen Seçim Yapınız...</option>
                                        <option value="1">KASADAN KASAYA</option>
                                        <option value="2">BANKADAN BANKAYA</option>
                                        <option value="3">KASADAN BANKAYA</option>
                                        <option value="4">BANKADAN KASAYA</option>
                                    </select>
                                </div>
                            </div>
                            <!-- İşlem Seçimlerine Göre Görünecek Alanlar -->
                            <div id="1" style="display: none;" >
                                <div class="col-md-6">
                                    <label for="birinci_kasa1">Kasadan</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="birinci_kasa" id="birinci_kasa1" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($kasalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ikinci_kasa1">Kasaya</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="ikinci_kasa" id="ikinci_kasa1" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($kasalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="2" style="display: none;" >
                                <div class="col-md-6">
                                    <label for="birinci_banka2">Bankadan</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="birinci_banka" id="birinci_banka2" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($bankalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->banka_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ikinci_banka2">Bankaya</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="ikinci_banka" id="ikinci_banka2" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($bankalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->banka_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="3" style="display: none;" >
                                <div class="col-md-6">
                                    <label for="birinci_kasa3">Kasadan</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="birinci_kasa" id="birinci_kasa3" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($kasalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="birinci_banka3">Bankaya</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="birinci_banka" id="birinci_banka3" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($bankalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->banka_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="4" style="display: none;" >
                                <div class="col-md-6">
                                    <label for="ikinci_banka4">Bankadan</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="ikinci_banka" id="ikinci_banka4" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($bankalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->banka_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="ikinci_kasa4">Kasaya</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                        <select name="ikinci_kasa" id="ikinci_kasa4" class="form-control form-control-sm" required>
                                            <option value="">Seçiniz...</option>
                                            @foreach ($kasalar as $item)
                                                <option value="{{ $item->id }}">{{ $item->kasa_adi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                <table class="table table-bordered table-hover" style="width:100%;" id="example2" role="grid"
                    aria-describedby="example_info">
                    <thead >
                        <tr>
                            <th scope="col">#</th>
                            <th>İşlemi Yapan</th>
                            <th>İşlem Tarihi</th>
                            <th>Kasadan</th>
                            <th>Kasaya</th>
                            <th>Bankadan</th>
                            <th>Bankaya</th>
                            <th>Virman Tutar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($virman as $sn => $virmanitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $virmanitem->user->ad_soyad }}</td>
                                <td>{{ $virmanitem->islem_tarihi }}</td>
                                <td>{{ $virmanitem->birinciKasa->kasa_adi  ?? '-' }}</td>
                                <td>{{ $virmanitem->ikinciKasa->kasa_adi  ?? '-' }}</td>
                                <td>{{ $virmanitem->birincibanka->banka_adi ?? '-' }}</td>
                                <td>{{ $virmanitem->ikincibanka->banka_adi ?? '-'}}</td>
                                <td>{{ number_format($virmanitem->virman_tutar, 2, ',', '.') }} <b style="color: red">₺</b></td>
                                {{-- <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">
                                            <button class="text-warning" data-bs-toggle="modal"
                                                data-bs-target="#virmanupdateModal-{{ $virmanitem->id }}"><i
                                                    class="bi bi-pencil-fill"></i></button>
                                            @include('admin.contents.virman.virman-update')
                                            <form
                                                action="{{ route('virman.destroy', ['virman' => $virmanitem->id]) }}"
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
                                </td> --}}
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Önceden belirlenmiş öğeler
        var secimislemi = document.getElementById('secimislemi');
        var div1 = document.getElementById('1');
        var div2 = document.getElementById('2');
        var div3 = document.getElementById('3');
        var div4 = document.getElementById('4');

        var birinci_kasa1 = document.getElementById('birinci_kasa1');
        var ikinci_kasa1 = document.getElementById('ikinci_kasa1');
        var birinci_banka1 = document.getElementById('birinci_banka1');
        var ikinci_banka1 = document.getElementById('ikinci_banka1');

        var birinci_kasa2 = document.getElementById('birinci_kasa2');
        var ikinci_kasa2 = document.getElementById('ikinci_kasa2');
        var birinci_banka2 = document.getElementById('birinci_banka2');
        var ikinci_banka2 = document.getElementById('ikinci_banka2');

        var birinci_kasa3 = document.getElementById('birinci_kasa3');
        var birinci_banka3 = document.getElementById('birinci_banka3');

        var ikinci_kasa4 = document.getElementById('ikinci_kasa4');
        var ikinci_banka4 = document.getElementById('ikinci_banka4');

        // Secimislemi'ye göre div'leri kontrol eden fonksiyon
        function toggleDivs() {
            var selectedValue = secimislemi.value;
            div1.style.display = (selectedValue === '1') ? 'flex' : 'none';
            div2.style.display = (selectedValue === '2') ? 'flex' : 'none';
            div3.style.display = (selectedValue === '3') ? 'flex' : 'none';
            div4.style.display = (selectedValue === '4') ? 'flex' : 'none';

            var allSelects = document.querySelectorAll('select');
            allSelects.forEach(function(select) {
                if (select !== secimislemi) {
                    select.removeAttribute('name');
                }
            });

            // Seçili olan div'e göre name özelliğini ayarla
            if (selectedValue === '1') {
                birinci_kasa1.setAttribute('name', 'birinci_kasa');
                ikinci_kasa1.setAttribute('name', 'ikinci_kasa');
            } else if (selectedValue === '2') {
                birinci_banka2.setAttribute('name', 'birinci_banka');
                ikinci_banka2.setAttribute('name', 'ikinci_banka');
            } else if (selectedValue === '3') {
                birinci_kasa3.setAttribute('name', 'birinci_kasa');
                birinci_banka3.setAttribute('name', 'birinci_banka');
            } else if (selectedValue === '4') {
                ikinci_banka4.setAttribute('name', 'ikinci_banka');
                ikinci_kasa4.setAttribute('name', 'ikinci_kasa');
            }
        }

        // event listener'lar
        secimislemi.addEventListener('change', toggleDivs);

        // Sayfa yüklendiğinde div'leri kontrol et
        toggleDivs();
    });
</script>

@endsection
