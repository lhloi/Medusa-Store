@extends('Client.Pages.User.layout')
@section('profile_card')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Hồ Sơ Của Tôi
            </h3>
        </div>
        <div class="card-body" style="border:1px">
            <form action="{{ Url('user/save-profile') }}" method="POST" class="form-horizontal" style="text-align: right; color: #6c757d;">
                @csrf
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Họ và Tên</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="Tên Người Dùng" value="{{ isset($profile)?$profile->name :'' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <p class="col-12" style="text-align: left;">{{  isset(Auth::user()->email)? Auth::user()->email  : ''}} <a href="">thay đổi</a> </p>
                        {{-- <input type="email" class="form-control" name="email" value="{{  Auth::user()->email }}"> --}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Số Điện Thoại</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" placeholder="Số Điện Thoại" value="{{ isset($profile)?$profile->phone :'' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Giới Tính</label>
                    <div class="col-sm-10 row">
                        <div class="form-check col-md-1 ml-3">
                            <input class="form-check-input" type="radio" name="gender" id="male"
                                value="1" {{ isset($profile)?$profile->gender=='1'? 'checked' :'':'' }}>
                            <label class="form-check-label" for="male">Nam</label>
                        </div>
                        <div class="form-check col-md-1">
                            <input class="form-check-input" type="radio" name="gender" id="female"
                                value="0" {{ isset($profile)?$profile->gender=='0'? 'checked' :'':'' }}>
                            <label class="form-check-label" for="female">Nữ</label>
                        </div>
                        <div class="form-check col-md-1">
                            <input class="form-check-input" type="radio" name="gender" id="other"
                                value="2" {{ isset($profile)? $profile->gender=='2'? 'checked' :'':'' }}>
                            <label class="form-check-label" for="other">Khác</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Ngày Sinh</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="birthday" placeholder="Ngày Sinh" value="{{ isset($profile)?$profile->birthday :'' }}">
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Địa Chỉ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ" value="{{ isset($profile)?$profile->address :'' }}">
                    </div>
                </div> --}}
                {{-- <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms
                                and conditions</a>
                        </label>
                    </div>
                </div>
            </div> --}}
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
