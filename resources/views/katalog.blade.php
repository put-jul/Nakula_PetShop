<x-app-layout>
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Banner Katalog -->
        <div class="bg-gradient-to-r from-teal-400 to-emerald-500 rounded-[2rem] p-10 mb-10 text-white relative overflow-hidden shadow-xl">
            <div class="relative z-10">
                <p class="font-bold uppercase tracking-widest text-sm mb-2 opacity-80">Etalase Nakula</p>
                <h1 class="text-4xl font-black mb-2">Belanja Keperluan Anabul 🛍️</h1>
                <p class="text-lg opacity-90 max-w-xl">Cek ketersediaan stok sebelum kehabisan! Pembelian hanya dapat dilakukan langsung di Kasir Toko Nakula Petshop.</p>
            </div>
            <div class="absolute right-0 bottom-0 opacity-20 text-[10rem] transform translate-y-10 translate-x-5 -rotate-12">🦴</div>
        </div>

        <!-- Grid Produk (Otomatis dari Database) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($barang as $b)
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 relative group">
                    
                    <!-- Label Stok -->
                    <div class="absolute top-4 right-4 z-10">
                        @if($b->stok > 10)
                            <span class="bg-green-100 text-green-600 text-[10px] font-black px-3 py-1 rounded-full uppercase shadow-sm">Stok Aman</span>
                        @elseif($b->stok > 0)
                            <span class="bg-orange-100 text-orange-600 text-[10px] font-black px-3 py-1 rounded-full uppercase shadow-sm">Sisa {{ $b->stok }}</span>
                        @else
                            <span class="bg-red-100 text-red-600 text-[10px] font-black px-3 py-1 rounded-full uppercase shadow-sm">Habis</span>
                        @endif
                    </div>

                    <!-- Tempat Gambar Otomatis -->
                    <div class="w-full h-48 rounded-2xl mb-4 overflow-hidden bg-gray-50 flex items-center justify-center">
                        @if(!empty($b->image))
                            <!-- Jika admin sudah isi link di database -->
                            <img src="{{ $b->image }}" alt="Gambar Produk" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <!-- Jika admin belum isi link -->
                            <div class="text-5xl opacity-50 group-hover:scale-110 transition duration-500">📦</div>
                        @endif
                    </div>

                    <div>
                        <!-- Info Produk -->
                        <h3 class="font-black text-gray-800 text-lg mb-1 leading-tight">{{ $b->nama_barang ?? 'Nama Produk' }}</h3>
                        <p class="text-orange-500 font-black text-xl mb-4">Rp {{ number_format($b->harga ?? 0, 0, ',', '.') }}</p>
                        
                        <!-- Tombol Beli -->
                        <button disabled class="w-full bg-orange-50 text-orange-600 font-black py-3 rounded-xl border border-orange-200 text-sm flex justify-center items-center gap-2 cursor-default">
                            <span>🏪</span> Beli Langsung di Kasir
                        </button>
                    </div>
                </div>
            @empty
                <!-- Tampilan jika database kosong -->
                <div class="col-span-full bg-white p-10 rounded-3xl text-center border border-dashed border-gray-300">
                    <div class="text-6xl mb-4 opacity-50">🛒</div>
                    <h3 class="text-xl font-black text-gray-800 mb-2">Katalog Masih Kosong</h3>
                    <p class="text-gray-500">Admin belum menambahkan produk ke etalase.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</x-app-layout> 