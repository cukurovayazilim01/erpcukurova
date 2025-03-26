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
                    <i class="fa-solid fa-award"></i>
                    </button>

{{--    @include('admin.contents.personel.personelegitim.personelegitim')  --}}
                </td>
                 <td><button class="text-purple open-modal-btn" data-bs-toggle="modal"
                    data-bs-target="#perseoneldokumanModal-{{ $personelitem->id }}">
                    <i class="fa-solid fa-file"></i>
                    </button>
                    {{-- @include('admin.contents.personel.personeldokuman.personeldokuman') --}}
                </td>

                <td class="text-right">
                    <div class="databutton">
                        <div class="d-flex align-items-center fs-6">

                            <button class="text-warning" data-bs-toggle="modal"
                                data-bs-target="#personelupdateModal-{{ $personelitem->id }}"><i
                                    class="bi bi-pencil-fill"></i></button>
                            @include('admin.contents.personel.personel-update')
                            <a href="{{ route('personell.show', ['personell' => $personelitem
                            ->id]) }}"
                                class="text-primary btn btn-link p-0 m-0 ">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <form
                                action="{{ route('personell.destroy', ['personell' => $personelitem->id]) }}"
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