<div class="product-item">
    <div class="pi-pic">
        @foreach ($product->getLabels() as $label)
            @if ($product->$label)
                <span class="tag tag-sale">{{ Str::upper($label) }}</span>
            @endif
        @endforeach

        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
        <div class="pi-links d-flex justify-content-around">
            @if ($product->isAvailable())
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf

                    <button type="submit" style="padding:0; margin:0; border:0; background-color:transparent; cursor: pointer;"
                        class="add-cart" value="ADD TO CART"><i class="flaticon-bag"></i></button>
                </form>
            @endif

            @auth
                <form action="{{ route('like.add', [auth()->user()->id, $product->id]) }}" method="POST">
                    @csrf

                    @if (auth()->user()->hasLike($product->id))
                        <button type="submit" style="padding:0; margin:0; border:0; background-color:transparent; cursor: pointer;"
                            class="wishlist-btn"><i class="flaticon-heart" style="background-color: #fff;"></i></button>
                    @else
                        <button type="submit" style="padding:0; margin:0; border:0; background-color:transparent; cursor: pointer;"
                            class="wishlist-btn"><i class="flaticon-heart"></i></button>
                    @endif
                </form>
            @endauth
        </div>
    </div>
    <div class="pi-text">
        <h6>{{ $product->price }} $</h6>
        <a href="{{ route('product', $product->slug) }}" style="color: black;">{{ $product->name }}</a>
    </div>
</div>
