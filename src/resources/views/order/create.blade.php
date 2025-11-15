@extends('layouts.app')

@section('title', 'Order')

@section('content')
<div class="container max-w-3xl p-4">

    @auth
        <div class="mx-auto max-w-2xl bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Order</h1>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold mb-2">Checkout</h2>
            <label class="block font-semibold">{{ Auth::user()->name }}</label>
        </div>
        <form action="{{ route('order.store') }}" method="POST" class="space-y-4 mb-8">
            @csrf
            <div>
                <label class="block font-semibold">Shipping Address</label>
                <input type="text" name="shipping_address" value="{{ old('shipping_address', Auth::user()->address) }}" required class="w-full border rounded px-2 py-1">
            </div>
            <div class="mt-4">
                <h3 class="font-bold mb-2">Order Summary</h3>
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
        <form action="{{ route('logout') }}" method="POST" class="text-center">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-800 underline">Logout</button>
        </form>
            </div>
    @else
        <h1 class="text-2xl font-bold mb-4">Order</h1>
        <div class="flex justify-between items-start mb-4 gap-4">
            <form name="guest" action="{{ route('order.store') }}" method="POST" class="space-y-4 mb-8 flex-1">
                @csrf
                <h2 class="text-xl font-semibold mb-2">Guest Checkout</h2>
                <div>
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="guest_email" required class="w-full border rounded px-2 py-1">
                </div>
                <div>
                    <label class="block font-semibold">Shipping Address</label>
                    <input type="text" name="guest_address" required class="w-full border rounded px-2 py-1">
                </div>
                <button type="submit" class="cursor-pointer bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Place Order</button>
            </form>
        <form name="register" action="{{ route('order.store') }}" method="POST" class="space-y-4 mb-8 flex-1">
            @csrf
            <h2 class="text-xl font-semibold mb-2">Registered User Checkout</h2>
            <div>
                <label class="block font-semibold">Name</label>
                <input type="text" name="user_name" required class="w-full border rounded px-2 py-1">
            </div>
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="user_email" required class="w-full border rounded px-2 py-1">
            </div>
            <div>
                <label class="block font-semibold">Password</label>
                <input type="password" name="user_password" required class="w-full border rounded px-2 py-1">
            </div>
            <div>
                <label class="block font-semibold">Shipping Address</label>
                <input type="text" name="user_address" required class="w-full border rounded px-2 py-1">
            </div>
            <button type="submit" class="cursor-pointer bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Place Order and register</button>

        </form>
        <div class="mt-4">
            <h3 class="font-bold mb-2">Order Summary</h3>
            <ul class="mb-2">
                @foreach($products as $product)
                    <li>{{ $product->name }} x {{ $cart[$product->id] }} - ${{ number_format($product->price * $cart[$product->id], 2) }}</li>
                @endforeach
            </ul>
            <div class="font-bold">
                Total: ${{ number_format(collect($products)->sum(fn($p) => $p->price * $cart[$p->id]), 2) }}
            </div>
        </div>
        </div>

        <div class="text-sm text-center mb-8">
            <span class="text-gray-600">Already have an account?</span>
            <a href="{{ route('login.index') }}" class="text-blue-600 hover:underline">Log in</a>
        </div>
    @endauth
</div>
@endsection
