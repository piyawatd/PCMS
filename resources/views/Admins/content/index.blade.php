@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - บทความ
@endsection
@section('stylesheet')
    <link href="{{asset('/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">บทความ</h1>
        <a href="{{ route('admincontentnew') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
            <span class="text">เพิ่ม</span>
        </a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <form>
            <div class="form-group row">
                <label for="category" class="col-md-4 col-form-label">หมวด</label>
                <div class="col-md-8">
                    <select class="form-control" id="category" name="category">
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name_th }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th class="col-md-3">ชื่อภาษาไทย</th>
                    <th class="col-md-3">ชื่อภาษาอังกฤษ</th>
                    <th class="col-md-3">Alias</th>
                    <th class="col-md-1">Publish</th>
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
            $('#category').change(function(){
                clearall();
            })
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
                    "url": "{{ route('admincontentlist') }}?category="+$('#category').val(),
                    "dataType": "json",
                    "type": "GET",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "title_th" },
                    { "data": "title_en" },
                    { "data": "alias" },
                    { "data": "publish" , "sClass": "dt-center"},
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
                            url: "{{ url('admins/content/publish') }}/"+id,
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
                            url: "{{ url('admins/content/delete') }}/"+id,
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
