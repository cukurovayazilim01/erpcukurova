<table class="table align-middle mb-0" id="example2">

    <tbody>
        @foreach ($personel as $sn => $personelitem)
            <tr>
                <th scope="row">{{ $sn + 1 }}</th>
                <td>{{ $personelitem->ad_soyad }}</td>
                <td>{{ $personelitem->askerlik_durumu }}</td>
                <td>{{ $personelitem->dogum_yeri }} </td>
                <td>{{ $personelitem->dogum_tarihi }} </td>
                <td>{{ $personelitem->medeni_hali }} </td>

                <td><button class=" text-success open-modal-btn" data-bs-toggle="modal"
                    data-bs-target="#perseonelegitimModal-{{ $personelitem->id }}">
                    <i style="color:#293445;  "
                                class="fa-solid fa-award fs-6"></i>
                    </button>

{{--    @include('admin.contents.personel.personelegitim.personelegitim')  --}}
                </td>
                 <td><button class="text-purple open-modal-btn" data-bs-toggle="modal"
                    data-bs-target="#perseoneldokumanModal-{{ $personelitem->id }}">
                    <i style="color:#293445;  " class="fa-solid fa-file fs-6"></i>
                    </button>
                    {{-- @include('admin.contents.personel.personeldokuman.personeldokuman') --}}
                </td>

                <td class="text-right">
                    <div class="databutton">
                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">

                            <button data-bs-toggle="modal"
                                data-bs-target="#personelupdateModal-{{ $personelitem->id }}"> <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                            @include('admin.contents.personel.personel-update')
                            <a href="{{ route('personell.show', ['personell' => $personelitem
                            ->id]) }}"
                                class=" btn btn-link p-0 m-0 ">
                                <i style="color:#293445;  "
                                class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                            </a>
                            <form
                                action="{{ route('personell.destroy', ['personell' => $personelitem->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn  p-0 m-0 show_confirm">
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
