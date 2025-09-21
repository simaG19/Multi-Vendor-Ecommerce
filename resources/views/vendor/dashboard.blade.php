@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vendor Dashboard</h1>

    <div class="grid grid-cols-2 gap-4">
        <div class="p-4 border rounded">
            <h3>Vendor</h3>
            <p>{{ $vendor->business_name ?? 'No vendor profile yet' }}</p>
        </div>
        <div class="p-4 border rounded">
            <h3>Your Products</h3>
            <p>{{ $productsCount }}</p>
        </div>
        <div class="p-4 border rounded">
            <h3>Your Orders</h3>
            <p>{{ $ordersCount }}</p>
        </div>
    </div>
</div>
@endsection
