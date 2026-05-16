<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - Nakula Petshop</title>
    
    <!-- Memanggil Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            /* Background Anabul Lucu khas Petshop yang sama dengan halaman Login */
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

    <!-- Kotak Register Utama -->
    <div class="glass-box w-full max-w-md p-8 sm:p-10 rounded-[2rem] relative overflow-hidden">
        
        <!-- Hiasan Sudut -->
        <div class="absolute -bottom-10 -left-10 text-9xl opacity-10 transform -rotate-12">🐈</div>

        <!-- Header -->
        <div class="text-center mb-6 relative z-10">
            <div class="bg-gradient-to-br from-orange-400 to-orange-600 w-16 h-16 rounded-full flex items-center justify-center text-3xl mx-auto mb-3 shadow-lg shadow-orange-200 transform hover:-translate-y-2 transition duration-300">🐾</div>
            <h1 class="text-2xl font-black text-gray-800 mb-1 tracking-tight">Daftar Akun</h1>
            <p class="text-gray-500 text-sm font-medium">Bergabunglah dengan keluarga Nakula!</p>
        </div>

        <!-- Form Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-3 rounded-xl mb-5 text-xs border border-red-100 font-bold">
                Ups! Ada yang terlewat atau email sudah terdaftar. Cek lagi ya!
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="relative z-10">
            @csrf

            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="name" class="block font-bold text-gray-700 mb-1 text-sm">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 rounded-xl px-4 py-2.5 outline-none transition text-sm" 
                       placeholder="Masukkan namamu">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-bold text-gray-700 mb-1 text-sm">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 rounded-xl px-4 py-2.5 outline-none transition text-sm" 
                       placeholder="contoh@gmail.com">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-bold text-gray-700 mb-1 text-sm">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 rounded-xl px-4 py-2.5 outline-none transition text-sm"
                       placeholder="Minimal 8 karakter">
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block font-bold text-gray-700 mb-1 text-sm">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 rounded-xl px-4 py-2.5 outline-none transition text-sm"
                       placeholder="Ulangi password">
            </div>

            <!-- Tombol Daftar -->
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black tracking-widest uppercase py-3.5 rounded-xl shadow-lg shadow-orange-500/30 transform hover:-translate-y-1 transition duration-300 text-sm">
                DAFTAR SEKARANG ✨
            </button>
            
            <!-- Link ke Login -->
            <div class="mt-6 text-center border-t border-gray-100 pt-4">
                <p class="text-xs text-gray-500 font-medium">Sudah punya akun?</p>
                <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-black text-sm mt-1 inline-block transition hover:scale-110">
                    Masuk di sini 🚀
                </a>
            </div>
        </form>
    </div>

</body>
</html>