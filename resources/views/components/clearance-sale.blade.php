<div class="mb-8">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <div class="bg-gradient-to-r from-orange-400 to-red-500 text-white px-4 py-2 rounded-l-lg font-bold">
                    Clearance Sale
                </div>
                <div class="absolute top-0 right-0 w-0 h-0 border-t-[40px] border-b-[40px] border-l-[20px] border-t-transparent border-b-transparent border-l-red-500"></div>
            </div>
            <div class="bg-yellow-400 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                Save More
            </div>
        </div>
        <a href="#" class="text-golden-600 hover:text-golden-700 font-medium flex items-center space-x-1">
            <span>View All</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
        @php
            $clearanceProducts = [
                ['name' => 'Bohemiantee Shirt Tops', 'price' => '19.80', 'original_price' => '22.00', 'discount' => '-10%'],
                ['name' => 'One Dark Window', 'price' => '11.00', 'original_price' => '14.00', 'discount' => '-$3.00'],
                ['name' => 'T900 Smart Watch', 'price' => '25.00', 'original_price' => '30.00', 'discount' => '-$5.00', 'rating' => 4, 'reviews' => 1],
                ['name' => 'Magnetic Portable...', 'price' => '40.00', 'original_price' => '50.00', 'discount' => '-$10.00'],
                ['name' => 'Notebook Laptops', 'price' => '377.10', 'original_price' => '419.00', 'discount' => '-10%'],
                ['name' => 'Straps Plaid Patchwork...', 'price' => '19.00', 'original_price' => '20.00', 'discount' => '-5%', 'rating' => 5, 'reviews' => 1]
            ];
        @endphp

        @foreach($clearanceProducts as $product)
            <x-product-card :product="$product" :discount="$product['discount']" />
        @endforeach
    </div>
</div>
