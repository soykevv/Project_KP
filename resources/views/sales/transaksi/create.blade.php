@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
<h2>Transaksi Penjualan</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form action="/transaksi" method="POST">
    @csrf

    <div>
        <label>Barang</label><br>
        <select name="barang_id" id="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barang as $b)
                <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Satuan</label><br>
        <select name="barang_satuan_id" id="barang_satuan_id" >
            <option value="">-- Pilih Satuan --</option>
        </select>
    </div>

    <br>

    <div>
        <label>Jumlah</label><br>
        <input type="number" name="jumlah" min="1" required>
    </div>

    <br>

    <button type="submit">Simpan Transaksi</button>
</form>


<script>
document.getElementById('barang_id').addEventListener('change', function () {
    let barangId = this.value;

    fetch(`/barang/${barangId}/satuan`)
        .then(res => res.json())
        .then(data => {
            let satuanSelect = document.getElementById('barang_satuan_id');
            satuanSelect.innerHTML = '<option value="">-- Pilih Satuan --</option>';

            data.forEach(s => {
                satuanSelect.innerHTML +=
                    `<option value="${s.id}">${s.nama_satuan} - Rp ${s.harga_jual}</option>`;
            });
        });
});


</script>


@endsection
