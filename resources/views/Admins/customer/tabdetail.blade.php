<div class="form-group row">
    <label for="email" class="col-md-2 col-form-label">Email</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$customer->email}}" required @if($mode == 'edit') readonly @endif >
        <input type="hidden" id="currentemail" name="currentemail" value="{{$customer->email}}">
        <div class="invalid-feedback" id="validatealert">
            Email ห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-2 col-form-label">Password</label>
    <div class="col-md-10">
        <input type="password" class="form-control" id="password" name="password">
        <div class="invalid-feedback" id="validatealert">
            Password ห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="firstname" class="col-md-2 col-form-label">ชื่อ</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ" value="{{$customer->firstname}}" required>
        <div class="invalid-feedback">
            ชื่อห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="lastname" class="col-md-2 col-form-label">นามสกุล</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล" value="{{$customer->lastname}}" required>
        <div class="invalid-feedback">
            นามสกุลห้ามว่าง
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="phone" class="col-md-2 col-form-label">เบอร์โทรศัพท์</label>
    <div class="col-md-10">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์โทรศัพท์" value="{{$customer->phone}}">
    </div>
</div>
