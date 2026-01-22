@extends('layouts.app')

@section('title', 'Dashboard Sales')

@section('content')
<div style="padding: 20px; font-family: Arial, sans-serif;">

    <h2 style="color:#333; margin-bottom: 20px;">Dashboard Sales</h2>

    <!-- Ringkasan -->
    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
        <div style="flex:1; background:#f0f8ff; padding:15px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
            <h4>Total Barang</h4>
            <p style="font-size:20px; font-weight:bold; color:#007bff;">{{ $totalBarang }}</p>
        </div>
        <div style="flex:1; background:#f0f8ff; padding:15px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
            <h4>Total Stok</h4>
            <p style="font-size:20px; font-weight:bold; color:#28a745;">{{ $totalStok }}</p>
        </div>
        <div style="flex:1; background:#f0f8ff; padding:15px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
            <h4>Total Supplier</h4>
            <p style="font-size:20px; font-weight:bold; color:#ffc107;">{{ $totalSupplier }}</p>
        </div>
    </div>

    <hr style="margin:30px 0; border:none; border-top:1px solid #ddd;">

    <!-- Daftar Barang -->
    <h3 style="margin-bottom:15px; color:#333;">Daftar Barang</h3>
    <table style="width:100%; border-collapse:collapse; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
        <thead style="background:#007bff; color:#fff;">
            <tr>
                <th style="padding:10px; text-align:left;">Nama Barang</th>
                <th style="padding:10px; text-align:left;">Supplier</th>
                <th style="padding:10px; text-align:right;">Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangList as $b)
            <tr style="background:#fff; border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $b->nama_barang }}</td>
                <td style="padding:10px;">{{ $b->supplier->nama_supplier ?? '-' }}</td>
                <td style="padding:10px; text-align:right;">{{ $b->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr style="margin:30px 0; border:none; border-top:1px solid #ddd;">

    <!-- Daftar Supplier -->
    <h3 style="margin-bottom:15px; color:#333;">Daftar Supplier</h3>
    <table style="width:100%; border-collapse:collapse; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
        <thead style="background:#007bff; color:#fff;">
            <tr>
                <th style="padding:10px; text-align:left;">No</th>
                <th style="padding:10px; text-align:left;">Nama Supplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach($supplierList as $index => $s)
            <tr style="background:#fff; border-bottom:1px solid #ddd;">
                <td style="padding:10px;">{{ $index + 1 }}</td>
                <td style="padding:10px;">{{ $s->nama_supplier }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
