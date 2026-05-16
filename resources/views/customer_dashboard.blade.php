<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="max-w-7xl mx-auto px-4 py-8">

        @if(session('success'))
            <div class="bg-orange-500 text-white p-4 rounded-2xl mb-6 shadow-lg font-bold animate-bounce">
                ✨ {{ session('success') }}
            </div>
        @endif

        <!-- ========================================== -->
        <!-- KARTU MEMBER DIGITAL VIP NAKULA -->
        <!-- ========================================== -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-6 mb-8 text-white shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between border border-gray-700">
            <div class="absolute -right-10 -top-10 opacity-10 text-9xl transform rotate-12">💎</div>
            
            <div class="flex items-center gap-6 relative z-10 w-full md:w-auto mb-6 md:mb-0">
                <!-- Inisial Nama Pelanggan -->
                <div class="w-20 h-20 bg-gradient-to-tr from-orange-400 to-yellow-400 rounded-2xl flex items-center justify-center text-4xl shadow-lg border-2 border-white/20 font-black">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-xs text-orange-400 font-bold tracking-widest uppercase mb-1">Nakula VIP Member</p>
                    <h2 class="text-2xl font-black">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="relative z-10 bg-white/10 p-5 rounded-2xl border border-white/10 backdrop-blur-sm text-center min-w-[150px]">
                <p class="text-xs text-gray-300 font-bold uppercase tracking-wider mb-1">Saldo Poin</p>
                <p class="text-3xl font-black text-orange-400">{{ Auth::user()->points }} <span class="text-lg">pts</span></p>
            </div>
        </div>
        <!-- ========================================== -->

        <div class="bg-gradient-to-r from-orange-400 to-orange-600 rounded-[2rem] p-10 mb-10 text-white relative overflow-hidden shadow-xl">
            <div class="relative z-10">
                <h1 class="text-4xl font-black mb-2">Halo, {{ Auth::user()->name }}! 🐾</h1>
                <p class="text-lg opacity-90">Anabulmu butuh perawatan? Yuk, reservasi jadwal grooming sekarang!</p>
            </div>
            <div class="absolute right-0 bottom-0 opacity-20 text-[12rem] transform translate-y-10 translate-x-10">🐈</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-orange-100 sticky top-6">
                    <h3 class="font-black text-xl text-gray-800 mb-6 flex items-center gap-2">
                        <span class="bg-orange-100 p-2 rounded-lg text-orange-600">✂️</span> Booking Grooming
                    </h3>
                    <form action="/portal-pelanggan/reservasi" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="text-xs font-bold text-gray-400 uppercase mb-2 block">Nama Anabul</label>
                            <input type="text" name="nama_hewan" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500" placeholder="Cth: Mochi" required>
                        </div>
                        <div class="mb-4">
                            <label class="text-xs font-bold text-gray-400 uppercase mb-2 block">Jenis Hewan</label>
                            <select name="jenis_hewan" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500">
                                <option value="Kucing">Kucing 🐈</option>
                                <option value="Anjing">Anjing 🐕</option>
                                <option value="Kelinci">Kelinci 🐇</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="text-xs font-bold text-gray-400 uppercase mb-2 block">Pilih Layanan</label>
                            <select name="paket" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500">
                                <option value="Mandi Biasa">Mandi Biasa (Rp 50rb)</option>
                                <option value="Mandi Jamur/Kutu">Mandi Jamur (Rp 85rb)</option>
                                <option value="Full Grooming + Potong">Full Grooming (Rp 120rb)</option>
                                <option value="Spa Styling">Premium Spa (Rp 200rb)</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-orange-500 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-orange-600 transition duration-300">
                            Pesan Jadwal 🚀
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-orange-100 overflow-hidden">
                    <div class="p-6 border-b border-orange-50 bg-orange-50/30">
                        <h3 class="font-black text-gray-800 flex items-center gap-2"><span>📜</span> Riwayat Perawatanmu</h3>
                    </div>
                    <div class="p-6">
                        @forelse($riwayat as $r)
                            <div class="flex flex-col md:flex-row md:items-center justify-between p-5 bg-gray-50 rounded-2xl mb-4 border border-gray-100 hover:shadow-md transition">
                                <div class="flex items-center gap-4 mb-4 md:mb-0">
                                    <div class="text-3xl bg-white w-14 h-14 rounded-full flex items-center justify-center shadow-sm">🛁</div>
                                    <div>
                                        <h4 class="font-black text-gray-800">{{ $r->nama_hewan }} <span class="text-xs font-normal text-gray-400">({{ $r->paket }})</span></h4>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">{{ $r->created_at->format('d M Y - H:i') }} WIB</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    @if($r->status == 'Antre')
                                        <span class="bg-yellow-100 text-yellow-600 px-3 py-1.5 rounded-lg text-xs font-black animate-pulse">⏳ ANTRE</span>
                                        <a href="/portal-pelanggan/batal/{{ $r->id }}" class="bg-white border border-red-200 text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg text-xs font-bold transition" onclick="return confirm('Yakin ingin membatalkan?')">Batalkan</a>
                                    @else
                                        <span class="bg-green-100 text-green-600 px-3 py-1.5 rounded-lg text-xs font-black">✅ SELESAI</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400 font-bold">Belum ada reservasi. Yuk, manjakan anabulmu!</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>