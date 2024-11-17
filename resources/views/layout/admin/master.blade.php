 <x-app-layout>
     <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight  flex justify-between">
             <p>{{ __('ShopifySports') }}</p>
             <p class=" capitalize">{{ Route::currentRouteName() }}</p>
         </h2>
     </x-slot>
     <style>
         .ck-editor__editable[role="textbox"] {
             min-height: 300px;
         }

         .ck-content .image {
             max-width: 80%;
             margin: 20px auto;
         }
     </style>
     <div class="flex flex-col md:flex-row w-full">

         <!-- Sidebar -->
         <div class="bg-gray-900 shadow-lg h-screen w-64 sticky top-0 sm:block">
             <div class="p-6 text-white text-2xl font-semibold">
                 ShopifySports
             </div>
             {{-- include leftside navbar --}}
             @includeIf('layout.admin.sidenavbar')
         </div>

         {{-- <div class="p-6 text-gray-900 dark:text-gray-100" x-init="Echo.channel('contact').listen('InquiryEvent', (event) => {
             console.log(event);
             document.getElementById('tet').innerHTML = event.data.name;
             document.getElementById('tet').value = event.data.name;
         });"> --}}
         {{-- <div id="tet"></div> --}}
         {{-- <input type="text" id="tet"> --}}
         <!-- Main Content -->
         <div class="flex-1 p-6">
             @yield('contents')
         </div>
     </div>
 </x-app-layout>
