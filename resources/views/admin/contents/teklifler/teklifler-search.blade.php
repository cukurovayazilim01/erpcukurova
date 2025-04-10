<table  class="table table-bordered table-hover" style="width:100%;  ">

    <tbody>
        @foreach ($teklifler as $teklifleritem)
            <tr>
                <th scope="row">{{ $startNumber - $loop->index }}</th>
                @if ($teklifleritem->teklif_kodu_text!= 'ÇT')
                <th scope="row">
                    {{ $teklifleritem->teklif_kodu_text }}</th>
                @else
                <th scope="row">
                    {{ $teklifleritem->teklif_kodu_text }}-{{ $teklifleritem->teklif_kodu }}</th>
                @endif

                <td>{{ $teklifleritem->islem_tarihi }}</td>
                <td>{{ $teklifleritem->firmaadi->firma_unvan }}</td>
                <td>{{ $teklifleritem->teklif_konu }}</td>
                <td>{{ number_format($teklifleritem->teklif_iskonto_toplam, 2, ',', '.') }} ₺</td>
                <td>{{ number_format($teklifleritem->teklif_kdv_toplam, 2, ',', '.') }} ₺</td>
                <td>{{ number_format($teklifleritem->teklif_ara_toplam, 2, ',', '.') }} ₺</td>
                <td>{{ number_format($teklifleritem->teklif_kdvli_toplam, 2, ',', '.') }} ₺</td>


                <td class="text-right" >
                    <div class="databutton">
                        <div class="d-flex align-items-center fs-6"  style="justify-content: space-evenly; ">
                            @if (!Request::is('teklifler') && !Request::is('onaylananteklifler') && !Request::is('onaylanmayanteklifler'))
                                <button class="btn btn-sm btn-outline-success open-modal-btn"
                                    style="margin-right: 3px" data-bs-toggle="modal"
                                    data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">Teklif
                                    İşlemleri</button>
                                @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')
                            @endif
                            @if (($teklifleritem->satis_durum == '0' && Request::is('onaylananteklifler')) || Request::is('onaylanmayanteklifler'))
                                <button class="btn btn-sm btn-outline-danger open-modal-btn"
                                    style="margin-right: 3px" data-bs-toggle="modal"
                                    data-bs-target="#teklifislemmodal-{{ $teklifleritem->id }}">İptal
                                    Et</button>
                                @include('admin.contents.teklifler.tekliflerdurum.teklifler-islem')
                            @endif
                            @if (Request::is('onaylananteklifler') && $teklifleritem->satis_durum == '0')
                                <a href="{{ route('satisafisineaktar', ['id' => $teklifleritem->id]) }}"
                                    class="btn btn-sm btn-outline-success open-modal-btn"
                                    style="margin-right: 3px">Satışa Aktar</a>
                            @elseif (Request::is('onaylananteklifler') && $teklifleritem->satis_durum == '1')
                                <a href="#" class="btn btn-sm btn-success open-modal-btn"
                                    style="margin-right: 3px">Satışa Aktarıldı</a>
                            @endif

                            <a href="{{ route('teklifler.show', ['teklifler' => $teklifleritem->id]) }}"
                                class="text-primary btn btn-link p-0 m-0 " target="_blank">
                                <i style="color:#293445;  "
                                class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                            </a>
                            <a href="{{ route('teklifler.edit', ['teklifler' => $teklifleritem->id]) }}"
                                class="text-warning btn btn-link p-0 m-0 ">
                                <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                            </a>
                            <form
                                action="{{ route('teklifler.destroy', ['teklifler' => $teklifleritem->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-link text-danger p-0 m-0 show_confirm">
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
