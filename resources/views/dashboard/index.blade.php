@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('main.dashboard')</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="d-flex no-block align-items-center m-b-10">
                            <h4 class="card-title">@lang('main.department_and_users')</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="file_export" class="table bg-white table-bordered nowrap display">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>@lang('main.logo')</th>
                                    <th>@lang('main.department_name')</th>
                                    <th>@lang('main.department_users')</th>
                                    <th>@lang('main.created_at')</th>
                                    <th>@lang('main.actions')</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($departments as $department)
                                        <td>{{$department->id}}</td>
                                        <td>
                                            @isset($department->logo)
                                                <img src="{{asset($department->logo)}}" style="width:60px">
                                            @endisset
                                        </td>
                                        <td>
                                            {{$department->name}}
                                        </td>
                                        <td class="text-left">
                                            @if(!$department->users->isEmpty())
                                                @foreach($department->users as $user)
                                                    <a href="{{route('dashboard.users.edit',$user)}}"> {{$user->name}} <small> {{$user->email}}</small> </a><br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="text-center">{{\Carbon\Carbon::parse($department->created_at)->format('d.m.Y')}}</td>

                                        <td class="text-center">
                                            <form action="{{route('dashboard.departments.destroy', $department)}}"
                                                  class="delete_department"
                                                  method="POST">
                                                @csrf
                                                @method('delete')

                                                <a href="{{route('dashboard.departments.edit', $department)}}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="submit"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline delete_user"
                                                        data-toggle="tooltip" data-original-title="Delete">
                                                    <i class="ti-close" aria-hidden="true"></i>
                                                </button>

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
