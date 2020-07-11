<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Piyawat Damrongsuphakit">

    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    @yield('meta')
    @include('layouts.inc-stylesheet')
    @yield('stylesheet')
</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
        @include('layouts.inc-navbar')
        <!-- End of Topbar -->
            <!-- Message -->
                @if ($message = Session::get('success'))
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 align-self-center">
                                <div class="alert alert-success" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            <!-- End of Message -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
</div>
<!-- End of Page Wrapper -->
@include('layouts.inc-scripts')
@yield('scripts')
<script type="text/javascript">
    loadCart();
    activeCart();

    function changeLanguage(language) {
        $.ajax({
            url:'/lang/'+language,
            method:"GET",
            success:function(result){
                location.reload()
            }
        })
    }

    function activeCart() {
        $('#cartDropdown').hover(function () {
            $('#viewcart').show();
        }, function () {
            $('#viewcart').hide();
        })
        $('#viewcart').hover(function () {
            $('#viewcart').show();
        }, function () {
            $('#viewcart').hide();
        })
    }

    function loadCart() {
        $('#viewcart').html('');
        $.ajax({
            url: '{{ route('viewcart') }}',
            method: "GET",
            success: function (response) {
                // console.log(response.total)
                if (response.cart.length > 0) {
                    $('#numberItemCart').text(response.cart.length);
                    $('#viewcart').append('<h6 class="dropdown-header">Cart</h6>');
                }else{
                    $('#numberItemCart').text('0');
                }
                $.each(response.cart, function (key, value) {
                    // console.log(value.id)
                    // console.log(value.title)
                    // console.log(value.quantity)
                    // console.log(value.price)
                    // console.log(value.thumbnail)
                    // console.log(value.total)
                    var strcart = '<a class="dropdown-item d-flex align-items-center" href="#">\n' +
                        '<div class="dropdown-list-image col-md-2">' +
                        '<img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"></div>'+
                        '<div class="text-truncate col-md-9">'+value.title+'</div>' +
                        '<div class="border-left text-center col-md-1">'+value.quantity+'</div></a>';
                    $('#viewcart').append(strcart);
                    $('#viewcart').append('<a class="dropdown-item text-center small text-gray-500" href="#">View More</a>');
                })
            }
        })
    }
</script>
</body>
</html>
