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

    <div class="flex-1">

        <!-- Contact Us Section -->
        <section class="container mx-auto px-4 py-12">
            <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Submitted Messages</h2>

                @if (session()->has('status'))
                    <div class="flex justify-center p-4 bg-green-800 w-full rounded-xl shadow-md">
                        {{ session('status') }}</div>
                @endif
                @if (session()->has('delete'))
                    <div class="flex justify-center p-4 bg-red-600 w-full rounded-xl shadow-md">{{ session('delete') }}
                    </div>
                @endif
                @if ($inquiries->isNotEmpty())
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200">Name</th>
                                <th class="py-2 px-4 border-b border-gray-200">Email</th>
                                <th class="py-2 px-4 border-b border-gray-200">Subject</th>
                                <th class="py-2 px-4 border-b border-gray-200">Message</th>
                                <th class="py-2 px-4 border-b border-gray-200">Actions</th>
                            </tr>
                        </thead>
                        @foreach ($inquiries as $inquiry)
                            <tbody>

                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        {{ $inquiry->user->name ?? $inquiry->name }}
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $inquiry->email ?? '' }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        {{ $inquiry->subject ?? 'No Subject' }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $inquiry->message ?? '' }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        <a class="bg-blue-600 text-white py-1 px-4 rounded-lg hover:bg-blue-700"
                                            href="#{{-- {{ route('contact.edit', $message->id) }} --}}">Edit</a>
                                        <button class="bg-red-600 text-white py-1 px-4 rounded-lg hover:bg-red-700"
                                            type="submit" wire:click="delete({{ $inquiry->id }})">Delete</button>
                                    </td>
                                </tr>

                            </tbody>
                        @endforeach
                    </table>
                    <div class="flex justify-start">

                        {{ $inquiries->links() }}
                    </div>
                @else
                    <div class="flex justify-start">

                        <p class="text-xl text-black bg-cyan-200 mx-auto py-4 px-32 rounded-md shadow-lg">No data Found
                        </p>
                    </div>
                @endif

            </div>
        </section>

        <!-- Footer Section -->

        @includeIf('layout.admin.footer')

    </div>
</div>
<script>
    window.Echo.channel('contact')
        .listen('InquiryEvent', (e) => {
            console.log('New inquiry received:', e);
            alert("Contact added or Deleted");
        });
</script>
