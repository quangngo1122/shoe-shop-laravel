@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth" style="background-color: #f5f5f5; padding: 40px 0;">
    <div class="container">
        <!-- Page Header -->
        <div style="margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 10px;">Giỏ Hàng</h1>
            <p style="color: #666; font-size: 14px;">Quản lý sản phẩm của bạn và tiến hành thanh toán</p>
        </div>

        @if (count(\Cart::getContent()) <= 0)
            <!-- Empty Cart State -->
            <div style="background: white; border-radius: 8px; padding: 80px 40px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <div style="margin-bottom: 30px;">
                    <i class="fas fa-shopping-cart" style="font-size: 80px; color: #ddd;"></i>
                </div>
                <h3 style="font-size: 24px; color: #1a1a1a; margin-bottom: 10px;">Giỏ Hàng Trống</h3>
                <p style="color: #666; margin-bottom: 30px; font-size: 14px;">Bạn chưa có sản phẩm nào trong giỏ hàng. Hãy bắt đầu mua sắm ngay!</p>
                <a href="{{ route('user.home') }}" style="display: inline-block; background-color: #ff6b35; color: white; padding: 12px 40px; border-radius: 4px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                    Bắt Đầu Mua Sắm
                </a>
            </div>
        @else
            <!-- Cart Content -->
            <div class="row">
                <!-- Cart Items Section (Left) -->
                <div class="col-md-8">
                    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
                        <!-- Cart Items Header -->
                        <div style="background-color: #f9f9f9; padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0; color: #1a1a1a; font-weight: 600;">
                                Sản Phẩm Trong Giỏ ({{ Cart::getTotalQuantity() }})
                            </h5>
                            <a href="{{ route('user.home') }}" style="color: #ff6b35; text-decoration: none; font-size: 12px; font-weight: 600;">
                                ← Tiếp Tục Mua Sắm
                            </a>
                        </div>

                        <!-- Cart Items List -->
                        <div style="padding: 0;">
                            @foreach ($carts as $cart)
                                <form action="{{ route('cart.update') }}" method="post">
                                    @csrf
                                    <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; align-items: center; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor='white'">
                                        <!-- Product Image -->
                                        <div style="flex: 0 0 120px; margin-right: 20px;">
                                            <img src="{{ asset("assets/client/images/products/small/" . $cart->attributes->image . "") }}" alt="{{ $cart->name }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px;">
                                        </div>

                                        <!-- Product Details -->
                                        <div style="flex: 1;">
                                            <h6 style="margin: 0 0 10px 0; color: #1a1a1a; font-weight: 600; font-size: 14px;">
                                                {{ $cart->name }}
                                            </h6>
                                            <div style="font-size: 13px; color: #666; margin-bottom: 8px;">
                                                <span style="display: inline-block; margin-right: 15px;">
                                                    <strong>Màu:</strong> {{ $cart->attributes->color }}
                                                </span>
                                                <span style="display: inline-block;">
                                                    <strong>Kích thước:</strong> {{ $cart->attributes->size }}
                                                </span>
                                            </div>
                                            <p style="margin: 0; color: #999; font-size: 12px;">Mã: #{{ $cart->id }}</p>
                                        </div>

                                        <!-- Quantity & Price Section -->
                                        <div style="flex: 0 0 300px; display: flex; align-items: center; justify-content: space-between; margin-left: 20px;">
                                            <!-- Unit Price -->
                                            <div style="text-align: center;">
                                                <p style="margin: 0; color: #999; font-size: 12px; margin-bottom: 5px;">Giá</p>
                                                <p style="margin: 0; color: #1a1a1a; font-weight: 600; font-size: 14px;">
                                                    {{ format_number_to_money($cart->price) }}
                                                </p>
                                            </div>

                                            <!-- Quantity Input -->
                                            <div style="text-align: center;">
                                                <p style="margin: 0; color: #999; font-size: 12px; margin-bottom: 5px;">Số Lượng</p>
                                                <input type="text" value="{{ $cart->id }}" hidden name="id">
                                                <input name="quantity" type="number" min="1" value="{{ $cart->quantity }}" style="width: 60px; padding: 8px 6px; text-align: center; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                                            </div>

                                            <!-- Total Price -->
                                            <div style="text-align: center;">
                                                <p style="margin: 0; color: #999; font-size: 12px; margin-bottom: 5px;">Thành Tiền</p>
                                                <p style="margin: 0; color: #ff6b35; font-weight: 700; font-size: 16px;">
                                                    {{ format_number_to_money($cart->price * $cart->quantity) }}
                                                </p>
                                            </div>

                                            <!-- Update & Delete Buttons -->
                                            <div style="display: flex; gap: 10px; align-items: center; margin-left: 20px;">
                                                <button type="submit" style="padding: 8px 16px; background-color: #ff6b35; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 600; transition: all 0.3s ease;">
                                                    Cập Nhật
                                                </button>
                                                <a href="{{ route('cart.delete', $cart->id) }}" style="color: #999; text-decoration: none; font-size: 16px; transition: color 0.3s ease;" onmouseover="this.style.color='#ff4444'" onmouseout="this.style.color='#999'">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary Section (Right) -->
                <div class="col-md-4">
                    <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); position: sticky; top: 20px;">
                        <!-- Summary Header -->
                        <h5 style="margin: 0 0 20px 0; color: #1a1a1a; font-weight: 700; font-size: 16px;">Tóm Tắt Đơn Hàng</h5>

                        <!-- Summary Items -->
                        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px;">
                                <span style="color: #666;">Tổng tiền sản phẩm:</span>
                                <span style="color: #1a1a1a; font-weight: 600;">{{ format_number_to_money(Cart::getTotal()) }} VNĐ</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px;">
                                <span style="color: #666;">Số lượng sản phẩm:</span>
                                <span style="color: #1a1a1a; font-weight: 600;">{{ Cart::getTotalQuantity() }} sản phẩm</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px;">
                                <span style="color: #666;">Phí vận chuyển:</span>
                                <span style="color: #666;">Tính khi thanh toán</span>
                            </div>
                        </div>

                        <!-- Grand Total -->
                        <div style="padding: 15px; background-color: #f9f9f9; border-radius: 4px; margin-bottom: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #1a1a1a; font-weight: 700; font-size: 14px;">Tổng Cộng:</span>
                                <span style="color: #ff6b35; font-weight: 700; font-size: 24px;">
                                    {{ format_number_to_money(Cart::getTotal()) }}
                                </span>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <a href="{{ route('checkout.index') }}" style="display: block; width: 100%; background-color: #ff6b35; color: white; padding: 14px; text-align: center; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s ease; margin-bottom: 10px;">
                            Tiến Hành Thanh Toán
                        </a>

                        <!-- Continue Shopping -->
                        <a href="{{ route('user.home') }}" style="display: block; width: 100%; background-color: #f0f0f0; color: #1a1a1a; padding: 12px; text-align: center; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s ease;">
                            Tiếp Tục Mua Sắm
                        </a>

                        <!-- Info Box -->
                        <div style="background-color: #e8f4f8; border-left: 3px solid #20a0a8; padding: 12px; border-radius: 4px; margin-top: 20px; font-size: 12px; color: #1a1a1a;">
                            <p style="margin: 0 0 5px 0; font-weight: 600;">💡 Mẹo:</p>
                            <p style="margin: 0;">Kiểm tra lại thông tin sản phẩm trước khi thanh toán để đảm bảo chính xác.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@vite(['resources/client/css/cart.css'])
@endsection