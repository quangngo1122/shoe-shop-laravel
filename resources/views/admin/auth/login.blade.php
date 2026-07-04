@extends('layouts.admin-auth')
@section('content-auth')
<style>
  body {
    margin: 0;
    font-family: 'Source Sans Pro', sans-serif;
  }

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
  .login-box {
    width: min(100%, 460px);
  }

  .card-outline {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.24);
    background: rgba(255, 255, 255, 0.96);
  }

  .card-header {
    background: linear-gradient(90deg, #0f172a 0%, #2563eb 100%);
    border-bottom: none;
    padding: 24px 20px;
  }

  .login-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: #ffffff;
  }

  .login-brand .icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.16);
    backdrop-filter: blur(6px);
    font-size: 20px;
  }

  .login-brand h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
  }

  .login-brand small {
    display: block;
    opacity: 0.9;
  }

  .card-body {
    padding: 32px 28px 28px;
  }

  .login-box-msg {
    margin-bottom: 22px;
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    text-align: center;
  }

  .form-group {
    margin-bottom: 16px;
  }

  .form-control {
    border-radius: 12px;
    border: 1px solid #dbe4f0;
    padding: 12px 14px;
    box-shadow: none;
  }

  .form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.16);
  }

  .btn-primary {
    border: none;
    border-radius: 12px;
    padding: 12px;
    font-weight: 600;
    background: linear-gradient(90deg, #2563eb 0%, #0ea5e9 100%);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.25);
  }

  .helper-text {
    margin-top: 14px;
    text-align: center;
    color: #64748b;
    font-size: 13px;
    line-height: 1.5;
  }

  .error.invalid-feedback {
    display: block;
    margin-top: 6px;
    font-size: 13px;
  }
</style>

<div class="bodylogin">
  <div class="login-box">
    <div class="card card-outline">
      <div class="card-header text-center">
        <div class="login-brand">
          <div class="icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <div>
            <h3>Admin Panel</h3>
            <small>Quản trị hệ thống</small>
          </div>
        </div>
      </div>

      <div class="card-body">
        <p class="login-box-msg">Đăng nhập tài khoản quản trị</p>

        @if ($errors->get('disable_reason'))
          <span class="error invalid-feedback" style="display: block">
            {{ implode(", ", $errors->get('disable_reason')) }}
          </span>
        @endif

        <form action="{{ route('admin.login') }}" method="post" id="login-form__js">
          @csrf

          <div class="form-group mb-3">
            <label for="email" class="sr-only">Email</label>
            <x-admin-input id="email" type="text" value="{{ old('email') }}" name="email" placeholder="Email" />
            @if ($errors->get('email'))
              <span id="email-error" class="error invalid-feedback" style="display: block">
                {{ implode(", ", $errors->get('email')) }}
              </span>
            @endif
          </div>

          <div class="form-group mb-3">
            <label for="password" class="sr-only">Mật khẩu</label>
            <x-admin-input id="password" type="password" value="{{ old('password') }}" name="password" placeholder="Mật khẩu" />
            @if ($errors->get('password'))
              <span id="password-error" class="error invalid-feedback" style="display: block">
                {{ implode(", ", $errors->get('password')) }}
              </span>
            @endif
          </div>

          <div class="row">
            <div class="col-12">
              <button id="btn-submit" type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </div>
          </div>

          <p class="helper-text">Vui lòng sử dụng tài khoản được cấp phép để truy cập hệ thống quản trị.</p>
        </form>
      </div>
    </div>
  </div>
</div>

@vite(['resources/common/js/login.js'])
@endsection

