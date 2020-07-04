<div class="form-group row">
    <label for="alias" class="col-md-2 col-form-label">Alias</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" value="{{$product->alias}}" required>
        <input type="hidden" id="currentalias" name="currentalias" value="{{$product->alias}}">
        <div class="invalid-feedback" id="validatealert">
            Alias ห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="sku" class="col-md-2 col-form-label">SKU</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="{{$product->sku}}">
        <div class="invalid-feedback" id="validatealert">
            SKU ห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-md-2 col-form-label">ราคา</label>
    <div class="col-md-10">
        <input type="number" class="form-control" id="price" name="price" placeholder="0" value="{{$product->price}}" required>
        <div class="invalid-feedback" id="validatealert">
            ราคาห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="category" class="col-md-2 col-form-label">หมวด</label>
    <div class="col-md-10">
        <select class="form-control" id="category" name="category">
            @foreach ($category as $item)
                <option value="{{ $item->id }}" @if($item->id == $product->category)selected="selected"@endif>{{ $item->name_th }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-2">Hi Light</div>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="hilight" name="hilight" @if($product->hilight) checked @endif>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-2">Publish</div>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="publish" name="publish" @if($product->publish) checked @endif>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="publish_date" class="col-md-2 col-form-label">วันแสดงสินค้า</label>
    <div class="col-md-3">
        @php
            $publishdate = '';
            if($product->publish_date){
                $publishdate = date('d/m/Y', strtotime($product->publish_date));
            }
        @endphp
        <input type="text" class="form-control" id="publish_date" name="publish_date" value="{{$publishdate}}" readonly>
    </div>
</div>
<div class="form-group row">
    <?php
    $clssthumb = '';
    if ($product->thumbnail == ''){
        $clssthumb = 'd-none';
    }
    ?>
    <label for="thumbnail" class="col-md-2 col-form-label">thumbnail</label>
    <div class="col-md-3">
        <input type="text" class="form-control" id="thumbnail" name="thumbnail" value="{{$product->thumbnail}}" readonly>
    </div>
    <div class="col-md-4">
        <button type="button" class="btn btn-primary btn-sm" onclick="addThumb()">Browse</button>
        <button type="button" class="btn btn-danger btn-sm {{$clssthumb}}" id="delthumb" onclick="deletethumb()">Delete</button>
    </div>
    <div class="col-sm-3 {{ $clssthumb }}" id="file-show">
        <img src="{{$product->thumbnail}}" id="imageShow" style="height: 180px;" class="thumbnail">
    </div>
</div>
