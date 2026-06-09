@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth" style="background-color: #f7f7f7; padding: 40px 0;">
    <div class="container">
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Lịch Sử Mua Hàng</h1>
            <p style="color: #666; font-size: 14px; margin: 0;">Xem lịch sử đơn hàng, trạng thái và chi tiết từng đơn.</p>
        </div>

        @if (count($orderHistorys) <= 0)
            <div style="background: white; padding: 60px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <i class="fas fa-box-open" style="font-size: 60px; color: #f1f1f1; margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 8px; color: #1a1a1a;">Bạn chưa có đơn hàng nào</h3>
                <p style="color: #777; margin-bottom: 20px;">Hãy mua sắm để tạo đơn hàng đầu tiên của bạn.</p>
                <a href="{{ route('user.home') }}" class="btn-a" style="background-color: #ff6b35; color: #fff; border: none; padding: 12px 28px;">Tiếp Tục Mua Sắm</a>
            </div>
        @else
            <div class="row" style="gap: 20px;">
                <div class="col-12">
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 18px;">
                        @foreach ($orderHistorys as $orderHistory)
                            <div style="background: white; border-radius: 8px; padding: 18px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: flex; flex-direction: column; justify-content: space-between;">
                                <div style="display:flex; justify-content: space-between; align-items: start; gap: 12px;">
                                    <div>
                                        <h4 style="margin:0; font-size:16px; color:#1a1a1a;">Đơn hàng #{{ $orderHistory->id }}</h4>
                                        <p style="margin:6px 0 0 0; color:#666; font-size:13px;">Ngày: {{ $orderHistory->created_at }}</p>
                                    </div>
                                    <div style="text-align:right;">
                                        <p style="margin:0; font-size:14px; color:#1a1a1a; font-weight:700;">{{ format_number_to_money($orderHistory->total_money) }}</p>
                                        <p style="margin:6px 0 0 0; font-size:12px; color:#666;">{{ $orderHistory->payment_name }}</p>
                                    </div>
                                </div>

                                <div style="display:flex; justify-content: space-between; align-items: center; margin-top: 12px; gap:12px;">
                                    <div>
                                        @if ($orderHistory->order_status == 0)
                                            <span class="badge badge-warning" style="padding:6px 10px; font-size:12px; border-radius:4px;">Chờ xử lý</span>
                                        @elseif($orderHistory->order_status == 1)
                                            <span class="badge badge-info" style="padding:6px 10px; font-size:12px; border-radius:4px;">Đang giao hàng</span>
                                        @elseif($orderHistory->order_status == 2)
                                            <span class="badge badge-danger" style="padding:6px 10px; font-size:12px; border-radius:4px;">Đã hủy</span>
                                        @elseif($orderHistory->order_status == 3)
                                            <span class="badge badge-success" style="padding:6px 10px; font-size:12px; border-radius:4px;">Đã nhận hàng</span>
                                        @endif
                                        @if(!empty($orderHistory->note))
                                            <div style="margin-top:8px; color:#666; font-size:13px;">Ghi chú: {{ $orderHistory->note }}</div>
                                        @endif
                                    </div>

                                    <div style="display:flex; gap:10px;">
                                        <a href="{{ route('order_history.show', $orderHistory->id) }}" class="btn-a" style="background:#fff; border:1px solid #e6e6e6; padding:8px 12px; color:#1a1a1a;">Chi tiết</a>

                                        @if ($orderHistory->order_status == 0)
                                            <a href="{{ route('order_history.update', $orderHistory->id) }}" class="btn-a" style="background:#ff6b35; color:#fff; border:none; padding:8px 12px;">Hủy Đơn</a>
                                        @elseif($orderHistory->order_status == 1)
                                            <a href="{{ route('order_history.update', $orderHistory->id) }}" class="btn-a" style="background:#20a0a8; color:#fff; border:none; padding:8px 12px;">Xác Nhận</a>
                                        @elseif(in_array($orderHistory->order_status, [2,3]))
                                            <a href="{{ route('order_history.update', $orderHistory->id) }}" class="btn-a" style="background:#f0f0f0; color:#1a1a1a; border:1px solid #e6e6e6; padding:8px 12px;">Xóa Đơn</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div style="margin-top: 22px; display:flex; justify-content:center;">
                {{ $orderHistorys->links('vendor.pagination.default') }}
            </div>
        @endif
    </div>
</div>

@vite(['resources/client/css/cart.css'])
@endsection