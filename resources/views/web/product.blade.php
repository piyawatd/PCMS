@extends('layouts.template')
@section('title')
    {{$product->title}}
@endsection
@section('meta')

@endsection
@section('stylesheet')

@endsection
@section('content')
<h2>{{$product->title}}</h2>
<p>{{$product->detail}}</p>
<p>{{$product->price}}</p>
<a class="cart" href="javascript:void(0);" productid="{{$product->id}}">Add Cart</a>
@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $('.cart').click(function () {
            $.ajax({
                url: '{{ route('addcart') }}',
                method: "POST",
                data: {"id": $(this).attr('productid'),},
                success: function (response) {
                    loadCart()
                }
            })
        })
    })
</script>
@endsection
