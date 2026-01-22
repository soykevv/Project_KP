@extends('layouts.app')

@section('title','Data Barang')

@section('content')
<h2>Data Barang</h2>

<a href="/barang/tambah">+ Tambah Barang</a>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Supplier</th>
        <th>Stok</th>
        <th>Harga Awal</th>
        <th>Aksi</th>
    </tr>

    @foreach($barang as $b)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $b->nama_barang }}</td>
        <td>{{ $b->kategori->nama_kategori ?? '-' }}</td>
        <td>{{ $b->supplier->nama_supplier ?? '-' }}</td>
        <td>{{ $b->stok }}{{ $b->satuanDasar->nama_satuan ?? '' }}</td>
        <td>Rp {{ number_format($b->harga_awal) }}</td>
        <td>
            <a href="/barang/{{ $b->id }}/edit">Edit</a>
            <form action="/barang/{{ $b->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
