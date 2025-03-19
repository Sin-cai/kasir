<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script>
        window.onload = function () {
            window.print(); // Otomatis membuka pop-up print
            setTimeout(() => { window.close(); }, 1000); // Menutup tab setelah print
        };
    </script>

</head>
<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-4 rounded shadow-md text-center w-64">
        <!-- Logo dan Informasi Toko -->
        <img src="{{ asset('img/zen.png') }}" 
             alt="logo" class="mx-auto mb-2" width="100" height="50"/>
        <h1 class="text-lg font-bold">PT Zen</h1>
        <p class="text-sm">Bantul, Yogyakarta<br/>Telp/WA 081341287038</p>
        <hr class="my-2"/>

    
        
        <!-- Informasi Transaksi -->
        <div class="text-left text-sm">
            <p><span class="font-bold">Tanggal</span>: {{ $penjualan->created_at }}</p>
            <p><span class="font-bold">Kasir</span>: {{ $penjualan->user->name }}</p>
            <p><span class="font-bold">Plg.</span>: {{ $penjualan->pelanggan->nama ?? 'Umum' }}</p>
        </div>
        <hr class="my-2"/>
        
        <!-- Daftar Produk -->
        <div class="text-left text-sm">
        @foreach ($penjualan->detailPenjualan as $item)
            <p>{{ $item->produk->nama_produk }}<br>
                {{ number_format($item->harga_jual, 0, ',', '.') }} x {{ $item->qty }} - {{ $item->diskon_produk }}% = 
                {{ number_format($item->sub_total, 0, ',', '.') }}</p>
         @endforeach
        </div>
        <hr class="my-2"/>
        
        <!-- Rincian Pembayaran -->
        <div class="text-left text-sm">
            <strong>Diskon:</strong> {{ $penjualan->diskon }}%<br>
            <strong>Total:</strong> {{ number_format($penjualan->total_harga , 0, ',', '.') }}</p>
            <strong>Bayar:</strong> {{ number_format($penjualan->bayar , 0, ',', '.') }}</p>
            <strong>Kembali:</strong> {{ number_format($penjualan->kembali , 0, ',', '.') }}</p>
        </div>
        <hr class="my-2"/>
        
        <!-- Pesan Terima Kasih -->
        <p class="text-sm">Terima kasih telah berbelanja di tempat kami. Kepuasan Anda adalah tujuan kami.</p>
    </div>
</body>
</html>
