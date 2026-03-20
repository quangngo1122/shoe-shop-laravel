@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth content-page">
    <div class="container">
      <div class="row">
       <div class="col-12">
        {!! $setting->introduction !!}
       </div>
      </div>
      <div class="clearfix">
      </div>
    </div>
    <div style="display:flex;">
        <div style="margin-left:220px;list-style:none;">
            <li style="line-height:0px;"><img srcset="asset/client/images/chuky.png" width = "90px" alt=""></li>
            <li style="line-height:0px;margin-left:5px;"><img srcset="asset/client/images/hoten.png" width = "90px" alt=""></li></div>
        <div class ="thanksyouverymuch">
              <style>
                      .containerabc{margin-left:900px;}
                      @media screen and (min-width: 1024px) {
                          @keyframes moveY {
                            from {
                                transform: translateY(-15px);}
                            to {
                                transform: translateY(15px);}}
                        .hero-image img {animation: moveY 1.8s alternate infinite;}}
                      @media screen and (max-width: 1023.98px) {
                      .hero {padding-top: 40px;}
                      .hero-container {flex-wrap: wrap;gap: 60px;}
                      .hero-image {
                          max-width: 330px;
                          margin-left: auto;
                          margin-right: auto;}
                      .hero-desc {width: 100%;}}
                      @media screen and (max-width: 767.98px) {.hero {padding-top: 0;}}
                      @media screen and (max-width: 475.98px) {.hero-image {max-width: 85%;}}
              </style>
            <section class="hero">
                    <div class="containerabc">
                        <div class="hero-container">
                            <div class="hero-content">
                            </div>
                            <div class="hero-image">
                                <img srcset="asset/client/images/thanks.png 2x" width = "150px" alt="">
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>
@endsection