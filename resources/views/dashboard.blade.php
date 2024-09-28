<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ShopifySports') }}
        </h2>
    </x-slot>

    <div class="flex flex-col md:flex-row">

        <!-- Sidebar -->
        <div class="bg-gray-900 shadow-lg h-screen w-64 sticky top-0 hidden sm:block">
            <div class="p-6">
                <a class="text-white text-2xl font-semibold" href="#">ShopifySports</a>
            </div>
            {{-- include leftside navbar --}}
            @includeIf('layout.admin.sidenavbar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <!-- Header -->
            <div class="flex justify-end items-center mb-6">
                <div>
                    <input class="px-4 py-2 border rounded-md" type="text" placeholder="Search">
                    <button class="bg-purple-500 text-white px-4 py-2 rounded-md ml-2">Search</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-purple-100 p-6 rounded-lg shadow-lg">
                    <p class="text-2xl font-bold text-purple-700">50</p>
                    <p class="text-gray-600">Sales</p>
                </div>
                <div class="bg-green-100 p-6 rounded-lg shadow-lg">
                    <p class="text-2xl font-bold text-green-700">1563</p>
                    <p class="text-gray-600">Revenue</p>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg shadow-lg">
                    <p class="text-2xl font-bold text-blue-700">100</p>
                    <p class="text-gray-600">Orders</p>
                </div>
                <div class="bg-red-100 p-6 rounded-lg shadow-lg">
                    <p class="text-2xl font-bold text-red-700">250</p>
                    <p class="text-gray-600">Customers</p>
                </div>
            </div>

            <!-- Revenue Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <p class="text-xl font-semibold mb-4">Revenue Chart</p>
                <canvas id="revenueChart"></canvas>
            </div>

            <!-- Revenue Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex gap-4 items-center mb-4">
                    <p class="text-xl font-semibold">Revenue</p>
                    <div class="relative inline-block text-left">
                        <button
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Daily
                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-end w-full gap-2">
                        <button class="text-white bg-blue-500 py-1 px-6 rounded-lg">Filter</button>
                        <input class="px-4 py-2 border rounded-md" type="text" placeholder="Search">
                    </div>
                </div>

                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2">S.N</th>
                            <th class="py-2">Date</th>
                            <th class="py-2">Product Name</th>
                            <th class="py-2">Category</th>
                            <th class="py-2">Qty.</th>
                            <th class="py-2">Amount</th>
                            <th class="py-2">Revenue</th>
                            <th class="py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">523</td>
                            <td class="border px-4 py-2">2024-5-25</td>
                            <td class="border px-4 py-2">Silk Saree</td>
                            <td class="border px-4 py-2">Saree</td>
                            <td class="border px-4 py-2">5</td>
                            <td class="border px-4 py-2">5000</td>
                            <td class="border px-4 py-2">25,000</td>
                            <td class="border px-4 py-2"><button
                                    class="bg-purple-500 text-white px-4 py-2 rounded">View</button></td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">523</td>
                            <td class="border px-4 py-2">2024-5-25</td>
                            <td class="border px-4 py-2">Silk Saree</td>
                            <td class="border px-4 py-2">Saree</td>
                            <td class="border px-4 py-2">5</td>
                            <td class="border px-4 py-2">5000</td>
                            <td class="border px-4 py-2">25,000</td>
                            <td class="border px-4 py-2"><button
                                    class="bg-purple-500 text-white px-4 py-2 rounded">View</button></td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">523</td>
                            <td class="border px-4 py-2">2024-5-25</td>
                            <td class="border px-4 py-2">Silk Saree</td>
                            <td class="border px-4 py-2">Saree</td>
                            <td class="border px-4 py-2">5</td>
                            <td class="border px-4 py-2">5000</td>
                            <td class="border px-4 py-2">25,000</td>
                            <td class="border px-4 py-2"><button
                                    class="bg-purple-500 text-white px-4 py-2 rounded">View</button></td>
                        </tr>
                        <tr>
                            <td class="border px-4 py-2">523</td>
                            <td class="border px-4 py-2">2024-5-25</td>
                            <td class="border px-4 py-2">Silk Saree</td>
                            <td class="border px-4 py-2">Saree</td>
                            <td class="border px-4 py-2">5</td>
                            <td class="border px-4 py-2">5000</td>
                            <td class="border px-4 py-2">25,000</td>
                            <td class="border px-4 py-2"><button
                                    class="bg-purple-500 text-white px-4 py-2 rounded">View</button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-right px-4 py-2" colspan="7">Total Revenue</td>
                            <td class="border px-4 py-2">120000</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
