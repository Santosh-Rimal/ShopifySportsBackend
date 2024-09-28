@extends('layout.frontend.master')
@section('content')
    <!-- Products Listing Section -->
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Our Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-2">{{ $product->description }}</p>
                            <p class="text-blue-500 font-bold">${{ $product->price }}</p>
                            <a class="text-blue-500 hover:underline mt-2 block"
                                href="{{ route('products.show', $product->id) }}">View Details</a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No products found.</p>
                @endforelse
            </div>
            <div class="mt-10">
                {{ $products->links() }} <!-- Pagination links -->
            </div>
        </div>
    </section>
@endsection
