<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Nakula Petshop</title>
    
    <!-- Memanggil Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            /* Background Anabul Lucu khas Petshop */
            background-image: url('https://images.unsplash.com/photo-1583337130417-3346a1be7dee?q=80&w=2068&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .glass-box {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 2px solid #ff9f43;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Kotak Login Utama -->
    <div class="glass-box w-full max-w-md p-8 sm:p-10 rounded-[2rem] relative overflow-hidden">
        
        <!-- Hiasan Sudut -->
        <div class="absolute -top-10 -right-10 text-9xl opacity-10 transform rotate-12">🐕</div>

        <!-- Header -->
        <div class="text-center mb-8 relative z-10">
            <div class="bg-gradient-to-br from-orange-400 to-orange-600 w-20 h-20 rounded-full flex items-center justify-center text-4xl mx-auto mb-4 shadow-lg shadow-orange-200 transform hover:-translate-y-2 transition duration-300">🐾</div>
            <h1 class="text-3xl font-black text-gray-800 mb-1 tracking-tight">Nakula Petshop</h1>
            <p class="text-gray-500 text-sm font-medium">Masuk untuk mengelola anabulmu!</p>
        </div>

        <!-- Form Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm border border-red-100 font-bold">
                Ups! Email atau password salah. Coba lagi ya.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="relative z-10">
            @csrf

            <!-- Email Input -->
            <div class="mb-5">
                <label for="email" class="block font-bold text-gray-700 mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 rounded-xl px-4 py-3 outline-none transition" 
                       placeholder="contoh@gmail.com">
            </div>

            <!-- Password Input -->
            <div class="mb-5">
                <label for="password" class="block font-bold text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 rounded-xl px-4 py-3 outline-none transition" 
                       placeholder="••••••••">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-8">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-orange-500 shadow-sm focus:ring-orange-500 w-4 h-4">
                    <span class="ms-2 text-sm text-gray-600 font-bold">Ingat Saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-orange-500 hover:text-orange-700 font-bold transition" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black tracking-widest uppercase py-4 rounded-xl shadow-lg shadow-orange-500/30 transform hover:-translate-y-1 transition duration-300">
                MASUK 🚀
            </button>
            
            <!-- Link Daftar -->
            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-500 font-medium">Belum punya akun pelanggan?</p>
                <a href="{{ route('register') }}" class="text-orange-500 hover:text-orange-600 font-black text-sm mt-1 inline-block transition hover:scale-110">
                    Daftar Sekarang ✨
                </a>
            </div>
        </form>
    </div>

</body>
</html>