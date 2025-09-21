<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    protected function getSessionId()
    {
        // ensure session started
        if (!session()->has('_token')) session()->regenerateToken();
        return session()->getId();
    }

    protected function cartQueryForCurrentUserOrSession()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id());
        }
        return Cart::where('session_id', $this->getSessionId());
    }

    public function index()
    {
        $carts = $this->cartQueryForCurrentUserOrSession()->with('product.images')->get();
        $total = $carts->sum(function($c){ return $c->quantity * ($c->product->price ?? 0); });
        return view('cart.index', compact('carts','total'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);
        $qty = $data['quantity'] ?? 1;
        $product = Product::findOrFail($data['product_id']);
        if (! $product->is_active) return back()->with('error','Product not available.');

        // check stock
        if ($product->stock < $qty) {
            return back()->with('error','Not enough stock available.');
        }

        // determine owner (user or session)
        $userId = Auth::id();
        $sessionId = $userId ? null : $this->getSessionId();

        $cart = Cart::where('product_id', $product->id)
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->first();

        if ($cart) {
            $cart->quantity = min($product->stock, $cart->quantity + $qty);
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $product->id,
                'quantity' => min($product->stock, $qty),
            ]);
        }

        return back()->with('success','Added to cart.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'cart_id' => 'required|integer|exists:carts,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::findOrFail($data['cart_id']);
        // ensure ownership
        if (Auth::check()) {
            if ($cart->user_id !== Auth::id()) abort(403);
        } else {
            if ($cart->session_id !== $this->getSessionId()) abort(403);
        }

        $product = $cart->product;
        if (!$product) { $cart->delete(); return back()->with('error','Product no longer available.'); }

        $cart->quantity = min($product->stock, $data['quantity']);
        $cart->save();

        return back()->with('success','Cart updated.');
    }

    public function remove(Request $request)
    {
        $data = $request->validate(['cart_id' => 'required|integer|exists:carts,id']);
        $cart = Cart::findOrFail($data['cart_id']);

        if (Auth::check()) {
            if ($cart->user_id !== Auth::id()) abort(403);
        } else {
            if ($cart->session_id !== $this->getSessionId()) abort(403);
        }

        $cart->delete();
        return back()->with('success','Removed from cart.');
    }

    public function showCheckout()
{
    $user = auth()->user();
    $carts = Cart::where('user_id', $user->id)->with('product')->get();
    if ($carts->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    $total = $carts->sum(fn($c) => ($c->product->price ?? 0) * $c->quantity);
    return view('cart.checkout', compact('carts','total'));
}



public function checkout(Request $request)
{
    // validate common fields for guest and auth users
    $rules = [
        'phone' => 'required|string|max:50',
        'shipping_address' => 'required|string|max:1000',
        'payment_screenshot' => 'required|image|max:5120', // 5MB
    ];

    $data = $request->validate($rules);

    // load cart items for current actor (user or guest session)
    $carts = $this->cartQueryForCurrentUserOrSession()->with('product')->get();
    if ($carts->isEmpty()) {
        return back()->with('error', 'Your cart is empty.');
    }

    // compute total (snapshot using product price or cart price if available)
    $total = $carts->sum(function ($c) {
        $price = $c->price ?? ($c->product->price ?? 0);
        return $price * $c->quantity;
    });

    // store payment screenshot (public disk)
    $screenshotPath = null;
    if ($request->hasFile('payment_screenshot')) {
        $screenshotPath = $request->file('payment_screenshot')->store('payments', 'public');
    }

    // generate unique 6-char alphanumeric order number (uppercase)
    do {
        $orderNumber = strtoupper(Str::random(6)); // uses letters+numbers, check uniqueness
    } while (Order::where('order_number', $orderNumber)->exists());

    // create order (user_id nullable)
    $order = Order::create([
        'order_number' => $orderNumber,
        'user_id' => auth()->id(),
        'phone' => $data['phone'],
        'shipping_address' => $data['shipping_address'],
        'payment_screenshot' => $screenshotPath,
        'status' => 'pending', // adjust default statuses as you use them
        'total' => $total,
    ]);

    // create order items
    foreach ($carts as $c) {
        $product = $c->product;
        $priceSnapshot = $c->price ?? ($product->price ?? 0);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $c->quantity,
            'price' => $priceSnapshot,
        ]);
    }

    // clear cart rows for this user/session
    $this->cartQueryForCurrentUserOrSession()->delete();

    // show confirmation view with order number
    return view('cart.order_success', compact('order'));
}


}
