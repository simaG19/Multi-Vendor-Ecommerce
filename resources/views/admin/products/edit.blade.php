@extends('layouts.app')

@section('title','Edit Product: '.$product->name)

@section('content')
<div class="container mx-auto px-6 py-8">
  <h1 class="text-2xl font-bold mb-4">Edit product</h1>

  <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.products._form')
    <div class="mt-4">
      <button class="px-4 py-2 bg-amber-500 text-white rounded">Save</button>
      <a href="{{ route('admin.products.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </div>
  </form>
</div>
@endsection
