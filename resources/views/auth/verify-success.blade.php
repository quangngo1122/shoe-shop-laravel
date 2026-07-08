@extends('layouts.client')
@section('content-client')


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