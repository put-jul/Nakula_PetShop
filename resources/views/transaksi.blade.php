<x-app-layout>
    <div class="max-w-7xl mx-auto">

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-2xl mb-6 shadow-lg flex items-center justify-between font-bold animate-bounce">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">✅</span> {{ session('success') }}
                </div>
                <span class="text-sm opacity-80">Scroll ke bawah untuk cetak struk.</span>
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-2xl mb-6 shadow-lg flex items-center gap-3 font-bold">
                <span class="text-2xl">⚠️</span> {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8 mb-10">
            
            <div class="flex-1 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h3 class="font-black text-2xl text-gray-800 mb-6 flex items-center gap-2"><span>🛍️</span> Pilih Produk</h3>
                <form action="/transaksi/tambah" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Nama Barang</label>
                        <select name="product_id" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3 focus:ring-orange-500">
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_barang }} (Stok: {{ $p->stok }}) - Rp {{ number_format($p->harga) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Jumlah Beli</label>
                        <input type="number" name="jumlah" value="1" min="1" class="w-full bg-gray-50 border-gray-200 rounded-xl p-3" required>
                    </div>
                    <div class="md:col-span-2">
                        <button class="w-full bg-orange-500 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-orange-600 transition">Tambahkan ke Keranjang</button>
                    </div>
                </form>
            </div>

            <div class="w-full lg:w-96 bg-[#2d3436] text-white p-8 rounded-3xl shadow-xl border border-gray-700">
                <h3 class="font-black text-xl mb-6 flex justify-between items-center">
                    <span>🛒 Keranjang</span>
                    <a href="/transaksi/hapus" class="text-xs text-red-400 hover:text-red-300 underline transition">Kosongkan</a>
                </h3>
                
                <div class="space-y-4 mb-8">
                    @php $total = 0; @endphp
                    @forelse($cart as $id => $item)
                        @php $total += ($item['harga'] * $item['jumlah']); @endphp
                        <div class="flex justify-between items-center bg-white/10 p-3 rounded-xl">
                            <div>
                                <p class="font-bold text-sm">{{ $item['nama'] }}</p>
                                <p class="text-[10px] opacity-60">{{ $item['jumlah'] }} x {{ number_format($item['harga']) }}</p>
                            </div>
                            <p class="font-black">Rp {{ number_format($item['harga'] * $item['jumlah']) }}</p>
                        </div>
                    @empty
                        <p class="text-center opacity-40 py-10">Belum ada barang...</p>
                    @endforelse
                </div>

                <div class="border-t border-white/20 pt-5 mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="opacity-60 text-sm">Total Belanja</span>
                        <span class="text-2xl font-black text-orange-400">Rp {{ number_format($total) }}</span>
                    </div>
                </div>

                <form action="/transaksi/simpan" method="POST">
                    @csrf
                    <input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" class="w-full bg-white/10 border-white/20 rounded-xl p-3 mb-4 text-white placeholder-white/40 focus:ring-orange-500 focus:border-orange-500" required>
                    <button class="w-full bg-gradient-to-r from-green-500 to-green-600 py-4 rounded-2xl font-black shadow-xl hover:scale-105 transition">PROSES BAYAR 💰</button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <h3 class="font-black text-xl text-gray-800 mb-6 flex items-center gap-2"><span>📜</span> Riwayat Transaksi & Cetak Struk</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-400 text-xs font-black uppercase border-b border-gray-100">
                        <tr>
                            <th class="p-4">No. TRX</th>
                            <th class="p-4">Pelanggan</th>
                            <th class="p-4">Total Belanja</th>
                            <th class="p-4">Waktu (WIB)</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($transactions as $t)
                        <tr class="hover:bg-orange-50 transition">
                            <td class="p-4 font-bold text-gray-800">#TRX-{{ sprintf("%04d", $t->id) }}</td>
                            <td class="p-4 text-gray-600 font-medium">{{ $t->nama_pelanggan }}</td>
                            <td class="p-4 font-black text-green-600">Rp {{ number_format($t->total_bayar) }}</td>
                            <td class="p-4 text-sm text-gray-500 font-medium">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-4 text-center">
                                <a href="/transaksi/cetak/{{ $t->id }}" target="_blank" class="inline-block bg-orange-100 text-orange-600 hover:bg-orange-500 hover:text-white px-5 py-2 rounded-xl font-bold text-sm transition shadow-sm">
                                    🖨️ Cetak Struk
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 font-medium text-lg">
                                Belum ada transaksi. Ayo mulai jualan! 🐾
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>