<table class="table align-middle mb-0  ">

    <tbody>
        @foreach ($yillikizin as $sn => $yillikizinitem)
            <tr>
                <th>{{ $sn + 1 }}</th>
                <td>{{ $yillikizinitem->baslangic_tarihi }}</td>
                <td>{{ $yillikizinitem->bitis_tarihi }}</td>
                <td>{{ $yillikizinitem->personel->ad_soyad }}</td>
                {{-- <td>{{ $yillikizinitem->izin_hakki }} Gün</td> --}}
                <td>{{ $yillikizinitem->izin_gun }} Gün</td>
                <td>{{ $yillikizinitem->hangi_ay }}</td>
                <td>{{ $yillikizinitem->gecirilecek_adres }}</td>
                <td>{{ $yillikizinitem->izin_aciklama }}</td>

                <td class="text-right">
                    <div class="d-flex align-items-center">
                        <button class=" btn btn-sm btn-link text-warning p-0 m-0"
                            data-bs-toggle="modal"
                            data-bs-target="#yillikizinupdateModal-{{ $yillikizinitem->id }}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        @include('admin.contents.yillikizin.yillikizin-update')

                        <form
                            action="{{ route('yillikizin.destroy', ['yillikizin' => $yillikizinitem->id]) }}"
                            method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm p-0 m-0 btn-link text-danger show_confirm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>