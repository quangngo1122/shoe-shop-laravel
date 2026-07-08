@extends('layouts.client')
@section('content-client')

<div class="container_fullwidth forgot-password-page">
    <div class="container">
        <div class="forgot-password-card">
            <h3>Quên Mật Khẩu</h3>
            <p class="subtitle">Nhập email tài khoản của bạn để nhận hướng dẫn đặt lại mật khẩu</p>

            @if (Session::has('notify'))
                <div class="notify-message">
                    {{ session('notify') }}
                </div>
            @endif

            <form action="{{ route('user.forgot_password_create') }}" method="POST">
                @csrf
                <div class="forgot-form-group">
                    <label for="email">Email đăng kí</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email đăng kí tài khoản" autofocus>
                    @if ($errors->get('email'))
                        <span class="invalid-feedback">{{ implode(", ",$errors->get('email')) }}</span>
                    @endif
                </div>
                <button type="submit" class="forgot-password-button">Gửi Hướng Dẫn Đặt Lại Mật Khẩu</button>
                <a href="{{ route('user.login') }}" class="forgot-back-link">Quay lại trang đăng nhập</a>
            </form>
        </div>
    </div>
</div>
@endsection