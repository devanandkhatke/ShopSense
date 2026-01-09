<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel - ShopSense')</title>
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

        {{-- Sidebar (Fixed Width) --}}
        <aside class="w-72 flex-shrink-0 bg-slate-900 text-white flex flex-col transition-all duration-300">
            @include('layouts.partials.admin-sidebar')
        </aside>

        {{-- Main Area --}}
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            {{-- Topbar --}}
            @include('layouts.partials.admin-topbar')

            {{-- Page Content (Scrollable) --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">
                <div class="container mx-auto max-w-7xl">
                    @yield('content')
                </div>
            </main>

        </div>

    </div>

</body>

</html>