@extends('admin.layouts.master')

@section('content')
    @foreach ($orders as $order)
        <div class="card-header">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $order->id }}</h5>
                <p class="card-text">address: {{ $order->address }} <br>
                    address line 2: {{ $order->address_line_2 }} <br>
                    phone: {{ $order->phone ?? "no" }} <br>
                    zipcode: {{ $order->zipcode }} <br>
                    delievery: {{ $order->delievery }} <br>
                    promocode: {{ isset($order->promoCode->promoCodeOption) ? $order->promoCode->promoCodeOption->discount . "%" : "no" }} <br>
                    total price: {{ isset($order->promoCode->promoCodeOption) ? $order->getTotalPriceWithPromoCode() :
                        $order->getTotalPrice() }}$
                </p>
            </div>
        </div>
    @endforeach

    {{ $orders->withQueryString()->links() }}
@endsection
