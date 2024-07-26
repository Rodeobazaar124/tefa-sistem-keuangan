<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;
    protected $table =  'asset';
    protected $fillable = [
        'nama',
        'kategori',
        'tanggal_pembelian',
        'harga',
        'keterangan',
        'jumlah',
        'kondisi_baik',
        'kondisi_kurang_baik',
        'kondisi_buruk',
        'penggunaan',

    ];

}
