<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('/assets/vendor/fontawesome-free/css/all.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/assets/css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admins.layouts.inc-sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admins.layouts.inc-navbar')
            <!-- End of Topbar -->

<!--            Form-->
            <div class="container" id="app">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">File Upload</div>
                            <div class="card-body">
<!--                                <img src="{{asset('/upload')}}/KqJ5.png">-->
                                <form method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="logo" />
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Upload') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--            End Form-->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('/assets/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset('/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('/assets/vendor/jquery-easing/jquery.easing.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('/assets/js/sb-admin-2.js')}}"></script>
</body>

</html>
