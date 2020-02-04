@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('dashboard.users.create')}}"
                           class="btn btn-outline-secondary btn-rounded float-right">
                            @lang('main.add_user')
                        </a>
                        <h4 class="card-title" style="display:inline-block">@lang('main.users')</h4>
                        <h6 class="card-subtitle" style="display:inline-block">@lang('main.manage_users')</h6>
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
                                        @lang('main.full_name')
                                    </th>

                                    <th>
                                        @lang('main.email')
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
                                @foreach($users as $user)

                                    <tr>
                                        <td> {{$user->id}}</td>
                                        <td>
                                            <a href="{{route('dashboard.users.edit', $user)}}"> {{$user->name}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('dashboard.users.edit', $user)}}"> {{$user->email}}</a>
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($user->created_at)->format('d.m.Y')}}</td>
                                        <td>
                                            <form action="{{route('dashboard.users.destroy', $user)}}"
                                                  class="delete_user"
                                                  method="POST">
                                                @csrf
                                                @method('delete')

                                                <a href="{{route('dashboard.users.edit', $user)}}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <button type="submit" class="btn btn-danger btn-sm delete_user"><i
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
            $('body').on('submit', '.delete_user', function (e) {
                e.preventDefault()
                let form = this

                swal({
                    title: "Вы Уверены?",
                    text: "Пользователь будет удален из системы",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Да, удалить!",
                    cancelButtonText: "Нет, я передумал!",
                }, function (isConfirm) {
                }).then((isConfirm) => {
                    if (isConfirm.value) {
                        form.submit();
                        swal("Deleted!", "Пользователь удаляется.", "success");
                    } else {
                        swal("Отменено", "Пользователь спасен :)", "error");
                    }
                });

            });
        })
    </script>
@endpush
