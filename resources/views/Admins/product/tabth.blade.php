<div class="form-group row">
    <label for="title_th" class="col-md-2 col-form-label">ชื่อสินค้า</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="title_th" name="title_th" placeholder="ชื่อสินค้าภาษาไทย" required value="{{$product->title_th}}">
        <div class="invalid-feedback">
            ชื่อสินค้าห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="intro_th" class="col-md-2 col-form-label">Intro</label>
    <div class="col-md-10">
        <textarea class="form-control" id="intro_th" name="intro_th">{{$product->intro_th}}</textarea>
    </div>
</div>
<div class="form-group row">
    <label for="detail_th" class="col-md-2 col-form-label">รายละเอียด</label>
    <div class="col-md-10">
        <textarea class="form-control" id="detail_th" name="detail_th">{{$product->detail_th}}</textarea>
    </div>
</div>
