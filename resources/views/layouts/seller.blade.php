<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Seller Panel - ShopSense')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar (Fixed) --}}
        <aside class="w-72 flex-shrink-0 bg-slate-900 text-white flex flex-col transition-all duration-300 hidden md:flex">
            @include('layouts.partials.seller-sidebar')
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            {{-- Topbar --}}
            @include('layouts.partials.seller-topbar')

            {{-- Page Content (Scrollable) --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">
                <div class="container mx-auto max-w-7xl">

                    @if(session('warning'))
                    <div class="mb-6 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-amber-800">Attention Needed</h3>
                            <p class="text-sm text-amber-700 mt-1">{{ session('warning') }}</p>
                        </div>
                    </div>
                    @endif

                    @yield('content')
                </div>
            </main>

        </div>

    </div>

</body>

</html>