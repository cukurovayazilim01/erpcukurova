<table class="table align-middle mb-0 dataTable"  role="grid"
                        aria-describedby="example_info" >
                        <tbody>
                             @foreach ($tescilnoksan as $tescilnoksanitem)
                                <tr>
                                    <th scope="row">{{ $startNumber - $loop->index }}</th>
                                    <td>{{ $tescilnoksanitem->referansno->basvuru_no }}</td>
                                    <td>{{ $tescilnoksanitem->referans_no }}</td>
                                    <td>{{ $tescilnoksanitem->marka_adi }}</td>
                                    <td>{{ $tescilnoksanitem->firma_adi }}</td>
                                    <td>{{ $tescilnoksanitem->musteri_temsilcisi }}</td>
                                    <td>{{ $tescilnoksanitem->satis_temsilcisi }}</td>
                                    <td>{{ $tescilnoksanitem->teblig_tarihi }}</td>
                                    <td>{{ $tescilnoksanitem->teblig_bitis_tarihi }}</td>
                                    <td>@if ($tescilnoksanitem->tn_durum === 'Yapıldı')
                                        <span class="badge bg-success">{{ $tescilnoksanitem->tn_durum }}</span>
                                        @elseif($tescilnoksanitem->tn_durum === 'Yapılmadı')
                                        <span class="badge bg-danger">{{ $tescilnoksanitem->tn_durum }}</span>
                                        @elseif ($tescilnoksanitem->tn_durum === 'Beklemede')
                                        <span class="badge bg-warning">{{ $tescilnoksanitem->tn_durum }}</span>
                                        @else
                                        {{ $tescilnoksanitem->tn_durum }}
                                        @endif
                                    </td>
                                    <td>{{ $tescilnoksanitem->islem_tarihi }}</td>

                                    <td>
                                        @if ($tescilnoksanitem->itiraz_dosya)
                                        @php
                                            $fileExtension = pathinfo($tescilnoksanitem->itiraz_dosya, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (strtolower($fileExtension) === 'pdf')
                                            <a href="{{ asset($tescilnoksanitem->itiraz_dosya) }}" target="_blank" style="color: red">
                                                <i class="bi bi-file-earmark-pdf" style="color: red;"></i> Görüntüle
                                            </a>
                                        @else
                                            <a href="{{ asset($tescilnoksanitem->itiraz_dosya) }}" target="_blank">
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


                                                <a href="{{ route('tescilnoksan.edit', ['tescilnoksan' => $tescilnoksanitem->id]) }}"
                                                    class="text-warning btn btn-link p-0 m-0 ">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form
                                                    action="{{ route('tescilnoksan.destroy', ['tescilnoksan' => $tescilnoksanitem->id]) }}"
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
