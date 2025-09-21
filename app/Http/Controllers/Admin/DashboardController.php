<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // basic metrics you can expand later
        $usersCount = User::count();
        $vendorsCount = Vendor::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();

        return view('admin.dashboard', compact('usersCount','vendorsCount','productsCount','ordersCount'));
    }
}
