<nav class="-mx-3 flex flex-1 justify-end">
    @auth
        @if (Auth::user()->role === 'admin')
            <a class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                href="{{ url('/dashboard') }}"wire:navigate>
                Dashboard
            </a>
        @endif
    @else
        <a class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            href="{{ route('login') }}" wire:navigate>
            Log in
        </a>

        @if (Route::has('register'))
            <a class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                href="{{ route('register') }}" wire:navigate>
                Register
            </a>
        @endif
    @endauth
</nav>
