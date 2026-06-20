@extends('layouts.client')
@section('content-client')
<style>
  .register-page {
    padding: 48px 0;
    min-height: calc(100vh - 260px);
    background: linear-gradient(180deg, #f6fbff 0%, #ffffff 100%);
  }
  .register-card {
    max-width: 920px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(16,24,40,0.08);
    overflow: hidden;
    display: flex;
    gap: 0;
  }
  .register-aside {
    flex: 1 1 320px;
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    color: #fff;
    padding: 36px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    gap:12px;
  }
  .register-aside h2 { margin:0; font-size:20px }
  .register-aside p { margin:0; opacity:0.95; line-height:1.4 }
  .register-form-wrap { flex: 1 1 520px; padding: 28px 36px }
  .register-title { font-size:22px; margin-bottom:6px; font-weight:400 }
  .register-subtitle { color:#6b7280; margin-bottom:18px }
  .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px }
  .form-row { margin-bottom:12px }
  label.field-label { display:block; font-weight:600; margin-bottom:6px }
  .required { color:#ef4444; margin-left:6px }
  .form-control { margin-left:0;width:100%; padding:5px 6px; border:1px solid #e6e9ef; border-radius:10px }
  .form-control:focus { outline:none; box-shadow:0 6px 20px rgba(99,102,241,0.12); border-color:#6366f1 }
  .invalid-feedback { display:block; color:#dc2626; margin-top:6px; font-size:13px }
  .submit-row { display:flex; justify-content:space-between; align-items:center; gap:12px; margin-top:18px }
  .btn-primary { background:linear-gradient(90deg,#6366f1,#06b6d4); color:#fff; border:none; padding:12px 18px; border-radius:10px; font-weight:700 }
  .link-muted { color:#6b7280; text-decoration:none }
  @media (max-width:900px) {
    .register-card { flex-direction:column }
    .form-grid { grid-template-columns:1fr }
  }
</style>

<div class="container_fullwidth register-page">
  <div class="container">
    <div class="register-card">
      <div class="register-aside">
        <h2>Chào mừng bạn!</h2>
        <p>Đăng ký để quản lý đơn hàng, lưu địa chỉ, và trải nghiệm mua sắm nhanh chóng.</p>
        <ul style="padding-left:16px;margin:12px 0 0 0;">
          <li>Đăng ký nhanh chóng</li>
          <li>Bảo mật thông tin</li>
          <li>Hỗ trợ khách hàng 24/7</li>
        </ul>
      </div>

      <div class="register-form-wrap">
        <h3 class="register-title">Tạo tài khoản</h3>
        <p class="register-subtitle">Vui lòng nhập thông tin chính xác để hoàn tất đăng ký.</p>

        <div id="form-data" hidden data-rules="{{ json_encode($rules) }}" data-messages="{{ json_encode($messages) }}"></div>

        <form action="{{ route('user.register') }}" method="POST" id="form__js" novalidate>
          @csrf

          <div class="form-grid">
            <div class="form-row">
              <label class="field-label" for="name">Họ và tên <span class="required">*</span></label>
              <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nguyễn Văn A" autofocus aria-required="true">
              @if ($errors->get('name'))
                <span id="name-error" class="invalid-feedback">{{ implode(", ",$errors->get('name')) }}</span>
              @endif
            </div>

            <div class="form-row">
              <label class="field-label" for="email">Email <span class="required">*</span></label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="name@example.com" aria-required="true">
              @if ($errors->get('email'))
                <span id="email-error" class="invalid-feedback">{{ implode(", ",$errors->get('email')) }}</span>
              @endif
            </div>

            <div class="form-row">
              <label class="field-label" for="password">Mật khẩu <span class="required">*</span></label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Ít nhất 8 ký tự" aria-required="true">
              @if ($errors->get('password'))
                <span id="password-error" class="invalid-feedback">{{ implode(", ",$errors->get('password')) }}</span>
              @endif
            </div>

            <div class="form-row">
              <label class="field-label" for="password_confirm">Xác nhận mật khẩu <span class="required">*</span></label>
              <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Nhập lại mật khẩu" aria-required="true">
              @if ($errors->get('password_confirm'))
                <span id="password_confirm-error" class="invalid-feedback">{{ implode(", ",$errors->get('password_confirm')) }}</span>
              @endif
            </div>

            <div class="form-row">
              <label class="field-label" for="phone_number">Số điện thoại <span class="required">*</span></label>
              <input type="tel" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') }}" placeholder="0912xxxxxx" aria-required="true">
              @if ($errors->get('phone_number'))
                <span id="phone_number-error" class="invalid-feedback">{{ implode(", ",$errors->get('phone_number')) }}</span>
              @endif
            </div>

            <div class="form-row">
              <label class="field-label" for="city">Tỉnh / Thành phố <span class="required">*</span></label>
              <select id="city" name="city" class="form-control" aria-required="true">
                @foreach ($citys as $city)
                  <option value="{{ $city['ProvinceID'] }}" @if($city['ProvinceID'] == old('city')) selected @endif>{{ $city['NameExtension'][1] }}</option>
                @endforeach
              </select>
              @if ($errors->get('city'))
                <span id="city-error" class="invalid-feedback">{{ implode(", ",$errors->get('city')) }}</span>
              @endif
            </div>

            <div class="form-row">
              <label class="field-label" for="district">Quận / Huyện <span class="required">*</span></label>
              <select id="district" name="district" class="form-control" aria-required="true">
                @foreach ($districts as $district)
                  <option value="{{ $district['DistrictID'] }}" @if($district['DistrictID'] == old('district')) selected @endif>{{ $district['DistrictName'] }}</option>
                @endforeach
              </select>
              @if ($errors->get('district'))
                <span id="district-error" class="invalid-feedback">{{ implode(", ",$errors->get('district')) }}</span>
              @endif
            </div>

            <div class="form-row">
              <label class="field-label" for="ward">Phường / Xã <span class="required">*</span></label>
              <select id="ward" name="ward" class="form-control" aria-required="true">
                @foreach ($wards as $ward)
                  <option value="{{ $ward['WardCode'] }}" @if($ward['WardCode'] == old('ward')) selected @endif>{{ $ward['WardName'] }}</option>
                @endforeach
              </select>
              @if ($errors->get('ward'))
                <span id="ward-error" class="invalid-feedback">{{ implode(", ",$errors->get('ward')) }}</span>
              @endif
            </div>

            <div class="form-row" style="grid-column:1 / -1;">
              <label class="field-label" for="apartment_number">Địa chỉ cụ thể <span class="required">*</span></label>
              <input type="text" id="apartment_number" name="apartment_number" class="form-control" value="{{ old('apartment_number') }}" placeholder="Số nhà, tên đường, khu vực">
              @if ($errors->get('apartment_number'))
                <span id="apartment_number-error" class="invalid-feedback">{{ implode(", ",$errors->get('apartment_number')) }}</span>
              @endif
            </div>
          </div>

          <div class="submit-row">
            <div>
              <a class="link-muted" href="{{ route('user.login') }}">Bạn đã có tài khoản? Đăng nhập</a>
            </div>
            <div>
              <button type="submit" class="btn-primary">Đăng Kí</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@vite(['resources/client/js/register.js'])
@endsection