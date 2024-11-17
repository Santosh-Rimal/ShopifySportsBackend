@extends('layout.frontend.master')
@section('content')
    <!-- Hero Section -->
    <section class="text-white text-center" style="height: 50vh;">
        <div
            style="background-image: url('{{ asset('fig/1.jfif') }}'); background-size: cover; background-position: center; height: 100%; width: 100%;">
            <h1 class="text-4xl font-bold mb-4 text-white">Welcome to ShopifySports</h1>
            <p class="text-lg mb-8 text-white">Discover the best products just for you</p>
            <a class="bg-white text-blue-500 py-2 px-6 rounded-full text-lg hover:bg-gray-200" href="{{ route('shop') }}">Shop
                Now</a>
        </div>
    </section>
    <!-- Featured Products Section -->
    <section class="py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Featured Products</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featuredProducts as $product)
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
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="bg-gray-100 py-20">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-10">Shop by Category</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden text-center">
                        <img class="w-full h-32 object-cover" src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->name }}">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $category->name }}</h3>
                            <a class="text-blue-500 hover:underline mt-2 block" href="#">Explore</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
