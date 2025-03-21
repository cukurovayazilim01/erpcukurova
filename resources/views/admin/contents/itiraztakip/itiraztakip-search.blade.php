<table class="table align-middle mb-0 dataTable"  role="grid"
                    aria-describedby="example_info">

                    <tbody>
                        @foreach ($itiraztakip as $itiraztakipitem)
                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td>{{ $itiraztakipitem->referansno->basvuru_no }}</td>
                                <td>{{ $itiraztakipitem->referans_no }}</td>
                                <td>{{ $itiraztakipitem->bakanlik_karari }}</td>
                                <td>{{ $itiraztakipitem->itiraz_islem }}</td>
                                <td>{{ $itiraztakipitem->marka_adi }}</td>
                                <td>{{ $itiraztakipitem->firma_adi }}</td>
                                <td>{{ $itiraztakipitem->musteri_temsilcisi }}</td>
                                <td>{{ $itiraztakipitem->satis_temsilcisi }}</td>
                                <td>{{ $itiraztakipitem->teblig_tarihi }}</td>
                                <td>{{ $itiraztakipitem->teblig_bitis_tarihi }}</td>
                                <td>{{ number_format($itiraztakipitem->ucret, 2, ',', '.') }} <b style="color: red">
                                        ₺</b></td>
                                <td>
                                    @if ($itiraztakipitem->itiraz_durum === 'Yapıldı')
                                    <span class="badge bg-success" style="font-size: 12px;"><i class="fa fa-check"></i></span>
                                    @elseif($itiraztakipitem->itiraz_durum === 'İptal')
                                    <span class="badge bg-danger" style="font-size: 12px;"><i class="fa fa-times"></i></span>
                                    @elseif($itiraztakipitem->itiraz_durum === 'Beklemede')
                                    <span class="badge bg-warning" style="font-size: 12px;"><i class="fa fa-spinner"></i></span>
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
                                        <div class="d-flex align-items-center fs-6">


                                            <a href="{{ route('itiraztakipp.edit', ['itiraztakipp' => $itiraztakipitem->id]) }}"
                                                class="text-warning btn btn-link p-0 m-0 ">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form
                                                action="{{ route('itiraztakipp.destroy', ['itiraztakipp' => $itiraztakipitem->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger p-0 m-0 show_confirm">
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
