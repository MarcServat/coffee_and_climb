@extends('layouts.app')

@section('title', 'Order')

@section('content')
<div class="container mx-auto max-w-2xl p-4">
    <h1 class="text-2xl font-bold mb-4">Order</h1>
    <form action="{{ route('order.store') }}" method="POST" class="space-y-4">
        @csrf
        @guest
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="guest_email" required class="w-full border rounded px-2 py-1">
            </div>
            <div>
                <label class="block font-semibold">Shipping Address</label>
                <input type="text" name="guest_address" required class="w-full border rounded px-2 py-1">
            </div>
        @else
            <div>
                <label class="block font-semibold">Shipping Address</label>
                <input type="text" name="shipping_address" value="{{ Auth::user()->address }}" required class="w-full border rounded px-2 py-1">
            </div>
        @endguest
        <div class="mt-4">
            <h2 class="font-bold mb-2">Order Summary</h2>
            <ul class="mb-2">
                @foreach($products as $product)
                    <li>{{ $product->name }} x {{ $cart[$product->id] }} - ${{ number_format($product->price * $cart[$product->id], 2) }}</li>
                @endforeach
            </ul>
            <div class="font-bold">
                Total: ${{ number_format(collect($products)->sum(fn($p) => $p->price * $cart[$p->id]), 2) }}
            </div>
        </div>
        <button type="submit" class="cursor-pointer bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Place Order</button>
    </form>
</div>
@endsection

