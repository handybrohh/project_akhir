<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'kode_transaksi',
        'tanggal_penjualan',
        'harga_per_barang',
        'jumlah_barang',
        'total_harga'
    ];
}
