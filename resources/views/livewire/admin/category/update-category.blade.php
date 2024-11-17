<div class="flex flex-col md:flex-row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight  flex justify-between">
            <p>{{ __('ShopifySports') }}</p>
            <p class=" capitalize">{{ request()->path() }}</p>
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
    <div class="flex flex-col items-center gap-4 w-1/2 mx-auto">
        <div class=" flex w-full justify-end my-2">
            <a class="border border-gray-300 text-black bg-green-300 hover:bg-green-400 shadow-current delay-100 transition-colors cursor-pointer px-4 py-2 rounded-xl"
                wire:navigate href="{{ route('category') }}">Back</a>

        </div>
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-4">Sports Categories Management</h1>

            <!-- Category Form -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Update Category</h2>
                <form wire:submit.prevent="update" method="POST">
                    <div class="mb-4 relative">
                        <label class="block text-sm font-medium text-gray-700" for="category-name">Category Name</label>

                        <input
                            class=" mt-1 w-full px-4 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('category') border-red-500 @enderror"
                            id="category-name" type="text" wire:model.live="category" required>
                        <div class="absolute text-right -translate-y-8 -translate-x-2 w-full" wire:loading>
                            <i class="fa-solid
                                fa-spinner"></i>
                        </div>
                        <input class="w-full p-2 border border-gray-300 rounded-md" type="file" wire:model="image">
                    </div>
                    <div class="mb-2">
                        @error('category')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($image)
                        <div class="mt-4">
                            <img class="w-40 border rounded-full" src="{{ $image->temporaryUrl() }}">
                        </div>
                    @endif
                    @if ($photo && !$image)
                        <img class="w-40 border rounded-full" src="{{ asset('storage/' . $photo) }}">
                    @endif
                    <button class=" bg-indigo-600 px-4 py-2 text-white text-xl rounded-md shadow-2xl" type="submit">
                        Update
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
