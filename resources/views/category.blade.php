@extends('layouts.master')

@section('title', 'category ' . $category->name)

@section('custom_js')
    @include('includes.ajax.loadMore')
@endsection

@section('content')
	<div class="page-top-info">
		<div class="container">
			<h4>CAtegory PAge {{ $category->name }}</h4>
			<div class="site-pagination">
				<a href="{{ route('index') }}">Home</a> /
				<a href="{{ route('index') }}">Shop</a> /
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
                    <form action="" method="GET">
                        <div class="filter-widget mb-0">
                            <h2 class="fw-title">refine by</h2>
                            <div class="price-range-wrap">
                                <h4>Price</h4>
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="1" data-max="5000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;">
                                    </span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;">
                                    </span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" name="min_price" id="minamount">
                                        <input type="text" name="max_price" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($properties as $property)
                            <div class="filter-widget mb-0">
                                <h2 class="fw-title">{{ $property->name }}</h2>
                                <div class="fw-size-choose">
                                    @foreach ($property->propertyOptions as $propertyOption)
                                    <input type="radio"
                                        name="{{ $property->name }}[{{ $propertyOption->name }}]" id="{{ $propertyOption->id }}">
                                    <label for="{{ $propertyOption->id }}">{{ $propertyOption->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                        <input type="submit" value="filter" class="btn btn-success">
                    </form>
				</div>

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row" id="products">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                @include('card_product', $product)
                            </div>
                        @endforeach
					</div>
                    <div class="text-center w-100 pt-3">
                        <button class="site-btn sb-line sb-dark" id="load-more" data-paginate="2">LOAD MORE</button>
                        <p class="invisible">No more products...</p>
                    </div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->

@endsection
