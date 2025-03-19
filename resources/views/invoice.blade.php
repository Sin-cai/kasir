<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script>
        window.onload = function () {
            window.print(); // Otomatis membuka pop-up print
            setTimeout(() => { window.close(); }, 1000); // Menutup tab setelah print
        };
    </script>

</head>
<body class="bg-white text-black font-sans">
    <div class="max-w-4xl mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <img src="{{ asset('img/zen.png') }}" 
                     alt="logo" class="h-16 w-16"/>
                <p class="text-sm">
                    PT Zen<br/>
                   
                   Bantul, Bantul<br/> DIYogyakarta
                </p>
            </div>
            <div class="text-right">
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-center text-2xl font-bold mb-4">INVOICE</h1>

        <!-- Buyer Info -->
        <div class="mb-4">
            <p class="font-bold">Pembeli</p>
            <p>Nama: {{ $penjualan->pelanggan->nama ?? 'Umum' }}
        </div>
        
        <!-- Invoice Date -->
        <div class="mb-4 text-right">
            <p>{{ $penjualan->created_at->format('d M Y H:i:s') }}</p>
        </div>

        <!-- Items Table -->
        <table class="w-full border-collapse border border-gray-400 mb-4">
            <thead>
                <tr>
                    <th class="border border-gray-400 p-2">No</th>
                    <th class="border border-gray-400 p-2">Deskripsi</th>
                    <th class="border border-gray-400 p-2">Harga Satuan</th>
                    <th class="border border-gray-400 p-2">Kuantitas</th>
                    <th class="border border-gray-400 p-2">Diskon Produk</th>
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
                        <td class="border border-gray-400 p-2 text-right">{{ $detail->diskon_produk ?? 0 }}% </td>
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

        <!-- Footer -->
        <p class="text-center text-sm mt-4">
            Terima kasih telah berbelanja di tempat kami. Kepuasan Anda adalah tujuan kami.
        </p>
    </div>
</body>
</html>
