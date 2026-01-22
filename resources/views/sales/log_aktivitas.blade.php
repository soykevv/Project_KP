@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
<h2>Log Aktivitas</h2>

<table style="width:100%; border-collapse:collapse;" border="1" cellpadding="8">
    <thead style="background:#007bff; color:#fff;">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Barang</th>
            <th>Tipe Aktivitas</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @forelse($logs as $index => $log)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $log->user->name ?? '-' }}</td>

            <!-- Barang bisa null -->
            <td>{{ $log->barang->nama_barang ?? '-' }}</td>

            <td>{{ $log->tipe_aktivitas }}</td>
            <td>{{ $log->jumlah }}</td>
            
            <!-- Keterangan tampil jika ada -->
            <td>{{ $log->keterangan ?? '-' }}</td>
            <td>{{ $log->tanggal }}</td>
            <td>{{ $log->waktu }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">Belum ada log aktivitas</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
