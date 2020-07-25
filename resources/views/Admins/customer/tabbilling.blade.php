<div class="form-group row">
    <label for="billaddress" class="col-md-2 col-form-label">ที่อยู่</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="billaddress" name="billaddress" placeholder="ที่อยู่" value="{{$billing->address}}">
    </div>
</div>
<div class="form-group row">
    <label for="billprovince" class="col-md-2 col-form-label">จังหวัด</label>
    <div class="col-md-10">
        <select class="form-control" id="billprovince" name="billprovince">
            <option value="" @if($billing->province == "")selected="selected"@endif>กรุณาเลือกจังหวัด</option>
            @foreach ($billprovince as $item)
                <option value="{{ $item->id }}" @if($item[$selfield] == $billing->province)selected="selected"@endif>{{ $item[$selfield] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="billamphure" class="col-md-2 col-form-label">อำเภอ</label>
    <div class="col-md-10">
        <select class="form-control" id="billamphure" name="billamphure">
            @foreach ($billamphure as $item)
                <option value="{{ $item[$selfield] }}" @if($item[$selfield] == $billing->amphure)selected="selected"@endif>{{ $item[$selfield] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="billdistrict" class="col-md-2 col-form-label">ตำบล</label>
    <div class="col-md-10">
        <select class="form-control" id="billdistrict" name="billdistrict">
            @foreach ($billdistrict as $item)
                <option value="{{ $item[$selfield] }}" @if($item[$selfield] == $billing->district)selected="selected"@endif>{{ $item[$selfield] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="billzipcode" class="col-md-2 col-form-label">รหัสไปรษณีย์</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="billzipcode" name="billzipcode" placeholder="รหัสไปรษณีย์" value="{{$billing->zipcode}}">
    </div>
</div>
<input type="hidden" id="bprovince" name="bprovince" value="{{$billing->province}}">
<input type="hidden" id="bamphure" name="bamphure" value="{{$billing->amphure}}">
<input type="hidden" id="bdistrict" name="bdistrict" value="{{$billing->district}}">
