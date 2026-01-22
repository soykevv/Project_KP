@extends('layouts.app')

@section('title', 'Dashboard Gudang')

@section('content')
<h1>Dashboard Gudang</h1>
<p>Halo {{ auth()->user()->nama }}</p>

<hr>

<div style="display:flex; gap:20px; margin-bottom:30px">

    <div style="border:1px solid #ccc; padding:15px; width:200px">
        <h3>Total Barang</h3>
        <p>{{ $totalBarang }}</p>
    </div>

    <div style="border:1px solid #ccc; padding:15px; width:200px">
        <h3>Total Supplier</h3>
        <p>{{ $totalSupplier }}</p>
    </div>

    <div style="border:1px solid #ccc; padding:15px; width:200px">
        <h3>Total Stok</h3>
        <p>{{ $totalStok }}</p>
    </div>

</div>

<h3>Aktivitas Terakhir</h3>

<table border="1" cellpadding="8" width="100%">
    <tr>
        <th>Tanggal</th>
        <th>User</th>
        <th>Aktivitas</th>
        <th>Barang</th>
        <th>Keterangan</th>
    </tr>

    @foreach($logTerakhir as $log)
    <tr>
        <td>{{ $log->tanggal }} {{ $log->waktu }}</td>
        <td>{{ $log->user->nama }}</td>
        <td>{{ $log->tipe_aktivitas }}</td>
        <td>{{ $log->barang->nama_barang ?? '-' }}</td>
        <td>{{ $log->keterangan }}</td>
    </tr>
    @endforeach
</table>
@endsection
