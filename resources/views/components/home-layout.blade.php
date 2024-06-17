<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ public_path('css/styles.css') }}">
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between">
            <h1 class="text-3xl font-bold text-gray-800">{{ config('app.name') }}</h1>

            <div class="flex gap-2">
                <div class="relative">
                    <form action="{{ route('home') }}" method="get" class="flex gap-0 p-0 m-0 rounded">
                        <input type="search" name="query" placeholder="Search Query..."
                            class="border border-gray-600 placeholder:text-gray-500">

                        <button type="submit"
                            class="h-full p-3 bg-slate-700 flex align-center justify-center items-center text-white">
                            <svg class="h-5 w-5" data-slot="icon" fill="none" stroke-width="1.5"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Action Button --}}
                @auth

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-sm font-semibold text-white flex place-content-center place-items-center">Logout</button>
                    </form>
                @else
                    <a class="font-semibold text-white bg-blue-700 rounded p-2 px-4 text-sm h-full flex place-content-center place-items-center"
                        href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>
    </header>

    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-white shadow mt-8">
        <div class="container mx-auto px-6 py-4 text-center">
            <p class="text-gray-600">&copy; 2024 {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>


</body>

</html>
