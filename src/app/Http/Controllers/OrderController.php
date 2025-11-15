<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Psy\debug;

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
            $user = User::find(Auth::id());
            $order = Order::create([
                'user_id' => Auth::id(),
                'email' => $user->email,
                'shipping_address' => $request->input('shipping_address', Auth::user()->address),
                'status' => 'pending',
                'total' => $total,
            ]);
        } else {

            $mode = $request->input('guest_email') ? 'guest' : 'register';
            if ($mode === 'register') {
                $request->validate([
                    'user_email' => 'required|email',
                    'user_address' => 'required|string',
                ]);

                $user = User::create([
                    'name' => $request->input('user_name'),
                    'email' => $request->input('user_email'),
                    'password' => Hash::make($request->input('user_password')),
                    'address' => $request->input('user_address'),
                ]);
                $order = Order::create([
                    'user_id' => $user->id,
                    'shipping_address' => $request->input('user_address'),
                    'status' => 'pending',
                    'total' => $total,
                ]);
                Auth::login($user);
            } else {
                $request->validate([
                    'guest_email' => 'required|email',
                    'guest_address' => 'required|string',
                ]);
                $order = Order::create([
                    'email' => $request->input('guest_email'),
                    'shipping_address' => $request->input('guest_address'),
                    'status' => 'pending',
                    'total' => $total,
                ]);
            }
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

