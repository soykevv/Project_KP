@extends('layouts.app')

@section('title', 'Tambah Satuan Barang')

@section('content')
<div class="container">
    <h2>Tambah Satuan untuk Barang</h2>

    <div style="margin-bottom:15px;">
        <strong>Nama Barang:</strong> {{ $barang->nama_barang }} <br>
        <strong>Stok Saat Ini:</strong> {{ $barang->stok }}
    </div>

    <form action="{{ route('barang-satuan.store') }}" method="POST">
        @csrf

        {{-- barang_id (hidden) --}}
        <input type="hidden" name="barang_id" value="{{ $barang->id }}">

        <div class="form-group">
            <label>Nama Satuan</label>
            <input 
                type="text" 
                name="nama_satuan" 
                class="form-control" 
                placeholder="Contoh: Roll / Meter / Cm"
                required
            >
        </div>

        <div class="form-group">
            <label>Konversi ke Stok Utama</label>
            <input 
                type="number" 
                name="konversi" 
                class="form-control" 
                placeholder="Contoh: 1 roll = 100 cm → isi 100"
                min="1"
                required
            >
            <small class="text-muted">
                Artinya 1 satuan ini setara dengan berapa stok utama
            </small>
        </div>

        <div class="form-group">
            <label>Harga Jual</label>
            <input 
                type="number" 
                name="harga_jual" 
                class="form-control" 
                min="0"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Satuan
        </button>

        <a href="{{ url('/barang') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
