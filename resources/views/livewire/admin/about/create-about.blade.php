<div class="flex flex-col md:flex-row">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex justify-between">
            <p>{{ __('ShopifySports') }}</p>
            <p class="capitalize">{{ isset($about) ? 'Edit About Us' : 'Create About Us' }}</p>
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
                    {{ isset($about) ? 'Edit About Us Entry' : 'Create About Us Entry' }}
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

                <form wire:submit.prevent="save" enctype="multipart/form-data">
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

                    <div class="mb-4" wire:ignore>
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
                            id="image" wire:model="image" type="file" name="image">
                        @if ($image)
                            <div class="mt-2">
                                <img class="w-20 h-20 border rounded-full" src="{{ $image->temporaryUrl() }}"
                                    alt="Selected Image">
                            </div>
                        @endif
                        @error('image')
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
                            type="submit">Create</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- Footer Section -->
        @includeIf('layout.admin.footer')
    </div>

    <div>
        {{-- @push('script')
            <script>
                function ckeditor($className) {
                    CKEDITOR.ClassicEditor.create(document.querySelector("." + $className), {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                                'superscript', 'removeFormat', '|',
                                'bulletedList', 'numberedList', '|',
                                'outdent', 'indent', '|',
                                'undo', 'redo', '|',
                                'fontSize', 'fontFamily', 'fontColor', '|',
                                'alignment', '|',
                                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                                'sourceEditing'
                            ],
                            shouldNotGroupWhenFull: true
                        },
                        list: {
                            properties: {
                                styles: true,
                                startIndex: true,
                                reversed: true
                            }
                        },
                        heading: {
                            options: [{
                                    model: 'paragraph',
                                    title: 'Paragraph',
                                    class: 'ck-heading_paragraph'
                                },
                                {
                                    model: 'heading1',
                                    view: 'h1',
                                    title: 'Heading 1',
                                    class: 'ck-heading_heading1'
                                },
                                {
                                    model: 'heading2',
                                    view: 'h2',
                                    title: 'Heading 2',
                                    class: 'ck-heading_heading2'
                                },
                                {
                                    model: 'heading3',
                                    view: 'h3',
                                    title: 'Heading 3',
                                    class: 'ck-heading_heading3'
                                },
                                {
                                    model: 'heading4',
                                    view: 'h4',
                                    title: 'Heading 4',
                                    class: 'ck-heading_heading4'
                                },
                                {
                                    model: 'heading5',
                                    view: 'h5',
                                    title: 'Heading 5',
                                    class: 'ck-heading_heading5'
                                },
                                {
                                    model: 'heading6',
                                    view: 'h6',
                                    title: 'Heading 6',
                                    class: 'ck-heading_heading6'
                                }
                            ]
                        },
                        placeholder: '',
                        fontFamily: {
                            options: [
                                'default',
                                'Arial, Helvetica, sans-serif',
                                'Courier New, Courier, monospace',
                                'Georgia, serif',
                                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                'Tahoma, Geneva, sans-serif',
                                'Times New Roman, Times, serif',
                                'Trebuchet MS, Helvetica, sans-serif',
                                'Verdana, Geneva, sans-serif'
                            ],
                            supportAllValues: true
                        },
                        fontSize: {
                            options: [8, 10, 12, 14, 'default', 18, 20, 22, 24, 26, 28, 30, 32, 34, 36],
                            supportAllValues: true
                        },
                        htmlSupport: {
                            allow: [{
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }]
                        },
                        htmlEmbed: {
                            showPreviews: true
                        },
                        link: {
                            decorators: {
                                addTargetToExternalLinks: true,
                                defaultProtocol: 'https://',
                                toggleDownloadable: {
                                    mode: 'manual',
                                    label: 'Downloadable',
                                    attributes: {
                                        download: 'file'
                                    }
                                }
                            }
                        },
                        mention: {
                            feeds: [{
                                marker: '@',
                                feed: [
                                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                                    '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                                    '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                                    '@pudding', '@sesame', '@snaps', '@soufflé',
                                    '@sugar', '@sweet', '@topping', '@wafer'
                                ],
                                minimumCharacters: 1
                            }]
                        },
                        removePlugins: [
                            'CKBox',
                            'CKFinder',
                            'EasyImage',
                            'RealTimeCollaborativeComments',
                            'RealTimeCollaborativeTrackChanges',
                            'RealTimeCollaborativeRevisionHistory',
                            'PresenceList',
                            'Comments',
                            'TrackChanges',
                            'TrackChangesData',
                            'RevisionHistory',
                            'Pagination',
                            'WProofreader',
                            'MathType'
                        ]
                    });
                }
            </script>
        @endpush --}}

    </div>
</div>
