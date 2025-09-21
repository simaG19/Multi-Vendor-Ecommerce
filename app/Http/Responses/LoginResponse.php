<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Admin detection (role string or is_admin boolean)
        $isAdmin = false;
        if ($user) {
            if (isset($user->role) && is_string($user->role) && strtolower($user->role) === 'admin') {
                $isAdmin = true;
            }
            if (! $isAdmin && isset($user->is_admin) && $user->is_admin) {
                $isAdmin = true;
            }
        }

        if ($isAdmin) {
            return redirect()->intended('/admin/dashboard');
        }

        // Vendor detection: role 'vendor', is_vendor flag, or related vendor model
        $isVendor = false;
        if ($user) {
            if (isset($user->role) && is_string($user->role) && strtolower($user->role) === 'vendor') {
                $isVendor = true;
            }
            if (! $isVendor && isset($user->is_vendor) && $user->is_vendor) {
                $isVendor = true;
            }
            if (! $isVendor) {
                // check relation existence safely
                try {
                    if (method_exists($user, 'vendor') && $user->vendor) {
                        $isVendor = true;
                    }
                } catch (\Throwable $e) {
                    // ignore relation errors, keep $isVendor false
                }
            }
        }

        if ($isVendor) {
            // Prefer named route if present, otherwise fallback to vendor dashboard path
            if (function_exists('route')) {
                try {
                    $vendorOrdersUrl = route('vendor.orders.index');
                } catch (\Throwable $e) {
                    $vendorOrdersUrl = url('/vendor/order');
                }
            } else {
                $vendorOrdersUrl = url('/vendor/order');
            }

            return redirect()->intended($vendorOrdersUrl);
        }

        // Default for normal users
        return redirect()->intended('/dashboard');
    }
}
