@extends('layouts.master')

@section('title', 'product ' . $product->name)

@section('content')
	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
				<a href="{{ route('category', $product->category->slug) }}"> &lt;&lt; Back to Category</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title">{{ $product->name }}</h2>
					<h3 class="p-price">{{ $product->price }}$</h3>
					<h4 class="p-stock">Available: <span>{{ $product->isAvailable() ? "In stock" : "No Stock" }}</span></h4>
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->

@endsection
