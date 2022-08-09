<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\Api\Order\StoreRequest;
use App\Http\Requests\Api\Order\UpdateRequest;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::getActive()->latest()->get());
    }

    public function store(StoreRequest $request)
    {
        return new OrderResource(Order::create($request->validated()));
    }

    public function show(int $id)
    {
        return new OrderResource(Order::getActive()->findOrFail($id));
    }

    public function update(UpdateRequest $request, Order $order)
    {
        $order->update($request->validated());

        return new OrderResource($order);
    }

    public function destroy(int $id)
    {
        $order = Order::getActive()->findOrFail($id);
        $order->delete();

        return response(Response::HTTP_NO_CONTENT);
    }
}
