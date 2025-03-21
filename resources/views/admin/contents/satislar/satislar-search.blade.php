<table class="table align-middle mb-0" >

    <tbody>
        @foreach ($satislar as $satislaritem)
        <tr>
            <th scope="row">{{ $startNumber - $loop->index }}</th>
            @if (!empty($satislaritem->teklif_id))
            <th scope="row"> <a href="{{route('teklifler.show',$satislaritem->teklif_id)}}" target="_blank">{{ $satislaritem->teklifler->teklif_kodu_text .'-'. $satislaritem->teklifler->teklif_kodu }} </a> </th>
            @else
           <th><b style="color: red">Direkt Satış</b></th>
            @endif
            <th scope="row">{{ $satislaritem->satis_kodu_text }}-{{ $satislaritem->satis_kodu }}</th>
            <td>{{ $satislaritem->firmaadi->firma_unvan }}</td>
            <td>{{ $satislaritem->satis_konu }}</td>

            <td>{{ $satislaritem->satis_tarihi }}</td>
            <td>{{ number_format($satislaritem->satis_iskonto_toplam, 2, ',', '.') }} ₺</td>
            <td>{{ number_format($satislaritem->satis_kdv_toplam, 2, ',', '.') }} ₺</td>
            <td>{{ number_format($satislaritem->satis_ara_toplam, 2, ',', '.') }} ₺</td>
            <td>{{ number_format($satislaritem->satis_kdvli_toplam, 2, ',', '.') }} ₺</td>


            <td class="text-right">
                <div class="databutton">
                    <div class="d-flex align-items-center fs-6">


                        <a href="{{ route('satislar.show', ['satislar' => $satislaritem->id]) }}"
                            class="text-primary btn btn-link p-0 m-0 " target="_blank">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('satislar.edit', ['satislar' => $satislaritem->id]) }}"
                            class="text-warning btn btn-link p-0 m-0 ">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form
                            action="{{ route('satislar.destroy', ['satislar' => $satislaritem->id]) }}"
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