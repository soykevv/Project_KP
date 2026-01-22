<h1>Data Barang</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Supplier</th>
        <th>Stok</th>
        <th>Harga</th>
    </tr>

    @foreach($barang as $b)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $b->nama_barang }}</td>
        <td>{{ $b->nama_kategori }}</td>
        <td>{{ $b->nama_supplier }}</td>
        <td>{{ $b->stok }}</td>
        <td>{{ $b->harga_awal }}</td>
    </tr>
    @endforeach
</table>
