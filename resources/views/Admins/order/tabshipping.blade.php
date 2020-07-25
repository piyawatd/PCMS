<div class="form-group row">
    <label for="shipaddress" class="col-md-2 col-form-label">ที่อยู่</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="shipaddress" name="shipaddress" placeholder="ที่อยู่" value="{{$shipping->address}}">
    </div>
</div>
<div class="form-group row">
    <label for="shipprovince" class="col-md-2 col-form-label">จังหวัด</label>
    <div class="col-md-10">
        <select class="form-control" id="shipprovince" name="shipprovince">
            <option value="" @if($shipping->province == "")selected="selected"@endif>กรุณาเลือกจังหวัด</option>
            @foreach ($shipprovince as $item)
                <option value="{{ $item->id }}" @if($item[$selfield] == $shipping->province)selected="selected"@endif>{{ $item[$selfield] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="shipamphure" class="col-md-2 col-form-label">อำเภอ</label>
    <div class="col-md-10">
        <select class="form-control" id="shipamphure" name="shipamphure">
            @foreach ($shipamphure as $item)
                <option value="{{ $item[$selfield] }}" @if($item[$selfield] == $shipping->amphure)selected="selected"@endif>{{ $item[$selfield] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="shipdistrict" class="col-md-2 col-form-label">ตำบล</label>
    <div class="col-md-10">
        <select class="form-control" id="shipdistrict" name="shipdistrict">
            @foreach ($shipdistrict as $item)
                <option value="{{ $item[$selfield] }}" @if($item[$selfield] == $shipping->district)selected="selected"@endif>{{ $item[$selfield] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="shipzipcode" class="col-md-2 col-form-label">รหัสไปรษณีย์</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="shipzipcode" name="shipzipcode" placeholder="รหัสไปรษณีย์" value="{{$shipping->zipcode}}">
    </div>
</div>
<input type="hidden" id="sprovince" name="sprovince" value="{{$shipping->province}}">
<input type="hidden" id="samphure" name="samphure" value="{{$shipping->amphure}}">
<input type="hidden" id="sdistrict" name="sdistrict" value="{{$shipping->district}}">
