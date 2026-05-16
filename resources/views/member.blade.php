<x-app-layout>
    <div class="max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg font-bold">
                ✨ {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-orange-100">
            <h2 class="text-2xl font-black text-gray-800 mb-6 flex items-center gap-3">
                <span class="bg-orange-100 p-2 rounded-xl">🐕</span> Database Pelanggan (Member)
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-sm uppercase tracking-wider">
                            <th class="p-4 rounded-tl-xl">Nama Pelanggan</th>
                            <th class="p-4">Email</th>
                            <th class="p-4 text-center">Total Poin</th>
                            <th class="p-4 rounded-tr-xl text-center">Aksi Poin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($members as $m)
                        <tr class="hover:bg-orange-50/50 transition">
                            <td class="p-4 font-bold text-gray-800">{{ $m->name }}</td>
                            <td class="p-4 text-gray-500">{{ $m->email }}</td>
                            <td class="p-4 text-center">
                                <span class="bg-orange-100 text-orange-600 font-black px-3 py-1 rounded-lg">{{ $m->points }} Poin</span>
                            </td>
                            <td class="p-4 text-center">
                                <form action="/member/poin/{{ $m->id }}" method="POST" class="flex justify-center gap-2">
                                    @csrf
                                    <input type="number" name="poin" class="w-20 border-gray-200 rounded-lg text-sm" placeholder="+ Poin" required>
                                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded-lg font-bold text-sm transition">Tambah</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-400 font-bold">Belum ada pelanggan yang mendaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>