<!DOCTYPE html>
<html>
<head>
    <title>Nota {{ $transaksi->nomor_nota }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: left; }
        .text-right { text-align: right; }
        .header { margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .header p { margin: 2px 0; }
        tfoot th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>CV Montana</h2>
        <p><strong>Nota:</strong> {{ $transaksi->nomor_nota }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->tanggal ? \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y H:i') : $transaksi->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Sales:</strong> {{ $transaksi->user->name ?? '-' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($transaksi->detail as $index => $item)
                @php $total += $item->subtotal; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $item->satuan->nama_satuan ?? '-' }}</td>
                    <td class="text-right">{{ $item->jumlah }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga_satuan,0,',','.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total</th>
                <th class="text-right">Rp {{ number_format($total,0,',','.') }}</th>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top:20px;">Terima kasih atas pembelian Anda!</p>
</body>
</html>
