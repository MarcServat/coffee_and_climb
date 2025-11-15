@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="container mx-auto max-w-2xl p-4">
    <h1 class="text-2xl font-bold mb-4">Order Confirmation</h1>
    <div class="mb-4">
        <strong>Order #:</strong> {{ $order->id }}<br>
        @if($order->user)
            <strong>Name:</strong> {{ $order->user->name }}<br>
            <strong>Email:</strong> {{ $order->user->email }}<br>
        @else
            <strong>Email:</strong> {{ $order->email }}<br>
        @endif
        <strong>Shipping Address:</strong> {{ $order->shipping_address }}<br>
        <strong>Status:</strong> {{ ucfirst($order->status) }}<br>
    </div>
    <h2 class="font-bold mb-2">Order Items</h2>
    <ul class="mb-2">
        @foreach($order->items as $item)
            <li>{{ $item->product->name }} x {{ $item->quantity }} - ${{ number_format($item->price * $item->quantity, 2) }}</li>
        @endforeach
    </ul>
    <div class="font-bold">
        Total: ${{ number_format($order->total, 2) }}
    </div>
    <a href="/" class="mt-4 inline-block text-blue-600 hover:underline">Return to Store</a>
</div>
@endsection

