<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'barang_id',
        'tipe_aktivitas',
        'jumlah',
        'keterangan',
        'tanggal',
        'waktu'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // Relasi ke Barang (nullable)
    public function barang()
    {
        return $this->belongsTo(\App\Models\Barang::class, 'barang_id');
    }
}
