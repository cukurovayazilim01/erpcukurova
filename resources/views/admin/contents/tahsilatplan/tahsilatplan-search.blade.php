<table class="table table-bordered table-striped" >

    <tbody>
         @foreach ($tahsilatplan as $sn => $tahsilatplanitem)
            <tr>
                <th scope="row">{{ $startNumber - $loop->index }}</th>
                <td>{{ $tahsilatplanitem->tarih }}</td>

                <td>{{ $tahsilatplanitem->firmaadi->firma_unvan }}</td>
                <td>{{ $tahsilatplanitem->vade_tarih }}</td>
                <td>{{ number_format($tahsilatplanitem->tahsilat_tutar , 2, ',', '.')}} ₺</td>

                <td>
                    @if ($tahsilatplanitem->durum == 'Edildi')
                    <span class="badge bg-success">Tahsil Edildi</span>

                    @else
                    <span class="badge bg-danger">Tahsil Edilmedi</span>

                    @endif
                </td>

                <td>{{ $tahsilatplanitem->aciklama }}</td>

                <td class="text-right">
                    <div class="databutton">
                        <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                            <button data-bs-toggle="modal"
                            data-bs-target="#tahsilatplanupdateModal-{{ $tahsilatplanitem->id }}"><i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i></button>
                        @include('admin.contents.tahsilatplan.tahsilatplan-update')
                            <form action="{{ route('tahsilatplan.destroy', ['tahsilatplan' => $tahsilatplanitem->id]) }}"
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
