<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-10">
        
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-4 mb-8 border-b pb-4">
                <a href="/dashboard" class="text-gray-400 hover:text-orange-500 text-2xl transition">⬅️</a>
                <h2 class="text-2xl font-black text-gray-800">Edit Produk Tuan Putri 👑</h2>
            </div>

            <form action="/barang/update/{{ $barang->id }}" method="POST">
                @csrf
                
                <!-- Nama Barang -->
                <div class="mb-5">
                    <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Nama Produk</label>
                    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none" required>
                </div>

                <!-- Stok & Harga -->
                <div class="grid grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Stok Saat Ini</label>
                        <input type="number" name="stok" value="{{ $barang->stok }}" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none" required>
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Harga (Rp)</label>
                        <input type="number" name="harga" value="{{ $barang->harga }}" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none" required>
                    </div>
                </div>

                <!-- Link Gambar -->
                <div class="mb-8">
                    <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Link URL Gambar</label>
                    <input type="text" name="image" value="{{ $barang->image }}" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 mt-1 focus:ring-2 focus:ring-orange-400 outline-none">
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-blue-500 text-white font-bold py-3.5 rounded-xl shadow-lg hover:bg-blue-600 transition">💾 Simpan Perubahan</button>
                    <a href="/dashboard" class="flex-1 bg-gray-100 text-gray-600 text-center font-bold py-3.5 rounded-xl hover:bg-gray-200 transition">Batal</a>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>