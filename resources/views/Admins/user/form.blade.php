@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - User
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
@endsection
@section('content')
    <?php
    $headertitle = ' - เพิ่ม';
    $linkurl = route('usercreate');
    if ($mode == 'edit'){
        $headertitle = ' - แก้ไข '.$user->username;
        $linkurl = route('userupdate',['id'=>$user->id]);
    }
    ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User{{$headertitle}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-8">
            <form class="needs-validation" id="formdata" novalidate method="post" action="{{$linkurl}}">
                @csrf
                <div class="form-group row">
                    <label for="username" class="col-md-2 col-form-label">Username</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$user->username}}" required>
                        <small id="usernameHelpBlock" class="form-text text-muted">
                            Username ความยาวขั้นต่ำ 5 ตัวอักษร เฉพาะภาษาอังกฤษตัวอักษรตัวใหญ่ ตัวเล็ก ตัวเลข และ _
                        </small>
                        <div class="invalid-feedback" id="validateusername">
                            Username ห้ามว่าง
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-2 col-form-label">Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Password ความยาวขั้นต่ำ 5 ตัวอักษร และ ต้องมีตัวอักษรตัวใหญ่ 1 ตัว ตัวเล็ก 1 ตัว ตัวเลข 1 ตัว เฉพาะภาษาอังกฤษ
                        </small>
                        <div class="invalid-feedback" id="validatepassword">
                            Password ห้ามว่าง
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label">Email</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" required>
                        <div class="invalid-feedback" id="validateemail">
                            Valid Email is required.
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$user->name}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role" id="role" class="form-control">
                            <option value="saadmin" @if($user->role == 'saadmin') selected="selected" @endif>Sa Admin</option>
                            <option value="admin" @if($user->role == 'admin') selected="selected" @endif>Admin</option>
                            <option value="staff" @if($user->role == 'staff') selected="selected" @endif>Staff</option>
                        </select>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg" type="submit">Save</button>
                <a href="{{ route('userindex') }}" class="btn btn-danger btn-lg">Cancel</a>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/form-validation.js')}}"></script>
    <script src="{{asset('/js/dataservice.js')}}"></script>
    <script type="text/javascript">

        @if($mode == 'new')
            var pass = false;
            var mode = 'new';
        @else
            var pass = true;
            var mode = 'edit';
        @endif

        $(function(){
            $('#username').focusout(function(){
                var username = $.trim($('#username').val());
                if(checkusername(username)){
                    pass = true;
                    $('#username').addClass('is-valid');
                    $('#validateusername').text('Username ห้ามว่าง');
                }else{
                    pass = false;
                    $('#username').addClass('is-invalid');
                    $('#validateusername').text('Username ใส่ได้เฉพาะอักษร a - z A - Z 0 - 9 และ _');
                }
            });
            $('#password').focusout(function(){
                var password = $.trim($('#password').val());
                if(mode == 'new'){
                    if(checkpassword(password)){
                        pass = true;
                        $('#password').addClass('is-valid');
                        $('#validatepassword').text('Password ห้ามว่าง');
                    }else{
                        pass = false;
                        $('#password').addClass('is-invalid');
                        $('#validatepassword').text('Password ความยาวขั้นต่ำ 5 ตัวอักษร และ ต้องมีตัวอักษรตัวใหญ่ 1 ตัว ตัวเล็ก 1 ตัว ตัวเลข 1 ตัว เฉพาะภาษาอังกฤษ');
                    }
                }else{
                    if(password.length > 0){
                        if(checkpassword(password)){
                            pass = true;
                            $('#password').addClass('is-valid');
                            $('#validatepassword').text('Password ห้ามว่าง');
                        }else{
                            pass = false;
                            $('#password').addClass('is-invalid');
                            $('#validatepassword').text('Password ความยาวขั้นต่ำ 5 ตัวอักษร และ ต้องมีตัวอักษรตัวใหญ่ 1 ตัว ตัวเล็ก 1 ตัว ตัวเลข 1 ตัว เฉพาะภาษาอังกฤษ');
                        }
                    }else{
                        $('#password').removeClass('is-invalid');
                        pass = true;
                    }
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
                        url: '{{route('checkcategoryalias')}}',
                        method: "GET",
                        cache: false,
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content'),
                            "value": alias
                        },
                        success:function (result) {
                            if (result.value == true) {
                                $('#alias').addClass('is-invalid');
                                $('#validatealert').text('Alias is have use to other category.');
                                pass = false;
                            } else {
                                $('#alias').removeClass('is-invalid');
                                $('#validatealert').text('Valid Alias is required.');
                                pass = true;
                            }
                        }
                    });
                }else{
                    $('#alias').removeClass('is-invalid');
                    $('#validatealert').text('Valid Alias is required.');
                    pass = true;
                }
            }
        }
    </script>
@endsection
