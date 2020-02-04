@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('dashboard.departments.create')}}"
                           class="btn btn-outline-secondary btn-rounded float-right">
                            @lang('main.add_department')
                        </a>
                        <h4 class="card-title" style="display:inline-block">@lang('main.departments')</h4>
                        <h6 class="card-subtitle" style="display:inline-block">@lang('main.manage_departments')</h6>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="file_export" class="table table-striped table-bordered display"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        @lang('main.logo')
                                    </th>
                                    <th>
                                        @lang('main.department_name')
                                    </th>

                                    <th>
                                        @lang('main.registered')
                                    </th>
                                    <th>
                                        @lang('main.actions')
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($departments as $department)

                                    <tr>
                                        <td> {{$department->id}}</td>
                                        <td>
                                            @if($department->logo)
                                                <img src="{{asset($department->logo)}}" style="width:60px"></td>
                                        @endif
                                        <td>
                                            <a href="{{route('dashboard.departments.edit', $department)}}"> {{$department->name}}</a>
                                        </td>

                                        <td>{{\Carbon\Carbon::parse($department->created_at)->format('d.m.Y')}}</td>
                                        <td>
                                            <form action="{{route('dashboard.departments.destroy', $department)}}"
                                                  class="delete_department"
                                                  method="POST">
                                                @csrf
                                                @method('delete')

                                                <a href="{{route('dashboard.departments.edit', $department)}}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button type="submit" class="btn btn-danger btn-sm delete_department"><i
                                                        class="fa fa-times"></i></button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
@push('css')
    <link href="{{asset('crm')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('crm')}}/assets/extra-libs/prism/prism.css">

    <style>
        td, th {
            text-align: center !important;
        }
    </style>
@endpush

@push('js')
    <script src="{{asset('crm')}}/assets/extra-libs/DataTables/datatables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="{{asset('crm')}}/assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/datatables/buttons.flash.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/datatables/jszip.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/datatables/pdfmake.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/datatables/vfs_fonts.js"></script>
    <script src="{{asset('crm')}}/assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/datatables/buttons.print.min.js"></script>
    <script src="{{asset('crm/dist/js/pages/datatable/datatable-advanced.init.js')}}"></script>
    <script src="{{asset('crm')}}/assets/extra-libs/prism/prism.js"></script>
    <script src="{{asset('crm')}}/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/sweetalert2/sweet-alert.init.js"></script>

    <script>
        $(function () {
            $('body').on('submit', '.delete_department', function (e) {
                e.preventDefault()
                let form = this

                swal({
                    title: "@lang('main.are_you_sure')",
                    text: "@lang('main.department_will_be_destroyed')",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "@lang('main.confirm')",
                    cancelButtonText: "@lang('main.cancel')",
                }, function (isConfirm) {
                }).then((isConfirm) => {
                    if (isConfirm.value) {
                        form.submit();
                        swal("@lang('deleted')", "@lang('main.department_is_deleting')", "success");
                    } else {
                        swal("@lang('canceled')", "@lang('main.department_saved') :)", "error");
                    }
                });

            });
        })
    </script>
@endpush
