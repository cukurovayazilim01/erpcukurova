<table class="table align-middle mb-0 display " >

    <tbody>
        @foreach ($zimmet as $sn => $zimmetitem)
            <tr>
                <th>{{ $sn + 1 }}</th>
                <td>{{ $zimmetitem->islem_tarihi }}</td>
                <td>{{ $zimmetitem->personel->ad_soyad }}</td>
                <td>{{ $zimmetitem->personel->sigorta_sicil_no }}</td>
                <td>{{ $zimmetitem->personel->ise_giris_tarihi }}</td>

                <td>
                    <a href="{{route('zimmet.show',['zimmet'=>$zimmetitem->id])}}" target="_blank"
                         class="btn btn-sm text-light btn-danger"> <i class="fa fa-file-pdf"></i>
                    </a>
                </td>
                <td>
                    <a href="{{ route('zimmet.edit', ['zimmet' => $zimmetitem->id]) }}"
                        class="btn btn-sm  btn-success"><i class="fa fa-refresh"></i> Teslim Alma
                    </a>
                </td>
                <td class="text-right">
                    <div class="d-flex align-items-center">


                        <form
                            action="{{ route('zimmet.destroy', ['zimmet' => $zimmetitem->id]) }}"
                            method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" text-danger show_confirm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>