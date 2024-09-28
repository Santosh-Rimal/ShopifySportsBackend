@extends('layout.frontend.master')
@section('content')
    <!-- Order Details Section -->
    <section class="py-20">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold mb-4">Order Details</h1>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                <h2 class="text-xl font-semibold mb-4">Order #{{ $order->invoice }}</h2>

                <p class="mb-4">Status: {{ $order->status }}</p>
                <p class="mb-4">Total: ${{ $order->total }}</p>
                <p class="mb-4">Address: {{ $order->address }}</p>
                <p class="mb-4">Payment Method: {{ $order->payment_method }}</p>

                <h3 class="text-lg font-semibold mb-4">Products</h3>
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
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ $item->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ $item->quantity * $item->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
