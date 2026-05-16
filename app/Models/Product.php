<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nama_barang', 'stok', 'harga', 'kategori'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}