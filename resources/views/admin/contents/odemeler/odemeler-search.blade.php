<table class="table table-bordered table-striped" style="width:100%;" id="example2">

    <tbody>
        @foreach ($odemeler as $odemeleritem)
        <tr>
            <td scope="row">{{ $startNumber - $loop->index }}</td>
            <th>{{ $odemeleritem->odeme_kodu_text }}-{{ $odemeleritem->odeme_kodu }}</th>
            <td>{{ $odemeleritem->tarih }}</td>
            <td>{{ $odemeleritem->firmaadi->firma_unvan }}</td>
            <td>{{ $odemeleritem->odeme_turu }}</td>
            <td>{{ number_format($odemeleritem->odeme_tutar, 2, ',', '.') }} ₺</td>


            <td class="text-right">
                <div class="databutton">
                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                        <a href="{{ route('odemeler.show', ['odemeler' => $odemeleritem->id]) }}"
                            class=" btn btn-link p-0 m-0 " target="_blank">
                            <i style="color:#293445;  "
                            class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                        </a>

                        <form
                            action="{{ route('odemeler.destroy', ['odemeler' => $odemeleritem->id]) }}"
                            method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn  p-0 m-0 show_confirm">
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
