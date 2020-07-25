<div class="form-group row">
    <label for="orderno" class="col-md-2 col-form-label">รหัสใบสั่งซื้อ</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="orderno" name="orderno" placeholder="orderno" value="{{$order->order_no}}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="orderdate" class="col-md-2 col-form-label">วันที่สั่ง</label>
    <div class="col-md-10">
        <?php
            $orderdate = '';
            if(!empty($order->order_date))
            {
                $orderdate = date('d/m/Y H:i', strtotime($order->order_date));
            }
        ?>
        <input type="text" class="form-control" id="orderdate" name="orderdate" placeholder="orderdate" value="{{$orderdate}}" readonly>
    </div>
</div>
<div class="form-group row">
    <label for="firstname" class="col-md-2 col-form-label">ชื่อ - นามสกุล</label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="customer" name="customer" value="{{$customer->id}}" required>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ" value="{{$customer->firstname}} {{$customer->lastname}}" required>
    </div>
    <div class="col-md-2">
        <a href="#" class="btn-primary btn">Browse</a>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-2 col-form-label">Email</label>
    <div class="col-md-10">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$customer->email}}">
    </div>
</div>
<div class="form-group row">
    <label for="phone" class="col-md-2 col-form-label">เบอร์โทรศัพท์</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์โทรศัพท์" value="{{$customer->phone}}">
    </div>
</div>
<div class="form-group row">
    <label for="orderstatus" class="col-md-2 col-form-label">สถานะใบสั่งซื้อ</label>
    <div class="col-md-10">
        <select class="form-control" id="orderstatus" name="orderstatus">
            <option value="0" @if($order->order_status == 0)selected="selected"@endif>ใบใหม่</option>
            <option value="1" @if($order->order_status == 1)selected="selected"@endif>ยืนยันการโอนเงิน</option>
            <option value="2" @if($order->order_status == 2)selected="selected"@endif>จัดส่งแล้ว</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="note" class="col-md-2 col-form-label">Note</label>
    <div class="col-md-10">
        <textarea class="form-control" id="note" name="note">{{$order->note}}</textarea>
    </div>
</div>
