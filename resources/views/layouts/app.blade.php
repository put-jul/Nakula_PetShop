<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Nakula Petshop - Management System</title>
        
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex min-h-screen">
            
            <!-- ========================================== -->
            <!-- SIDEBAR DINAMIS -->
            <!-- ========================================== -->
            <div class="w-72 bg-[#1e272e] shadow-2xl flex flex-col sticky top-0 h-screen hidden md:flex">
                <div class="p-6 border-b border-gray-800 flex items-center gap-4">
                    <div class="bg-gradient-to-br from-orange-400 to-orange-600 w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow-lg">🐾</div>
                    <div>
                        <h2 class="text-xl font-black text-white tracking-widest">NAKULA</h2>
                        <p class="text-[10px] text-orange-400 font-bold uppercase tracking-widest">
                            {{ Auth::user()->role == 'admin' ? 'Management System' : 'Customer Portal' }}
                        </p>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-5">
                    
                    @if(Auth::user()->role == 'admin')
                        <!-- MENU KHUSUS ADMIN -->
                        <p class="text-xs font-bold text-gray-500 mb-4 uppercase tracking-wider ml-2">Menu Utama</p>
                        <a href="/dashboard" class="flex items-center gap-3 {{ request()->is('dashboard') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} p-3.5 rounded-xl mb-3 font-bold transition-all">
                            <span class="text-xl">📦</span> Dashboard Stok
                        </a>
                        <a href="/transaksi" class="flex items-center gap-3 {{ request()->is('transaksi') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} p-3.5 rounded-xl mb-3 font-bold transition-all">
                            <span class="text-xl">💰</span> Kasir (POS)
                        </a>
                        <a href="/laporan/excel" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-gray-800 p-3.5 rounded-xl mb-8 font-medium transition-all">
                            <span class="text-xl">📊</span> Laporan Excel
                        </a>

                        <p class="text-xs font-bold text-gray-500 mb-4 uppercase tracking-wider ml-2">Layanan Petshop</p>
                        <a href="/grooming" class="flex items-center gap-3 {{ request()->is('grooming') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} p-3.5 rounded-xl mb-3 font-medium transition-all">
                            <span class="text-xl">✂️</span> Antrean Grooming
                        </a>
                        <a href="/member" class="flex items-center gap-3 {{ request()->is('member') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} p-3.5 rounded-xl mb-3 font-medium transition-all">
                            <span class="text-xl">🐕</span> Data Member
                        </a>
                    @else
                        <!-- MENU KHUSUS PELANGGAN (CUSTOMER) -->
                        <p class="text-xs font-bold text-gray-500 mb-4 uppercase tracking-wider ml-2">Layanan Mandiri</p>
                        <a href="/portal-pelanggan" class="flex items-center gap-3 {{ request()->is('portal-pelanggan') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} p-3.5 rounded-xl mb-3 font-bold transition-all">
                            <span class="text-xl">🛁</span> Reservasi Grooming
                        </a>
                        <a href="/poin-reward" class="flex items-center gap-3 {{ request()->is('poin-reward') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} p-3.5 rounded-xl mb-3 font-bold transition-all">
                            <span class="text-xl">🎁</span> Poin Reward
                        </a>
                        <a href="/katalog" class="flex items-center gap-3 {{ request()->is('katalog') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} p-3.5 rounded-xl mb-3 font-bold transition-all">
                            <span class="text-xl">🛍️</span> Katalog Produk
                        </a>
                    @endif
                </div>

                <div class="p-5 border-t border-gray-800">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white py-3.5 rounded-xl font-bold transition-all flex justify-center items-center gap-2">
                            <span>🚪</span> Keluar Sistem
                        </button>
                    </form>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- KONTEN UTAMA -->
            <!-- ========================================== -->
            <div class="flex-1 flex flex-col min-w-0">
                <nav class="bg-white border-b border-gray-100 p-4 flex justify-between items-center px-8 shadow-sm">
                    <div class="font-black text-gray-800 text-sm md:text-base">Halaman: <span class="text-orange-500 uppercase">{{ request()->path() }}</span></div>
                    <div class="font-bold text-gray-600 flex items-center gap-2">
                        <span class="hidden md:inline">Halo, {{ Auth::user()->name }} ✨</span>
                        <div class="bg-orange-100 text-orange-600 w-8 h-8 rounded-full flex items-center justify-center font-black">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </nav>

                <main class="p-4 md:p-8 overflow-x-hidden">
                    {{ $slot }}
                </main>
            </div>
            
        </div>
    </body>
</html>