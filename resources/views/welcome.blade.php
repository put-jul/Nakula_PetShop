<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di Nakula Petshop</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-petshop {
            background-image: url('https://images.unsplash.com/photo-1548191265-cc70d3d45ba1?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-petshop">
        <div class="overlay absolute inset-0"></div>

        <div class="relative z-10 text-center">
            <h1 class="text-6xl font-extrabold text-white mb-4 drop-shadow-lg">
                🐾 NAKULA <span style="color: #ff9f43;">PETSHOP</span>
            </h1>
            <p class="text-white text-xl mb-8 font-medium">Solusi Terbaik untuk Kebutuhan Hewan Kesayangan Anda</p>

            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-3 bg-orange-500 text-white font-bold rounded-full shadow-lg hover:bg-orange-600 transition duration-300">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-orange-500 text-white font-bold rounded-full shadow-lg hover:bg-orange-600 transition duration-300">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-white text-orange-600 font-bold rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</body>
</html>