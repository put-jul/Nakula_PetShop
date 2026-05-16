<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Grooming; //
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NakulaController extends Controller
{
    // --- HALAMAN UTAMA (DASHBOARD) ---
    public function index() {
        $products = Product::all();
        
        // Fitur Statistik untuk Admin
        $totalProduk = Product::count();
        $totalTransaksi = Transaction::count();
        $totalPendapatan = Transaction::sum('total_bayar');

        return view('dashboard', compact('products', 'totalProduk', 'totalTransaksi', 'totalPendapatan'));
    }

    // FUNGSI SIMPAN BARANG (VERSI OTOMATIS LINK URL)
    public function simpanBarang(Request $request) {
        // Validasi: 'image' sekarang tidak wajib (nullable) dan berupa teks biasa (URL)
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'image' => 'nullable', // Boleh diisi link internet, boleh kosong
        ]);

        // Langsung simpan data ke database
        Product::create([
            'nama_barang' => $request->nama_barang,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'image'       => $request->image, // Mengambil link URL yang dipaste Tuan Putri
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambah, putri syantik!');
    }

    public function hapusBarang($id) {
        try {
            // Sistem akan mencoba menghapus barang
            Product::destroy($id);
            return redirect()->back()->with('success', 'Barang berhasil dihapus, putri syantik!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika barang terkunci karena sudah masuk riwayat transaksi, tampilkan pesan ini
            return redirect()->back()->with('error', 'Ups! Barang ini tidak bisa dihapus karena sudah tercatat di Laporan Transaksi. Jika stok habis, cukup ubah stoknya menjadi 0 lewat tombol Edit ya, Tuan Putri! 🐾');
        }
    }

    // --- FITUR EDIT BARANG ---
    public function editBarang($id) {
        $barang = Product::findOrFail($id);
        return view('edit_barang', compact('barang'));
    }

    public function updateBarang(Request $request, $id) {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'image' => 'nullable',
        ]);

        $barang = Product::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'image'       => $request->image,
        ]);

        return redirect('/dashboard')->with('success', 'Data barang berhasil diperbarui, putri syantik! ✨');
    }

    // --- HALAMAN TRANSAKSI (KASIR) ---
    public function transaksi() {
        $products = Product::where('stok', '>', 0)->get();
        $cart = session()->get('cart', []);
        $transactions = Transaction::with('details.product')->orderBy('created_at', 'desc')->get();
        return view('transaksi', compact('products', 'cart', 'transactions'));
    }

    public function tambahKeKeranjang(Request $request) {
        $product = Product::findOrFail($request->product_id);
        
        // Cek jika stok cukup sebelum masuk keranjang
        if($product->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['jumlah'] += $request->jumlah;
        } else {
            $cart[$request->product_id] = [
                "nama" => $product->nama_barang,
                "jumlah" => $request->jumlah,
                "harga" => $product->harga,
                "product_id" => $product->id
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Barang masuk keranjang!');
    }

    public function hapusKeranjang() {
        session()->forget('cart');
        return redirect()->back();
    }

    public function simpanTransaksi(Request $request) {
        $cart = session()->get('cart');
        if(!$cart) return redirect()->back()->with('error', 'Keranjang kosong!');

        $total_bayar = 0;
        foreach($cart as $item) { 
            $total_bayar += ($item['harga'] * $item['jumlah']); 
        }

        $transaksi = Transaction::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'total_bayar' => $total_bayar
        ]);

        foreach($cart as $id => $details) {
            TransactionDetail::create([
                'transaction_id' => $transaksi->id,
                'product_id' => $id,
                'jumlah' => $details['jumlah'],
                'subtotal' => $details['harga'] * $details['jumlah']
            ]);
            
            // Kurangi stok barang asli
            $p = Product::find($id);
            $p->stok -= $details['jumlah'];
            $p->save();
        }

        session()->forget('cart');
        return redirect()->back()->with('success', 'Transaksi Berhasil!');
    }

    // --- CETAK PDF & EXCEL ---
    public function cetakStruk($id) {
        $transaksi = Transaction::with('details.product')->findOrFail($id);
        $pdf = Pdf::loadView('struk_transaksi', compact('transaksi'));
        return $pdf->stream('struk-'.$transaksi->nama_pelanggan.'.pdf');
    }

    public function exportExcel() {
        // 1. Ambil Data Kasir
        $transactions = Transaction::with('details.product')->get();
        // 2. Ambil Data Grooming
        $groomings = Grooming::orderBy('created_at', 'desc')->get();

        $fileName = 'Laporan_Lengkap_Nakula_Petshop_' . date('d-m-Y') . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Pragma: no-cache");
        header("Expires: 0");

    
        echo '
        <html xmlns:o="urn:schemas-microsoft-com:office:office"
              xmlns:x="urn:schemas-microsoft-com:office:excel"
              xmlns="http://www.w3.org/TR/REC-html40">
        <head>
        <!--[if gte mso 9]>
        <xml>
          <x:ExcelWorkbook>
            <x:ExcelWorksheets>
              <x:ExcelWorksheet>
                <x:Name>Laporan Nakula Petshop</x:Name>
                <x:WorksheetOptions>
                  <x:ProtectContents>True</x:ProtectContents>
                </x:WorksheetOptions>
              </x:ExcelWorksheet>
            </x:ExcelWorksheets>
          </x:ExcelWorkbook>
        </xml>
        <![endif]-->
        <style>
            table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
            th, td { border: 1px solid #000; padding: 8px; }
            .locked { mso-protection:locked visible; }
        </style>
        </head>
        <body class="locked">
        ';

        echo '
        <table>
            <thead>
                <tr>
                    <th colspan="5" style="background-color: #2d3436; color: white; font-size: 16px;">LAPORAN PENJUALAN BARANG KASIR</th>
                </tr>
                <tr style="background-color: #ff9f43; color: white; font-weight: bold;">
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Daftar Barang (Qty)</th>
                    <th>Total Bayar (Rp)</th>
                    <th>Tanggal & Waktu</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($transactions as $t) {
            $itemDetails = [];
            foreach($t->details as $d) {
                $itemDetails[] = ($d->product->nama_barang ?? 'Barang') . " (x" . $d->jumlah . ")";
            }
            $daftarBarang = implode(", ", $itemDetails);

            echo '
                <tr>
                    <td align="center">' . $t->id . '</td>
                    <td>' . $t->nama_pelanggan . '</td>
                    <td>' . $daftarBarang . '</td>
                    <td align="right" style="font-weight: bold;">' . number_format($t->total_bayar) . '</td>
                    <td>' . $t->created_at->format('d/m/Y H:i') . '</td>
                </tr>';
        }

        echo '
            </tbody>
            <tfoot>
                <tr style="background-color: #fff3e0; font-weight: bold;">
                    <td colspan="3" align="right">SUBTOTAL PENDAPATAN KASIR:</td>
                    <td align="right" style="color: #d35400;">Rp ' . number_format($transactions->sum('total_bayar')) . '</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>';

      
        echo '
        <table>
            <thead>
                <tr>
                    <th colspan="6" style="background-color: #0984e3; color: white; font-size: 16px;">🛁 LAPORAN RESERVASI GROOMING</th>
                </tr>
                <tr style="background-color: #74b9ff; color: white; font-weight: bold;">
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Hewan (Jenis)</th>
                    <th>Paket Grooming</th>
                    <th>Harga (Rp)</th>
                    <th>Tanggal Reservasi</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($groomings as $g) {
            echo '
                <tr>
                    <td align="center">' . $g->id . '</td>
                    <td>' . $g->nama_pelanggan . '</td>
                    <td>' . $g->nama_hewan . ' (' . $g->jenis_hewan . ')</td>
                    <td>' . $g->paket . '</td>
                    <td align="right" style="font-weight: bold;">' . number_format($g->harga) . '</td>
                    <td>' . $g->created_at->format('d/m/Y H:i') . '</td>
                </tr>';
        }

        echo '
            </tbody>
            <tfoot>
                <tr style="background-color: #e3f2fd; font-weight: bold;">
                    <td colspan="4" align="right">SUBTOTAL PENDAPATAN GROOMING:</td>
                    <td align="right" style="color: #0984e3;">Rp ' . number_format($groomings->sum('harga')) . '</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>';
        
        $grandTotal = $transactions->sum('total_bayar') + $groomings->sum('harga');
        echo '
        <table>
            <tr>
                <td colspan="4" align="right" style="font-size: 18px; font-weight: bold; background-color: #2d3436; color: white; padding: 15px;">GRAND TOTAL PENDAPATAN (KASIR + GROOMING):</td>
                <td colspan="2" align="right" style="font-size: 18px; font-weight: bold; background-color: #2ecc71; color: white; padding: 15px;">Rp ' . number_format($grandTotal) . '</td>
            </tr>
        </table>';

        echo '
        </body>
        </html>';
    }
}