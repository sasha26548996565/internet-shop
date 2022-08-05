@extends('layouts.master')

@section('title', 'checkout')

@section('content')
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				<a href="{{ route('index') }}">Home</a> /
				<a href="{{ route('cart.index') }}">Your cart</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form action="{{ route('checkout.save', $order->id) }}" method="POST" class="checkout-form">
                        @csrf

						<div class="cf-title">Billing Address</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="text" name="address" value="{{ old('address') }}" placeholder="Address">
                                @include('includes.error', ['fieldName' => 'address'])

								<input type="text" name="address_line_2" value="{{ old('address_line_2') }}" placeholder="Address line 2">
                                @include('includes.error', ['fieldName' => 'address_line_2'])

								<input type="text" name="country" value="{{ old('country') }}" placeholder="Country">
                                @include('includes.error', ['fieldName' => 'country'])
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Zip code" name="zipcode">
                                @include('includes.error', ['fieldName' => 'zipcode'])
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Phone no." name="phone">
							</div>
						</div>
						<div class="cf-title">Delievery Info</div>
						<div class="row shipping-btns">
							<div class="col-6">
								<h4>Standard</h4>
							</div>
							<div class="col-6">
								<div class="cf-radio-btns">
									<div class="cfr-item">
										<input type="radio" name="shipping" value="free" @checked(old('shipping')) id="ship-1">
										<label for="ship-1">Free</label>
									</div>
								</div>
							</div>
							<div class="col-6">
								<h4>Next day delievery  </h4>
							</div>
							<div class="col-6">
								<div class="cf-radio-btns">
									<div class="cfr-item">
										<input type="radio" name="shipping" value="next_day" @checked(old('shipping')) id="ship-2">
										<label for="ship-2">$3.45</label>
									</div>
								</div>
							</div>
						</div>
						<div class="cf-title">Payment</div>
						<ul class="payment-list">
							<li>Paypal<a href="#"><img src="{{ asset('img/paypal.png') }}" alt=""></a></li>
							<li>Credit / Debit card<a href="#"><img src="{{ asset('img/mastercart.png') }}" alt=""></a></li>
							<li>Pay when you get the package</li>
						</ul>
						<button class="site-btn submit-order-btn">Place Order</button>
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<ul class="product-list">
                            @foreach ($order->products as $product)
                                <li>
                                    <div class="pl-thumb"><img src="{{ $product->image }}" alt="{{ $product->name }}"></div>
                                    <h6>{{ $product->name }}</h6>
                                    <p>{{ $product->price }}</p>
                                </li>
                            @endforeach
						</ul>
						<ul class="price-list">
							<li>Total<span>{{ $order->promoCode ? $order->getTotalPriceWithPromoCode() : $order->getTotalPrice() }}$</span></li>
							<li>Shipping<span>free</span></li>
							<li class="total">Total<span>{{ $order->promoCode ? $order->getTotalPriceWithPromoCode() : $order->getTotalPrice() }}$</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->

@endsection
