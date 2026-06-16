@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth" style="background-color: #f7f7f7; padding: 40px 0; min-height: calc(100vh - 300px);">
    <div class="container">
        <!-- Page Header -->
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Thông Tin Cá Nhân</h1>
            <p style="color: #666; font-size: 14px; margin: 0;">Quản lý thông tin tài khoản và cài đặt bảo mật</p>
        </div>

        <div class="row" style="gap: 20px;">
            <!-- Left Column - Profile Info -->
            <div class="col-md-7">
                <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 0; overflow: hidden;">
                    <!-- Card Header -->
                    <div style="background-color: #f9f9f9; padding: 20px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-user" style="font-size: 18px; color: #ff6b35;"></i>
                        <h5 style="margin: 0; color: #1a1a1a; font-weight: 600; font-size: 16px;">Thông Tin Cá Nhân</h5>
                    </div>

                    <!-- Form Content -->
                    <div style="padding: 25px;">
                        <form action="{{ route('profile.change_profile') }}" method="post">
                            @csrf
                            
                            <!-- Name & Email Row -->
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-md-6" style="margin-bottom: 16px;">
                                    <label style="display: block; margin-bottom: 8px; color: #1a1a1a; font-weight: 600; font-size: 13px;">Họ Và Tên</label>
                                    <input type="text" class="form-control" value="{{ $fullName }}" id="name" name="name" placeholder="Nhập họ và tên" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                                    @if ($errors->get('name'))
                                        <span style="display: block; color: #dc3545; font-size: 12px; margin-top: 4px;">
                                            {{ implode(", ",$errors->get('name')) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6" style="margin-bottom: 16px;">
                                    <label style="display: block; margin-bottom: 8px; color: #1a1a1a; font-weight: 600; font-size: 13px;">Email</label>
                                    <input type="text" class="form-control" value="{{ $email }}" id="email" name="email" placeholder="Nhập địa chỉ email" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                                    @if ($errors->get('email'))
                                        <span style="display: block; color: #dc3545; font-size: 12px; margin-top: 4px;">
                                            {{ implode(", ",$errors->get('email')) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Phone -->
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; color: #1a1a1a; font-weight: 600; font-size: 13px;">Số Điện Thoại</label>
                                <input type="text" class="form-control" value="{{ $phoneNumber }}" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; width: 100%;">
                                @if ($errors->get('phone_number'))
                                    <span style="display: block; color: #dc3545; font-size: 12px; margin-top: 4px;">
                                        {{ implode(", ",$errors->get('phone_number')) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Location Section -->
                            <div style="background-color: #f9f9f9; padding: 16px; border-radius: 4px; margin-bottom: 16px;">
                                <h6 style="margin: 0 0 12px 0; color: #1a1a1a; font-weight: 600; font-size: 13px;">Địa Chỉ Giao Hàng</h6>

                                <!-- City, District, Ward Row -->
                                <div class="row" style="margin-bottom: 12px; gap: 0;">
                                    <div class="col-md-4" style="margin-bottom: 12px;">
                                        <label style="display: block; margin-bottom: 6px; color: #1a1a1a; font-weight: 600; font-size: 12px;">Tỉnh, Thành Phố</label>
                                        <select class="form-control form-select" id="city" name="city" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px;">
                                            @foreach ($citys as $item)
                                                <option value="{{ $item['ProvinceID'] }}" @if ($item['ProvinceID'] == $city) selected @endif>
                                                    {{ $item['NameExtension'][1] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->get('city'))
                                            <span style="display: block; color: #dc3545; font-size: 11px; margin-top: 3px;">
                                                {{ implode(", ",$errors->get('city')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" style="margin-bottom: 12px;">
                                        <label style="display: block; margin-bottom: 6px; color: #1a1a1a; font-weight: 600; font-size: 12px;">Quận, Huyện</label>
                                        <select class="form-control form-select" id="district" name="district" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px;">
                                            @foreach ($districts as $item)
                                                <option value="{{ $item['DistrictID'] }}" @if ($item['DistrictID'] == $district) selected @endif>
                                                    {{ $item['DistrictName'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->get('district'))
                                            <span style="display: block; color: #dc3545; font-size: 11px; margin-top: 3px;">
                                                {{ implode(", ",$errors->get('district')) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" style="margin-bottom: 12px;">
                                        <label style="display: block; margin-bottom: 6px; color: #1a1a1a; font-weight: 600; font-size: 12px;">Phường, Xã</label>
                                        <select class="form-control form-select" id="ward" name="ward" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px;">
                                            @foreach ($wards as $item)
                                                <option value="{{ $item['WardCode'] }}" @if ($item['WardCode'] == $ward) selected @endif>
                                                    {{ $item['WardName'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->get('ward'))
                                            <span style="display: block; color: #dc3545; font-size: 11px; margin-top: 3px;">
                                                {{ implode(", ",$errors->get('ward')) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Street Address -->
                                <div>
                                    <label style="display: block; margin-bottom: 6px; color: #1a1a1a; font-weight: 600; font-size: 12px;">Địa Chỉ Nhà</label>
                                    <input type="text" class="form-control" value="{{ $apartment_number }}" id="apartment_number" name="apartment_number" placeholder="Nhập địa chỉ nhà (số nhà, đường, ...)" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; width: 100%;">
                                    @if ($errors->get('apartment_number'))
                                        <span style="display: block; color: #dc3545; font-size: 11px; margin-top: 3px;">
                                            {{ implode(", ",$errors->get('apartment_number')) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div style="text-align: center; margin-top: 24px;">
                                <button type="submit" style="background-color: #ff6b35; color: white; padding: 12px 32px; border: none; border-radius: 4px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s ease;">
                                    <i class="fas fa-check" style="margin-right: 6px;"></i> Lưu Thay Đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Change Password -->
            <div class="col-md-5">
                <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 0; overflow: hidden; position: sticky; top: 20px;">
                    <!-- Card Header -->
                    <div style="background-color: #f9f9f9; padding: 20px; border-bottom: 1px solid #eee; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-lock" style="font-size: 18px; color: #20a0a8;"></i>
                        <h5 style="margin: 0; color: #1a1a1a; font-weight: 600; font-size: 16px;">Đổi Mật Khẩu</h5>
                    </div>

                    <!-- Form Content -->
                    <div style="padding: 25px;">
                        <form action="{{ route('profile.change_password') }}" method="post">
                            @csrf

                            <!-- Current Password -->
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; color: #1a1a1a; font-weight: 600; font-size: 13px;">Mật Khẩu Hiện Tại</label>
                                <input type="password" class="form-control" value="{{ old('current_password') }}" id="current_password" name="current_password" placeholder="Nhập mật khẩu hiện tại" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; width: 100%;">
                                @if ($errors->get('current_password'))
                                    <span style="display: block; color: #dc3545; font-size: 12px; margin-top: 4px;">
                                        {{ implode(", ",$errors->get('current_password')) }}
                                    </span>
                                @endif
                            </div>

                            <!-- New Password -->
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; color: #1a1a1a; font-weight: 600; font-size: 13px;">Mật Khẩu Mới</label>
                                <input type="password" class="form-control" value="{{ old('new_password') }}" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; width: 100%;">
                                @if ($errors->get('new_password'))
                                    <span style="display: block; color: #dc3545; font-size: 12px; margin-top: 4px;">
                                        {{ implode(", ",$errors->get('new_password')) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Confirm Password -->
                            <div style="margin-bottom: 16px;">
                                <label style="display: block; margin-bottom: 8px; color: #1a1a1a; font-weight: 600; font-size: 13px;">Xác Nhận Mật Khẩu Mới</label>
                                <input type="password" class="form-control" value="{{ old('confirm_password') }}" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" style="padding: 10px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; width: 100%;">
                                @if ($errors->get('confirm_password'))
                                    <span style="display: block; color: #dc3545; font-size: 12px; margin-top: 4px;">
                                        {{ implode(", ",$errors->get('confirm_password')) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Password Strength Info -->
                            <div style="background-color: #e8f4f8; border-left: 3px solid #20a0a8; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-size: 12px; color: #1a1a1a;">
                                <p style="margin: 0 0 6px 0; font-weight: 600;">💡 Mẹo bảo mật:</p>
                                <ul style="margin: 0; padding-left: 20px;">
                                    <li>Sử dụng mật khẩu có ít nhất 8 ký tự</li>
                                    <li>Bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt</li>
                                    <li>Không sử dụng thông tin cá nhân</li>
                                </ul>
                            </div>

                            <!-- Submit Button -->
                            <div style="text-align: center;">
                                <button type="submit" style="background-color: #20a0a8; color: white; padding: 12px 28px; border: none; border-radius: 4px; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s ease; width: 100%;">
                                    <i class="fas fa-shield-alt" style="margin-right: 6px;"></i> Cập Nhật Mật Khẩu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@vite(['resources/client/css/checkout.css', 'resources/client/js/profile.js'])

@endsection