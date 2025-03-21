<table class="table align-middle mb-0 dataTable">
    <tbody>
        @foreach ($aktiflog as $aktiflogitem)
            <tr>
                <th scope="row">{{ $startNumber - $loop->index }}</th>
                <td>{{ $aktiflogitem->islem_tarihi }}</td>
                <td>{{ $aktiflogitem->adsoyad->ad_soyad }}</td>
                <td>{{ $aktiflogitem->islem }}</td>
                <td>{{ $aktiflogitem->guncellenmis_islem }}</td>


            </tr>
        @endforeach
    </tbody>
</table>
