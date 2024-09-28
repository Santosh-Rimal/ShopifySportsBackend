@extends('layout.frontend.master')

@section('content')
    <!-- User Orders Section -->
    <section class="py-20">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold mb-6">My Orders</h1>

            @if ($orders->isEmpty())
                <p class="text-gray-600">You have not placed any orders yet.</p>
            @else
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Products</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $order->total }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($order->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($order->orderItems as $item)
                                            <div>{{ $item->product->name }} (x{{ $item->quantity }})</div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a class="text-blue-500 hover:text-blue-700"
                                            href="{{ route('orders.show', $order->id) }}">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
@endsection
