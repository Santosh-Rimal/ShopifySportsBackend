<nav class="text-white">
    <x-admin.sidenavbar class="block p-3 hover:bg-gray-700" href="{{ route('orders') }}" name="Orders" wire:navigate />
    <x-admin.sidenavbar class="block p-3 hover:bg-gray-700" href="{{ route('products') }}" name="Products" />
    <x-admin.sidenavbar class="block p-3 hover:bg-gray-700" href="{{ route('users') }}" name="Customers" wire:navigate />
    {{-- <x-admin.sidenavbar class="block p-3 hover:bg-gray-700" href="{{ route('services') }}" name="Services"
        wire:navigate /> --}}
    <x-admin.sidenavbar class="block p-3 hover:bg-gray-700" href="#" name="Customers Diaries" />
    <x-admin.sidenavbar class="block p-3 hover:bg-gray-700" href="#" name="Settings" />
    <x-admin.sidenavbar class="block p-3 hover:bg-gray-700" href="{{ route('logout') }}" name="Logout" wire:navigate />
</nav>
