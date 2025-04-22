<table class="table dataTable table-striped table-bordered " id="example2">
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
                        class="btn btn-sm  "><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i> Teslim Alma
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
                                <i style="color: rgb(180, 68, 34)"
                                        class="fa-solid fa-trash-can fs-6"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
