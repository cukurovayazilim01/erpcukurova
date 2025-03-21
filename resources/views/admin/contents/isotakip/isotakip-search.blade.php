<table class="table align-middle mb-0 display " >

    <tbody>
        @foreach ($isotakip as $isotakipitem)
            <tr>
                <td>{{ $startNumber - $loop->index }}</td>
                <td>{{ $isotakipitem->basvuru_referans_no }}</td>
                <td>{{ $isotakipitem->belge_tarihi }}</td>
                <td>{{ $isotakipitem->firmaadi->firma_unvan }}</td>
                <td>{{ $isotakipitem->hizmet_adi }}</td>
                <td>{{ $isotakipitem->akreditasyon_kurulusu }}</td>
                <td>{{ $isotakipitem->belgelendirme_kurulusu }}</td>
                <td>{{ $isotakipitem->kapsam }}</td>
                <td>{{ $isotakipitem->musteri_temsilcisi }}</td>
                <td>
                    @if ($isotakipitem->belge)
                        @php $fileExtension = pathinfo($isotakipitem->belge, PATHINFO_EXTENSION); @endphp
                        @if (strtolower($fileExtension) === 'pdf')
                            <a href="{{ asset($isotakipitem->belge) }}" target="_blank" style="color: red">
                                <i class="bi bi-file-earmark-pdf"></i> Görüntüle
                            </a>
                        @else
                            <a href="{{ asset($isotakipitem->belge) }}" target="_blank">
                                <i class="bi bi-image"></i> Görüntüle
                            </a>
                        @endif
                    @else
                        <span class="text-muted">Resim Yok</span>
                    @endif
                </td>
                <td>
                    @if ($isotakipitem->yenileme_durumu === 'Aktif')
                        <span class="badge bg-success">Aktif</span>
                    @elseif($isotakipitem->yenileme_durumu === 'Pasif')
                        <span class="badge bg-danger"><i class="fa fa-times"></i></span>
                    @endif
                </td>
                <td class="text-right">
                    <div class="d-flex align-items-center">
                        <button class="text-warning" data-bs-toggle="modal" data-bs-target="#isotakipupdateModal-{{ $isotakipitem->id }}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        @include('admin.contents.isotakip.isotakip-update')

                        <form action="{{ route('isotakipp.destroy', ['isotakipp' => $isotakipitem->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger show_confirm">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
