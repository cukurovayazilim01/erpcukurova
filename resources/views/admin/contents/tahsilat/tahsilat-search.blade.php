<table class="table align-middle mb-0" >
    <tbody>
        @foreach ($tahsilat as $tahsilatitem)
        <tr>
            <th scope="row">{{ $startNumber - $loop->index }}</th>
            <th>
                {{$tahsilatitem->tahsilat_kodu_text}}-{{ $tahsilatitem->tahsilat_kodu }}
            </th>
            <td>{{ $tahsilatitem->tarih }}</td>

            <td>{{ $tahsilatitem->firmaadi->firma_unvan }}</td>
            <td>{{ $tahsilatitem->odeme_turu }}</td>
            <td>{{ number_format($tahsilatitem->tahsilat_tutar, 2, ',', '.') }} <b style="color: red">₺</b></td>


            <td class="text-right">
                <div class="databutton">
                    <div class="d-flex align-items-center fs-6">


                        <a href="{{ route('tahsilat.show', ['tahsilat' => $tahsilatitem->id]) }}"
                            class="text-primary btn btn-link p-0 m-0 " target="_blank">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        {{-- <a href="{{ route('tahsilat.edit', ['tahsilat' => $tahsilatitem->id]) }}"
                            class="text-warning btn btn-link p-0 m-0 ">
                            <i class="bi bi-pencil-fill"></i>
                        </a> --}}
                        <form
                            action="{{ route('tahsilat.destroy', ['tahsilat' => $tahsilatitem->id]) }}"
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
