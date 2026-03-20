@extends('layouts.admin-auth')
@section('content-auth')
<style>
  /* body{
    background-image: url({{ asset('asset/client/images/bg.jpg') }});
  } */
  .card-outline{
    background-image: linear-gradient(135deg, rgb(30, 206, 255), rgb(168, 217, 255));
  }
  .bodylogin{
    width: 100vw;
    height:100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url('../asset/client/images/bg.jpg');
    background-size: 100%;
    background-size: cover;
  }
  .login-box{
    width: 460px;
  }
  .card-body{
    margin:30px 0px;
  }
  .login-box-msg{
    margin-bottom:20px;
  }
  .card-header{
    background: linear-gradient(to right, black 0%, blue 90%);
    background-clip: text;
    color: transparent;
  }
</style>
<div class="bodylogin">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <p class="h1"><b>Admin</b></p>
      </div>
      <div class="card-body">
        <p style ="font-size:18px;" class="login-box-msg"><b>Đăng Nhập Hệ Thống</b></p>
        @if ($errors->get('disable_reason'))
          <span class="error invalid-feedback" style="display: block">
            {{ implode(", ",$errors->get('disable_reason')) }}
          </span>
        @endif
        <form action="{{ route('admin.login') }}" method="post" id="login-form__js">
          @csrf
          <div class="form-group mb-3">
            <x-admin-input id="email" type="text" value="{{ old('email') }}" name="email" placeholder="Email" />
            @if ($errors->get('email'))
              <span id="email-error" class="error invalid-feedback" style="display: block">
                {{ implode(", ",$errors->get('email')) }}
              </span>
            @endif
          </div >
          <div class="form-group mb-3">
            <x-admin-input id="password" type="password" value="{{ old('password') }}" name="password" placeholder="Mật khẩu" />
            @if ($errors->get('password'))
              <span id="password-error" class="error invalid-feedback" style="display: block">
                {{ implode(", ",$errors->get('password')) }}
              </span>
            @endif
          </div >
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button id="btn-submit" type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@vite(['resources/common/js/login.js'])
@endsection
