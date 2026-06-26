@extends('layouts.client')
@section('content-client')
<style>
    .success-page {
        padding: 40px 0;
    }

    .success-card {
        max-width: 620px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        border: 1px solid #eef2f7;
        padding: 36px 24px;
        text-align: center;
    }

    .success-icon {
        width: 84px;
        height: 84px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e8f8ee;
        color: #198754;
        font-size: 36px;
        margin-bottom: 20px;
    }

    .success-title {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 12px;
    }

    .success-message {
        font-size: 16px;
        line-height: 1.7;
        color: #4b5563;
        margin-bottom: 22px;
    }

    .success-btn {
        display: inline-block;
        padding: 12px 24px;
        border-radius: 999px;
        background: #198754;
        color: #fff;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .success-btn:hover {
        background: #157347;
        color: #fff;
    }
</style>

<div class="container_fullwidth content-page">
    <div class="container">
        <div class="success-page">
            <div class="success-card">
                <div class="success-icon">
                    <i class="fa fa-check"></i>
                </div>

                <h4 class="success-title">
                    @if (Session::has('status') && session('status') == 'verifify-success')
                        Xác thực tài khoản thành công
                    @elseif(Session::has('status') && session('status') == 'forgot-password-success')
                        Thay đổi mật khẩu thành công
                    @endif
                </h4>

                <p class="success-message">
                    @if (Session::has('status') && session('status') == 'verifify-success')
                        Chúc mừng! Tài khoản của bạn đã được xác thực thành công. Bạn có thể đăng nhập ngay để bắt đầu sử dụng dịch vụ.
                    @elseif(Session::has('status') && session('status') == 'forgot-password-success')
                        Chúc mừng! Bạn đã thay đổi mật khẩu thành công. Vui lòng đăng nhập bằng mật khẩu mới của mình.
                    @endif
                </p>

                <a href="{{ route('user.login') }}" class="success-btn">
                    Đăng nhập ngay
                </a>
            </div>
        </div>
    </div>
</div>
@endsection