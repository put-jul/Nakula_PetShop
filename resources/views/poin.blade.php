<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 py-6">
        
        <!-- Banner Poin -->
        <div class="bg-gradient-to-r from-orange-400 to-rose-500 rounded-[2rem] p-8 md:p-12 mb-10 text-white shadow-2xl flex flex-col md:flex-row items-center justify-between relative overflow-hidden">
            <div class="relative z-10 mb-6 md:mb-0">
                <p class="font-bold uppercase tracking-widest text-sm mb-2 opacity-80 text-orange-100">Nakula Loyalty Program</p>
                <h1 class="text-4xl md:text-5xl font-black mb-3">Poin Reward Saya 🎁</h1>
                <p class="text-lg opacity-90 max-w-lg">Kumpulkan poin dari setiap transaksi Grooming atau Belanja, dan tukarkan dengan berbagai hadiah menarik untuk Anabul kesayangan!</p>
            </div>
            
            <!-- Kotak Poin -->
            <div class="relative z-10 bg-white/20 p-6 md:p-8 rounded-[2rem] backdrop-blur-md border border-white/30 text-center min-w-[200px] shadow-lg">
                <span class="block text-sm font-bold uppercase tracking-widest mb-1 text-orange-50">Total Poin Anda</span>
                
                <!-- Angka Poin Otomatis -->
                <div class="text-6xl font-black text-white drop-shadow-md">{{ $poin ?? 0 }}</div>
                
                <span class="block text-xs font-medium mt-2 text-white/80">
                    @if(($poin ?? 0) > 0)
                        Terima kasih telah menjadi pelanggan setia! ✨
                    @else
                        Belum ada poin terkumpul
                    @endif
                </span>
            </div>
            
            <!-- Hiasan Background -->
            <div class="absolute right-10 bottom-0 opacity-10 text-[12rem] transform translate-y-10 rotate-12">⭐</div>
            <div class="absolute left-1/2 top-0 opacity-10 text-[8rem] transform -translate-y-10 -rotate-12">🐾</div>
        </div>

        <!-- Daftar Hadiah yang Bisa Ditukar -->
        <div class="mb-8">
            <h2 class="text-2xl font-black text-gray-800 mb-6 flex items-center gap-3">
                <span>🛍️</span> Tukarkan Poin Anda
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Hadiah 1: Potong Kuku (50 Poin) -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="bg-orange-50 w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mb-4 text-orange-500">
                        ✂️
                    </div>
                    <h3 class="font-black text-gray-800 text-xl mb-2">Gratis Potong Kuku</h3>
                    <p class="text-gray-500 text-sm mb-4">Tukarkan poin untuk layanan potong kuku anabul gratis tanpa antre lama.</p>
                    <div class="flex items-center justify-between">
                        <span class="font-black text-orange-500 bg-orange-100 px-4 py-1.5 rounded-full text-sm">50 Poin</span>
                        
                        @if(($poin ?? 0) >= 50)
                            <button class="bg-orange-500 text-white px-4 py-2 rounded-xl font-bold text-sm hover:bg-orange-600 shadow-md transition">Tukarkan</button>
                        @else
                            <button disabled class="text-gray-400 font-bold text-sm cursor-not-allowed">Poin Kurang</button>
                        @endif
                    </div>
                </div>

                <!-- Hadiah 2: Diskon Mandi (150 Poin) -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="bg-pink-50 w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mb-4 text-pink-500">
                        🛁
                    </div>
                    <h3 class="font-black text-gray-800 text-xl mb-2">Diskon Mandi 50%</h3>
                    <p class="text-gray-500 text-sm mb-4">Potongan harga setengahnya untuk semua paket mandi biasa atau jamur.</p>
                    <div class="flex items-center justify-between">
                        <span class="font-black text-pink-500 bg-pink-100 px-4 py-1.5 rounded-full text-sm">150 Poin</span>
                        
                        @if(($poin ?? 0) >= 150)
                            <button class="bg-pink-500 text-white px-4 py-2 rounded-xl font-bold text-sm hover:bg-pink-600 shadow-md transition">Tukarkan</button>
                        @else
                            <button disabled class="text-gray-400 font-bold text-sm cursor-not-allowed">Poin Kurang</button>
                        @endif
                    </div>
                </div>

                <!-- Hadiah 3: Spa Styling (300 Poin) -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="bg-teal-50 w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mb-4 text-teal-500">
                        👑
                    </div>
                    <h3 class="font-black text-gray-800 text-xl mb-2">Free Spa Styling</h3>
                    <p class="text-gray-500 text-sm mb-4">Layanan grooming paling mewah dan lengkap secara cuma-cuma.</p>
                    <div class="flex items-center justify-between">
                        <span class="font-black text-teal-500 bg-teal-100 px-4 py-1.5 rounded-full text-sm">300 Poin</span>
                        
                        @if(($poin ?? 0) >= 300)
                            <button class="bg-teal-500 text-white px-4 py-2 rounded-xl font-bold text-sm hover:bg-teal-600 shadow-md transition">Tukarkan</button>
                        @else
                            <button disabled class="text-gray-400 font-bold text-sm cursor-not-allowed">Poin Kurang</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Tambahan -->
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex items-start gap-4">
            <div class="text-blue-500 text-2xl mt-1">💡</div>
            <div>
                <h4 class="font-bold text-blue-900 mb-1">Cara Mendapatkan Poin</h4>
                <p class="text-blue-800/80 text-sm leading-relaxed">Setiap transaksi kelipatan <strong>Rp 10.000</strong> di Nakula Petshop (baik layanan Grooming maupun pembelian di Kasir), Anda akan otomatis mendapatkan <strong>1 Poin</strong>. Pastikan Anda menyebutkan nama akun ini ke Kasir saat melakukan pembayaran!</p>
            </div>
        </div>

    </div>
</x-app-layout>