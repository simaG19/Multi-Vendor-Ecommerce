@extends('simple_layout')

@section('title','Checkout')

@section('content')
<h2>Checkout</h2>

@if(session('error')) <div style="padding:8px;background:#fff4f4;border:1px solid #f8d7da">{{ session('error') }}</div> @endif

<form action="{{ route('cart.checkout') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div style="margin-bottom:12px">
        <label>Phone number</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required>
        @error('phone') <div class="muted" style="color:#c0392b">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom:12px">
        <label>Shipping address</label>
        <textarea name="shipping_address" required>{{ old('shipping_address') }}</textarea>
        @error('shipping_address') <div class="muted" style="color:#c0392b">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom:12px">
        <label>Payment screenshot (upload proof of payment)</label>
        <input type="file" name="payment_screenshot" accept="image/*" required>
        <div class="muted">Upload a screenshot or image of your payment transaction. Max 5MB.</div>
        @error('payment_screenshot') <div class="muted" style="color:#c0392b">{{ $message }}</div> @enderror
    </div>

    <h3>Order summary</h3>
    <ul>
        @foreach($carts as $c)
            <li>{{ $c->product->name ?? '—' }} — Qty: {{ $c->quantity }} — {{ number_format(($c->product->price ?? 0) * $c->quantity, 2) }} ETB</li>
        @endforeach
    </ul>
    <div style="margin-top:8px"><strong>Total: {{ number_format($total,2) }} ETB</strong></div>

    <div style="margin-top:12px">
        <button type="submit">Place order (submit proof)</button>
    </div>
</form>
@endsection
