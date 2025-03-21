<table class="table align-middle mb-0 dataTable" role="grid"
aria-describedby="example_info" >
<tbody>
    @foreach ($kontak as $kontakitem)
        <tr>
            <th scope="row">{{ $startNumber - $loop->index }}</th>
            <td >{{ $kontakitem->firmaadi->firma_unvan }}</td>
            <td >{{ $kontakitem->yetkili_isim }}</td>
            <td >{{ $kontakitem->eposta }}</td>
            <td >{{ $kontakitem->telefon }}</td>
            <td class="text-right">
                <div class="databutton">
                    <div class="d-flex align-items-center fs-6">
                        <button class="text-warning btn btn-sm" data-bs-toggle="modal"
                        data-bs-target="#kontakupdateModal-{{ $kontakitem->id }}">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    @include('admin.contents.kontaklistesi.kontaklistesi-update')
                        <form
                            action="{{ route('kontaklistesi.destroy',  $kontakitem->id) }}"
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
