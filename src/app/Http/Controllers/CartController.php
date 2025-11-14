<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Display the cart
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('cart.index', compact('cart', 'products'));
    }

    // Add a product to the cart
    public function add(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $cart[$productId] = ($cart[$productId] ?? 0) + 1;
        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update product quantity in the cart
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = max(1, (int) $request->input('quantity', 1));
        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index');
    }

    // Remove a product from the cart
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    // Clear the cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}

