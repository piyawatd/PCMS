@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - Gallery {{$content->title_th}}
@endsection
@section('stylesheet')
    <link href="{{asset('/css/sorttheme.css')}}" rel="stylesheet">
    <style type="text/css">
        .top-gallery {
            margin-bottom: 15px;
        }
        .thumbnail img {
            width: 242px;
            height: 200px;
        }
    </style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gallery {{$content->title_th}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-11">
            <form class="needs-validation" id="formdata" novalidate method="post" action="{{ route('admincontentgalleryupdate',$content->id) }}">
                @csrf
                <div class="row top-gallery justify-content-between">
                    <div class="col-2">
                        <a href="javascript:addGallery();" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                              <i class="fas fa-images"></i>
                            </span>
                            <span class="text">เพิ่มรูป</span>
                        </a>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                              <i class="fas fa-save"></i>
                            </span>
                            <span class="text">บันทึก</span>
                        </button>
                        <a href="{{route('admincontent')}}" class="btn btn-danger btn-sm">
                            ยกเลิก
                        </a>
                    </div>
                </div>
                <div class="row" id="showgallery">
                    @foreach ($gallery as $item)
                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <img src="{{ $item->image }}">
                                <div class="caption">
                                    <a href="javascript:void(0);" class="btn btn-danger delgallery" role="button">Delete</a>
                                    <input type="hidden" name="image[]" value="{{ $item->image }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/Sortable.min.js')}}"></script>
    <script type="text/javascript">
        var swapDemo = document.getElementById('showgallery');

        new Sortable(swapDemo, {
            swap: true,
            swapClass: 'highlight',
            animation: 150
        });

        $(function(){
            bliddelete();
        });

        function addGallery() {
            window.open("{{route('elbrowse')}}?type=images&folder=gallery", "_blank", "toolbar=no,scrollbars=no,resizable=no,top=200,left=200,width=800,height=410");
        }

        function processFile(file){
            var text = '<div class="col-sm-4">';
            text += '<div class="thumbnail">';
            text += '<img src="'+file+'">';
            text += '<div class="caption">';
            text += '<a href="javascript:void(0);" class="btn btn-danger delgallery" role="button">Delete</a>';
            text += '<input type="hidden" name="image[]" value="'+file+'">';
            text += '</div></div></div>';
            $('#showgallery').append(text);
            $( ".delgallery").unbind( "click" );
            bliddelete();
        }

        function bliddelete(){
            $('.delgallery').click(function () {
                $(this).parent().parent().parent().remove();
            });
        }
    </script>
@endsection
