<table class="table table-bordered table-hover" id="example2">

    <tbody>
        @foreach ($satislar as $satislaritem)
            <tr>
                <th scope="row">{{ $startNumber - $loop->index }}</th>
                @if (!empty($satislaritem->teklif_id))
                    <th scope="row"> <a href="{{route('teklifler.show', $satislaritem->teklif_id)}}"
                            target="_blank">{{ $satislaritem->teklifler->teklif_kodu_text . '-' . $satislaritem->teklifler->teklif_kodu }}
                        </a> </th>
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
                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                            <a href="{{ route('satislar.show', ['satislar' => $satislaritem->id]) }}"
                                class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                <i style="color:#293445;  "
                                class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                            </a>
                            <a href="{{ route('satislar.edit', ['satislar' => $satislaritem->id]) }}"
                                class="text-warning btn btn-link p-0 m-0 ">
                                <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                            </a>
                            <form
                                action="{{ route('satislar.destroy', ['satislar' => $satislaritem->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0 m-0 show_confirm">
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
