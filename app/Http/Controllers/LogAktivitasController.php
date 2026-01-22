<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;

class LogAktivitasController extends Controller
{
    public function index()
    {
        // Ambil semua log aktivitas dengan relasi user & barang
        $logs = LogAktivitas::with(['user', 'barang'])->latest()->get();

        // Kirim ke view
        return view('gudang.log_aktivitas', compact('logs'));
    }
}
