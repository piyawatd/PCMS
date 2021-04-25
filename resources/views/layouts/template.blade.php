<?php
$route = Route::currentRouteName();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Piyawat Damrongsuphakit">
    <title>BNC Supply : @yield('title')</title>
    <!-- Bootstrap Core CSS -->
    @yield('meta')
    @include('layouts.inc-stylesheet')
    @yield('stylesheet')
</head>
<body>
    <!-- #site-wrapper start -->
    @if($route === 'home')
    <div id="site-wrapper" class="site-wrapper home-main">
    @endif
    @if($route === 'product')
    <div id="site-wrapper" class="site-wrapper blog-listing blog-listing-grid">
    @endif
    @if($route === 'productdetail')
    <div id="site-wrapper" class="site-wrapper page-shop page-single-product">
    @endif
    @if($route === 'client')
    <div id="site-wrapper" class="site-wrapper blog-listing blog-listing-grid">
    @endif
    @if($route === 'clientdetail')
    <div id="site-wrapper" class="site-wrapper single-blog single-blog-image">
    @endif
    @if($route === 'career')
    <div id="site-wrapper" class="site-wrapper explore-sidebar explore-sidebar-list">
    @endif
    @if($route === 'careerdetail')
    <div id="site-wrapper" class="site-wrapper explore-details explore-details-gallery bg-gray-06">
    @endif
    @if($route === 'aboutus')
    <div id="site-wrapper" class="site-wrapper explore-details explore-details-gallery bg-gray-06">
    @endif


        <!-- #header start -->
        @include('layouts.inc-header')
        <!-- #wrapper-content start -->
        <!-- content-wrapper start -->
        @if($route === 'home')
            @include('layouts.inc-slider')
            <div class="content-wrap">
                @yield('content')
            </div>
        @endif
        @if($route === 'product')
        <!-- #page-title start -->
            <div id="page-title" class="page-title page-title-style-background">
                <div class="container">
                    <div class="h-100 d-flex align-items-center">
                        <div class="mb-2">
                            <h1 class="mb-0" data-animate="fadeInDown">
                                <span class="font-weight-light">@lang('web_product.product')</span>
                            </h1>
                            <ul class="breadcrumb breadcrumb-style-01" data-animate="fadeInUp">
                                <li class="breadcrumb-item"><a href="{{route('home')}}" class="link-hover-dark-primary">@lang('web_product.home')</a></li>
                                <li class="breadcrumb-item"><span>@lang('web_product.product')</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="wrapper-content" class="wrapper-content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            <!-- #page-title end -->
        @endif
        @if($route === 'productdetail')
        <!-- #page-title start -->
            <div id="page-title" class="page-title py-6">
                <div class="container">
                    <div class="h-100 ">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">@lang('web.home')</a></li>
                            <li class="breadcrumb-item"><a href="/product" class="text-decoration-none">{{ $category->name }} </a></li>
                            <li class="breadcrumb-item"><span> {{$product->title}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #page-title end -->
            <div id="wrapper-content" class="wrapper-content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        @endif
        @if($route === 'client')
        <!-- #page-title start -->
            <div id="page-title" class="page-title page-title-style-background">
                <div class="container">
                    <div class="h-100 d-flex align-items-center">
                        <div class="mb-2">
                            <h1 class="mb-0" data-animate="fadeInDown">
                                <span class="font-weight-light">@lang('web.client')</span>
                            </h1>
                            <ul class="breadcrumb breadcrumb-style-01" data-animate="fadeInUp">
                                <li class="breadcrumb-item"><a href="{{route('home')}}" class="link-hover-dark-primary">@lang('web.home')</a></li>
                                <li class="breadcrumb-item"><span>@lang('web.client')</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="wrapper-content" class="wrapper-content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
            <!-- #page-title end -->
        @endif
        @if($route === 'clientdetail')
            <div id="wrapper-content" class="wrapper-content pb-13">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        @endif
        @if($route === 'career')
        <!-- #page-title start -->
            <div id="wrapper-content" class="wrapper-content bg-gray-04 pb-0">
                <div class="container">
                    <ul class="breadcrumb breadcrumb-style-02 py-7">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('web.home')</a></li>
                        <li class="breadcrumb-item">@lang('web.career')</li>
                    </ul>
                    <div class="page-container row">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- #page-title end -->
        @endif
        @if($route === 'careerdetail')
            <div id="wrapper-content" class="wrapper-content pb-0 pt-0 ">
                <div class="page-wrapper bg-white">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endif
        @if($route === 'aboutus')
            <div id="wrapper-content" class="wrapper-content pb-0 pt-0 ">
                <div class="page-wrapper bg-white">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endif
        @if($route === 'notfound')
            <div id="wrapper-content" class="wrapper-content pt-0 pb-0">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        @endif
        <!-- .content-wrapper end -->
        <!-- #wrapper-content end -->
        @include('layouts.inc-footer')
    </div>
    {{--@include('layouts.inc-widget')--}}
    <!-- End of Page Wrapper -->
    @include('layouts.inc-scripts')
    @yield('scripts')
</body>
</html>
