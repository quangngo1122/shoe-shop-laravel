@extends('layouts.client')
@section('content-client')
<style>
    .login-page {
        background-color: #f7f7f7;
        padding: 60px 0;
        min-height: calc(100vh - 300px);
    }
    .login-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
    }
    .login-side {
        background: linear-gradient(135deg, #ff7f50 0%, #ff6b35 100%);
        color: #fff;
        padding: 48px 32px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 420px;
    }
    .login-side h2 {
        font-size: 28px;
        margin-bottom: 12px;
        line-height: 1.1;
    }
    .login-side p {
        color: rgba(255,255,255,0.85);
        font-size: 14px;
        line-height: 1.8;
    }
    .login-side .feature-list {
        margin-top: 26px;
        padding-left: 0;
        list-style: none;
    }
    .login-side .feature-list li {
        display: flex;
        align-items: center;
        margin-bottom: 14px;
        font-size: 14px;
    }
    .login-side .feature-list li i {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    .login-form-wrapper {
        padding: 42px 34px;
        background: #ffffff;
    }
    .login-form-wrapper h3 {
        font-size: 22px;
        margin-bottom: 24px;
        color: #111827;
    }
    .login-form-group {
        margin-bottom: 20px;
    }
    .login-form-group label {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 10px;
    }
    .login-form-group label span {
        color: #ff6b35;
    }
    .login-form-group input {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 14px;
        color: #111827;
        transition: border-color 0.2s ease;
    }
    .login-form-group input:focus {
        outline: none;
        border-color: #ff6b35;
        box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.12);
    }
    .login-form-group .invalid-feedback {
        display: block;
        margin-top: 8px;
        color: #dc2626;
        font-size: 13px;
    }
    .login-button {
        width: 100%;
        padding: 14px 0;
        background-color: #ff6b35;
        border: none;
        color: white;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.25s ease;
    }
    .login-button:hover {
        background-color: #ff4f1f;
    }
    .auth-links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 18px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .auth-links a {
        color: #6b7280;
        font-size: 13px;
        transition: color 0.2s ease;
        text-decoration: none;
    }
    .auth-links a:hover {
        color: #111827;
    }
    @media (max-width: 992px) {
        .login-side {
            min-height: auto;
            padding: 32px;
        }
        .login-form-wrapper {
            padding: 32px;
        }
    }
    @media (max-width: 768px) {
        .login-card {
            flex-direction: column;
        }
    }
</style>
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