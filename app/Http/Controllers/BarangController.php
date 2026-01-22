<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangSatuan;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori','supplier')->get();
        return view('gudang.barang', compact('barang'));
    }
    public function indexSales()
    {
        $barang = Barang::with('supplier')->get();
        return view('sales.produk', compact('barang'));
    }



    public function create()
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        $satuan   = BarangSatuan::select('nama_satuan')->distinct()->get();
        return view('gudang.barang_tambah', compact('kategori','supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'supplier_id' => 'required',
            'barang_satuan_id'  => 'required|exists:barang_satuan,id',
            'jumlah'            => 'required|integer|min:1',
            'harga_awal' => 'required|numeric'
        ]);

        $satuan = BarangSatuan::findOrFail($request->barang_satuan_id);
        $stok_masuk = $request->jumlah * $satuan->konversi;
        // Cari barang yang benar-benar sama
        $barang = Barang::where('nama_barang', $request->nama_barang)
                        ->where('kategori_id', $request->kategori_id)
                        ->where('supplier_id', $request->supplier_id)
                        ->where('harga_awal', $request->harga_awal)
                        ->first();

        if ($barang) {
            // Barang sama → tambahkan stok
            $barang->increment('stok', $request->stok);

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'barang_id' => $barang->id,
                'tipe_aktivitas' => 'barang_masuk',
                'jumlah' => $request->stok,
                'keterangan' => 'Menambah stok barang yang sudah ada',
                'tanggal' => now()->toDateString(),
                'waktu' => now()->toTimeString()
            ]);
        } else {
            // Barang baru → buat ro                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        w baru
            $barang = Barang::create([
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori_id,
                'supplier_id' => $request->supplier_id,
                'stok' => $request->stok,
                'harga_awal' => $request->harga_awal
            ]);

            LogAktivitas::create([
                'user_id' => Auth::id(),
                'barang_id' => $barang->id,
                'tipe_aktivitas' => 'barang_masuk',
                'jumlah' => $request->stok,
                'keterangan' => 'Stok awal barang',
                'tanggal' => now()->toDateString(),
                'waktu' => now()->toTimeString()
            ]);
        }

        return redirect('/barang')->with('success','Barang berhasil ditambahkan');
    }



    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        $supplier = Supplier::all();

        return view('gudang.barang_edit', compact('barang','kategori','supplier'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $stok_lama = $barang->stok;

        $barang->update($request->all());

        if ($request->stok != $stok_lama) {
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'barang_id' => $barang->id,
                'tipe_aktivitas' => 'penyesuaian',
                'jumlah' => abs($request->stok - $stok_lama),
                'keterangan' => 'Perubahan stok',
                'tanggal' => now()->toDateString(),
                'waktu' => now()->toTimeString()
            ]);
        }

        return redirect('/barang')->with('success','Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Putuskan semua relasi Laravel (log aktivitas / transaksi detail)
        $barang->logAktivitas()->update(['barang_id' => null]);
        $barang->detailTransaksi()->delete();

        // Baru hapus barang
        $barang->delete();

        return redirect('/barang')->with('success','Barang berhasil dihapus.');
    }




    public function getSatuan($id)
    {
        $satuan = BarangSatuan::where('barang_id', $id)->get();
        return response()->json($satuan);
    }


    public function dashboardSales()
    {
        $barang = Barang::with('supplier')->get();

        return view('sales.dashboard', [
            'totalBarang' => $barang->count(),
            'totalStok' => $barang->sum('stok'),
            'barangList' => $barang,
            'totalSupplier' => Supplier::count(),
            'supplierList' => Supplier::all(),
        ]);
    }

}
