@extends('layouts.template')
@section('title')
    @lang('web_register.pagetitle')
@endsection
@section('meta')

@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('web_register.pagetitle')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-8">
            <form class="needs-validation" id="formdata" novalidate method="post" action="{{route('signupsave')}}">
                @csrf
                <div class="form-group row">
                    <label for="username" class="col-md-2 col-form-label">@lang('web_register.username')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="@lang('web_register.username')" required>
                        <div class="invalid-feedback" id="validateusername">
                            @lang('web_register.usernameempty')
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-2 col-form-label">@lang('web_register.password')</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="@lang('web_register.password')" required>
                        <div class="invalid-feedback" id="validatepassword">
                            @lang('web_register.password')
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="firstname" class="col-md-2 col-form-label">@lang('web_register.firstname')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="@lang('web_register.firstname')" required>
                        <div class="invalid-feedback">
                            @lang('web_register.firstnameempty')
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lastname" class="col-md-2 col-form-label">@lang('web_register.lastname')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="@lang('web_register.lastname')" required>
                        <div class="invalid-feedback">
                            @lang('web_register.lastnameempty')
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label">@lang('web_register.email')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="@lang('web_register.email')" required>
                        <div class="invalid-feedback" id="validateemail">
                            @lang('web_register.emailempty')
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-2 col-form-label">@lang('web_register.phone')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="@lang('web_register.phone')">
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-sm" type="submit">@lang('web.save')</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/form-validation.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('#name_th').focusout(function(){
                if($('#name_th').val() != '' && $('#alias').val() == ''){
                    $('#alias').val(replacetext($('#name_th').val()));
                    checkalias();
                }
            });
            $('#alias').focusout(function(){
                if($('#alias').val() != ''){
                    $('#alias').val(replacetext($('#alias').val()));
                    checkalias();
                }
            });
            $('#formdata').submit(function( event ) {
                return pass;
            });
        })
    </script>
@endsection
