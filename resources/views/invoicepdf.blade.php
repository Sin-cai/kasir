<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img, .footer img {
            height: 50px;
        }
        .header div, .footer div {
            text-align: right;
        }
        .header div p, .footer div p {
            margin: 0;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .section p {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .font-bold {
            font-weight: bold;
        }
        .bg-green {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                
                <h2>PT Zen</h2>
                <p><br>Bantul, Bantul<br>DIYogyakarta</p>
            </div>
            <div>
        
              

            </div>
        </div>
        <div class="title">INVOICE</div>
        <div class="section">
            <h2>Pembeli</h2>
            <p>Nama: {{ $penjualan->pelanggan->nama ?? 'Umum' }}
        </div>
        <div class="section">
            <h2>Transaksi</h2>
            <table>
                <thead>
                    <tr>
                        <th class="border border-gray-400 p-2">No</th>
                    <th class="border border-gray-400 p-2">Deskripsi</th>
                    <th class="border border-gray-400 p-2">Harga Satuan</th>
                    <th class="border border-gray-400 p-2">Kuantitas</th>
                    <th class="border border-gray-400 p-2">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->detailPenjualan as $index => $detail)
                        <tr>
                            <td class="border border-gray-400 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-400 p-2">{{ $detail->produk->nama_produk ?? '-' }}</td>
                            <td class="border border-gray-400 p-2 text-center">{{ number_format($detail->harga_jual ?? 0, 0, ',', '.') }}</td>
                            <td class="border border-gray-400 p-2 text-right">{{ $detail->qty ?? 0 }}</td>
                            <td class="border border-gray-400 p-2 text-right">{{ number_format($detail->sub_total ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="border border-gray-400 p-2 text-right font-bold" colspan="4">Diskon</td>
                        <td class="border border-gray-400 p-2 text-right">{{ $penjualan->diskon ?? 0 }}% </td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-right font-bold" colspan="4">Total</td>
                        <td class="border border-gray-400 p-2 text-right">{{ number_format($penjualan->total_harga ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-right font-bold" colspan="4">Total Bayar</td>
                        <td class="border border-gray-400 p-2 text-right">{{ number_format($penjualan->bayar ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-right font-bold" colspan="4">Kembali</td>
                        <td class="border border-gray-400 p-2 text-right">{{ number_format($penjualan->kembali ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      
    </div>
</body>
</html>