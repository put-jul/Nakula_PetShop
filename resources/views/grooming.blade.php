<x-app-layout>
    <div class="max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="bg-orange-500 text-white p-4 rounded-2xl mb-6 shadow-lg flex items-center gap-3 font-bold animate-bounce">
                <span class="text-2xl">✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="bg-gradient-to-r from-orange-400 to-orange-600 rounded-3xl p-8 mb-8 shadow-md flex justify-between items-center text-white relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-3xl font-black mb-2">✂️ Layanan Grooming & Spa</h1>
                <p class="opacity-90 font-medium">Kelola antrean mandi dan perawatan anabul di sini.</p>
            </div>
            <div class="text-7xl opacity-20 absolute right-10 -bottom-5">🛁</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 bg-white p-8 rounded-3xl shadow-sm border border-gray-100 h-fit sticky top-6">
                <h3 class="font-black text-xl text-gray-800 mb-6 flex items-center gap-2"><span>📝</span> Tambah Antrean</h3>
                <form action="/grooming/simpan" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nama Anabul</label>
                            <input type="text" name="nama_hewan" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Jenis</label>
                            <select name="jenis_hewan" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500">
                                <option value="Kucing">Kucing 🐈</option>
                                <option value="Anjing">Anjing 🐕</option>
                                <option value="Kelinci">Kelinci 🐇</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Paket Grooming</label>
                        <select name="paket" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500">
                            <option value="Mandi Biasa">Mandi Biasa (Basic)</option>
                            <option value="Mandi Jamur/Kutu">Mandi Jamur/Kutu (Medicated)</option>
                            <option value="Full Grooming + Potong">Full Grooming + Cukur</option>
                            <option value="Spa Styling">Premium Spa Styling</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Tarif (Rp)</label>
                        <input type="number" name="harga" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500" required>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition">
                        Masukkan Antrean
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="font-black text-gray-800 flex items-center gap-2"><span>📋</span> Daftar Antrean Hari Ini</h3>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr class="text-gray-400 text-xs font-black uppercase">
                                <th class="p-4">Pemilik & Hewan</th>
                                <th class="p-4">Paket</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($groomings as $g)
                            <tr class="hover:bg-orange-50 transition">
                                <td class="p-4">
                                    <p class="font-bold text-gray-800">{{ $g->nama_pelanggan }}</p>
                                    <p class="text-[10px] font-bold text-orange-600 bg-orange-100 inline-block px-2 py-0.5 rounded-md">{{ $g->nama_hewan }} ({{ $g->jenis_hewan }})</p>
                                </td>
                                <td class="p-4">
                                    <p class="font-bold text-gray-700 text-sm">{{ $g->paket }}</p>
                                    <p class="text-xs text-gray-400 font-bold">Rp {{ number_format($g->harga) }}</p>
                                </td>
                                <td class="p-4 text-center">
                                    @if($g->status == 'Antre')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg text-[10px] font-black animate-pulse">⏳ ANTRE</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-[10px] font-black">✅ SELESAI</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center space-y-2">
                                    @if($g->status == 'Antre')
                                        <a href="/grooming/selesai/{{ $g->id }}" class="block bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-xl text-xs font-bold transition shadow-sm">Selesai</a>
                                    @endif
                                    <a href="/grooming/hapus/{{ $g->id }}" class="block text-red-400 hover:text-red-600 font-bold text-xs" onclick="return confirm('Hapus?')">Hapus</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center text-gray-400">Belum ada antrean mandi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>