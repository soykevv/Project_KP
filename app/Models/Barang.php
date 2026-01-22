<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'kategori_id',
        'supplier_id',
        'nama_barang',
        'stok',
        'harga_awal',
        'satuan_dasar'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function satuan()
    {
        return $this->hasMany(BarangSatuan::class);
    }
    public function satuanDasar()
    {
        return $this->hasOne(BarangSatuan::class)
                    ->where('konversi', 1);
    }
    public function logAktivitas()
    {
        return $this->hasMany(\App\Models\LogAktivitas::class, 'barang_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(\App\Models\TransaksiDetail::class, 'barang_id');
    }


}
