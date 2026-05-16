<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grooming extends Model
{
    protected $fillable = ['nama_pelanggan', 'nama_hewan', 'jenis_hewan', 'paket', 'harga', 'status'];
}