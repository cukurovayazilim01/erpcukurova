<table class="table table-bordered table-striped" style="width:100%; ">

    <tbody>
        @foreach ($cariler as $cariitem)
            <tr>

                <td><a style="color:inherit" href="{{ route('cariler.show', ['cariler' => $cariitem->id]) }}">{{ $cariitem->firma_unvan }} </a> </td>
                <td style="text-align: center">{{ $cariitem->firma_sektor }}</td>
                <td style="text-align: center">{{ $cariitem->yetkili_kisi }}</td>
                <td style="text-align: center">{{ $cariitem->yetkili_kisi_tel }}</td>
                <td style="text-align: center">{{ $cariitem->eposta }}</td>
                <td style="text-align: center">{{ $cariitem->user->ad_soyad }}</td>

                <td class="text-right">
                    <div class="databutton ">
                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                            @include('admin.contents.cariler.aramalar.cari-aramalar')
                            <a href="{{ route('cariler.show', ['cariler' => $cariitem->id]) }}"
                                class=" btn btn-link p-0 m-0 ">
                                <i style="color:#293445;  " class="fa-solid fa-wand-magic-sparkles fs-6" ></i>
                            </a>
                            <button class="open-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#dokumanModal-{{ $cariitem->id }}">
                                <i style="color:#293445" class="fa-solid fa-file-pdf fs-6"></i>
                            </button>
                            @include('admin.contents.cariler.dokuman.cari-dokuman')
                            <button class=" open-modal-btn" data-bs-toggle="modal"
                                data-bs-target="#aramalarModal-{{ $cariitem->id }}">
                                <i style="color:rgb(88, 134, 88)" class="fa-solid fa-square-phone-flip fs-6"></i>
                            </button>

                            <button class="" data-bs-toggle="modal"
                                data-bs-target="#carilerupdateModal-{{ $cariitem->id }}">
                                <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                            </button>
                            @include('admin.contents.cariler.cariler-update')

                            <form
                                action="{{ route('cariler.destroy', ['cariler' => $cariitem->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn  p-0 m-0 show_confirm " >
                                    <i style="color: rgb(180, 68, 34)" class="fa-solid fa-trash-can fs-6"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
