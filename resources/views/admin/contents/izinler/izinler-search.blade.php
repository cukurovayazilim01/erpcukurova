<table class="table align-middle mb-0 display " >

    <tbody>
        @foreach ($izinler as $sn => $izinleritem)
            <tr>
                <th>{{ $sn + 1 }}</th>
                <td>{{ $izinleritem->baslangic_tarihi }}</td>
                <td>{{ $izinleritem->bitis_tarihi }}</td>
                <td>{{ $izinleritem->personel->ad_soyad }}</td>
                <td>{{ $izinleritem->izin_gun }}</td>
                <td>{{ $izinleritem->izin_turu }}</td>
                <td>{{ $izinleritem->izin_aciklama }}</td>

                <td class="text-right">
                    <div class="d-flex align-items-center">
                        {{-- <button class="text-warning" data-bs-toggle="modal"
                            data-bs-target="#izinlerupdateModal-{{ $izinleritem->id }}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        @include('admin.contents.izinler.izinler-update')--}}
                        <a href="{{ route('izinler.show', ['izinler' => $izinleritem->id]) }}"
                            class="text-primary btn btn-link p-0 m-0 ">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <form
                            action="{{ route('izinler.destroy', ['izinler' => $izinleritem->id]) }}"
                            method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link btn-sm text-danger show_confirm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>