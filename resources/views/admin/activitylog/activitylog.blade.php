@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('title')
    Loglar
@endsection
@extends('admin.adminlayouts.adminapp')
@section('contents')
    <div class="content-wrapper">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Loglar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><b>#</b></th>
                            <th>DEĞİŞİM</th>
                            <th>İŞLEM</th>
                            <th>KULLANICI ADI</th>
                            <th>ZAMAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loglar as $numara => $loglaritem)
                            <tr>
                                <th scope="row">{{ $numara + 1 }}</th>
                                    <td>{{$loglaritem->properties}}</td>
                                    <td>{{ $loglaritem->description }}</td>
                                    <td>{{ $loglaritem->user ? $loglaritem->user->username : '' }}</td>
                                    
                                    <td><b>{{ $loglaritem->updated_at->diffForHumans() }}</b></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
@endsection

@section('script')
    <!-- Datatables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('vendor/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendor/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendor/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $("#example").DataTable({
            "responsive": true,
            "lengthChange": true,
            "pageLength": 100,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            "autoWidth": false,
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            language: {
                url: " {{ asset('vendor/tr.json') }} "
            },
            buttons: [{
                    extend: 'copyHtml5',
                    className: 'btn btn-primary',
                    text: '<i class="fa fa-copy"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print" aria-hidden="true"></i>',
                    className: 'btn btn-warning',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
            ]
        });
    </script>
@endsection
