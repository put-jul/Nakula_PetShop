<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // KITA ARAHKAN LANGSUNG KE TABEL 'products' 👇
    protected $table = 'products'; 

    // Bebaskan semua kolom agar bisa dibaca
    protected $guarded = []; 
}