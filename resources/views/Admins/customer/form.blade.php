@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - สมาชิก
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
    <link href="{{asset('/css/gijgo.css')}}" rel="stylesheet">
    type="text/css" />
@endsection
@section('content')
    <?php
    $headertitle = ' - เพิ่ม';
    $linkurl = route('admincustomersave');
    if ($mode == 'edit'){
        $headertitle = ' - แก้ไข '.$customer->firstname.' '.$customer->lastname;
        $linkurl = route('admincustomerupdate',['id'=>$customer->id]);
    }
    if($customer->local == 'th'){
        $selfield = 'name_th';
    }else{
        $selfield = 'name_en';
    }
    ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">สมาชิก {{$headertitle}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-11">
            <form class="needs-validation" id="formdata" novalidate method="post" action="{{$linkurl}}">
                @csrf
                <input type="hidden" id="local" name="local" value="{{$selfield}}">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#tab-detail" role="tab" aria-controls="tab-detail" aria-selected="true">ข้อมูลทั่วไป</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#tab-shipping" role="tab" aria-controls="tab-shipping" aria-selected="true">ที่อยู่ที่จัดส่ง</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="billing-tab" data-toggle="tab" href="#tab-billing" role="tab" aria-controls="tab-billing" aria-selected="true">ที่อยู่ออกใบเสร็จ</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- TAB Detail -->
                    <div class="tab-pane active" id="tab-detail" role="tabpanel" aria-labelledby="tab-detail">
                        @include('Admins.customer.tabdetail')
                    </div>
                    <!-- TAB Shipping -->
                    <div class="tab-pane" id="tab-shipping" role="tabpanel" aria-labelledby="tab-shipping">
                        @include('Admins.customer.tabshipping')
                    </div>
                    <!-- TAB Billing -->
                    <div class="tab-pane" id="tab-billing" role="tabpanel" aria-labelledby="tab-billing">
                        @include('Admins.customer.tabbilling')
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-sm" type="submit">บันทึก</button>
                <a href="{{ route('admincustomer') }}" class="btn btn-danger btn-sm">ยกเลิก</a>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/form-validation.js')}}"></script>
    <script src="{{asset('/js/ckeditor.js')}}"></script>
    <script src="{{asset('/js/dataservice.js')}}"></script>
    <script src="{{asset('/js/gijgo.js')}}"></script>
    <script src="{{asset('/js/address.js')}}"></script>
    <script type="text/javascript">

        @if($mode == 'new')
        var pass = false;
        @else
        var pass = true;
        @endif

        $(function(){
            $('#email').focusout(function(){
                if($('#email').val() != ''){
                    if(isEmail($('#email').val()))
                    {
                        checkemail();
                    }else{
                        $('#email').addClass('is-invalid');
                        $('#validatealert').text('Email ผิดรูปแบบ');
                        pass = false;
                    }
                }
            });
            $('#shipprovince').change(function () {
                getAmphure($('#shipprovince').val(),'{{$selfield}}').then((data)=>renderAmphure(data,'shipamphure','{{$selfield}}'));
            })
            $('#shipamphure').change(function () {
                changeShipAmphure();
            })
            $('#billprovince').change(function () {
                getAmphure($('#billprovince').val(),'{{$selfield}}').then((data)=>renderAmphure(data,'billamphure','{{$selfield}}'));
            })
            $('#billamphure').change(function () {
                changeBillAmphure();
            })
            $('#formdata').submit(function( event ) {
                $('#sprovince').val($('#shipprovince option:selected').text());
                $('#samphure').val($('#shipamphure option:selected').text());
                $('#sdistrict').val($('#shipdistrict option:selected').text());
                $('#bprovince').val($('#billprovince option:selected').text());
                $('#bamphure').val($('#billamphure option:selected').text());
                $('#bdistrict').val($('#billdistrict option:selected').text());
                return pass;
            });
        })

        function renderAmphure(result,element,local) {
            $('#'+element).html("");
            $.each(result,function (key, value) {
                $('#'+element).append('<option value="'+value.id+'">'+value[local]+'</option>')
            })
            if(element == 'shipamphure')
            {
                changeShipAmphure();
            }else{
                changeBillAmphure();
            }
        }

        function changeShipAmphure() {
            getDistrict($('#shipamphure').val(),'{{$selfield}}').then((data)=>renderDistrict(data,'shipdistrict','{{$selfield}}'));
        }

        function changeBillAmphure() {
            getDistrict($('#billamphure').val(),'{{$selfield}}').then((data)=>renderDistrict(data,'billdistrict','{{$selfield}}'));
        }

        function renderDistrict(result,element,local) {
            $('#'+element).html("");
            $.each(result,function (key, value) {
                $('#'+element).append('<option value="'+value.id+'">'+value[local]+'</option>')
            })
        }

        function checkemail() {
            var email = $.trim($('#email').val());
            if(email != '')
            {
                if(email != $('#currentemail').val())
                {
                    $.ajax({
                        url: '{{route('checkcustomeremail')}}',
                        method: "GET",
                        cache: false,
                        data: {
                            "value": email
                        },
                        success:function (result) {
                            if (result.value == true) {
                                $('#email').addClass('is-invalid');
                                $('#validatealert').text('Email นี้มีใช้แล้ว');
                                pass = false;
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#validatealert').text('Email ห้ามว่าง');
                                pass = true;
                            }
                        }
                    });
                }else{
                    $('#email').removeClass('is-invalid');
                    $('#validatealert').text('Email ห้ามว่าง');
                    pass = true;
                }
            }
        }
    </script>
@endsection
