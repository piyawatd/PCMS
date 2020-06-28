@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - หมวดบทความ
@endsection
@section('stylesheet')
    <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">หมวดบทความ</h1>
        <a href="{{ route('admincategorycontentnew') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
            <span class="text">เพิ่ม</span>
        </a>


    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ชื่อภาษาไทย</th>
                        <th>ชื่อภาษาอังกฤษ</th>
                        <th>Alias</th>
                        <th>ลำดับ</th>
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
                    "url": "{{ route('admincategorycontentlist') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "name_th" },
                    { "data": "name_en" },
                    { "data": "alias" },
                    { "data": "order_number" },
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
            var r = confirm("ต้องการลบ "+title+"?");
            if (r == true) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('admins/categorycontent/delete') }}/"+id,
                    dataType:"json",
                    data:{ _token: "{{csrf_token()}}" },
                    success: function(response){
                        if(response.result == true)
                        {
                            alert('ลบสำเร็จ');
                            clearall();
                        }else{
                            alert('มีบทความในหมวดนี้ ไม่สามารถลบได้');
                        }
                    }
                });
            }
        }
    </script>
@endsection
