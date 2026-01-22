@extends('layouts.app')

@section('title','Tambah Supplier')

@section('content')
<h2>Tambah Supplier</h2>

<form action="/supplier" method="POST">
    @csrf

    <p>Nama Supplier</p>
    <input type="text" name="nama_supplier" required>

    <p>Alamat</p>
    <input type="text" name="alamat" required>

    <p>No Telp</p>
    <input type="text" name="no_telp" required>

    <br><br>
    <button type="submit">Simpan</button>
</form>
@endsection
