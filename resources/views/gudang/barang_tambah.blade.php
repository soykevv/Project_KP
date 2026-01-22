@extends('layouts.app')

@section('title','Tambah Barang')

@section('content')
<h2>Tambah Barang</h2>

<form action="/barang" method="POST">
    @csrf

    <p>Nama Barang</p>
    <input type="text" name="nama_barang">

    <p>Kategori</p>
    <select name="kategori_id">
        @foreach($kategori as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
        @endforeach
    </select>

    <p>Supplier</p>
    <select name="supplier_id">
        @foreach($supplier as $s)
            <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
        @endforeach
    </select>

    <p>Satuan</p>
    <select name="barang_satuan_id" required>
        <option value="">-- Pilih Satuan --</option>
        @foreach($satuan as $s)
            <option value="{{ $s->id }}">
                {{ $s->nama_satuan }}
            </option>
        @endforeach
    </select>


    <p>Jumlah Barang</p>
    <input type="number" name="stok">

    <p>Harga Awal</p>
    <input type="number" name="harga_awal">

    <br><br>
    <button type="submit">Simpan</button>
</form>
@endsection
