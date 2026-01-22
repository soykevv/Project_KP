@extends('layouts.app')

@section('title','Data Supplier')

@section('content')
<h2>Data Supplier</h2>

<a href="/supplier/tambah">+ Tambah Supplier</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No Telp</th>
        <th>Aksi</th>
    </tr>

    @foreach($supplier as $s)
    <tr>
        <td>{{ $s->nama_supplier }}</td>
        <td>{{ $s->alamat }}</td>
        <td>{{ $s->no_telp }}</td>
        <td>
            <a href="/supplier/{{ $s->id }}/edit">Edit</a>
            <form action="/supplier/{{ $s->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus supplier?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
