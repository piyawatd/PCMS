<div class="form-group row">
    <label for="title_en" class="col-md-2 col-form-label">หัวข้อ</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="หัวข้อภาษาอังกฤษ" value="{{$content->title_en}}">
    </div>
</div>
<div class="form-group row">
    <label for="intro_en" class="col-md-2 col-form-label">Intro</label>
    <div class="col-md-10">
        <textarea class="form-control" id="intro_en" name="intro_en">{{$content->intro_en}}</textarea>
    </div>
</div>
<div class="form-group row">
    <label for="detail_en" class="col-md-2 col-form-label">รายละเอียด</label>
    <div class="col-md-10">
        <textarea class="form-control" id="detail_en" name="detail_en">{{$content->detail_en}}</textarea>
    </div>
</div>
