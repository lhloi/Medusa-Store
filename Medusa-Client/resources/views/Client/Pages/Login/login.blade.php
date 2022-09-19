@extends('Client.Layout.layout')
@section('title')
    <title>Home Medusa</title>
@endsection
@php
 $baseUrl = config('app.base_url');
@endphp
<link rel="stylesheet" href="{{ asset( $baseUrl.'/AdminBE/Layout/adminlte.min.css') }}">
@section('css')
<style>
    .divider:after,
    .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
    }
</style>
@endsection

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-7">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-4  offset-xl-1">
            <div class="login-box">
                <div class="card">
                    <div class="card-body login-card-body">
                        <h4 class="login-box-msg">Đăng nhập</h4>
                        <form action="{{ Url('check-Login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="social-auth-links text-center">
                            <p>- OR -</p>
                            <a href="{{ Url('login-facebook') }}" class="btn btn-primary col-md-5">
                                <i class="fa fa-facebook mr-2"></i> Facebook
                            </a>
                            <a href="#" class="btn btn-danger col-md-5">
                                <i class="fa fa-google-plus mr-2"></i> Google+
                            </a>
                        </div>
                        <!-- /.social-auth-links -->
                        <div class="col-md-12">
                            <p class="col-md-5">
                                <a href="forgot-password.html">Quên mật khẩu</a>
                            </p>
                            <p class="col-md-5">
                                <a href="register.html" class="text-center">Đăng ký</a>
                            </p>
                        </div>

                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('js')

@endsection
