@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth" style="background-color: #f7f7f7; padding: 40px 0;">
    <div class="container">
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 30px;">
            <div style="min-width: 240px;">
                <h1 style="font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px;">Lịch Sử Mua Hàng</h1>
                <p style="color: #666; font-size: 14px; margin: 0;">Xem lịch sử đơn hàng, trạng thái và chi tiết từng đơn.</p>
            </div>
            <div id="order-view-toggle" style="display: flex; gap: 10px;">            
                <button id="btn-table-view" class="btn-a" style="padding:8px 12px;">Bảng</button>
                <button id="btn-card-view" class="btn-a" style="padding:8px 12px; background:#ff6b35; color:#fff; border:none;">Thẻ</button>
            </div>
        </div>
        @if (count($orderHistorys) <= 0)
            <div style="background: white; padding: 60px; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <i class="fas fa-box-open" style="font-size: 60px; color: #f1f1f1; margin-bottom: 20px;"></i>
                <h3 style="margin-bottom: 8px; color: #1a1a1a;">Bạn chưa có đơn hàng nào</h3>
                <p style="color: #777; margin-bottom: 20px;">Hãy mua sắm để tạo đơn hàng đầu tiên của bạn.</p>
                <a href="{{ route('user.home') }}" class="btn-a" style="background-color: #ff6b35; color: #fff; border: none; padding: 12px 28px;">Tiếp Tục Mua Sắm</a>
            </div>
        @else
            <!-- Table View (original code retained) -->
            <div id="order-table-view" style="display:none; clear: both; position: relative;">
                <div style="background: white; border-radius:8px; padding:16px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); overflow: auto;">
                    <table class="table table-bordered table-cart">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Mã ĐH</th>
                                <th scope="col" class="text-center">Tổng Tiền</th>
                                <th scope="col" class="text-center">Ngày Đặt Hàng</th>
                                <th scope="col" class="text-center">Phương Thức TT</th>
                                <th scope="col" class="text-center">Trạng Thái Đơn</th>
                                <th scope="col" class="text-center">Ghi chú</th>
                                <th scope="col" class="text-center">Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderHistorys as $orderHistory)
                                <tr>
                                    <td class="text-center">{{ $orderHistory->id }}</td>
                                    <td class="text-center">{{ format_number_to_money($orderHistory->total_money) }}</td>
                                    <td class="text-center">{{ $orderHistory->created_at }}</td>
                                    <td class="text-center"><span class="badge badge-info">{{ $orderHistory->payment_name }}</span></td>
                                    <td class="text-center">
                                        @if ($orderHistory->order_status == 0)
                                            <span class="badge badge-warning">Chờ xử lý</span>
                                        @elseif($orderHistory->order_status == 1)
                                            <span class="badge badge-info">Đang giao hàng</span>
                                        @elseif($orderHistory->order_status == 2)
                                            <span class="badge badge-danger">Đã hủy</span>
                                        @elseif($orderHistory->order_status == 3)
                                            <span class="badge badge-success">Đã nhận hàng</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $orderHistory->note }}</td>
                                    <td>
                                        <div style="padding: 8px; display: flex; justify-content: center; gap:10px;">
                                            <a class="btn-a" href="{{ route('order_history.show', $orderHistory->id) }}">Chi tiết</a>
                                            @if ($orderHistory->order_status == 0)
                                                <a class="btn-a" href="{{ route('order_history.update', $orderHistory->id) }}">Hủy Đơn</a>
                                            @elseif($orderHistory->order_status == 1)
                                                <a class="btn-a" href="{{ route('order_history.update', $orderHistory->id) }}">Xác Nhận</a>
                                            @elseif(in_array($orderHistory->order_status, [2,3]))
                                                <a class="btn-a" href="{{ route('order_history.update', $orderHistory->id) }}">Xóa Đơn</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Card View (new) -->
            <div id="order-card-view" style="clear: both; position: relative;">
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
                                            <a href="{{ route('order_history.show', $orderHistory->id) }}" class="btn-a" style="background:#fff; border:1px solid #e6e6e6; padding:8px 12px; color:#1a1a1a; white-space: nowrap;">Chi tiết</a>
                                            @if ($orderHistory->order_status == 0)
                                                <a href="{{ route('order_history.update', $orderHistory->id) }}" class="btn-a" style="background:#ff6b35; color:#fff; border:none; padding:8px 12px; white-space: nowrap;">Hủy Đơn</a>
                                            @elseif($orderHistory->order_status == 1)
                                                <a href="{{ route('order_history.update', $orderHistory->id) }}" class="btn-a" style="background:#20a0a8; color:#fff; border:none; padding:8px 12px; white-space: nowrap;">Xác Nhận</a>
                                            @elseif(in_array($orderHistory->order_status, [2,3]))
                                                <a href="{{ route('order_history.update', $orderHistory->id) }}" class="btn-a" style="background:#C0C0C0; color:#1a1a1a; border:1px solid #e6e6e6; padding:8px 12px; white-space: nowrap;">Xóa Đơn</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 22px; display:flex; justify-content:center;">
                {{ $orderHistorys->links('vendor.pagination.default') }}
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const btnTable = document.getElementById('btn-table-view');
                    const btnCard = document.getElementById('btn-card-view');
                    const tableView = document.getElementById('order-table-view');
                    const cardView = document.getElementById('order-card-view');
                    const STORAGE_KEY = 'orderHistoryView';
                    function setActive(view) {
                        if (view === 'table') {
                            tableView.style.display = '';
                            cardView.style.display = 'none';
                            btnTable.style.background = '#ff6b35';
                            btnTable.style.color = '#fff';
                            btnTable.style.border = 'none';
                            btnCard.style.background = '';
                            btnCard.style.color = '';
                            btnCard.style.border = '';
                        } else {
                            tableView.style.display = 'none';
                            cardView.style.display = '';
                            btnCard.style.background = '#ff6b35';
                            btnCard.style.color = '#fff';
                            btnCard.style.border = 'none';
                            btnTable.style.background = '';
                            btnTable.style.color = '';
                            btnTable.style.border = '';
                        }
                        try { localStorage.setItem(STORAGE_KEY, view); } catch (e) {}
                    }
                    btnTable.addEventListener('click', function () { setActive('table'); });
                    btnCard.addEventListener('click', function () { setActive('card'); });
                    // initialize from storage (default: card)
                    try {
                        const saved = localStorage.getItem(STORAGE_KEY) || 'card';
                        setActive(saved);
                    } catch (e) {
                        setActive('card');
                    }
                });
            </script>
        @endif
    </div>
</div>
@vite(['resources/client/css/cart.css'])
@endsection