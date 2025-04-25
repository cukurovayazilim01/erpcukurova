<table class="table table-bordered table-striped" style="width:100%;  "  role="grid"
                    aria-describedby="example_info">

                    <tbody>

                        @foreach ($gelenefatura as $key => $gelenefaturaitem)

                            <tr>
                                <th scope="row">{{ $startNumber - $loop->index }}</th>
                                <td><i class="fa-solid fa-hashtag fa-sm"></i> <b>{{$gelenefaturaitem->fatura_no}}</b><br><span class="badge bg-success">{{$gelenefaturaitem->type_code}}</span> |
                                     @if ($gelenefaturaitem->profile_id == 'TICARIFATURA')
                                     <span class="badge bg-info">{{$gelenefaturaitem->profile_id}}</span></td>
                                @else
                                <span class="badge bg-secondary">{{$gelenefaturaitem->profile_id}}</span></td>

                                @endif
                                <td><b>{{$gelenefaturaitem->sender_name}}</b><br>{{$gelenefaturaitem->sender_vkn_tckn}}</td>
                                <td><b>Fatura: </b>{{$gelenefaturaitem->issue_date}}<br><b>Zarf: </b> </td>
                                <td><b>Toplam: </b>{{number_format($gelenefaturaitem->payable, 2, ',', '.')}} {{$gelenefaturaitem->payable_currency}}<br><b>Vergi:</b>  {{ number_format($gelenefaturaitem->tax_amount, 2, ',', '.') }} {{ $gelenefaturaitem->tax_amount_currency }}  </td>
                                <td class="text-right">
                                    <div class="databutton">
                                        <div class="d-flex align-items-center fs-6">

                                            <a href="javascript:void(0);"
                                            class="text-danger btn btn-link p-0 m-0 openPdfModal"
                                            data-url="{{ route('invoices.pdf', $gelenefaturaitem->uuid ?? '') }}">
                                            <i style="font-size: 18px" class="fa fa-file-pdf"></i>
                                         </a>
                                         @if ($gelenefaturaitem->alis_aktarilma_durum == 'Aktarıldı')
                                         <a  class="btn btn-sm btn-primary  "
                                            style="margin-right: 3px" >Aktarıldı</a>
                                         @else
                                         <a href="{{route('gelenfaturayialisaktar',$gelenefaturaitem->id)}}" class="btn btn-sm btn-outline-success open-modal-btn"
                                            style="margin-right: 3px" >Alışlara Aktar</a>
                                         @endif

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
<!-- PDF Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" src="" style="width: 100%; height: 500px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
                </table>
