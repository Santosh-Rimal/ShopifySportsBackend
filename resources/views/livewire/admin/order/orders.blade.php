<div class="flex flex-col md:flex-row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between">
            <p>{{ __('ShopifySports') }}</p>
            <p class="capitalize">{{ Route::currentRouteName() }}</p>
        </h2>
    </x-slot>
    <!-- Sidebar -->
    <div class="bg-gray-900 shadow-lg h-screen w-64 sticky top-0 hidden sm:block">
        <div class="p-6">
            <a class="text-white text-2xl font-semibold" href="#">ShopifySports</a>
        </div>
        {{-- include leftside navbar --}}
        @includeIf('layout.admin.sidenavbar')
    </div>
    <div class="flex-1">
        <section class="container mx-auto px-4 py-12">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                @if (session()->has('status'))
                    <div class="flex justify-center p-4 bg-green-800 w-full rounded-xl shadow-md">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session()->has('delete'))
                    <div class="flex justify-center p-4 bg-red-600 w-full rounded-xl shadow-md">{{ session('delete') }}
                    </div>
                @endif
                @if ($orders->isNotEmpty())
                    <table class="border w-full bg-white rounded-xl shadow-lg">
                        <caption class="caption-top">
                            List of orders
                        </caption>
                        <thead>
                            <tr class="border">
                                <th class="border mx-auto p-2">Order ID</th>
                                <th class="border mx-auto p-2">Name</th>
                                <th class="border mx-auto p-2">Total Price</th>
                                <th class="border mx-auto p-2">Status</th>
                                <th class="border mx-auto p-2">View Items</th>
                            </tr>
                        </thead>
                        @foreach ($orders as $key => $order)
                            <tbody>
                                <tr class="border">
                                    <td class="text-center p-2 border">{{ $key + $orders->firstItem() }}</td>
                                    <td class="text-center p-2 border">{{ $order->user->name }}</td>
                                    <td class="text-center p-2 border">{{ $order->total }}</td>
                                    <td class="text-center p-2 border">{{ $order->status }}</td>
                                    <td class="text-center p-2 border">
                                        <button class="border bg-blue-600 py-2 px-4 rounded-xl shadow-md"
                                            onclick="toggleItems({{ $order->id }})">
                                            View Items
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hidden" id="items-{{ $order->id }}">
                                    <td colspan="5">
                                        <table class="border w-full bg-gray-100 rounded-xl shadow-lg">
                                            <thead>
                                                <tr>
                                                    <th class="border mx-auto p-2">Item ID</th>
                                                    <th class="border mx-auto p-2">Product Name</th>
                                                    <th class="border mx-auto p-2">Quantity</th>
                                                    <th class="border mx-auto p-2">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderItems as $item)
                                                    <tr>
                                                        <td class="text-center p-2 border">{{ $item->id }}</td>
                                                        <td class="text-center p-2 border">{{ $item->product->name }}
                                                        </td>
                                                        <td class="text-center p-2 border">{{ $item->quantity }}</td>
                                                        <td class="text-center p-2 border">{{ $item->price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="flex justify-start">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="flex justify-start">
                        <p class="w-full text-xl text-black bg-gray-200 text-center py-4 px-32 rounded-md shadow-lg">
                            No data Found
                        </p>
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>

<script>
    function toggleItems(orderId) {
        const itemRow = document.getElementById('items-' + orderId);
        itemRow.classList.toggle('hidden');
    }
</script>
