<table class="table table-bordered table-hover" style="width:100%;" id="example2">

    <tbody>
        @foreach ($tahsilat as $tahsilatitem)
        <tr>
            <td scope="row">{{ $startNumber - $loop->index }}</td>
            <td>
                {{$tahsilatitem->tahsilat_kodu_text}}-{{ $tahsilatitem->tahsilat_kodu }}
            </td>
            <td>{{ $tahsilatitem->tarih }}</td>

            <td>{{ $tahsilatitem->firmaadi->firma_unvan }}</td>
            <td>{{ $tahsilatitem->odeme_turu }}</td>
            <td>{{ number_format($tahsilatitem->tahsilat_tutar, 2, ',', '.') }} <b style="color: red">₺</b></td>


            <td class="text-right">
                <div class="databutton">
                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                        <a href="{{ route('tahsilat.show', ['tahsilat' => $tahsilatitem->id]) }}"
                            class=" btn btn-link p-0 m-0 " target="_blank">
                            <i style="color:#293445;  "
                            class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                        </a>

                        <form
                            action="{{ route('tahsilat.destroy', ['tahsilat' => $tahsilatitem->id]) }}"
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
