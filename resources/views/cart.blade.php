@extends('layouts.master')

@section('title', 'cart')

@section('content')
	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">Properties</th>
									<th class="total-th">Price</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td class="product-col">
                                            <img src="img/cart/1.jpg" alt="{{ $product->name }}">
                                            <div class="pc-title">
                                                <h4>{{ $product->name }} {{ $product->id }}</h4>
                                                <p>{{ $product->price }} $</p>
                                            </div>
                                        </td>
                                        <td class="quy-col">
                                            <div class="quantity">
                                                <div class="pro-qty d-flex">
                                                    <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                                        @csrf

                                                        <input type="submit" value="-" class="dec" style="cursor: pointer;">
                                                    </form>

                                                    <input type="text" value="{{ $product->pivot->count }}" readonly>

                                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                        @csrf

                                                        <input type="submit" value="+" class="inc" style="cursor: pointer;">
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="size-col">
                                            <h4>properties does not exists!</h4>
                                        </td>
                                        <td class="total-col"><h4 id="totalSum">{{ $product->getPriceForCount() }}$</h4></td>
                                    </tr>
                                @endforeach
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Total <span>{{ $order->getTotalPrice() }}$</span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
					<form class="promo-code-form">
						<input type="text" placeholder="Enter promo code">
						<button>Submit</button>
					</form>
					<a href="" class="site-btn">Proceed to checkout</a>
					<a href="" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

	<!-- Related product section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title text-uppercase">
				<h2>Continue Shopping</h2>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<div class="tag-new">New</div>
							<img src="./img/product/2.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Black and White Stripes Dress</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="./img/product/5.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="./img/product/9.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="./img/product/1.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Related product section end -->

@endsection
