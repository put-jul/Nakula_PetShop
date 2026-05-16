<x-app-layout>
    <!-- Banner Header -->
    <div class="bg-gradient-to-r from-orange-400 to-orange-500 rounded-3xl p-8 mb-8 shadow-md flex justify-between items-center text-white relative overflow-hidden">
        <div class="relative z-10">
            <h1 class="text-3xl font-black mb-2">Nakula Petshop Manager ✨</h1>
            <p class="opacity-90">Pantau stok dan pendapatan tokomu dengan mudah.</p>
        </div>
        <div class="text-7xl opacity-30 absolute right-10 -bottom-5">🐕</div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500">
            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Total Produk</p>
            <h2 class="text-2xl font-black text-gray-800">{{ $totalProduk }} <span class="text-sm font-medium text-gray-400">Item</span></h2>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-orange-500">
            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Total Transaksi</p>
            <h2 class="text-2xl font-black text-gray-800">{{ $totalTransaksi }} <span class="text-sm font-medium text-gray-400">Nota</span></h2>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500">
            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Pendapatan</p>
            <h2 class="text-2xl font-black text-green-600">Rp {{ number_format($totalPendapatan) }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- FORM INPUT STOK -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 h-fit">
            <h3 class="font-black mb-6 flex items-center gap-2 text-gray-800"><span>➕</span> Input Stok</h3>
            <form action="/barang/simpan" method="POST">
                @csrf
                <!-- Nama Barang -->
                <div class="mb-4">
                    <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Nama Produk</label>
                    <input type="text" name="nama_barang" placeholder="Contoh: Whiskas Tuna" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none" required>
                </div>

                <!-- Stok & Harga -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Stok</label>
                        <input type="number" name="stok" placeholder="0" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none" required>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Harga</label>
                        <input type="number" name="harga" placeholder="Rp" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none" required>
                    </div>
                </div>

                <!-- INPUT LINK GAMBAR (URL INTERNET) -->
                <div class="mb-6">
                    <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Link URL Gambar (Opsional)</label>
                    <input type="text" name="image" placeholder="Paste link gambar dari Google/Internet..." class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none">
                    <p class="text-[10px] text-gray-400 mt-1 italic">*Kosongkan jika tidak ada gambar</p>
                </div>

                <button class="w-full bg-orange-500 text-white font-bold py-3.5 rounded-xl shadow-lg hover:bg-orange-600 transition">Simpan Barang</button>
            </form>
        </div>

        <!-- TABEL DATA BARANG -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50">
                    <tr class="text-gray-400 text-xs font-black uppercase">
                        <th class="p-4">Info Barang</th>
                        <th class="p-4 text-center">Stok</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $p)
                    <tr class="hover:bg-orange-50 transition">
                        <td class="p-4 flex items-center gap-4">
                            <!-- Thumbnail Gambar -->
                            <div class="w-12 h-12 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden border border-gray-100 flex items-center justify-center shadow-sm">
                                @if(!empty($p->image))
                                    <img src="{{ $p->image }}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/100x100?text=Error'">
                                @else
                                    <span class="text-xl">📦</span>
                                @endif
                            </div>
                            <span class="font-bold text-gray-800">{{ $p->nama_barang }}</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $p->stok < 5 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                {{ $p->stok }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-600 font-medium">Rp {{ number_format($p->harga) }}</td>
                        
                        <!-- KOLOM AKSI (EDIT & HAPUS) -->
                        <td class="p-4 text-center flex justify-center gap-2 items-center h-full mt-2">
                            <a href="/barang/edit/{{ $p->id }}" class="text-blue-500 hover:text-blue-700 font-bold p-2 hover:bg-blue-50 rounded-lg transition">
                                ✏️ Edit
                            </a>
                            <a href="/barang/hapus/{{ $p->id }}" class="text-red-400 hover:text-red-600 font-bold p-2 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Hapus barang ini?')">
                                🗑️ Hapus
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>