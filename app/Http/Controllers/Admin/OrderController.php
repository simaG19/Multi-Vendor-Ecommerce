<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * List orders that include at least one admin-created product.
     * (admin-created products are those where products.created_by IS NOT NULL)
     */
    public function index(Request $request)
    {
        $q = Order::with(['user','items.product.vendor','items.product.images'])
            ->whereHas('items.product', function($q) {
                $q->whereNotNull('created_by'); // any admin-created product
            });

        // optional search by order_number or customer
        if ($request->filled('q')) {
            $term = '%' . $request->q . '%';
            $q->where(function($w) use ($term) {
                $w->where('order_number', 'like', $term)
                  ->orWhereHas('user', fn($u) => $u->where('name','like',$term)->orWhere('email','like',$term));
            });
        }

        $orders = $q->latest()->paginate(18)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show order details. Only show the full order but highlight items that belong to admin-created products.
     */
    public function show(Order $order)
    {
        $order->load(['user','items.product.vendor','items.product.images']);

        // vendorItems = only those items in the order that belong to admin-created products
        $adminItems = $order->items->filter(function($it) {
            return $it->product && ! is_null($it->product->created_by);
        });

        // items not owned by admin (for context)
        $otherItems = $order->items->filter(function($it) {
            return ! ($it->product && ! is_null($it->product->created_by));
        });

        return view('admin.orders.show', compact('order','adminItems','otherItems'));
    }

    /**
     * Update overall order status (admin-managed orders). This simple endpoint sets order.status.
     * For more granular item-level handling you can extend this to update OrderItem statuses.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled'
        ]);

        // Ensure this order actually includes admin-created items
        $hasAdmin = $order->items()->whereHas('product', fn($q) => $q->whereNotNull('created_by'))->exists();
        if (! $hasAdmin) {
            return back()->with('error','Order does not contain admin-created products.');
        }

        $order->status = $request->status;
        $order->save();

        return back()->with('success','Order status updated.');
    }
}
