@extends('layouts.client')
@section('content-client')
<style>
  .steps {
    background-image: linear-gradient(135deg, rgb(30, 206, 255), rgb(168, 217, 255));
  }
  .quenmk{
    margin-right:440px;
  }
</style>
<div class="container_fullwidth content-page">
    <div class="container">
        <div class="col-md-12 container-page">
            <div class="checkout-page">
              <ol class="checkout-steps">
                <li class="steps active">
                  <h4 class="title-steps text-center">
                    Đăng Nhập
                  </h4>
                  <div class="step-description">
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <div class="run-customer">
                          <form action="{{ route('user.login') }}" method="POST" id="login-form__js">
                            @csrf
                            <div class="form-group">
                              <label style="display:flex;" for="exampleInputEmail1">Email<p style="color:red;">*</p></label>
                              <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email" autofocus>
                              @if ($errors->get('email'))
                                <span id="email-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('email')) }}
                                </span>
                              @endif
                            </div>
                            <div class="form-group">
                              <label style="display:flex;" for="exampleInputPassword1">Mật Khẩu<p style="color:red;">*</p></label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                              @if ($errors->get('password'))
                                <span id="password-error" class="error invalid-feedback" style="display: block">
                                  {{ implode(", ",$errors->get('password')) }}
                                </span>
                              @endif
                            </div>
                            <div class="text-center">
                                <button>
                                  Đăng Nhập
                                </button>
                            </div>
                            <div class="content-footer">
                                <a style="font-size:13px;" class="quenmk" href="{{ route('user.forgot_password_create') }}">
                                  Quên mật khẩu?
                                </a>
                                <a style="font-size:13px;" href="{{ route('user.register') }}">
                                  Đăng kí tài khoản
                                </a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </ol>
            </div>
          </div>
    </div>
</div>
@vite(['resources/common/js/login.js'])
@endsection