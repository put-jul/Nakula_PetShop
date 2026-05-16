<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Ini adalah 'izin' agar kolom-kolom ini bisa diisi
    protected $fillable = ['nama_pelanggan', 'total_bayar'];

    // Relasi ke detail transaksi (satu transaksi punya banyak barang)
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}