@extends('layouts.client')
@section('content-client')


<div class="container_fullwidth content-page">
    <div class="container">
        <div class="verify-page">
            <div class="verify-card">
                <div class="verify-card__header">
                    <div class="verify-card__icon">
                        <i class="fa fa-envelope-open-text"></i>
                    </div>
                    <h4 class="verify-card__title">Xác thực tài khoản</h4>
                    <p class="verify-card__text" style="margin-bottom: 0;">Chỉ còn một bước nữa để bạn có thể sử dụng đầy đủ dịch vụ.</p>
                </div>

                <div class="verify-card__body">
                    <form action="{{ route('user.resend_email') }}" method="POST" id="login-form__js">
                        <input type="text" hidden value="{{ $user->id }}" name="id">

                        <p class="verify-card__text text-center">
                            Chúng tôi đã gửi một liên kết xác nhận đến địa chỉ email
                            <span class="verify-card__email">{{ $user->email }}</span>
                            của bạn. Vui lòng mở email và nhấp vào liên kết để kích hoạt tài khoản.
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="verify-card__alert text-center">
                                Một liên kết xác nhận mới đã được gửi đến địa chỉ email của bạn.
                            </div>
                        @endif

                        <p class="verify-card__note text-center">
                            Nếu bạn không thấy email trong hộp thư đến, hãy kiểm tra thư rác hoặc thư quảng cáo.
                        </p>

                        @csrf
                        <div class="text-center mt-4">
                            <button type="submit" class="verify-card__button">
                                Gửi lại liên kết
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection