<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="text-2xl font-bold text-black">
                    ShopSense
                </a>
            </div>

            {{-- Search --}}
            <div class="flex-1 flex justify-center px-2">
                <form action="{{ route('shop.index') }}" method="GET" class="w-full max-w-md">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search products..."
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
                        value="{{ request('search') }}">
                </form>
            </div>

            {{-- Right Side --}}
            <div class="flex items-center space-x-4">

                @auth

                {{-- Cart (only customers) --}}
                @if(!auth()->user()->hasAnyRole(['admin','super-admin','seller']))
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-black">
                    🛒
                </a>
                @endif

                {{-- Wishlist --}}
                <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-black">
                    ❤️
                </a>

                {{-- Notifications --}}
                <a href="{{ route('notifications.index') }}" class="text-gray-700 hover:text-black">
                    🔔
                </a>

                {{-- Profile --}}
                <div class="relative group">
                    <button class="flex items-center space-x-2">
                        <span class="font-medium">
                            {{ auth()->user()->name }}
                        </span>
                        ⌄
                    </button>

                    <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg py-1 z-20 hidden group-hover:block">
                        <a href="{{ route('profile.show') }}"
                            class="block px-4 py-2 hover:bg-gray-100">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                @else
                <a href="{{ route('login') }}" class="font-medium">Login</a>
                <a href="{{ route('register') }}" class="font-medium">Register</a>
                @endauth

            </div>
        </div>
    </div>
</nav>