<table class="table align-middle mb-0" >
    <tbody>
        @foreach ($personel as $sn => $personelitem)
            <tr>
                <th scope="row">{{ $sn + 1 }}</th>
                <td>{{ $personelitem->ad_soyad }}</td>
                <td>{{ $personelitem->meslegi }}</td>
                <td>{{ $personelitem->tc }} </td>
                <td>{{ $personelitem->sigorta_sicil_no }} </td>
                <td>{{ $personelitem->dogum_yeri }} </td>
                <td>{{ $personelitem->dogum_tarihi }} </td>
                <td>{{ $personelitem->ise_giris_tarihi }} </td>
                <td>{{ $personelitem->beden }} </td>
                <td>{{ $personelitem->ayak_no }} </td>
                <td>{{ $personelitem->acil_durum_kisi }} </td>
                <td>{{ $personelitem->ev_adresi }} </td>
                <td>{{ $personelitem->gsm }} </td>
                <td>{{ $personelitem->kan_grubu }} </td>

            </tr>
        @endforeach
    </tbody>
</table>