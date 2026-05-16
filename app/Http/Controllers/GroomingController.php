<?php

namespace App\Http\Controllers;

use App\Models\Grooming;
use Illuminate\Http\Request;

class GroomingController extends Controller
{
    public function index() {
        $groomings = Grooming::orderBy('created_at', 'desc')->get();
        return view('grooming', compact('groomings'));
    }

    public function simpan(Request $request) {
        Grooming::create($request->all());
        return redirect()->back()->with('success', 'Anabul berhasil masuk antrean Grooming!');
    }

    public function selesai($id) {
        $grooming = Grooming::findOrFail($id);
        $grooming->status = 'Selesai';
        $grooming->save();
        return redirect()->back()->with('success', 'Grooming selesai! Anabul sudah wangi.');
    }

    public function hapus($id) {
        Grooming::destroy($id);
        return redirect()->back()->with('success', 'Data grooming dibatalkan/dihapus.');
    }
}