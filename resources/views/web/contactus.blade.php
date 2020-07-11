@extends('layouts.template')
@section('title')
    @lang('web_contactus.pagetitle')
@endsection
@section('meta')

@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('web_contactus.pagetitle')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-8">
            <form class="needs-validation" id="formdata" novalidate method="post" action="{{route('contactussave')}}">
                @csrf
                <div class="form-group row">
                    <label for="fullname" class="col-md-2 col-form-label">@lang('web_contactus.fullname')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="@lang('web_contactus.fullname')" required>
                        <div class="invalid-feedback" id="validatealert">
                            @lang('web_contactus.fullnameempty')
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label">@lang('web_contactus.email')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="email" name="email" placeholder="@lang('web_contactus.email')" required>
                        <div class="invalid-feedback">
                            @lang('web_contactus.emailempty')
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-2 col-form-label">@lang('web_contactus.phone')</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="@lang('web_contactus.phone')">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="detail" class="col-md-2 col-form-label">@lang('web_contactus.detail')</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="detail" id="detail" required></textarea>
                        <div class="invalid-feedback">
                            @lang('web_contactus.detailempty')
                        </div>
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
