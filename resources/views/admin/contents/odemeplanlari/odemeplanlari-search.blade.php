<table class="table table-bordered table-hover">
    <tbody>
         @foreach ($odemeplanlari as $sn => $odemeplanlariitem)
            <tr>
                <th scope="row">{{ $startNumber - $loop->index }}</th>
                <td>{{ $odemeplanlariitem->tarih }}</td>

                <td>{{ $odemeplanlariitem->firmaadi->firma_unvan }}</td>
                <td>{{ $odemeplanlariitem->vade_tarih }}</td>
                <td>{{ number_format($odemeplanlariitem->odeme_tutar , 2, ',', '.')}} ₺</td>

                <td>
                    @if ($odemeplanlariitem->durum == 'Yapıldı')
                    <span class="badge bg-success">Ödeme Yapıldı</span>

                    @else
                    <span class="badge bg-danger">Ödeme Yapılmadı</span>

                    @endif
                </td>

                <td>{{ $odemeplanlariitem->aciklama }}</td>

                <td class="text-right">
                    <div class="databutton">
                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                            <button data-bs-toggle="modal"
                            data-bs-target="#odemeplanlariupdateModal-{{ $odemeplanlariitem->id }}"> <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>



                        @include('admin.contents.odemeplanlari.odemeplanlari-update')

                            <form action="{{ route('odemeplanlari.destroy', ['odemeplanlari' => $odemeplanlariitem->id]) }}"
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
