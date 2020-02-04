@extends('layouts.app')



@section('content')

    <div class="row">

        <!-- Column -->
        <div class="col-lg-6 col-xlg-8 col-md-8" style="margin-left:auto; margin-right:auto">
            <div class="card">
                <div class="card-header">
                    @if(isset($department)) @lang('main.department_edit') @else @lang('main.department_create') @endif
                </div>

                <div class="card-body">
                    <form class="form-horizontal form-material" enctype="multipart/form-data"
                          action="@if (!isset($department)) {{route('dashboard.departments.store')}} @else {{ route('dashboard.departments.update', $department) }} @endif"
                          method="POST">
                        @csrf
                        @if (isset($department)) @method('put') @endif

                        <div class="form-group">
                            <label class="col-md-12">@lang('main.department_name')</label>
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="@lang('main.department_name')" required
                                       value="{{old('name',$department->name?? '')}}"
                                       class="form-control form-control-line @error('name') is-invalid @enderror">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-12">@lang('main.description')</label>
                            <div class="col-md-12">
                                        <textarea
                                            class="form-control form-control-line @error('description') is-invalid @enderror"
                                            name="description" id="description"
                                            placeholder="@lang('main.description')">{{old('description',$department->description??'')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">@lang('main.logo')</label>
                            <div class="col-md-12">
                                <input type="file" name="logo" placeholder="@lang('main.logo')" @if(!isset($department)) required @endif
                                       class="form-control form-control-line @error('logo') is-invalid @enderror">
                            </div>

                        </div>


                        <div class="form-group ">
                            <label class="col-md-12" for="inlineFormCustomSelect">@lang('main.users')</label>
                            <select class="custom-select select2" id="inlineFormCustomSelect" name="users[]"
                                    multiple="multiple">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}"
                                            @if(isset($department) && in_array($user->id,$department->users->pluck('id')->toArray())) selected
                                        @endif>
                                        {{$user->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group mt-5">
                            <div class="col-sm-12">
                                <button type="submit"
                                        class="btn btn-success">@if(isset($department)) @lang('main.update_data') @else @lang('main.save_data') @endif</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')

@endpush

@push('js')
    <script src="{{asset('crm')}}/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="{{asset('crm')}}/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="{{asset('crm')}}/dist/js/pages/forms/select2/select2.init.js"></script>
@endpush
