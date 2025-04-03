<table class="table table-bordered table-hover"  role="grid"
                        aria-describedby="example_info" style="width:100%; cursor: pointer; ">

                        <tbody>
                            @foreach ($aramalar as $aramalaritem)
                                <tr>
                                    <th scope="row">{{ $startNumber - $loop->index }}</th>
                                    <td>{{ $aramalaritem->islem_tarihi }}</td>
                                    <td>{{ $aramalaritem->adsoyad->ad_soyad }}</td>
                                    <td>{{ $aramalaritem->cariler->firma_unvan }}</td>
                                    <td>{{ $aramalaritem->arama_tipi }}</td>
                                    <td>{{ $aramalaritem->hizmet_turu }}</td>
                                    <td class="text-wrap" style="max-width: 400px">{{ $aramalaritem->not }}
                                    </td>
                                    <td>{{ $aramalaritem->hatirlat_durumu }}</td>
                                    <td>{{ $aramalaritem->hatirlat_tarihi }}</td>
                                    <td class="text-right">
                                        <div class="databutton">
                                            <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">

                                                <form action="{{ route('aramalar.destroy', ['id' => $aramalaritem->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0 m-0 show_confirm">
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
