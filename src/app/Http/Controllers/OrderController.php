<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('order.create', compact('cart', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $products = Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        if (Auth::check()) {
            // Registered user
            $order = Order::create([
                'user_id' => Auth::id(),
                'shipping_address' => $request->input('shipping_address', Auth::user()->address),
                'status' => 'pending',
                'total' => $total,
            ]);
        } else {
            // Guest user
            $request->validate([
                'guest_email' => 'required|email',
                'guest_address' => 'required|string',
            ]);
            $order = Order::create([
                'guest_email' => $request->input('guest_email'),
                'guest_address' => $request->input('guest_address'),
                'shipping_address' => $request->input('guest_address'),
                'status' => 'pending',
                'total' => $total,
            ]);
        }

        foreach ($products as $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $cart[$product->id],
                'price' => $product->price,
            ]);
        }
        session()->forget('cart');
        return view('order.store', compact('order'));
    }

    /**
    * Display the specified resource.
    */
    public function show($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('order.store', compact('order'));
    }
}

