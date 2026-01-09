<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name', 'ShopSense'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    {{-- Global Header --}}
    @include('layouts.partials.header')

    {{-- Optional Filters --}}
    @hasSection('filters')
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            @yield('filters')
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    @include('layouts.partials.footer')


</body>

</html>