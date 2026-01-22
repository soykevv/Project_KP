<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangSatuan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangSatuanController extends Controller
{
    public function create($barang_id)
    {
        $barang = Barang::findOrFail($barang_id);
        return view('gudang.barang_satuan_tambah', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'   => 'required|exists:barang,id',
            'nama_satuan' => 'required|string',
            'konversi'    => 'required|integer|min:1',
            'stok'        => 'required|integer|min:1',
            'harga_jual'  => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {

            // 1️⃣ Simpan satuan
            $satuan = BarangSatuan::create([
                'barang_id'   => $request->barang_id,
                'nama_satuan' => $request->nama_satuan,
                'konversi'    => $request->konversi,
                'harga_jual'  => $request->harga_jual,
            ]);

            // 2️⃣ Ambil barang
            $barang = Barang::findOrFail($request->barang_id);

            // 3️⃣ HITUNG stok masuk (KONVERSI KE SATUAN DASAR)
            // contoh:
            // 5 meter × 100 cm = 500 cm
            $stok_masuk = $request->stok * $request->konversi;

            // 4️⃣ Tambah stok barang
            $barang->increment('stok', $stok_masuk);

            // 5️⃣ Catat log aktivitas
            LogAktivitas::create([
                'user_id'       => Auth::id(),
                'barang_id'     => $barang->id,
                'tipe_aktivitas'=> 'barang_masuk',
                'jumlah'        => $stok_masuk,
                'keterangan'    => 'Stok masuk melalui satuan ' . $request->nama_satuan,
                'tanggal'       => now()->toDateString(),
                'waktu'         => now()->toTimeString(),
            ]);
        });

        return redirect('/barang')->with('success', 'Satuan dan stok berhasil ditambahkan');
    }
}
