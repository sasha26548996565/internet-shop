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
                                @isset($order)
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td class="product-col">
                                                <img src="img/cart/1.jpg" alt="{{ $product->name }}">
                                                <div class="pc-title">
                                                    <h4>{{ $product->name }}</h4>
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

                                                        @if ($product->pivot->count >= $product->count)
                                                            <input type="text" class="inc" value="+" readonly>
                                                        @else
                                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                                @csrf

                                                                <input type="submit" value="+" class="inc" style="cursor: pointer;">
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="size-col">
                                                @forelse ($product->propertyOptions as $propertyOption)
                                                    <h4>{{ $propertyOption->property->name }}: {{ $propertyOption->name }}</h4>
                                                @empty
                                                    <h4>properties does not exists!</h4>
                                                @endforelse
                                            </td>
                                            <td class="total-col"><h4 id="totalSum">{{ $product->getPriceForCount() }}$</h4></td>
                                        </tr>
                                    @endforeach
                                @endisset
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Total <span>{{ $order->promoCode ? $order->getTotalPriceWithPromoCode() : $order->getTotalPrice() }}$</span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
                    @isset ($order->promoCode)
                        <p>{{ $order->promoCode->promo_code }}</p>
                    @else
                        <form action="{{ route('cart.promo_code.add') }}" method="POST" class="promo-code-form">
                            @csrf

                            <input type="text" name="promo_code" placeholder="Enter promo code">
                            @include('includes.error', ['fieldName' => 'promo_code'])

                            <button type="submit">Submit</button>
                        </form>
                    @endisset
					<a href="{{ route('checkout.index') }}" class="site-btn">Proceed to checkout</a>
				</div>
			</div>
		</div>
	</section>

@endsection
