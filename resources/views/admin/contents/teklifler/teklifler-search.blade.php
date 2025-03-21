<table class="table align-middle mb-0 dataTable">
    <tbody>
        @foreach ($teklifler as $sn => $teklifleritem)
            <tr>
                <th scope="row">{{ $sn + 1 }}</th>
                <th scope="row">{{ $teklifleritem->teklif_kodu_text }}-{{$teklifleritem->teklif_kodu}}</th>
                <td>{{ $teklifleritem->firmaadi->firma_unvan }}</td>
                <td>{{ $teklifleritem->islem_tarihi }}</td>
                <td>{{number_format($teklifleritem->teklif_iskonto_toplam, 2, ',', '.')  }} ₺</td>
                <td>{{number_format($teklifleritem->teklif_kdv_toplam, 2, ',', '.')  }} ₺</td>
                <td>{{number_format($teklifleritem->teklif_ara_toplam, 2, ',', '.')  }} ₺</td>
                <td>{{number_format($teklifleritem->teklif_kdvli_toplam, 2, ',', '.')  }} ₺</td>

                <td class="text-right">
                    <div class="databutton">
                        <div class="d-flex align-items-center fs-6">
                            <a href="{{ route('teklifler.show', ['teklifler' => $teklifleritem->id]) }}"
                                class="text-primary btn btn-link p-0 m-0 ">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('teklifler.edit', ['teklifler' => $teklifleritem->id]) }}"
                                class="text-warning btn btn-link p-0 m-0 ">
                                <i
                                    class="bi bi-pencil-fill"></i>
                            </a>
                            {{-- <button class="text-warning" data-bs-toggle="modal"
                                data-bs-target="#hizmetlerupdateModal-{{ $teklifleritem->id }}"><i
                                    class="bi bi-pencil-fill"></i></button> --}}

                            <form
                                action="{{ route('teklifler.destroy', ['teklifler' => $teklifleritem->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0 m-0 show_confirm">
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
