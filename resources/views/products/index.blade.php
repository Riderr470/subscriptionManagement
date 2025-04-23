<x-guest-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-white">Product List</h1>

        <div class="mb-4 p-3 rounded bg-blue-100 dark:bg-gray-800 text-blue-800 dark:text-white">
            Data loaded from: <strong>{{ $source }}</strong> in <strong>{{ $duration }} ms</strong>.
            <span class="text-sm">(Refresh page to see difference with/without cache later)</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @forelse ($products as $product)
            <div class="border dark:border-gray-700 rounded-lg p-4 shadow hover:shadow-lg transition-shadow bg-white dark:bg-gray-900">
                @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-4">
                @else
                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded mb-4">
                    <span class="text-gray-500 dark:text-gray-300">No Image</span>
                </div>
                @endif

                <h2 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white break-words">{{ $product->name }}</h2>
                <p class="mb-1 text-gray-800 dark:text-white">Price: ${{ number_format($product->price, 2) }}</p>
                <p class="mb-3 text-gray-800 dark:text-white">Stock: {{ $product->stock }}</p>
            </div>
            @empty
            <p class="text-white col-span-full">No products found.</p>
            @endforelse
        </div>


    </div>
</x-guest-layout>