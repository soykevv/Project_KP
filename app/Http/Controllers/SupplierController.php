<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        return view('gudang.supplier', compact('supplier'));
    }

    public function create()
    {
        return view('gudang.supplier_tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required'
        ]);

        $supplier = Supplier::create($request->all());

        // Catat log aktivitas
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'barang_id' => null, // karena ini supplier
            'tipe_aktivitas' => 'penyesuaian', // pakai enum yang ada
            'jumlah' => 0,
            'keterangan' => 'Menambahkan supplier: ' . $supplier->nama_supplier,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->format('H:i:s')
        ]);

        return redirect('/supplier')->with('success','Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('gudang.supplier_edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        // Catat log aktivitas
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'barang_id' => null,
            'tipe_aktivitas' => 'penyesuaian',
            'jumlah' => 0,
            'keterangan' => 'Mengubah supplier: ' . $supplier->nama_supplier,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->format('H:i:s')
        ]);

        return redirect('/supplier')->with('success','Supplier berhasil diperbarui');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Cek apakah masih ada barang terkait
        $barangTerkait = $supplier->barang()->count();
        if ($barangTerkait > 0) {
            return redirect()->back()->with('error', 'Supplier masih punya barang. Hapus atau ganti supplier barang dulu.');
        }

        $supplier->delete();

        // Catat log aktivitas
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'barang_id' => null,
            'tipe_aktivitas' => 'penyesuaian',
            'jumlah' => 0,
            'keterangan' => 'Menghapus supplier: ' . $supplier->nama_supplier,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->format('H:i:s')
        ]);

        return redirect()->back()->with('success', 'Supplier berhasil dihapus.');
    }
}
