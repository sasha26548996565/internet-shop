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
