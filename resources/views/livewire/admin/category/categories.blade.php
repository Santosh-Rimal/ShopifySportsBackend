<div class="flex flex-col md:flex-row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight  flex justify-between">
            <p>{{ __('ShopifySports') }}</p>
            <p class=" capitalize">{{ Route::currentRouteName() }}</p>
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
                <div class=" flex w-full justify-end my-2">
                    <a class="border border-gray-300 text-black bg-green-300 hover:bg-green-400 shadow-current delay-100 transition-colors cursor-pointer px-4 py-2 rounded-xl"
                        href="{{ route('category.create') }}"wire:navigate>Create</a>
                </div>
                @if ($categories->isNotEmpty())
                    <table class="border w-full bg-white rounded-xl shadow-lg">
                        <caption class="caption-top">
                            List of Categories
                        </caption>
                        <thead>

                            <tr class="border">
                                <th class="border mx-auto p-2">ID</th>
                                <th class="border mx-auto p-2">Name</th>
                                <th class="border mx-auto p-2">Images</th>
                                <th class="border mx-auto p-2">Edit</th>
                                <th class="border mx-auto p-2">Delete</th>
                            </tr>
                        </thead>
                        @foreach ($categories as $key => $category)
                            <tbody>
                                <tr class="border">
                                    <td class="text-center p-2 border">{{ $key + $categories->firstItem() }}</td>
                                    <td class="text-center p-2 border">{{ $category->name ?? '' }}</td>
                                    <td class="text-center p-2 border"><img class="w-20 border rounded-full"alt="photo"
                                            src="{{ asset('storage/' . $category->image) }}">

                                    </td>
                                    <td class="text-center P-2 border">
                                        <a class="border bg-green-600 py-2 px-4 rounded-xl shadow-md"
                                            href="{{ route('category.update', $category->id) }}" wire:navigate>Edit</a>
                                    </td>
                                    <td class="text-center p-2 border">
                                        <button class="border bg-orange-600 py-2 px-4 rounded-xl shadow-md"
                                            wire:click="delete({{ $category->id }})">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div class="flex justify-start">

                        {{ $categories->links() }}
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
