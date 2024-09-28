<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShopifySports</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto p-4 flex justify-between items-center">
            <div class="text-lg font-bold">
                <a class="text-gray-800 hover:text-blue-500" href="{{ route('shop') }}">ShopifySports</a>
            </div>
            <div class="flex justify-center items-center">
                <a class="text-gray-600 hover:text-blue-500 px-4" href="{{ route('shop') }}">Shop</a>
                <a class="text-gray-600 hover:text-blue-500 px-4" href="{{ route('products.index') }}">Products</a>
                <a class="text-gray-600 hover:text-blue-500 px-4">About Us</a>
                <a class="text-gray-600 hover:text-blue-500 px-4">Contact</a>
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif
                @auth
                    <a class="text-gray-600 hover:text-blue-500 px-4" href="{{ route('cart.index') }}">Cart</a>
                    <a class="text-gray-600 hover:text-blue-500 px-4" href="{{ route('orders.user') }}">My Orders</a>
                    <!-- Logout link -->
                    <form class="inline" action="{{ route('logout') }}" method="get">
                        @csrf
                        <button class="text-gray-600 hover:text-blue-500 px-4" type="submit">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4">
        @yield('content')
    </div>
</body>

</html>
