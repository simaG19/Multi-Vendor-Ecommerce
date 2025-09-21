@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>Price: {{ number_format($product->price,2) }}</p>
    <p>Stock: {{ $product->stock }}</p>
    <p>{{ $product->description }}</p>
    <a href="{{ route('vendor.products.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
