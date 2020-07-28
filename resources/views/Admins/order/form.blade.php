@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - ใบสั่งซื้อ
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
    <link href="{{asset('/css/gijgo.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/datatablefix.css')}}" rel="stylesheet">
@endsection
@section('content')
    <?php
    $headertitle = ' - เพิ่ม';
    $linkurl = route('adminordersave');
    if ($mode == 'edit'){
        $headertitle = ' - แก้ไข '.$order->order_no;
        $linkurl = route('adminorderupdate',['id'=>$order->id]);
    }
    if($order->local == 'th'){
        $selfield = 'name_th';
    }else{
        $selfield = 'name_en';
    }
    ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ใบสั่งซื้อ {{$headertitle}}</h1>
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
                    <li class="nav-item">
                        <a class="nav-link" id="product-tab" data-toggle="tab" href="#tab-product" role="tab" aria-controls="tab-product" aria-selected="true">รายการสินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="summary-tab" data-toggle="tab" href="#tab-summary" role="tab" aria-controls="tab-summary" aria-selected="true">สรุปยอด</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- TAB Detail -->
                    <div class="tab-pane active" id="tab-detail" role="tabpanel" aria-labelledby="tab-detail">
                        @include('Admins.order.tabdetail')
                    </div>
                    <!-- TAB Shipping -->
                    <div class="tab-pane" id="tab-shipping" role="tabpanel" aria-labelledby="tab-shipping">
                        @include('Admins.order.tabshipping')
                    </div>
                    <!-- TAB Billing -->
                    <div class="tab-pane" id="tab-billing" role="tabpanel" aria-labelledby="tab-billing">
                        @include('Admins.order.tabbilling')
                    </div>
                    <!-- TAB Product -->
                    <div class="tab-pane" id="tab-product" role="tabpanel" aria-labelledby="tab-product">
                        @include('Admins.order.tabproduct')
                    </div>
                    <!-- TAB Billing -->
                    <div class="tab-pane" id="tab-summary" role="tabpanel" aria-labelledby="tab-summary">

                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-sm" type="submit">บันทึก</button>
                <a href="{{ route('adminorder') }}" class="btn btn-danger btn-sm">ยกเลิก</a>
            </form>
        </div>
    </div>
    {{--Model Product--}}
    <div class="modal" tabindex="-1" role="dialog" id="productmodal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">สินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTableProduct" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ชื่อภาษาไทย</th>
                                            <th>ชื่อภาษาอังกฤษ</th>
                                            <th>Alias</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closemodal('product')">Close</button>
                    <button type="button" class="btn btn-primary" onclick="productsel()">OK</button>
                </div>
            </div>
        </div>
    </div>
    {{--Model Customer--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="customermodal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">สมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTableCustomer" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ</th>
                                            <th>นามสกุล</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closemodal('customer')">Close</button>
                    <button type="button" class="btn btn-primary" onclick="customersel()">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/form-validation.js')}}"></script>
    <script src="{{asset('/js/ckeditor.js')}}"></script>
    <script src="{{asset('/js/dataservice.js')}}"></script>
    <script src="{{asset('/js/gijgo.js')}}"></script>
    <script src="{{asset('/js/address.js')}}"></script>
    <script src="{{asset('/js/orderproduct.js')}}"></script>
    <script src="{{asset('/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">

        @if($mode == 'new')
        var pass = false;
        @else
        var pass = true;
        @endif
        var popup = '';
        var oTableProduct = '';
        urlproduct = '{{route('adminproductlist')}}';
        var oTableCustomer = '';
        urlcustomer = '{{route('admincustomerlist')}}';

        $(function(){
            bindaction();
            $('#shipprovince').change(function () {
                renderAmphure(getAmphure($('#shipprovince').val(),'{{$selfield}}'),'shipamphure','{{$selfield}}');
            })
            $('#shipamphure').change(function () {
                changeShipAmphure();
            })
            $('#billprovince').change(function () {
                renderAmphure(getAmphure($('#billprovince').val(),'{{$selfield}}'),'billamphure','{{$selfield}}');
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
            renderDistrict(getDistrict($('#shipamphure').val(),'{{$selfield}}'),'shipdistrict','{{$selfield}}');
        }

        function changeBillAmphure() {
            renderDistrict(getDistrict($('#billamphure').val(),'{{$selfield}}'),'billdistrict','{{$selfield}}');
        }

        function renderDistrict(result,element,local) {
            $('#'+element).html("");
            $.each(result,function (key, value) {
                $('#'+element).append('<option value="'+value.id+'">'+value[local]+'</option>')
            })
        }

        //datatable for popup
        function openmodalproduct() {
            oTableProduct = $('#dataTableProduct').DataTable({
                "language": {
                    url: '{{asset('/json/thai.json')}}'
                },
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "ajax":{
                    "url": urlproduct,
                    "dataType": "json",
                    "type": "GET"
                },
                "columns": [
                    { "data": "title_th" },
                    { "data": "title_en" },
                    { "data": "alias" }
                ]
            });
            $('#productmodal').modal('show')
            $('#dataTableProduct tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    oTableProduct.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );
        }

        function openmodalcustomer() {
            oTableCustomer = $('#dataTableCustomer').DataTable({
                "language": {
                    url: '{{asset('/json/thai.json')}}'
                },
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "ajax": {
                    "url": urlcustomer,
                    "dataType": "json",
                    "type": "GET"
                },
                "columns": [
                    {"data": "firstname"},
                    {"data": "lastname"},
                    {"data": "email"},
                    {"data": "phone"}
                ]
            });
            $('#customermodal').modal('show')
            $('#dataTableCustomer tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    oTableCustomer.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );
        }

        function closemodal(type) {
            if(type=='product'){
                $('#productmodal').modal('hide')
            }else{
                $('#customermodal').modal('hide')
            }
        }

        $('#productmodal').on('hidden.bs.modal', function (e) {
            oTableProduct.destroy();
        })

        $('#customermodal').on('hidden.bs.modal', function (e) {
            oTableCustomer.destroy();
        })

        function customersel(){
            if(oTableCustomer.rows('.selected').data()[0] != undefined){
                var email = oTableCustomer.rows('.selected').data()[0].email
            }
            closemodal('customer')
        }

        function productsel(){
            if(oTableProduct.rows('.selected').data()[0] != undefined){
                var alias = oTableProduct.rows('.selected').data()[0].alias
            }
            closemodal('product')
        }
    </script>
@endsection
