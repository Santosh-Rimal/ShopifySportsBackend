@extends('layout.frontend.master')

@section('content')
    <!-- Cart Section -->
    <section class="py-20">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold mb-4">Your Cart</h1>

            @if ($cartItems->isEmpty())
                <p class="text-gray-600">Your cart is empty.</p>
            @else
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $item->product->price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $item->quantity * $item->product->price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form class="inline" action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700" type="submit">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-6">
                        <a class="bg-blue-500 text-white py-2 px-6 rounded-full text-lg hover:bg-blue-600"
                            href="{{ route('checkout') }}">Proceed to Checkout</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
