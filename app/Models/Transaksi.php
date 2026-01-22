<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    // use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'nomor_nota',
        'jenis_transaksi',
        'status_pembayaran',
        'total_harga',
        'bukti_pembayaran',
        'tanggal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
