@extends('layouts.app')

@section('title','Data Transaksi')

@section('content')
<h2>Riwayat Transaksi</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nota</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Sales</th>
        <th>Aksi</th>
    </tr>

    @forelse($transaksi as $t)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $t->nomor_nota }}</td>
        <td>{{ $t->tanggal }}</td>
        <td>Rp {{ number_format($t->total_harga) }}</td>
        <td>{{ $t->user->name ?? '-' }}</td>
        <td>
            <a href="{{ route('transaksi.cetak', $t->id) }}" 
            target="_blank">Cetak Nota</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6">Belum ada transaksi</td>
    </tr>
    @endforelse
</table>
@endsection
