<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class VendorRegistrationController extends Controller
{
    public function show()
    {
        return view('vendor.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => ['nullable','string', Password::min(8)],
            'business_name' => 'required|string|max:255',
            'tin_number' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:1000',
        ]);

        // if the email exists, attach vendor profile to that user
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            // elevate user to vendor if not already
            if ($user->role !== User::ROLE_VENDOR) {
                $user->role = User::ROLE_VENDOR;
                $user->save();
            }

            // prevent duplicate vendor records
            if ($user->vendor) {
                return back()->withErrors(['email' => 'This account already has a vendor profile.'])->withInput();
            }
        } else {
            // create new user
            $pwd = $data['password'] ?? \Str::random(12);
            $user = User::create([
                'name' => $data['contact_name'],
                'email' => $data['email'],
                'password' => Hash::make($pwd),
                'role' => User::ROLE_VENDOR,
            ]);
        }

        // create vendor record (pending approval)
        $vendor = Vendor::create([
            'user_id' => $user->id,
            'business_name' => $data['business_name'],
            'tin_number' => $data['tin_number'] ?? null,
            'address' => $data['address'] ?? null,
            'is_approved' => false,
            'status' => 'pending',
        ]);

        // Optional: log the user in (not required). Safer to require admin approval before granting vendor capabilities.
        // Auth::login($user);

        return redirect()->route('vendor.register')->with('success', 'Registration submitted. You will be notified once admin approves your vendor account.');
    }
}
