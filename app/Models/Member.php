<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['nama_pemilik', 'nama_hewan', 'jenis_hewan', 'telepon', 'alamat'];
}