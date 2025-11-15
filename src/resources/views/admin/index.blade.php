@extends('layouts.app')

@section('title', 'Admin Orders')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Admin - Orders</h1>

    <table class="min-w-full border divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-3 py-2 text-left font-semibold">Order #</th>
                <th class="px-3 py-2 text-left font-semibold">User Type</th>
                <th class="px-3 py-2 text-left font-semibold">Total</th>
                <th class="px-3 py-2 text-left font-semibold">Status</th>
                <th class="px-3 py-2 text-left font-semibold">Details</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
        @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
                <td class="px-3 py-2">{{ $order->id }}</td>
                <td class="px-3 py-2">
                    @if($order->user)
                        Registered
                    @else
                        Guest
                    @endif
                </td>
                <td class="px-3 py-2">${{ number_format($order->total,2) }}</td>
                <td class="px-3 py-2">{{ ucfirst($order->status) }}</td>
                <td class="px-3 py-2"><a class="text-indigo-600 hover:underline" href="{{ route('admin.show', $order->id) }}">View</a></td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-3 py-4 text-center text-gray-500">No orders found.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $orders->links() }}</div>
</div>
@endsection
