<table class="table table-bordered table-striped"  role="grid" aria-describedby="example_info"
                style="width:100%; cursor: pointer; ">

                <tbody>
                    @foreach ($kontak as $kontakitem)
                        <tr>
                            <th scope="row">{{ $startNumber - $loop->index }}</th>
                            <td><a style="color:inherit"
                                href="{{ route('cariler.show', ['cariler' => $kontakitem->firmaadi->id]) }}">{{ $kontakitem->firmaadi->firma_unvan }}</a></td>
                            <td>{{ $kontakitem->yetkili_isim }}</td>
                            <td>{{ $kontakitem->telefon }}</td>
                            <td>{{ $kontakitem->eposta }}</td>
                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">
                                        <button  data-bs-toggle="modal"
                                            data-bs-target="#kontakupdateModal-{{ $kontakitem->id }}">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </button>
                                        @include('admin.contents.kontaklistesi.kontaklistesi-update')
                                        <form action="{{ route('kontaklistesi.destroy', $kontakitem->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn  p-0 m-0 show_confirm">
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
