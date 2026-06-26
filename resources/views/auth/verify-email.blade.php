@extends('layouts.client')
@section('content-client')
<style>
    .verify-page {
        padding: 40px 0;
    }

    .verify-card {
        max-width: 680px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        border: 1px solid #eef2f7;
        overflow: hidden;
    }

    .verify-card__header {
        padding: 32px 24px 20px;
        text-align: center;
        background: linear-gradient(135deg, #f8fbff 0%, #eef7ff 100%);
    }

    .verify-card__icon {
        width: 72px;
        height: 72px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e8f3ff;
        color: #0d6efd;
        font-size: 32px;
        margin-bottom: 16px;
    }

    .verify-card__title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .verify-card__body {
        padding: 24px;
    }

    .verify-card__text {
        font-size: 16px;
        line-height: 1.7;
        color: #4b5563;
        margin-bottom: 16px;
    }

    .verify-card__email {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 8px;
        background: #f8fafc;
        color: #0f172a;
        font-weight: 600;
        margin: 6px 0 16px;
    }

    .verify-card__note {
        color: #6b7280;
        font-size: 14px;
        margin-top: 8px;
    }

    .verify-card__button {
        display: inline-block;
        width: 100%;
        max-width: 220px;
        padding: 12px 18px;
        border: none;
        border-radius: 999px;
        background: #198754;
        color: #fff;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .verify-card__button:hover {
        background: #157347;
        color: #fff;
    }

    .verify-card__alert {
        padding: 12px 14px;
        border-radius: 10px;
        background: #e8f8ee;
        color: #157347;
        border: 1px solid #c9f1d7;
        font-size: 15px;
        margin-bottom: 16px;
    }
</style>

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