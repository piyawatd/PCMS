@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - รายการสั่งสินค้า
@endsection
@section('stylesheet')
    <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">รายการสั่งสินค้า</h1>
        <a href="{{ route('adminordernew') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
            <span class="text">เพิ่ม</span>
        </a>


    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>รหัสสั่งสินค้า</th>
                    <th>วันเวลาที่สั่ง</th>
                    <th>ชื่อลูกค้า</th>
                    <th>จำนวนเงิน</th>
                    <th class="col-md-2"></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        var oTable = '';
        $(document).ready(function () {
            createtable();
        });

        function createtable(){
            oTable = $('#dataTable').DataTable({
                "language": {
                    url: '{{asset('/json/thai.json')}}'
                },
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "ajax":{
                    "url": "{{ route('adminorderlist') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "order_no" },
                    { "data": "order_date" },
                    { "data": "customername" },
                    { "data": "grand_total" },
                    { "data": "options","orderable": false }
                ]
            });
        }

        function clearall()
        {
            oTable.destroy();
            createtable();
        }

        function publishitem(id,title) {
            $.confirm({
                title: 'Confirm!',
                content: title,
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: "PUT",
                            url: "{{ url('admins/order/publish') }}/"+id,
                            dataType:"json",
                            data:{ _token: "{{csrf_token()}}" },
                            success: function(response){
                                if(response.result == true)
                                {
                                    $.alert('อัพเดทสำเร็จ');
                                    clearall();
                                }
                            }
                        });
                    },
                    cancel:{
                        btnClass: 'btn-red',
                        action: function () {

                        }
                    }
                }
            });
        }

        function deleteitem(id,title) {
            $.confirm({
                title: 'Confirm Delete!',
                content: "ต้องการลบ "+title+" ?",
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('admins/order/delete') }}/"+id,
                            dataType:"json",
                            data:{ _token: "{{csrf_token()}}" },
                            success: function(response){
                                if(response.result == true)
                                {
                                    $.alert('ลบสำเร็จ');
                                    clearall();
                                }else{
                                    $.alert('ไม่สามารถลบได้');
                                }
                            }
                        });
                    },
                    cancel:{
                        btnClass: 'btn-red',
                        action: function () {

                        }
                    }
                }
            });
        }
    </script>
@endsection
