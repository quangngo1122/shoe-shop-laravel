@extends('layouts.client')
@section('content-client')
<style>
    .forgot-password-page {
        background-color: #f7f7f7;
        padding: 60px 0;
        min-height: calc(100vh - 300px);
        display: flex;
        align-items: center;
    }
    .forgot-password-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
        max-width: 480px;
        margin: 0 auto;
        padding: 48px 40px;
    }
    .forgot-password-card h3 {
        font-size: 26px;
        color: #111827;
        margin-bottom: 12px;
        text-align: center;
    }
    .forgot-password-card .subtitle {
        font-size: 14px;
        color: #6b7280;
        text-align: center;
        margin-bottom: 32px;
        line-height: 1.6;
    }
    .forgot-form-group {
        margin-bottom: 24px;
    }
    .forgot-form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 10px;
    }
    .forgot-form-group input {
        width: 100%;
        padding: 14px 16px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 14px;
        color: #111827;
        transition: border-color 0.2s ease;
        box-sizing: border-box;
    }
    .forgot-form-group input:focus {
        outline: none;
        border-color: #ff6b35;
        box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.12);
    }
    .forgot-form-group .invalid-feedback {
        display: block;
        margin-top: 8px;
        color: #dc2626;
        font-size: 13px;
    }
    .notify-message {
        padding: 12px 16px;
        background-color: #dcfce7;
        border: 1px solid #86efac;
        border-radius: 8px;
        color: #15803d;
        font-size: 13px;
        margin-bottom: 24px;
        text-align: center;
    }
    .forgot-password-button {
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
    .forgot-password-button:hover {
        background-color: #ff4f1f;
    }
    .forgot-back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #6b7280;
        font-size: 13px;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .forgot-back-link:hover {
        color: #111827;
    }
    @media (max-width: 768px) {
        .forgot-password-card {
            padding: 32px 24px;
        }
        .forgot-password-card h3 {
            font-size: 22px;
        }
    }
</style>
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