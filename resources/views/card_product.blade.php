<div class="product-item">
    <div class="pi-pic">
        <div class="tag-sale">ON SALE</div>
        <img src="{{ asset('img/product/1.jpg') }}" alt="{{ $product->name }}">
        <div class="pi-links d-flex justify-content-around">
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf

                <button type="submit" style="padding:0; margin:0; border:0; background-color:transparent; cursor: pointer;"
                    class="add-cart" value="ADD TO CART"><i class="flaticon-bag"></i></button>
            </form>
            <form action="" method="POST">
                <button type="submit" style="padding:0; margin:0; border:0; background-color:transparent; cursor: pointer;"
                    class="wishlist-btn"><i class="flaticon-heart"></i></button>
            </form>
        </div>
    </div>
    <div class="pi-text">
        <h6>{{ $product->price }} $</h6>
        <a class="details_name" href="{{ route('product', $product->slug) }}" style="color: black;" data-id="{{ $product->id }}">{{ $product->name }}</a>
    </div>
</div>
