<table class="table align-middle mb-0" >

    <tbody>
        @foreach ($odemeler as $odemeleritem)
        <tr>
            <th scope="row">{{ $startNumber - $loop->index }}</th>
            <th>{{ $odemeleritem->odeme_kodu_text }}-{{ $odemeleritem->odeme_kodu }}</th>
            <td>{{ $odemeleritem->tarih }}</td>
            <td>{{ $odemeleritem->firmaadi->firma_unvan }}</td>
            <td>{{ $odemeleritem->odeme_turu }}</td>
            <td>{{ number_format($odemeleritem->odeme_tutar, 2, ',', '.') }} ₺</td>


            <td class="text-right">
                <div class="databutton">
                    <div class="d-flex align-items-center fs-6">


                        <a href="{{ route('odemeler.show', ['odemeler' => $odemeleritem->id]) }}"
                            class="text-primary btn btn-link p-0 m-0 " target="_blank">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        {{-- <a href="{{ route('odemeler.edit', ['odemeler' => $odemeleritem->id]) }}"
                            class="text-warning btn btn-link p-0 m-0 ">
                            <i class="bi bi-pencil-fill"></i>
                        </a> --}}
                        <form
                            action="{{ route('odemeler.destroy', ['odemeler' => $odemeleritem->id]) }}"
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
