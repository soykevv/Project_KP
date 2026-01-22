<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangSatuan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function cetak($id)
    {
       $transaksi = Transaksi::with(['user','detail.barang','detail.satuan'])->findOrFail($id);

        $pdf = Pdf::loadView('sales.transaksi.nota', compact('transaksi'));
        return $pdf->stream('nota-'.$transaksi->nomor_nota.'.pdf');
    }
    public function index()
    {
        $transaksi = Transaksi::with(['user','detail.barang'])
            ->latest()
            ->get();

        return view('sales.transaksi.index', compact('transaksi'));
    }


    public function create()
    {
        $barang = Barang::with('satuan')->get();
        return view('sales.transaksi.create', compact('barang'));
    }

    public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required',
        'barang_satuan_id' => 'required',
        'jumlah' => 'required|numeric|min:1'
    ]);

    DB::beginTransaction();

    try {
        $barang = Barang::findOrFail($request->barang_id);
        $satuan = BarangSatuan::where('id', $request->barang_satuan_id)
            ->where('barang_id', $request->barang_id)
            ->firstOrFail();

        $stokKeluar = $request->jumlah * $satuan->konversi;
        $subtotal = $request->jumlah * $satuan->harga_jual;

        if ($barang->stok < $stokKeluar) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        // 1️⃣ Transaksi
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(),
            'nomor_nota' => 'TRX-' . date('YmdHis') . rand(10,99),
            'tanggal' => now(),
            'status_pembayaran' => 'lunas',
            'total_harga' => $subtotal
        ]);

        // 2️⃣ Detail
        TransaksiDetail::create([
            'transaksi_id' => $transaksi->id,
            'barang_id' => $barang->id,
            'barang_satuan_id' => $satuan->id,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $satuan->harga_jual,
            'subtotal' => $subtotal
        ]);

        // 3️⃣ Update stok
        $barang->decrement('stok', $stokKeluar);

        // 4️⃣ Log aktivitas
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'tipe_aktivitas' => 'barang_keluar',
            'jumlah' => $stokKeluar,
            'keterangan' => 'Penjualan - ' . $transaksi->nomor_nota,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->toTimeString()
        ]);

        DB::commit();
        return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', $e->getMessage());
    }
}


    public function dashboard()
    {
        $totalTransaksi = Transaksi::count();
        $totalOmzet = Transaksi::sum('total_harga');

        $transaksiHariIni = Transaksi::whereDate('created_at', today())->count();
        $omzetHariIni = Transaksi::whereDate('created_at', today())->sum('total_harga');

        $transaksiTerbaru = Transaksi::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('sales.dashboard', compact(
            'totalTransaksi',
            'totalOmzet',
            'transaksiHariIni',
            'omzetHariIni',
            'transaksiTerbaru'
        ));
    }

}
