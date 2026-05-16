<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran Nakula Petshop</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; font-size: 14px; color: #333; }
        .struk-container { width: 100%; max-width: 400px; margin: 0 auto; border: 1px dashed #ccc; padding: 20px; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        td { padding: 5px 0; }
        .garis { border-bottom: 1px dashed #333; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="struk-container">
        <h2 class="text-center bold" style="margin-bottom: 0;">NAKULA PETSHOP</h2>
        <p class="text-center" style="margin-top: 5px; font-size: 12px;">Jl. Palembang - Prabumulih<br>Telp: 0812-3456-7890</p>
        
        <div class="garis"></div>
        
        <table>
            <tr>
                <td>No. Transaksi</td>
                <td style="text-align: right;">#TRX-{{ sprintf("%04d", $transaksi->id) }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td style="text-align: right;">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td style="text-align: right;">{{ $transaksi->nama_pelanggan }}</td>
            </tr>
        </table>

        <div class="garis"></div>

        <p class="bold" style="margin-bottom: 5px;">Daftar Barang:</p>
        <table>
            {{-- LOOPING UNTUK MENAMPILKAN BANYAK BARANG --}}
            @foreach($transaksi->details as $item)
            <tr>
                <td colspan="2" class="bold">{{ $item->product->nama_barang ?? 'Barang' }}</td>
            </tr>
            <tr>
                <td style="font-size: 12px;">{{ $item->jumlah }} x Rp {{ number_format($item->product->harga ?? 0) }}</td>
                <td style="text-align: right;" class="bold">Rp {{ number_format($item->subtotal) }}</td>
            </tr>
            @endforeach
        </table>

        <div class="garis"></div>

        <table>
            <tr>
                <td class="bold" style="font-size: 16px;">TOTAL BAYAR</td>
                <td style="text-align: right; font-size: 16px;" class="bold">Rp {{ number_format($transaksi->total_bayar) }}</td>
            </tr>
        </table>

        <div class="garis"></div>
        <p class="text-center" style="font-size: 12px; margin-top: 15px;">
            Terima kasih telah berbelanja!<br>
            Hewan peliharaan sehat, majikan bahagia. 
        </p>
    </div>
</body>
</html>