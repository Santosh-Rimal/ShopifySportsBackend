@extends('layout.admin.master')
@section('contents')
    <div class="flex-1 p-10">
        <!-- Header -->
        {{-- <div class="flex justify-end items-center mb-6">
            <div>
                <input class="px-4 py-2 border rounded-md" type="text" placeholder="Search">
                <button class="bg-purple-500 text-white px-4 py-2 rounded-md ml-2">Search</button>
            </div>
        </div> --}}

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <x-admin.index class1="bg-purple-100 p-6 rounded-lg shadow-lg" class2="text-2xl font-bold text-purple-700"
                class3="text-gray-600" value="{{ $sale }}" name="Sale" />

            <x-admin.index class1="bg-green-100 p-6 rounded-lg shadow-lg" class2="text-2xl font-bold text-green-700"
                class3="text-gray-600" value="{{ $totalRevenue }}" name="Revenue" />

            <x-admin.index class1="bg-blue-100 p-6 rounded-lg shadow-lg" class2="text-2xl font-bold text-blue-700"
                class3="text-gray-600" value="{{ $order }}" name="Total Orders" />

            <x-admin.index class1="bg-red-100 p-6 rounded-lg shadow-lg" class2="text-2xl font-bold text-red-700"
                class3="text-gray-600" value="{{ $totalUsersExcludingAuthAndAdmins }}" name="Customers" />
        </div>

        <div class="flex">
            <!-- Revenue Chart -->

            <div class="mb-6" id="chart_div"></div>

            <!-- Order Status Bar Chart -->
        </div>
        <div class="mb-6" id="order_status_chart_div"></div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawCharts);

            function drawCharts() {
                drawRevenueChart();
                drawOrderStatusChart();
            }

            // Revenue Chart (Pie Chart)
            function drawRevenueChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Period');
                data.addColumn('number', 'Revenue');
                data.addRows([
                    ['Today', {{ $dailyRevenue }}],
                    ['This Week', {{ $weeklyRevenue }}],
                    ['This Month', {{ $monthlyRevenue }}]
                ]);

                var options = {
                    title: 'Revenue Statistics',
                    width: 400,
                    height: 300
                };

                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }

            // Order Status Chart (Bar Chart)
            function drawOrderStatusChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Order Status');
                data.addColumn('number', 'Count');
                data.addRows([
                    ['Completed', {{ $completedOrders }}],
                    ['Pending', {{ $pendingOrders }}],
                    ['Failed', {{ $failedOrders }}],
                    ['Canceled', {{ $canceledOrders }}]
                ]);

                var options = {
                    title: 'Order Status Overview',
                    width: 400,
                    height: 300,
                    legend: {
                        position: 'none'
                    },
                    bars: 'horizontal',
                    hAxis: {
                        title: 'Count',
                        minValue: 0
                    },
                    vAxis: {
                        title: 'Order Status'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('order_status_chart_div'));
                chart.draw(data, options);
            }
        </script>

        <!-- Revenue Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex gap-4 items-center mb-4">
                <p class="text-xl font-semibold">Revenue</p>
                <div class="relative inline-block text-left">
                    {{-- <button
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Daily
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button> --}}
                </div>
                {{-- <div class="flex justify-end w-full gap-2">
                    <button class="text-white bg-blue-500 py-1 px-6 rounded-lg">Filter</button>
                    <input class="px-4 py-2 border rounded-md" type="text" placeholder="Search">
                </div> --}}
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
                    @foreach ($orders as $order)
                        @foreach ($order->orderItems as $index => $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="border px-4 py-2">{{ $item->product->name }}</td>
                                <td class="border px-4 py-2">{{ $item->product->category->name }}</td>
                                <td class="border px-4 py-2">{{ $item->quantity }}</td>
                                <td class="border px-4 py-2">{{ $item->price }}</td>
                                <td class="border px-4 py-2">{{ $item->quantity * $item->price }}</td>
                                <td class="border px-4 py-2">
                                    <button class="bg-purple-500 text-white px-4 py-2 rounded">View</button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-right px-4 py-2" colspan="7">Total Revenue</td>
                        <td class="border px-4 py-2">{{ $totalRevenue }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@section('title')
    {{ 'Dashboard ' }}
@endsection
