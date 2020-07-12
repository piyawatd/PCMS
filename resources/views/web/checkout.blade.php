@extends('layouts.template')
@section('title')
    @lang('web_checkout.pagetitle')
@endsection
@section('meta')

@endsection
@section('stylesheet')
    <link href="{{asset('/css/form-validation.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('web_checkout.pagetitle')</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <table>
                @foreach ($carts['cart'] as $cart)
                    <tr>
                        <td>
                            {{$cart['id']}}
                            {{$cart['title']}}
                            {{$cart['quantity']}}
                            {{$cart['price']}}
                            {{$cart['total']}}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
