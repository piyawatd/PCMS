@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - Category
    @if ($mode == 'new')
        SB Admin 2 - Category - เพิ่ม
    @else
        SB Admin 2 - Category - แก้ไข {{$category->name_th}}
    @endif
@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-8">
            <form class="needs-validation" novalidate method="post" action="{{route('admincategorysave')}}">
                @csrf
                <div class="form-group row">
                    <label for="alias" class="col-md-2 col-form-label">Alias</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" value="{{$category->alias}}" required>
                        <div class="invalid-feedback">
                            Valid Alias is required.
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="order_number" class="col-md-2 col-form-label">Order Number</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="order_number" name="order_number" placeholder="0" value="{{$category->order_number}}">
                        <div class="invalid-feedback">
                            Wrong format.
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="th-tab" data-toggle="tab" href="#tab-th" role="tab" aria-controls="tab-th" aria-selected="true">TH</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#tab-en" role="tab" aria-controls="tab-en" aria-selected="true">EN</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- TAB TH -->
                    <div class="tab-pane active" id="tab-th" role="tabpanel" aria-labelledby="tab-th">
                        <div class="form-group row">
                            <label for="name_th" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name_th" name="name_th" placeholder="Name Th" required value="{{$category->name_th}}">
                                <div class="invalid-feedback">
                                    Valid name th is required.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detail_th" class="col-md-2 col-form-label">Detail</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="detail_th" name="detail_th">{{$category->detail_th}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- TAB EN -->
                    <div class="tab-pane" id="tab-en" role="tabpanel" aria-labelledby="tab-en">
                        <div class="form-group row">
                            <label for="name_en" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Name En" value="{{$category->name_en}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="detail_en" class="col-md-2 col-form-label">Detail</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="detail_en" name="detail_en">{{$category->detail_en}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image" class="col-md-2 col-form-label">Image</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="image" name="image" value="{{$category->image}}" readonly>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary btn-sm" onclick="addThumb()">Browse</button>
                        <button type="button" class="btn btn-danger btn-sm d-none" id="delthumb" onclick="deletethumb()">Delete</button>
                    </div>
                    <?php
                    $clssthumb = '';
                    if ($category->image == ''){
                        $clssthumb = 'd-none';
                    }
                    ?>
                    <div class="col-sm-3 {{ $clssthumb }}" id="file-show">
                        <img src="" id="imageShow" style="height: 180px;" class="thumbnail">
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg" type="submit">Save</button>
                <button class="btn btn-danger btn-lg" type="button">Cancel</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/form-validation.js')}}"></script>
    <script src="{{asset('/js/ckeditor.js')}}"></script>
    <script src="{{asset('/js/dataservice.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'detail_th' , {
            height: 400,
            customConfig: "{{asset('/js/config.js')}}",
            contentsCss: '{{asset('/css/web.css')}}',
            filebrowserImageBrowseUrl: '{{ route('ckbrowse') }}'
        });
        CKEDITOR.replace( 'detail_en' , {
            height: 400,
            customConfig: "{{asset('/js/config.js')}}",
            contentsCss: '{{asset('/css/web.css')}}',
            filebrowserImageBrowseUrl: '{{ route('ckbrowse') }}'
        });

        $(function(){
            $('#name_th').focusout(function(){
                if($('#name_th').val() != '' && $('#alias').val() == ''){
                    $('#alias').val(replacetext($('#name_th').val()));
                }
            });
            $('#alias').focusout(function(){
                if($('#alias').val() != ''){
                    $('#alias').val(replacetext($('#alias').val()));
                }
            });
        })

        function addThumb() {
            window.open("{{route('elbrowse')}}?type=images&folder=thumbnail", "_blank", "toolbar=no,scrollbars=no,resizable=no,top=200,left=200,width=800,height=410");
        }

        function deletethumb() {
            $('#file-show').addClass('d-none');
            $('#delthumb').addClass('d-none');
            $('#image').val('');
        }

        function processFile(file){
            $('#imageShow').attr('src',file);
            $('#file-show').removeClass('d-none');
            $('#delthumb').removeClass('d-none');
            $('#image').val(file);
        }
    </script>
@endsection
