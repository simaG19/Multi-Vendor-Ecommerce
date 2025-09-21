<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor; // assumes vendor relationship exists
        // basic placeholder stats (expand later)
        $productsCount = $vendor ? $vendor->products()->count() : 0;
        $ordersCount = 0; // you can compute vendor-specific orders later

        return view('vendor.dashboard', compact('vendor','productsCount','ordersCount'));
    }
}
