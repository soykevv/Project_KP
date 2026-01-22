@extends('layouts.app')

@section('title','Edit Supplier')

@section('content')
<h2>Edit Supplier</h2>

<form action="/supplier/{{ $supplier->id }}" method="POST">
    @csrf
    @method('PUT')

    <p>Nama Supplier</p>
    <input type="text" name="nama_supplier" value="{{ $supplier->nama_supplier }}" required>

    <p>Alamat</p>
    <textarea name="alamat" rows="3">{{ $supplier->alamat }}</textarea>

    <p>No. Telepon</p>
    <input type="text" name="telepon" value="{{ $supplier->telepon }}">

    <br><br>
    <button type="submit">Update</button>
    <a href="/supplier">Batal</a>
</form>
@endsection
