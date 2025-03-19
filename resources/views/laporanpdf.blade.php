<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">PT Zen</h2>
    <p style="text-align: center;">Bantul, Bantul, DIYogyakarta</p>
    <hr>

    <h3 style="text-align: center;">Barang Terjual</h3>
    <p style="text-align: center;">Periode: <strong>{{ date('d F Y', strtotime($tanggalMulai)) }} s.d. {{ date('d F Y', strtotime($tanggalSelesai)) }}</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>No Invoice</th>
                <th>Tgl. Invoice</th>
                <th>Total </th>
                <th>Untung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $index => $penjualan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $penjualan->pelanggan->nama ?? 'Umum' }}</td>
                    <td>{{ $penjualan->id }}</td>
                    <td>{{ date('d-m-Y', strtotime($penjualan->created_at)) }}</td>
                    <td>{{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ number_format($penjualan->total_harga - $penjualan->detailPenjualan->sum(fn($detail) => $detail->produk->harga_beli * $detail->qty), 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4"><strong>TOTAL</strong></td>
                <td><strong>{{ number_format($totalPenjualan, 0, ',', '.') }}</strong></td>
                <td><strong>{{ number_format($totalKeuntungan, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
