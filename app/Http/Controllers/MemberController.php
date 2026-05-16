<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index() {
        // Otomatis mengambil semua akun yang mendaftar sebagai customer
        $members = User::where('role', 'customer')->orderBy('created_at', 'desc')->get();
        return view('member', compact('members'));
    }

    // Fitur sakti Admin untuk menambah poin pelanggan
    public function tambahPoin(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->points += $request->poin;
        $user->save();
        return redirect()->back()->with('success', 'Yeay! Poin berhasil ditambahkan ke ' . $user->name);
    }

    public function hapus($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Akun pelanggan berhasil dihapus.');
    }
}