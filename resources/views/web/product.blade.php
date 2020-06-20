Product
@lang('web.hello',['name'=>'piyawat'])
@if(session('cart'))
@foreach(session('cart') as $id => $details)
<?php echo $details['name'] ?>
<?php echo $details['quantity'] ?>
@endforeach
@endif
