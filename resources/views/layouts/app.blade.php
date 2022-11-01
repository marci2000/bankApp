<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Scripts -->
    @vite('resources/css/main.css')
</head>

<body class="bg-zinc-200">
    <div class="bg-zinc-100 mx-8 my-8 rounded-lg shadow-xl">
        <header class="bg-zinc-600 border-b border-zinc-700 rounded-lg">
            <nav class="container flex justify-between">
                <div>
                    <ul class="flex items-center">
                        <li class="nav-item hover:bg-yellow-400 py-6 ml-10"><a href="/" class="text-white text-lg ml-5 mr-5 no-underline">Exchange App</a></li>

                        @auth
                            <li class="nav-item hover:bg-yellow-400 py-6"><a href="/banks" class="text-white text-lg ml-5 mr-5 no-underline">Banks</a></li>
                            <li class="nav-item hover:bg-yellow-400 py-6"><a href="/calculator" class=" text-white text-lg ml-5 mr-5 no-underline">Calculator</a></li>
                            <li class="nav-item hover:bg-yellow-400 py-6"><a href="/subscriptions" class=" text-white text-lg ml-5 mr-5 no-underline">Subscriptions</a></li>
                            <li class="nav-item hover:bg-yellow-400 py-6"><a href="/subscribe" class=" text-white text-lg ml-5 mr-5 no-underline">Subscribe</a></li>
                        @endauth

                        @admin
                            <li class="nav-item hover:bg-yellow-400 py-6"><a href="/users" class=" text-white text-lg ml-5 mr-5 no-underline">Users</a></li>
                        @endadmin
                    </ul>
                </div>

                <div>
                    <ul class="flex text-lg">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item hover:bg-yellow-400 px-10 py-6">
                                    <a class="nav-link nav-item text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item hover:bg-yellow-400 px-10 py-6">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item hover:bg-yellow-400 py-6">
                                <a href="#" class="text-white text-lg ml-5 mr-5 no-underline">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>

                            <li class="nav-item hover:bg-yellow-400 py-6">
                                <a class="text-white text-lg ml-5 mr-5 no-underline" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    @if(session()->has('success'))
        <div class="fixed bottom-3 right-3 bg-yellow-400 py-8 px-5 rounded-2xl"
             x-data = "{show : true}"
             x-init = "setTimeout(() => show = false, 4000)"
             x-show = "show">
            <p>{{ session('success') }}</p>
        </div>
    @endif
</body>
</html>
