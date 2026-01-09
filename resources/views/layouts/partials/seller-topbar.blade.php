<header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-sm px-6 py-3 flex justify-between items-center h-16">

    {{-- Left: Page Title + Search --}}
    <div class="flex items-center gap-8">

        <h1 class="text-xl font-bold text-slate-800">
            @yield('title', 'Seller Dashboard')
        </h1>

        {{-- Search --}}
        <div class="hidden md:block relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <form action="#" method="GET">
                <input
                    type="text"
                    name="q"
                    placeholder="Search products, orders..."
                    class="w-64 pl-10 pr-4 py-2 bg-slate-100 border-transparent rounded-lg text-sm focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all placeholder-slate-400 text-slate-700">
            </form>
        </div>
    </div>

    {{-- Right: Actions --}}
    <div class="flex items-center gap-5">

        {{-- Notifications --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-full transition-colors focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                </span>
            </button>

            <div
                x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 z-50">

                <div class="p-4 border-b border-slate-100 font-semibold text-slate-800">
                    Notifications
                </div>

                <ul class="divide-y divide-slate-100 max-h-64 overflow-y-auto">
                    <li class="p-4 hover:bg-slate-50 cursor-pointer">
                        <div class="text-sm text-slate-600">Product <strong class="text-slate-800">iPhone Case</strong> approved</div>
                        <div class="text-xs text-slate-400 mt-1">2 hours ago</div>
                    </li>
                    <li class="p-4 hover:bg-slate-50 cursor-pointer">
                        <div class="text-sm text-slate-600">Low stock on <strong class="text-slate-800">Power Bank</strong></div>
                        <div class="text-xs text-slate-400 mt-1">5 hours ago</div>
                    </li>
                </ul>

                <a href="#" class="block text-center p-3 text-xs font-semibold text-indigo-600 hover:bg-indigo-50 rounded-b-xl">
                    View all notifications
                </a>
            </div>
        </div>

        <div class="h-6 w-px bg-slate-200"></div>

        {{-- Profile Dropdown --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-3 focus:outline-none">

                <div class="hidden md:block text-right">
                    <div class="text-sm font-semibold text-slate-700 leading-tight">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-emerald-600 font-medium">Seller Account</div>
                </div>

                <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold border border-emerald-200">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>

                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div
                x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 z-50 py-1">

                <a href="{{ route('seller.profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                    Profile Settings
                </a>

                <div class="border-t border-slate-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </div>

</header>