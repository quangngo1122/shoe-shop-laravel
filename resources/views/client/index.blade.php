@extends('layouts.client')
@section('content-client')
<style>
    .thumbnailimg:hover{
        filter: opacity(90%);
        transform: scale(1.05);
    }
    .changebgcolor{
        background:#ff8132;
        transform: scale(1.05);
        transition: 0.5s ease-in-out;
    }
    .caption2 >h1{
        font-weight: bold;
    }
    .caption3 > p{
        color:rgb(241, 220, 213);;
        font-weight: bold;
    }
</style>

<div class="clearfix"></div>
<div class="hom-slider">
    <div class="container">
        <div id="sequence">
            <div class="sequence-prev"><i class="fa fa-angle-left"></i></div>
            <div class="sequence-next"><i class="fa fa-angle-right"></i></div>
            <ul class="sequence-canvas">
                <li class="animate-in">
                    <div class="flat-caption caption2 formLeft delay400 text-center">
                        <h1>Q&Q SHOP</h1>
                    </div>
                    <div class="flat-caption caption3 formLeft delay500 text-center">
                        <p>We hope you will be happy with products offered by the Q&QShop and that you will shop with us again and again.</p>
                        <p>Our goal is to offer the widest range of products offered by the Q&QShop at the highest quality. </p>
                        <p>If you think we should add any items to our store, don’t hesitate to contact us and share your feedback. Until then, enjoy your shopping!</p>
                    </div>
                    <div class="flat-image formBottom delay200" data-duration="5" data-bottom="true"><img src="{{ asset('asset/client/images/slider-image-03.png') }}" alt=""></div>
                </li>
                <li>
                    <div class="flat-caption caption2 formLeft delay400 text-center">
                        <h1>Q&Q SHOP</h1>
                    </div>
                    <div class="flat-caption caption3 formLeft delay500 text-center">
                        <p>Chúng tôi hy vọng bạn sẽ hài lòng với các sản phẩm do Q&QShop cung cấp và sẽ tiếp tục mua sắm cùng chúng tôi.</p>
                        <p>Mục tiêu của chúng tôi là cung cấp nhiều loại sản phẩm nhất được cung cấp bởi Q&QShop với chất lượng cao nhất.</p>
                        <p>Nếu bạn cho rằng chúng tôi nên thêm bất kỳ mặt hàng nào vào cửa hàng, đừng ngần ngại liên hệ với chúng tôi và chia sẻ phản hồi của bạn. Cho đến lúc đó, hãy tận hưởng việc mua sắm của bạn!</p>
                    </div>
                    <div class="flat-image formBottom delay200" data-bottom="true"><img src="{{ asset('asset/client/images/slider-image-02.png') }}" alt=""></div>
                </li>
            </ul>
        </div>
    </div>
    {{-- <div class="promotion-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="promo-box"><img src="{{ asset('asset/client/images/promotion-01.png') }}" alt=""></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="promo-box"><img src="{{ asset('asset/client/images/promotion-02.png') }}" alt=""></div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="promo-box"><img src="{{ asset('asset/client/images/promotion-03.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<div class="clearfix"></div>
<div class="container_fullwidth" style="padding-top:10px;">
    <div class="container">
    <div class="featured-products">
            <h3 class="title" style="color:rgb(0, 0, 139); font-weight: bold;">Sản Phẩm Mới Nhất:</h3>
            <div class="control"></div>
            <ul>
                <li>
                <div class="row">
                    @foreach ($newProducts as $newProduct)
                        <div class="col-md-3 col-sm-6">
                            <div class="products">
                            <!-- Mới Nhất -->
                                <div class="offer">New!</div>
                                <div class="thumbnail"><a href="{{ route('user.products_detail', $newProduct->id) }}"><img class="thumbnailimg" src="{{ asset("assets/client/images/products/small/$newProduct->img") }}" alt="Product Name"></a></div>
                                <div class="productname" style="height: 42px;">{{ $newProduct->name }}</div>
                                <h4 class="price">{{ format_number_to_money($newProduct->price_sell) }} VNĐ</h4>
                                <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                    <x-avg-stars :number="$newProduct->avg_rating" />
                                    <span style="font-size: 14px;">Đã bán: {{ $newProduct->sum }}</span>
                                </div>
                                <div class="button_group"><a href="{{ route('user.products_detail', $newProduct->id) }}" class="button add-cart" type="button">Xem Chi Tiết</a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </li>
            </ul>
            <div class="pagination-box">
                {{ $newProducts->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="hot-products">
            <h3 class="title" style="color:rgb(0, 0, 139); font-weight: bold;">Sản Phẩm Hot Nhất:</h3>
            <div class="control"></div>
            <ul>
                <li>
                <div class="row">
                    @foreach ($bellingProducts as $bellingProduct)
                    <div class="col-md-3 col-sm-6">
                        <div class="products">
                        <!-- Bán Chạy -->
                            <div class="offer">Hot!</div>
                            <div class="thumbnail">
                                <a href="{{ route('user.products_detail', $bellingProduct->id) }}"><img class="thumbnailimg" src="{{ asset("assets/client/images/products/small/$bellingProduct->img") }}" alt="Product Name"></a>
                            </div>
                            <div class="productname" style="height: 42px;">{{ $bellingProduct->name }}</div>
                            <h4 class="price">{{ format_number_to_money($bellingProduct->price_sell) }} VNĐ</h4>
                            <div class="productname" style="padding-bottom: 10px; padding-top: unset;">
                                <x-avg-stars :number="$bellingProduct->avg_rating" />
                                <span style="font-size: 14px;">Đã bán: {{ $bellingProduct->sum }}</span>
                            </div>
                            <div class="button_group"><a href="{{ route('user.products_detail', $bellingProduct->id) }}" class="button add-cart" type="button">Xem Chi Tiết</a></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
        let changebg = document.querySelectorAll('.offer');
        for(let i = 0 ; i < changebg.length; i+=2){
            setInterval(() => {
            changebg[i].classList.toggle('changebgcolor');
        }, 500);
        }
        for(let i = 1 ; i < changebg.length; i+=2){
            setInterval(() => {
            changebg[i].classList.toggle('changebgcolor');
        }, 500);
        }
        // setTimeout(() => { for(let i = 1 ; i < changebg.length; i+=2){
        //     setInterval(() => {
        //     changebg[i].classList.toggle('changebgcolor');
        // }, 500);
        // }},500);
        
    </script>
@endsection