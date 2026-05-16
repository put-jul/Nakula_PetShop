<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login - Nakula Petshop</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .bg-hewan {
                background-image: url('https://images.unsplash.com/photo-1548191265-cc70d3d45ba1?q=80&w=2070&auto=format&fit=crop');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
        </style>
    </head>
    
    <body class="font-sans text-gray-900 antialiased bg-hewan">
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-black/30 backdrop-blur-sm">
            <div>
                <a href="/">
                    <h2 class="text-4xl font-extrabold tracking-widest drop-shadow-lg" style="color: #ff9f43; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                        🐾 NAKULA PETSHOP
                    </h2>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/90 shadow-2xl overflow-hidden sm:rounded-2xl border-t-4" style="border-color: #ff9f43;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>