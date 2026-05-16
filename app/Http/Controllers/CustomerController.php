<?php

namespace App\Http\Controllers;

use App\Models\Grooming;
use App\Models\Barang; // <--- INI SURAT PENGANTARNYA, WAJIB ADA ✨
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index() {
        // Hanya ambil riwayat milik customer yang sedang login
        $riwayat = Grooming::where('nama_pelanggan', Auth::user()->name)
                           ->orderBy('created_at', 'desc')
                           ->get();
        return view('customer_dashboard', compact('riwayat'));
    }

    public function reservasi(Request $request) {
        $tarif = [
            'Mandi Biasa' => 50000,
            'Mandi Jamur/Kutu' => 85000,
            'Full Grooming + Potong' => 120000,
            'Spa Styling' => 200000
        ];

        Grooming::create([
            'nama_pelanggan' => Auth::user()->name,
            'nama_hewan' => $request->nama_hewan,
            'jenis_hewan' => $request->jenis_hewan,
            'paket' => $request->paket,
            'harga' => $tarif[$request->paket] ?? 0,
            'status' => 'Antre'
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil! Sampai jumpa di Nakula Petshop! 🐾');
    }

    public function batalkan($id) {
        $g = Grooming::where('id', $id)->where('nama_pelanggan', Auth::user()->name)->firstOrFail();
        if($g->status == 'Antre') {
            $g->delete();
            return redirect()->back()->with('success', 'Reservasi telah dibatalkan.');
        }
        return redirect()->back()->with('error', 'Gagal membatalkan.');
    }
    
    // Fungsi untuk halaman Poin Reward yang sempat hilang saya kembalikan 🎁
    public function poin() {
        // ✅ SUDAH DIUBAH MENJADI 'nama_pemilik' SESUAI DATABASE TUAN PUTRI
        $dataMember = \App\Models\Member::where('nama_pemilik', Auth::user()->name)->first();

        // Ambil jumlah poinnya, kalau tidak ketemu kasih angka 0
        $poin = $dataMember ? $dataMember->poin : 0;

        return view('poin', compact('poin'));
    }

    // Fungsi untuk halaman Katalog (Etalase) 🛍️
    public function katalog() {
        $barang = Barang::orderBy('created_at', 'desc')->get();
        return view('katalog', compact('barang'));
    }
}