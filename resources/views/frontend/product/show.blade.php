@extends('layout.frontend.master')
@section('content')
    <!-- Product Detail Section -->
    <section class="py-20">
        <div class="container mx-auto">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <img class="w-full lg:w-1/2 h-96 object-cover" src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}">
                    <div class="p-6 lg:w-1/2">
                        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                        <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                        <p class="text-blue-500 text-xl font-bold mb-4">${{ $product->price }}</p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="mb-4">
                                <label class="block text-gray-700" for="quantity">Quantity</label>
                                <input class="mt-1 border border-gray-300 rounded-lg p-2 w-full" id="quantity"
                                    type="number" name="quantity" min="1" value="1">
                            </div>
                            <button class="bg-blue-500 text-white py-2 px-6 rounded-full text-lg hover:bg-blue-600"
                                type="submit">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
