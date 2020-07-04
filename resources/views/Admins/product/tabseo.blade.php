<div class="form-group">
    <label for="seokey" class="col-sm-2 control-label">SEO Key</label>
    <div class="col-sm-10">
        <input id="seokey" name="seokey" type="input" value="{{ $product->seokey }}" class="form-control">
    </div>
</div>
<div class="form-group">
    <label for="seodescription" class="col-sm-2 control-label">รายละเอียด SEO</label>
    <div class="col-sm-10">
        <textarea id="seodescription" name="seodescription" class="form-control" rows="3">{{ $product->seodescription}}</textarea>
    </div>
</div>
