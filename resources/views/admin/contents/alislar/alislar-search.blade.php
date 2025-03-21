<table class="table align-middle mb-0" >

    <tbody>
        @foreach ($alislar as $alislaritem)
            <tr>
                <th scope="row">{{ $startNumber - $loop->index }}</th>
                <th scope="row">{{ $alislaritem->alis_kodu_text }}-{{ $alislaritem->alis_kodu }}</th>
                <td scope="row">{{ $alislaritem->fis_tarihi }}</td>
                <td>{{ $alislaritem->fis_no }}</td>
                <td>{{ $alislaritem->firmaadi->firma_unvan }}</td>
                <td>{{ number_format($alislaritem->toplam_tutar, 2, ',', '.') }} ₺</td>
                <td>{{ $alislaritem->aciklama }} </td>
                <td class="text-right">
                    <div class="databutton">
                        <div class="d-flex align-items-center fs-6">
                            <a href="{{ route('alislar.show', ['alislar' => $alislaritem->id]) }}"
                                class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('alislar.edit', ['alislar' => $alislaritem->id]) }}"
                                class="text-warning btn btn-link p-0 m-0 ">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form
                                action="{{ route('alislar.destroy', ['alislar' => $alislaritem->id]) }}"
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
