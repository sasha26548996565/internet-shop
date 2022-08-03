<div class="product-item">
    <div class="pi-pic">
        <div class="tag-sale">ON SALE</div>
        <img src="{{ asset('img/product/1.jpg') }}" alt="{{ $product->name }}">
        <div class="pi-links">
            <a href="#" class="addCart add-card" id="{{ $product->id }}" ><i class="flaticon-bag"></i><span data-id="{{ $product->id }}">ADD TO CART</span></a>
            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
        </div>
    </div>
    <div class="pi-text">
        <h6>{{ $product->price }} $</h6>
        <p class="details_name" data-id="{{ $product->id }}">{{ $product->name }}</p>
    </div>
</div>
