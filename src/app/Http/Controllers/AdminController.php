<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display admin orders list (requires admin session flag).
     */
    public function index(Request $request) {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login');
        }
        $orders = Order::with('user')->orderByDesc('id')->paginate(25);
        return view('admin.index', compact('orders'));
    }

    /**
     * Display a single order detail.
     */
    public function show(Request $request, $orderId) {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login');
        }
        $order = Order::with('items.product','user')->findOrFail($orderId);
        return view('admin.show', compact('order'));
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $config = config('admin');
        if ($data['username'] === $config['username'] && Hash::check($data['password'], $config['password_hash'])) {
            $request->session()->put('is_admin', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }
}
