<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cashier Dashboard - Transactions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        .sidebar {
            transition: width 0.3s;
        }
        .sidebar.collapsed {
            width: 64px;
        }
        .sidebar.collapsed .sidebar-item-text {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-green-800 w-64 min-h-screen flex flex-col sidebar">
            <div class="flex items-center justify-between h-20 border-b border-green-700 px-4">
                <div class="flex items-center">
                    <img src="{{ asset('img/zen.png') }}" alt="PT Zen Logo" class="h-10 w-10 mr-2 ">
                    <h1 class="text-white text-2xl sidebar-item-text font-bold">PT Zen</h1>
                </div>
                
            </div>
            <button id="toggleSidebar" class="text-white">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex-grow">
                    <nav class="mt-10">
                        <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('petugas.index') }}">
                            <i class="fas fa-home mr-3"></i>
                            <span class="sidebar-item-text">Home</span>
                        </a>
                        <a class="flex items-center py-2 px-8 bg-green-700 text-white" href="{{ route('kasir.index') }}">
                            <i class="fas fa-cash-register mr-3"></i>
                            <span class="sidebar-item-text">Transactions</span>
                        </a>
                        <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('member.index') }}">
                            <i class="fas fa-id-card mr-3"></i>
                            <span class="sidebar-item-text">Membership</span>
                        </a>
                        <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="/logout">
                            <i ></i>
                            <span class="sidebar-item-text">Log Out</span>
                        </a>
                    </nav>
                </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Transactions</h1>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <i class="fas fa-user-circle text-gray-600 text-xl"></i>
                </div>
            </div>
            <!-- Content -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <input class="border border-gray-300 rounded px-4 py-2 w-1/3" placeholder="Search a transaction" type="text"/>
                    <button class="bg-green-500 text-white px-4 py-2 rounded">
                        <a href="{{ route('kasir.create') }}" class="btn btn-primary mb-3">Transaction</a>
                    </button>
                </div>

                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-600">

                            <th class="pb-2">Nama User</th>
                            <th class="pb-2">Nama Pelanggan</th>
                            <th class="pb-2">Nama Produk</th>
                            <th class="pb-2">Harga Jual</th>
                            <th class="pb-2">Qty</th>
                            <th class="pb-2">Subtotal</th>
                            <th class="pb-2">Diskon</th>
                            <th class="pb-2">Total Harga</th>
                            <th class="pb-2">Tanggal</th>
                            <th class="pb-2">Print</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $penjualan)
                            @foreach ($penjualan->detailPenjualan as $detail)
                                <tr>
                                    <td>{{ $penjualan->user->name ?? '' }}</td>
                                    <td>{{ $penjualan->pelanggan->nama ?? 'Non-Member' }}</td>
                                    <td>{{ $detail->produk->nama_produk }}</td>
                                    <td>{{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                                    <td>{{ $detail->qty }}</td>
                                    <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                    <td>{{ $penjualan->diskon }}%</td>
                                    <td>{{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ $penjualan->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <!-- Tombol Cetak Nota -->
                                            <a href="{{ route('nota', $penjualan->id) }}" target="_blank" 
                                               class="px-4 py-2 bg-blue-500 text-white rounded shadow flex items-center space-x-2">
                                                <i class="fas fa-print"></i>
           
                                            </a>
                                        
                                        </div>
                                        
                                        
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $penjualans->links() }} 
                </div>
            </div>
        </div>
    </div>
    

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    
        document.getElementById('delete-selected').addEventListener('click', function() {
            let selectedIds = [];
            document.querySelectorAll('.select-item:checked').forEach(checkbox => {
                selectedIds.push(checkbox.value);
            });
            
            if (selectedIds.length > 0) {
                if (confirm('Apakah Anda yakin ingin menghapus data yang dipilih?')) {
                    fetch("{{ route('produk.bulk_delete') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ ids: selectedIds })
                    }).then(response => response.json())
                      .then(data => location.reload());
                }
            } else {
                alert('Pilih setidaknya satu data untuk dihapus.');
            }
        });
    </script>
</body>
</html>