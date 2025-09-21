@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 max-w-3xl">
    <h1 class="text-2xl font-bold mb-4">Edit Vendor — #{{ $vendor->id }}</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow">
        <form action="{{ route('admin.vendors.update', $vendor) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Business name</label>
                <input type="text" name="business_name" value="{{ old('business_name', $vendor->business_name) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">TIN / Tax ID</label>
                    <input type="text" name="tin_number" value="{{ old('tin_number', $vendor->tin_number) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium">Contact phone</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $vendor->contact_phone) }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Address</label>
                <textarea name="address" rows="3" class="w-full border rounded px-3 py-2">{{ old('address', $vendor->address) }}</textarea>
            </div>

            <div class="mb-4 flex items-center gap-4">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="is_approved" value="1" @if(old('is_approved', $vendor->is_approved)) checked @endif>
                    <span class="text-sm">Approved</span>
                </label>

                <label class="inline-flex items-center gap-2">
                    <select name="status" class="border rounded px-2 py-1">
                        <option value="pending" @selected(old('status', $vendor->status) == 'pending')>Pending</option>
                        <option value="approved" @selected(old('status', $vendor->status) == 'approved')>Approved</option>
                        <option value="rejected" @selected(old('status', $vendor->status) == 'rejected')>Rejected</option>
                        <option value="suspended" @selected(old('status', $vendor->status) == 'suspended')>Suspended</option>
                    </select>
                </label>
            </div>

            <div class="flex gap-3 items-center">
                <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded">Save changes</button>

                {{-- Approve / Reject quick actions (submit as separate forms) --}}
                <form action="{{ route('admin.vendors.approve', $vendor) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded" onclick="return confirm('Approve this vendor?')">Approve</button>
                </form>

                <form action="{{ route('admin.vendors.reject', $vendor) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded" onclick="return confirm('Reject / suspend this vendor?')">Reject</button>
                </form>

                {{-- Delete vendor (destructive) --}}
<form action="{{ route('admin.vendors.destroy', $vendor) }}" method="POST" style="display:inline" onsubmit="return confirm('DELETE vendor and all associated products/images? This is irreversible. Are you absolutely sure?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-4 py-2 bg-red-700 text-white rounded hover:bg-red-800 transition" title="Permanently delete vendor">
        <i class="fas fa-trash mr-2"></i>Delete Vendor
    </button>
</form>


                <a href="{{ route('admin.vendors.show', $vendor) }}" class="text-gray-600 ml-auto">Back to profile</a>
            </div>
        </form>
    </div>

    {{-- owner user info --}}
    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-2">Owner</h3>
        <div class="bg-white p-4 rounded shadow">
            <p><strong>Name:</strong> {{ $vendor->user->name ?? '—' }}</p>
            <p><strong>Email:</strong> {{ $vendor->user->email ?? '—' }}</p>
            <p><strong>Role:</strong> {{ $vendor->user->role ?? '—' }}</p>
        </div>
    </div>

    {{-- vendor orders (brief) --}}
    {{-- <div class="mt-6">
        <h3 class="text-lg font-semibold mb-2">Recent Orders for this vendor</h3>
        @if($vendorOrders->isEmpty())
            <div class="text-gray-500">No orders yet.</div>
        @else
            <ul class="divide-y">
                @foreach($vendorOrders as $o)
                    <li class="py-3 flex justify-between">
                        <div>
                            <div class="font-medium">Order #{{ $o->id }} — {{ $o->user->name ?? 'Guest' }}</div>
                            <div class="text-sm text-gray-500">Total: {{ number_format($o->total, 2) }} ETB</div>
                        </div>
                        <div>
                            <a href="{{ route('admin.orders.show', $o) }}" class="text-amber-600">View</a>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-3">
                {{ $vendorOrders->links() }}
            </div>
        @endif
    </div> --}}

</div>
@endsection
