<div class="flex flex-col md:flex-row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between">
            <p>{{ __('ShopifySports') }}</p>
            <p class="capitalize">{{ isset($title) ? 'Edit About Us' : 'Create About Us' }}</p>
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
        <!-- Form Section -->
        <section class="container mx-auto px-4 py-12">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    {{ isset($title) ? 'Edit About Us Entry' : 'Create About Us Entry' }}
                </h2>

                @if (session()->has('status'))
                    <div class="flex justify-center p-4 bg-green-800 w-full rounded-xl shadow-md">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="flex justify-center p-4 bg-red-600 w-full rounded-xl shadow-md">
                        {{ session('error') }}
                    </div>
                @endif

                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror"
                            id="title" wire:model.live="title" name="title" type="text">
                        @error('title')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="slogan">Slogan</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('slogan') border-red-500 @enderror"
                            id="slogan" wire:model.live="slogan" name="slogan" type="text">
                        @error('slogan')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                        <textarea
                            class="ckeditor shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                            id="description" wire:model.live="description" name="description" rows="4"></textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Image</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror"
                            type="file" wire:model.live="image" name="image">
                        ' @if ($image)
                            <div class="mt-4">
                                <img class="w-20 border rounded-full" src="{{ $image->temporaryUrl() }}">
                            </div>
                        @endif
                        @if ($photo && !$image)
                            <div class="mt-4">
                                <img class="w-20 h-20 border rounded-full" src="{{ asset('storage/' . $photo) }}"
                                    alt="Selected Image">
                            </div>
                        @endif
                        ' @error('image')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="others">Others</label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('others') border-red-500 @enderror"
                            id="others" wire:model.live="others" name="others" type="text">
                        @error('others')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700"
                            type="submit">Update</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- Footer Section -->
        @includeIf('layout.admin.footer')
    </div>
</div>
