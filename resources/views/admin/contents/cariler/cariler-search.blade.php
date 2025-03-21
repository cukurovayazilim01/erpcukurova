<table class="table align-middle mb-0 dataTable"  role="grid"
                        aria-describedby="example_info" >

                        <tbody>
                            @foreach ($cariler as $cariitem)
                                <tr>
                                    <th scope="row">{{ $startNumber - $loop->index }}</th>
                                    <td>{{ $cariitem->firma_unvan }}</td>
                                    <td>{{ $cariitem->firma_sektor }}</td>
                                    <td>{{ $cariitem->yetkili_kisi }}</td>
                                    <td>{{ $cariitem->yetkili_kisi_tel }}</td>
                                    <td>{{ $cariitem->eposta }}</td>
                                    <td>{{ $cariitem->musteri_temsilcisi }}</td>
                                    <td class="text-right">
                                        <div class="databutton">
                                            <div class="d-flex align-items-center fs-6">
                                                <button class="text-purple open-modal-btn" data-bs-toggle="modal"
                                                    data-bs-target="#dokumanModal-{{ $cariitem->id }}">
                                                    <i class="fa-solid fa-file"></i>
                                                </button>
                                                @include('admin.contents.cariler.dokuman.cari-dokuman')
                                                <button class="text-success open-modal-btn" data-bs-toggle="modal"
                                                    data-bs-target="#aramalarModal-{{ $cariitem->id }}">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                @include('admin.contents.cariler.aramalar.cari-aramalar')
                                                <a href="{{ route('cariler.show', ['cariler' => $cariitem->id]) }}"
                                                    class="text-primary btn btn-link p-0 m-0 ">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <button class="text-warning" data-bs-toggle="modal"
                                                    data-bs-target="#carilerupdateModal-{{ $cariitem->id }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                @include('admin.contents.cariler.cariler-update')

                                                <form
                                                    action="{{ route('cariler.destroy', ['cariler' => $cariitem->id]) }}"
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
