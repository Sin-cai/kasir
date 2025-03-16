<table class="min-w-full bg-white border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Pelanggan</th>
            <th class="border px-4 py-2">Total Harga</th>
            <th class="border px-4 py-2">Tanggal</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penjualans as $penjualan)
            <tr>
                <td class="border px-4 py-2">{{ $penjualan->id }}</td>
                <td class="border px-4 py-2">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">{{ $penjualan->created_at->format('d-m-Y H:i') }}</td>
                <td class="border px-4 py-2">
                    <button class="view-details bg-blue-500 text-white px-3 py-1 rounded" 
                        data-transaction-id="{{ $penjualan->id }}"
                        data-details='@json($penjualan->detailPenjualan)'>
                        View Details
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
