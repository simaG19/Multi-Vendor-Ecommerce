<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // show public form to paste order id (optional)
    public function checkForm()
    {
        return view('order.check');
    }

    // redirect to /order/{order_number}
    public function checkRedirect(Request $request)
    {
        $request->validate(['order_number' => 'required|string']);
        return redirect()->route('order.public.show', $request->order_number);
    }

    // public show by order number
    public function publicShow($order_number)
    {
        $order = Order::with('items.product.images')->where('order_number', $order_number)->firstOrFail();

        // only show minimal sensitive fields to public viewers (no internal notes)
        return view('order.public_show', compact('order'));
    }
}
