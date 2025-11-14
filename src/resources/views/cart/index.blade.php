@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<div class="container mx-auto max-w-2xl p-4">
    <h1 class="text-2xl font-bold mb-4">Cart</h1>
    @if(count($cart) === 0)
        <p>Your cart is empty.</p>
    @else
        <form action="{{ route('cart.clear') }}" method="POST" class="mb-4">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow transition-colors duration-200">Clear Cart</button>
        </form>
        <table class="w-full mb-4">
            <thead>
                <tr>
                    <th class="text-left">Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($products as $product)
                    @php $total = $product->price * $cart[$product->id]; $grandTotal += $total; @endphp
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>
                            <form action="{{ route('cart.update', $product->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="number" name="quantity" value="{{ $cart[$product->id] }}" min="1" class="w-16 border rounded px-2 py-1">
                                <button type="submit" class="cursor-pointer bg-indigo-500 hover:bg-indigo-700 text-white px-3 py-1 rounded shadow ml-2 transition-colors duration-200">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>${{ number_format($total, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="cursor-pointer bg-red-400 text-white px-2 py-1 rounded">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right font-bold text-lg mb-4">
            Grand Total: ${{ number_format($grandTotal, 2) }}
        </div>
        <form action="{{ route('order.create') }}" method="GET">
            @csrf
            <button type="submit" class="cursor-pointer bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Checkout</button>
        </form>
    @endif
    <a href="{{ "/" }}" class="text-blue-600 hover:underline">Continue Shopping</a>
</div>
@endsection
