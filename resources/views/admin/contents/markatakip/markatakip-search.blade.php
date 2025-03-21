<table class="table align-middle mb-0 dataTable"  role="grid"
aria-describedby="example_info" >
<tbody>
    @foreach ($markatakip as $markatakipitem)
        <tr>
            <th scope="row">{{ $startNumber - $loop->index }}</th>
            <td>{{ $markatakipitem->islem_tarihi }}</td>
            <td>{{ $markatakipitem->basvuru_tarihi }}</td>
            <td>{{ $markatakipitem->yenileme_tarih }}</td>
            <td>{{ $markatakipitem->referans_no }}</td>
            <td>{{ $markatakipitem->firmaadi->firma_unvan }}</td>
            <td>{{ $markatakipitem->firmaadi->yetkili_kisi_tel }}</td>
            <td>{{ $markatakipitem->marka_adi }}</td>
            <td>{{ $markatakipitem->marka_sinif }}</td>
            <td>{{ $markatakipitem->basvuru_no }}</td>
            <td>{{ $markatakipitem->hizmet->hizmet_ad }}</td>
            <td>{{ $markatakipitem->vkn }}</td>
            <td>{{ $markatakipitem->tc }}</td>
            <td>{{ $markatakipitem->sehir }}</td>
            <td style="text-align: center">
                @if ($markatakipitem->marka_islem === 'Yapıldı')
                <span class="badge bg-success">{{ $markatakipitem->marka_islem }}</span>
                @elseif($markatakipitem->marka_islem === 'Yapılmadı')
                <span class="badge bg-danger">{{ $markatakipitem->marka_islem }}</span>
                @endif
            </td>
            <td style="text-align: center">
                @if ($markatakipitem->marka_durum === 'Tescil Edildi')
                <span class="badge bg-success" style="font-size: 12px;"><i class="fa fa-check"></i></span>
                @elseif($markatakipitem->marka_durum === 'İptal Edildi')
                <span class="badge bg-danger" style="font-size: 12px;"><i class="fa fa-times"></i></span>
                @elseif($markatakipitem->marka_durum === 'Süreç Devam Ediyor')
                <span class="badge bg-warning" style="font-size: 12px;"><i class="fa fa-spinner"></i></span>
                @endif
            </td>
            <td class="text-right">
                <div class="databutton">
                    <div class="d-flex align-items-center fs-6">


                        <button class="text-warning" data-bs-toggle="modal"
                            data-bs-target="#markatakipupdateModal-{{ $markatakipitem->id }}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        {{-- @include('admin.contents.markatakip.markatakip-update') --}}

                        <form
                            action="{{ route('markatakip.destroy', ['markatakip' => $markatakipitem->id]) }}"
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
