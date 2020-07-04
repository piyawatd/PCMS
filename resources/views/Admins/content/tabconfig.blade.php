<div class="form-group row">
    <label for="alias" class="col-md-2 col-form-label">Alias</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="alias" name="alias" placeholder="Alias" value="{{$content->alias}}" required>
        <input type="hidden" id="currentalias" name="currentalias" value="{{$content->alias}}">
        <div class="invalid-feedback" id="validatealert">
            Valid Alias is required.
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="category" class="col-md-2 col-form-label">หมวด</label>
    <div class="col-md-10">
        <select class="form-control" id="category" name="category">
            @foreach ($category as $item)
                <option value="{{ $item->id }}" @if($item->id == $content->category)selected="selected"@endif>{{ $item->name_th }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-2">Hi Light</div>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="hilight" name="hilight" @if($content->hilight) checked @endif>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-2">Publish</div>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="publish" name="publish" @if($content->publish) checked @endif>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="publish_date" class="col-md-2 col-form-label">วันแสดงบทความ</label>
    <div class="col-md-3">
        @php
            $publishdate = '';
            if($content->publish_date){
                $publishdate = date('d/m/Y', strtotime($content->publish_date));
            }
        @endphp
        <input type="text" class="form-control" id="publish_date" name="publish_date" value="{{$publishdate}}" readonly>
    </div>
</div>
<div class="form-group row">
    <?php
    $clssthumb = '';
    if ($content->thumbnail == ''){
        $clssthumb = 'd-none';
    }
    ?>
    <label for="thumbnail" class="col-md-2 col-form-label">thumbnail</label>
    <div class="col-md-3">
        <input type="text" class="form-control" id="thumbnail" name="thumbnail" value="{{$content->thumbnail}}" readonly>
    </div>
    <div class="col-md-4">
        <button type="button" class="btn btn-primary btn-sm" onclick="addThumb()">Browse</button>
        <button type="button" class="btn btn-danger btn-sm {{$clssthumb}}" id="delthumb" onclick="deletethumb()">Delete</button>
    </div>
    <div class="col-sm-3 {{ $clssthumb }}" id="file-show">
        <img src="{{$content->thumbnail}}" id="imageShow" style="height: 180px;" class="thumbnail">
    </div>
</div>
