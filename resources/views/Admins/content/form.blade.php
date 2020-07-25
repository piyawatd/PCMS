@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - บทความ
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
    <link href="{{asset('/css/gijgo.css')}}" rel="stylesheet">
@endsection
@section('content')
    <?php
    $headertitle = ' - เพิ่ม';
    $linkurl = route('admincontentsave');
    if ($mode == 'edit'){
        $headertitle = ' - แก้ไข '.$content->name_th;
        $linkurl = route('admincontentupdate',['id'=>$content->id]);
    }
    ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">บทความ{{$headertitle}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-11">
            <form class="needs-validation" id="formdata" novalidate method="post" action="{{$linkurl}}">
                @csrf
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="config-tab" data-toggle="tab" href="#tab-config" role="tab" aria-controls="tab-config" aria-selected="true">ตั้งค่า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="seo-tab" data-toggle="tab" href="#tab-seo" role="tab" aria-controls="tab-seo" aria-selected="true">SEO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="th-tab" data-toggle="tab" href="#tab-th" role="tab" aria-controls="tab-th" aria-selected="true">ภาษาไทย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#tab-en" role="tab" aria-controls="tab-en" aria-selected="true">ภาษาอังกฤษ</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- TAB TH -->
                    <div class="tab-pane" id="tab-th" role="tabpanel" aria-labelledby="tab-th">
                        @include('Admins.content.tabth')
                    </div>
                    <!-- TAB EN -->
                    <div class="tab-pane" id="tab-en" role="tabpanel" aria-labelledby="tab-en">
                        @include('Admins.content.taben')
                    </div>
                    <div class="tab-pane active" id="tab-config" role="tabpanel" aria-labelledby="tab-config">
                        @include('Admins.content.tabconfig')
                    </div>
                    <div class="tab-pane" id="tab-seo" role="tabpanel" aria-labelledby="tab-seo">
                        @include('Admins.content.tabseo')
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-sm" type="submit">บันทึก</button>
                <a href="{{ route('admincontent') }}" class="btn btn-danger btn-sm">ยกเลิก</a>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/form-validation.js')}}"></script>
    <script src="{{asset('/js/ckeditor.js')}}"></script>
    <script src="{{asset('/js/dataservice.js')}}"></script>
    <script src="{{asset('/js/gijgo.js')}}"></script>
    <script type="text/javascript">

            @if($mode == 'new')
        var pass = false;
            @else
        var pass = true;
        @endif

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
            $( "#publish_date" ).datepicker({
                inline: true,
                uiLibrary: 'bootstrap4',
                format: "dd/mm/yyyy"
            });
            $('#title_th').focusout(function(){
                if($('#title_th').val() != '' && $('#alias').val() == ''){
                    $('#alias').val(replacetext($('#title_th').val()));
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

        function checkalias() {
            var alias = $.trim($('#alias').val());
            if(alias != '')
            {
                if(alias != $('#currentalias').val())
                {
                    $.ajax({
                        url: '{{route('checkcontentalias')}}',
                        method: "GET",
                        cache: false,
                        data: {
                            "value": alias
                        },
                        success:function (result) {
                            if (result.value == true) {
                                $('#alias').addClass('is-invalid');
                                $('#validatealert').text('Alias นี้มีบทความอื่นใช้แล้ว');
                                pass = false;
                            } else {
                                $('#alias').removeClass('is-invalid');
                                $('#validatealert').text('Alias ห้ามว่าง');
                                pass = true;
                            }
                        }
                    });
                }else{
                    $('#alias').removeClass('is-invalid');
                    $('#validatealert').text('Alias ห้ามว่าง');
                    pass = true;
                }
            }
        }

        function addThumb() {
            window.open("{{route('elbrowse')}}?type=images&folder=thumbnail", "_blank", "toolbar=no,scrollbars=no,resizable=no,top=200,left=200,width=800,height=410");
        }

        function deletethumb() {
            $('#file-show').addClass('d-none');
            $('#delthumb').addClass('d-none');
            $('#thumbnail').val('');
        }

        function processFile(file){
            $('#imageShow').attr('src',file);
            $('#file-show').removeClass('d-none');
            $('#delthumb').removeClass('d-none');
            $('#thumbnail').val(file);
        }
    </script>
@endsection
