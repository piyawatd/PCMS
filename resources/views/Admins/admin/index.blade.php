@extends('Admins.layouts.template')
@section('title')
    SB Admin 2 - Dashboard
@endsection
@section('stylesheet')

@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        {{ route('adminindex') }}
    </div>

    <!-- Content Row -->

    <div class="row">


    </div>

    <!-- Content Row -->
    <div class="row">

    </div>
@endsection
@section('scripts')

@endsection
