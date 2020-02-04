@extends('layouts.app')

@section('content')

    <div class="row">

        <!-- Column -->
        <div class="col-lg-6 col-xlg-8 col-md-8" style="margin-left:auto; margin-right:auto">
            <div class="card">
                <div class="card-header">
                    @if(isset($department)) @lang('main.user_edit') @else @lang('main.user_create') @endif
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-material"
                          action="@if (!isset($user)) {{route('dashboard.users.store')}} @else {{ route('dashboard.users.update', $user) }} @endif"
                          method="POST">
                        @csrf
                        @if (isset($user)) @method('put') @endif
                        <div class="form-group mb-5">
                            <div class="col-sm-12">
                                <button type="submit"
                                        class="btn btn-success">@if(isset($user)) @lang('main.update_data') @else @lang('main.save_data') @endif</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">@lang('main.full_name')</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="@lang('main.full_name')" required
                                       value="{{old('name',$user->name?? '')}}"
                                       class="form-control form-control-line @error('name') is-invalid @enderror">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-12">@lang('main.email'): <span
                                    class="required">
													* </span></label>
                            <div class="col-md-12">
                                <input type="email"
                                       class="form-control form-control-line @error('email') is-invalid @enderror"
                                       name="email"
                                       placeholder="E-mail" required value="{{old('email',$user->email??'')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-12">@lang('main.password'): <span
                                    class="required">
													* </span></label>
                            <div class="col-md-12">
                                <input type="password"
                                       class="form-control form-control-line @error('password') is-invalid @enderror"
                                       name="password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-12">@lang('main.password_confirm'): <span
                                    class="required">
													* </span></label>
                            <div class="col-md-12">
                                <input type="password"
                                       class="form-control form-control-line @error('password_confirmation') is-invalid @enderror"
                                       name="password_confirmation" >
                            </div>
                        </div>


                        <div class="form-group m-b-30">
                            <label class="mr-sm-2"
                                   for="department_select">@lang('main.departments')</label>
                            <select class="select2 form-control" id="department_select" multiple="multiple" name="description[]"
                                    style="height: 36px;width: 100%;">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}"
                                    @if(isset($user) && in_array($department->id,$user->departments->pluck('id')->toArray()))
                                        @endif>
                                        {{$department->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">@if(isset($user)) Обновить
                                    данные @else Сохранить данные @endif</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- Column -->
    </div>
@endsection


@push('css')

@endpush

@push('js')
    <script src="{{asset('crm')}}/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="{{asset('crm')}}/dist/js/pages/forms/select2/select2.init.js"></script>
@endpush

