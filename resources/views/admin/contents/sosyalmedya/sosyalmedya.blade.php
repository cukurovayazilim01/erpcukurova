@extends('admin.layouts.app')
@section('title')
Sosyal Medya
@endsection
@section('contents')
@section('topheader')
Sosyal Medya
@endsection
<div class="card radius-5">
    <div class="card-header bg-transparent">
        <div class="row ">

            <div class="d-flex align-items-center justify-content-between gap-1 mobile-erp">

                <div class="col-lg-4 ms-auto mobile-erp3 text-end">
                    <a type="button" href="{{ route('sosyalmedya.create') }}"
                    class="btn btn-outline-dark btn-sm "><i class="fa-solid fa-plus"></i>Yeni Ekle</a>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->


    <div class="card-body" style="border-radius: 5px">
        <div class="table-responsive" style="border-radius: 5px">
            <table class="table table-bordered table-hover" style="width:100%;" id="example2">
                <thead >
                    <tr>
                        <th scope="col">#</th>
                        <th>Gönderi Adı</th>
                        <th>Gönderi Tarihi</th>
                        <th>Gödneri Yeri</th>

                        <th>Aksiyon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sosyalmedya as $sn => $sosyalmedyaitem)
                    <tr>
                        <td scope="row">{{ $sn + 1 }}</td>
                        <td>
                            {{$sosyalmedyaitem->gonderi_adi}}
                        </td>
                        <td>{{ $sosyalmedyaitem->gonderi_zamani }}</td>
                        <td>{{ $sosyalmedyaitem->gonderi_yeri }}</td>



                        <td class="text-right">
                            <div class="databutton">
                                <div class="d-flex align-items-center fs-6" style="justify-content: space-evenly; ">


                                    <a href="{{ route('sosyalmedya.show', ['sosyalmedya' => $sosyalmedyaitem->id]) }}"
                                        class=" btn btn-link p-0 m-0 " target="_blank">
                                        <i style="color:#293445;  "
                                        class="fa-solid fa-wand-magic-sparkles fs-6"></i>
                                    </a>
                                    <a href="{{ route('sosyalmedya.edit', ['sosyalmedya' => $sosyalmedyaitem->id]) }}"
                                        class=" btn  p-0 m-0 ">
                                        <i style="color:#293445" class="fa-solid fa-pen-to-square fs-6"></i>
                                    </a>

                                    <form
                                        action="{{ route('sosyalmedya.destroy', ['sosyalmedya' => $sosyalmedyaitem->id]) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn  p-0 m-0 show_confirm">
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
        </div>
    </div>
</div>
@include('session.session')




@endsection
