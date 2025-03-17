<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <img src="{{ asset('img/zen.png') }}" alt="logo" class="h-16 mb-2">
                <h2 class="text-xl font-bold">PT Zen</h2>
                <p>
                    PT Zen<br/>
                   
                    Bantul, Bantul<br/> DIYogyakarta
                </p>
            </div>
            <div class="text-right">
                <div class="bg-green-300 text-green-800 px-4 py-2 rounded">LUNAS</div>
                <img src="https://storage.googleapis.com/a1aa/image/xods7SN4ApZHBDrKtuP6qFw6R81ZLEeSxf1MOEBf8iM.jpg" alt="Barcode" class="mt-2" width="150" height="50">
                <p>0004/INV/IK/2024</p>
            </div>
        </div>
        
        <h1 class="text-2xl font-bold text-center mb-4">INVOICE</h1>
        
        <div class="mb-4">
            <h2 class="text-lg font-bold">Pembeli</h2>
            <p>Nama: {{ $penjualan->pelanggan->nama ?? 'Umum' }}
        </div>
        
        <div class="mb-4">
            <h2 class="text-lg font-bold">Transaksi</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">Harga Satuan</th>
                        <th class="border border-gray-300 px-4 py-2">Kuantitas</th>
                        <th class="border border-gray-300 px-4 py-2">Sub Total</th>
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
        
        <div class="mt-4">
            <h2 class="text-lg font-bold">Pembayaran</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Tanggal Pembayaran</th>
                        <th class="border border-gray-300 px-4 py-2">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">30 Oktober 2024</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">100.000</td>
                    </tr>
                    <tr class="font-bold">
                        <td class="border border-gray-300 px-4 py-2">TOTAL</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">100.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
