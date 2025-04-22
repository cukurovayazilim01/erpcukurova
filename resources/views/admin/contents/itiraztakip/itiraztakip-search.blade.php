<table class="table align-middle mb-0 dataTable"  role="grid"
                    aria-describedby="example_info">

                    <tbody>
                        @foreach ($itiraztakip as $itiraztakipitem)
                        <tr>
                            <th scope="row">{{ $startNumber - $loop->index }}</th>
                            <td class="text-wrap" style="max-width:86px">{{ $itiraztakipitem->referansno->basvuru_no }}</td>
                            <td class="text-wrap" style="max-width:80px">{{ $itiraztakipitem->referans_no }}</td>
                            <td class="text-wrap" style="max-width:100px">{{ $itiraztakipitem->bakanlik_karari }}
                            </td>
                            <td>{{ $itiraztakipitem->itiraz_islem }}</td>
                            <td class="text-wrap" style="max-width:170px">{{ $itiraztakipitem->marka_adi }}</td>
                            <td class="text-wrap" style="max-width:170px">{{Str::limit( $itiraztakipitem->firma_adi ,35)}}</td>
                            <td>{{ $itiraztakipitem->musteri_temsilcisi }}</td>
                            <td>{{ $itiraztakipitem->satis_temsilcisi }}</td>
                            <td>{{ $itiraztakipitem->teblig_tarihi }}</td>
                            <td>{{ $itiraztakipitem->teblig_bitis_tarihi }}</td>
                            <td>{{ number_format($itiraztakipitem->ucret, 2, ',', '.') }} <b style="color: red">
                                    ₺</b></td>
                            <td>
                                @if ($itiraztakipitem->itiraz_durum === 'Yapıldı')
                                    <span class="badge bg-success" style="font-size: 12px;"><i
                                            class="fa fa-check"></i></span>
                                @elseif($itiraztakipitem->itiraz_durum === 'İptal')
                                    <span class="badge bg-danger" style="font-size: 12px;"><i
                                            class="fa fa-times"></i></span>
                                @elseif($itiraztakipitem->itiraz_durum === 'Beklemede')
                                    <span class="badge bg-warning" style="font-size: 12px;"><i
                                            class="fa fa-spinner"></i></span>
                                @endif
                            </td>
                            <td>{{ $itiraztakipitem->islem_tarihi }}</td>

                            <td>
                                @if ($itiraztakipitem->itiraz_dosya)
                                    @php
                                        $fileExtension = pathinfo(
                                            $itiraztakipitem->itiraz_dosya,
                                            PATHINFO_EXTENSION,
                                        );
                                    @endphp

                                    @if (strtolower($fileExtension) === 'pdf')
                                        <a href="{{ asset($itiraztakipitem->itiraz_dosya) }}" target="_blank"
                                            style="color: red">
                                            <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                        </a>
                                    @else
                                        <a href="{{ asset($itiraztakipitem->itiraz_dosya) }}" target="_blank">
                                            <i class="bi bi-image"></i> Görüntüle
                                        </a>
                                    @endif
                                @else
                                    <span class="text-muted">Dosya Yok</span>
                                @endif
                            </td>

                            <td class="text-right">
                                <div class="databutton">
                                    <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                                        <a href="{{ route('itiraztakipp.edit', ['itiraztakipp' => $itiraztakipitem->id]) }}"
                                            class=" btn btn-link p-0 m-0 ">
                                            <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                        </a>
                                        <form
                                            action="{{ route('itiraztakipp.destroy', ['itiraztakipp' => $itiraztakipitem->id]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-link  p-0 m-0 show_confirm">
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
