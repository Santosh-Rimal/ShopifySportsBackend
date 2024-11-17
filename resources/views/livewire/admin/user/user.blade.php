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
                @if ($users->isNotEmpty())
                    <table class="border w-full bg-white rounded-xl shadow-lg">
                        <caption class="caption-top">
                            List of Users
                        </caption>
                        <thead>
                            <tr class="border">
                                <th class="border mx-auto p-2">ID</th>
                                <th class="border mx-auto p-2">Name</th>
                                <th class="border mx-auto p-2">Email</th>
                            </tr>
                        </thead>
                        @foreach ($users as $key => $user)
                            <tbody>
                                <tr class="border">
                                    <td class="text-center p-2 border">{{ $key + $users->firstItem() }}</td>
                                    <td class="text-center p-2 border">{{ $user->name }}</td>
                                    <td class="text-center p-2 border">{{ $user->email }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="flex justify-start">
                        {{ $users->links() }}
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
