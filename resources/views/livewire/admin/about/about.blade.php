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
        <!-- About Us Section -->
        <section class="container mx-auto px-4 py-12">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">About Us Entries</h2>

                @if (session()->has('status'))
                    <div class="flex justify-center p-4 bg-green-800 w-full rounded-xl shadow-md">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session()->has('delete'))
                    <div class="flex justify-center p-4 bg-red-600 w-full rounded-xl shadow-md">
                        {{ session('delete') }}
                    </div>
                @endif

                <div class="flex w-full justify-end my-2">
                    <a class="border border-gray-300 text-black bg-green-300 hover:bg-green-400 shadow-current delay-100 transition-colors cursor-pointer px-4 py-2 rounded-xl"
                        href="{{ route('about.create') }}" wire:navigate>Create</a>
                </div>

                @if ($abouts->isNotEmpty())
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                        <caption class="caption-top text-xl font-bold mb-4">
                            List of About Us Entries
                        </caption>
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200">ID</th>
                                <th class="py-2 px-4 border-b border-gray-200">Title</th>
                                <th class="py-2 px-4 border-b border-gray-200">Slogan</th>
                                <th class="py-2 px-4 border-b border-gray-200">Description</th>
                                <th class="py-2 px-4 border-b border-gray-200">Image</th>
                                <th class="py-2 px-4 border-b border-gray-200">Others</th>
                                <th class="py-2 px-4 border-b border-gray-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abouts as $key => $about)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        {{ $key + $abouts->firstItem() }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $about->title }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $about->slogan }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $about->description }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        @if ($about->image)
                                            <img class="w-20 h-20 border rounded-full"
                                                src="{{ asset('storage/' . $about->image) }}"
                                                alt="{{ $about->title }}">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $about->others }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200 text-center">
                                        <a class="bg-blue-600 text-white py-1 px-4 rounded-lg hover:bg-blue-700"
                                            href="{{ route('about.update', $about->id) }}" wire:navigate>Edit</a>
                                        <button class="bg-red-600 text-white py-1 px-4 rounded-lg hover:bg-red-700 ml-4"
                                            type="button" wire:click="delete({{ $about->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-center mt-4">
                        {{ $abouts->links() }}
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

        <!-- Footer Section -->
        @includeIf('layout.admin.footer')
    </div>
</div>
