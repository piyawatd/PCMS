@extends('Admins.layouts.template')
@section('title')
    Admin - User
@endsection
@section('stylesheet')
    <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <a href="{{ route('usernew') }}" class="btn btn-primary btn-icon-split btn-sm">
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
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
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
            // var customer = $('#customer').val();
            oTable = $('#dataTable').DataTable({
                "language": {
                    url: '{{asset('/json/thai.json')}}'
                },
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "ajax":{
                    "url": "{{ route('userlist') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "username" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "role" },
                    { "data": "options","orderable": false }
                ]
            });
        }

        function clearall()
        {
            oTable.destroy();
            createtable();
        }

        function deleteitem(id,title) {
            $.confirm({
                title: 'Confirm Delete!',
                content: "ต้องการลบ "+title+" ?",
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('admins/customer/delete') }}/"+id,
                            dataType:"json",
                            success: function(response){
                                if(response.result == true)
                                {
                                    $.alert('ลบสำเร็จ');
                                    clearall();
                                }else{
                                    $.alert('มีสินค้าในหมวดนี้ ไม่สามารถลบได้');
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
