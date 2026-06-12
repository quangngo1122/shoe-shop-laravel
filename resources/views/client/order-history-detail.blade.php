@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth" style="background-color: #f7f7f7; padding: 40px 0;">
    <div class="container">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Chi Tiết Đơn Hàng #{{ $order->id }}</h1>
                <p style="color: #666; font-size: 13px; margin: 0;">Thông tin chi tiết sản phẩm trong đơn hàng</p>
            </div>
            <a href="{{ route('order_history.index') }}" style="display: inline-flex; align-items: center; gap: 8px; background-color: #f0f0f0; color: #1a1a1a; padding: 10px 18px; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s ease;">
                <i class="fas fa-arrow-left"></i> Quay Lại
            </a>
        </div>

        <div class="row" style="gap: 20px;">
            <!-- Main Content (Left) -->
            <div class="col-md-8">
                <!-- Order Info Card -->
                <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 20px;">
                    <h5 style="margin-top: 0; margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 14px;">Thông Tin Đơn Hàng</h5>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px;">
                        <div>
                            <p style="margin: 0; font-size: 12px; color: #999; margin-bottom: 4px;">Mã Đơn Hàng</p>
                            <p style="margin: 0; font-size: 14px; font-weight: 600; color: #1a1a1a;">#{{ $order->id }}</p>
                        </div>
                        <div>
                            <p style="margin: 0; font-size: 12px; color: #999; margin-bottom: 4px;">Ngày Đặt</p>
                            <p style="margin: 0; font-size: 14px; font-weight: 600; color: #1a1a1a;">{{ $order->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p style="margin: 0; font-size: 12px; color: #999; margin-bottom: 4px;">Phương Thức TT</p>
                            <span class="badge badge-info" style="padding: 6px 10px; font-size: 12px; border-radius: 4px;">{{ $infomationUser->payment_name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Products List -->
                <div style="background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden;">
                    <div style="background-color: #f9f9f9; padding: 16px; border-bottom: 1px solid #eee;">
                        <h5 style="margin: 0; color: #1a1a1a; font-weight: 600; font-size: 14px;">Sản Phẩm Trong Đơn ({{ count($order_details) }})</h5>
                    </div>

                    <div style="padding: 0;">
                        <?php $totalProductMoney = 0; ?>
                        @foreach ($order_details as $order_detail)
                            <?php $totalProductMoney += $order_detail->unit_price * $order_detail->quantity; ?>
                            <div style="padding: 16px; border-bottom: 1px solid #eee; display: flex; gap: 16px; align-items: flex-start; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor='white'">
                                <!-- Product Image -->
                                <div style="flex: 0 0 100px;">
                                    <img src="{{ asset("assets/client/images/products/small/$order_detail->product_img") }}" alt="{{ $order_detail->product_name }}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 4px;">
                                </div>

                                <!-- Product Info -->
                                <div style="flex: 1;">
                                    <h6 style="margin: 0 0 8px 0; color: #1a1a1a; font-weight: 600; font-size: 14px;">
                                        <a href="{{ route('user.products_detail', $order_detail->product_id) }}" style="color: #1a1a1a; text-decoration: none;">{{ $order_detail->product_name }}</a>
                                    </h6>
                                    <div style="display: flex; gap: 20px; font-size: 13px; color: #666; margin-bottom: 10px;">
                                        <span><strong>Màu:</strong> {{ $order_detail->color_name }}</span>
                                        <span><strong>Kích thước:</strong> {{ $order_detail->size_name }}</span>
                                    </div>
                                    <p style="margin: 0; font-size: 12px; color: #999;">Mã SP: #{{ $order_detail->product_id }}</p>
                                </div>

                                <!-- Quantity & Price -->
                                <div style="flex: 0 0 180px; text-align: right;">
                                    <div style="margin-bottom: 8px;">
                                        <p style="margin: 0; font-size: 12px; color: #999; margin-bottom: 4px;">Giá</p>
                                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: #1a1a1a;">{{ format_number_to_money($order_detail->unit_price) }}</p>
                                    </div>
                                    <div style="margin-bottom: 8px; display:flex; justify-content: flex-end;">
                                        <p style="margin: 0; margin-right:2px; font-size: 12px; color: #999; margin-bottom: 4px;">Số Lượng</p>
                                        <p style="margin: 0; font-size: 14px; font-weight: 600; color: #1a1a1a;">x{{ $order_detail->quantity }}</p>
                                    </div>
                                    <div style="padding-top: 8px; border-top: 1px solid #eee;">
                                        <p style="margin: 0; font-size: 12px; color: #999; margin-bottom: 4px;">Thành Tiền</p>
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; color: #ff6b35;">{{ format_number_to_money($order_detail->unit_price * $order_detail->quantity) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right) -->
            <div class="col-md-4">
                <!-- Summary Card -->
                <div style="background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); position: sticky; top: 20px;">
                    <h5 style="margin-top: 0; margin-bottom: 16px; color: #1a1a1a; font-weight: 600; font-size: 14px;">Tóm Tắt Đơn Hàng</h5>

                    <!-- Summary Items -->
                    <div style="border-bottom: 1px solid #eee; padding-bottom: 16px; margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px;">
                            <span style="color: #666;">Tổng tiền sản phẩm:</span>
                            <span style="color: #1a1a1a; font-weight: 600;">{{ format_number_to_money($totalProductMoney) }} VND</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px;">
                            <span style="color: #666;">Phí vận chuyển:</span>
                            <span style="color: #1a1a1a; font-weight: 600;">{{ format_number_to_money($infomationUser->orders_transport_fee) }} VND</span>
                        </div>
                    </div>

                    <!-- Grand Total -->
                    <div style="background-color: #f9f9f9; padding: 16px; border-radius: 4px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #1a1a1a; font-weight: 700; font-size: 14px;">Tổng Cộng:</span>
                            <span style="color: #ff6b35; font-weight: 700; font-size: 24px;">{{ format_number_to_money($order->total_money) }}</span>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div style="background-color: #e8f4f8; border-left: 3px solid #20a0a8; padding: 12px; border-radius: 4px;">
                        <p style="margin: 0 0 6px 0; font-size: 12px; font-weight: 600; color: #1a1a1a;">Trạng Thái Đơn</p>
                        <p style="margin: 0; font-size: 13px; color: #1a1a1a;">
                            @if ($order->order_status == 0)
                                <span class="badge badge-warning" style="padding: 6px 10px; border-radius: 4px;">Chờ xử lý</span>
                            @elseif($order->order_status == 1)
                                <span class="badge badge-info" style="padding: 6px 10px; border-radius: 4px;">Đang giao hàng</span>
                            @elseif($order->order_status == 2)
                                <span class="badge badge-danger" style="padding: 6px 10px; border-radius: 4px;">Đã hủy</span>
                            @elseif($order->order_status == 3)
                                <span class="badge badge-success" style="padding: 6px 10px; border-radius: 4px;">Đã nhận hàng</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@vite(['resources/client/css/cart.css'])
@endsection