@extends('layouts.app')

@section('title', 'Admin Order Detail')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>
    <div class="mb-4 space-y-1 text-sm">
        @if($order->user)
            <div><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</div>
        @elseif($order->email)
            <div><strong>Guest Email:</strong> {{ $order->email }}</div>
        @endif
        <div><strong>Shipping Address:</strong> {{ $order->shipping_address }}</div>
        <div><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
        <div><strong>Total:</strong> ${{ number_format($order->total,2) }}</div>
    </div>
    <h2 class="font-semibold mb-2">Items</h2>
    <table class="min-w-full border text-xs">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-2 py-1 text-left">Product</th>
                <th class="px-2 py-1 text-left">Qty</th>
                <th class="px-2 py-1 text-left">Price</th>
                <th class="px-2 py-1 text-left">Subtotal</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($order->items as $item)
                <tr>
                    <td class="px-2 py-1">{{ $item->product->name }}</td>
                    <td class="px-2 py-1">{{ $item->quantity }}</td>
                    <td class="px-2 py-1">${{ number_format($item->price,2) }}</td>
                    <td class="px-2 py-1">${{ number_format($item->price * $item->quantity,2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.index') }}" class="inline-block mt-4 text-indigo-600 hover:underline text-sm">Back to Orders</a>
</div>
@endsection
