@extends('layouts.master')

@section('custom_js')
    @include('includes.ajax.loadMore')
@endsection

@section('content')
    <section class="hero-section">
        <div class="hero-slider owl-carousel">
            @foreach ($newProducts as $product)
                <div class="hs-item set-bg" data-setbg="img/bg.jpg">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 text-white">
                                <span>{{ $product->name }}</span>
                                <h2>{{ $product->category->name }}</h2>
                                <p>{{ $product->description }}</p>
                                <a href="#" class="site-btn sb-line">DISCOVER</a>
                                @if ($product->isAvailable())
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline-block">
                                        @csrf

                                        <input type="submit" class="site-btn sb-white" value="ADD TO CART">
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="offer-card text-white">
                            <span>from</span>
                            <h2>$29</h2>
                            <p>SHOP NOW</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container">
            <div class="slide-num-holder" id="snh-1"></div>
        </div>
    </section>
    <!-- Hero section end -->

    <!-- Features section -->
    <section class="features-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="img/icons/1.png" alt="#">
                        </div>
                        <h2>Fast Secure Payments</h2>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="img/icons/2.png" alt="#">
                        </div>
                        <h2>Premium Products</h2>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="img/icons/3.png" alt="#">
                        </div>
                        <h2>Free & fast Delivery</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section end -->

    <!-- Product filter section -->
    <section class="product-filter-section">
        <div class="container">
            <div class="section-title">
                <h2>BROWSE TOP SELLING PRODUCTS</h2>
            </div>
            <ul class="product-filter-menu">
                @foreach ($categories as $category)
                    <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-sm-6" id="products">
                        @include('card_product', $product)
                    </div>
                @endforeach
            </div>
            <div class="text-center pt-5">
                <button class="site-btn sb-line sb-dark" id="load-more" data-paginate="2">Load more...</button>
                <p class="invisible">No more products...</p>
            </div>
        </div>
    </section>
    <!-- Product filter section end -->


    <!-- Banner section -->
    <section class="banner-section">
        <div class="container">
            <div class="banner set-bg" data-setbg="img/banner-bg.jpg">
                <div class="tag-new">NEW</div>
                <span>New Arrivals</span>
                <h2>STRIPED SHIRTS</h2>
                <a href="#" class="site-btn">SHOP NOW</a>
            </div>
        </div>
    </section>

@endsection