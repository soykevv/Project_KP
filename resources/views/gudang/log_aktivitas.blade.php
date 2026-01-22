@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
<h2>Log Aktivitas</h2>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        border: 1px solid #ccc;
        text-align: left;
    }
    thead {
        background: #007bff;
        color: #fff;
    }
    .bg-masuk { background: #d4edda; }        /* hijau muda */
    .bg-keluar { background: #f8d7da; }      /* merah muda */
    .bg-penyesuaian { background: #fff3cd; } /* kuning muda */
    .bg-lain { background: #e2e3e5; }        /* abu muda */
</style>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Barang / Supplier</th>
            <th>Tipe Aktivitas</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($logs as $index => $log)
        @php
            // Tentukan warna baris berdasarkan tipe aktivitas
            switch($log->tipe_aktivitas) {
                case 'barang_masuk': $class = 'bg-masuk'; break;
                case 'barang_keluar': $class = 'bg-keluar'; break;
                case 'penyesuaian': $class = 'bg-penyesuaian'; break;
                default: $class = 'bg-lain'; break;
            }

            // Tampilkan nama barang atau supplier
            if($log->barang) {
                $namaObjek = $log->barang->nama_barang;
            } elseif(str_contains($log->tipe_aktivitas, 'supplier')) {
                // Ambil nama supplier dari keterangan
                $namaObjek = preg_replace('/Menambahkan|Mengubah|Menghapus supplier: /', '', $log->keterangan);
            } else {
                $namaObjek = '-';
            }
        @endphp
        <tr class="{{ $class }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $log->user->name ?? '-' }}</td>
            <td>{{ $namaObjek ?? '-' }}</td>
            <td>{{ ucfirst(str_replace('_',' ', $log->tipe_aktivitas)) }}</td>
            <td>{{ $log->jumlah }}</td>
            <td>{{ $log->keterangan ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d-m-Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align:center;">Belum ada log aktivitas</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
