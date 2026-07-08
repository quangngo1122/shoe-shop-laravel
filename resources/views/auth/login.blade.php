@extends('layouts.client')
@section('content-client')

<div class="container_fullwidth login-page">
    <div class="container">
        <div class="login-card" style="display: flex; flex-wrap: wrap;">
            <div class="login-side" style="flex: 1 1 320px;">
                <span style="display: inline-flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; letter-spacing: 0.03em; text-transform: uppercase; margin-bottom: 18px;">
                    <i class="fas fa-star"></i> Chào mừng trở lại
                </span>
                <h2>Đăng nhập nhanh chóng và an toàn</h2>
                <p>Truy cập tài khoản để quản lý đơn hàng, xem lịch sử mua sắm và cập nhật thông tin cá nhân.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check"></i> Đồng bộ giỏ hàng tức thì</li>
                    <li><i class="fas fa-check"></i> Bảo mật 2 lớp cho tài khoản</li>
                    <li><i class="fas fa-check"></i> Theo dõi đơn hàng dễ dàng</li>
                </ul>
            </div>

            <div class="login-form-wrapper" style="flex: 1 1 320px;">
                <h3>Đăng Nhập</h3>
                <form action="{{ route('user.login') }}" method="POST" id="login-form__js">
                    @csrf
                    <div class="login-form-group">
                        <label for="email">Email <span>*</span></label>
                        <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email" autofocus>
                        @if ($errors->get('email'))
                            <span class="invalid-feedback">{{ implode(", ",$errors->get('email')) }}</span>
                        @endif
                    </div>
                    <div class="login-form-group">
                        <label for="password">Mật Khẩu <span>*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                        @if ($errors->get('password'))
                            <span class="invalid-feedback">{{ implode(", ",$errors->get('password')) }}</span>
                        @endif
                    </div>
                    <button type="submit" class="login-button">Đăng Nhập</button>
                    <div class="auth-links">
                        <a href="{{ route('user.forgot_password_create') }}">Quên mật khẩu?</a>
                        <a href="{{ route('user.register') }}">Đăng kí tài khoản</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@vite(['resources/common/js/login.js'])
@endsection