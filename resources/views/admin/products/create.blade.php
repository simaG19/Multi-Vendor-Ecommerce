{{-- resources/views/admin/products/create.blade.php --}}
@extends('layouts.app')

@section('title','Create Product')

@section('content')
<div class="container mx-auto px-6 py-8">
  <div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create product (Admin)</h1>

    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
        <ul class="list-disc pl-5">
          @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- reuse the same form partial used for edit --}}
      @include('admin.products._form')

      <div class="mt-4 flex gap-2">
        <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded">Create product</button>
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 border rounded text-gray-600">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
