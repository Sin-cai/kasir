<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cashier Dashboard - Reports</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('admin.index') }}">
                        <i class="fas fa-home mr-3"></i>
                        <span class="sidebar-item-text">Home</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('penjualan.index') }}">
                        <i class="fas fa-cash-register mr-3"></i>
                        <span class="sidebar-item-text">Transactions</span>
                    </a>
                    <a  class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('produk.index') }}">
                        <i class="fas fa-box-open mr-3"></i>
                        <span class="sidebar-item-text">Products</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('kategori.index') }}">
                        <i class="fas fa-tags mr-3"></i>
                        <span class="sidebar-item-text">Category</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('pelanggan.index') }}">
                        <i class="fas fa-id-card mr-3"></i>
                        <span class="sidebar-item-text">Membership</span>
                    </a>
                    <a class="flex items-center py-2 px-8 bg-green-700 text-white" href="{{ route('laporan.index') }}">
                        <i class="fas fa-chart-line mr-3"></i>
                        <span class="sidebar-item-text">Reports</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('users.index') }}">
                        <i class="fas fa-user mr-3"></i>
                        <span class="sidebar-item-text">Users</span>
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
                <h1 class="text-3xl font-bold">Reports</h1>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <i class="fas fa-user-circle text-gray-600 text-xl"></i>
                </div>
            </div>
            <!-- Content -->
            <form id="filter-form" class="p-4 bg-light rounded shadow">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex flex-col">
                        <label class="text-gray-700">Tanggal Mulai:</label>
                        <input class="border border-gray-300 rounded px-4 py-2" id="startDate" type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
                    </div>
                    <span class="text-gray-700 self-center">to</span>
                    <div class="flex flex-col">
                        <label class="text-gray-700">Tanggal Selesai:</label>
                        <input class="border border-gray-300 rounded px-4 py-2" id="endDate" type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
                    </div>
                    <div class="flex items-end">
                        <button class="bg-green-500 text-white px-4 py-2 rounded" id="filterButton" type="submit">Filter</button>
                    </div>
                </div>
            </form>
                <!-- Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-green-700">Total Sales</h2>
                        <div class="text-2xl font-bold text-green-700"><strong>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</strong></div>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-green-700">Total Profit</h2>
                        <div class="text-2xl font-bold text-green-700"><strong>Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</strong></div>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-green-700">Total Transactions</h2>
                        <div class="text-2xl font-bold text-green-700"><strong>{{ number_format($totalBarangTerjual, 0, ',', '.') }}</strong></div>
                    </div>
                </div>
                <!-- Download Buttons -->
                <div class="flex justify-end mb-4">
                    <a id="cetakPDF" class="bg-red-500 text-white px-4 py-2 rounded cursor-pointer">
                        <i class="fas fa-file-pdf"></i> Cetak Laporan PDF
                    </a>
                    <a href="{{ route('laporan.export.excel', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai')]) }}" 
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        <i class="fas fa-file-excel"></i> Download Excel
                     </a>
                </div>
                <!-- Table -->
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-green-700 text-white">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Employee</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Customer</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Discount</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Total</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($penjualans as $index => $penjualan)
                        <tr class="border border-gray-300 text-gray-700 hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $penjualan->created_at->format('d-m-Y H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $penjualan->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $penjualan->pelanggan->nama ?? 'Umum' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $penjualan->diskon }}%</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <button class="view-details bg-blue-500 text-white px-3 py-1 rounded" 
                                    data-transaction-id="{{ $penjualan->id }}"
                                    data-details='@json($penjualan->detailPenjualan)'>
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Transaction Details
                            </h3>
                            <div class="mt-2">
                                <table class="w-full border-collapse border border-gray-200">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="border px-4 py-2">Produk</th>
                                            <th class="border px-4 py-2">Harga</th>
                                            <th class="border px-4 py-2">Qty</th>
                                            <th class="border px-4 py-2">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalContent">
                                        <!-- Detail transaksi akan dimuat di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="closeModal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    
   <script>
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function() {
            const transactionId = this.getAttribute('data-transaction-id');
            const details = JSON.parse(this.getAttribute('data-details'));

            // Bangun tabel isi modal
            let modalContent = "";
            details.forEach(detail => {
                modalContent += `
                    <tr>
                        <td class="border px-4 py-2">${detail.produk.nama_produk}</td>
                        <td class="border px-4 py-2">Rp ${new Intl.NumberFormat('id-ID').format(detail.harga_jual)}</td>
                        <td class="border px-4 py-2">${detail.qty}</td>
                        <td class="border px-4 py-2">Rp ${new Intl.NumberFormat('id-ID').format(detail.sub_total)}</td>
                    </tr>`;
            });

            document.getElementById('modalContent').innerHTML = modalContent;
            document.getElementById('modal').classList.remove('hidden');
            document.body.classList.add('modal-active');
        });
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('modal').classList.add('hidden');
        document.body.classList.remove('modal-active');
    });
</script>

<script>
    document.getElementById('cetakPDF').addEventListener('click', function() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        window.open(`/laporan/pdf?tanggal_mulai=${startDate}&tanggal_selesai=${endDate}`, '_blank');
    });
</script>

</body>
</html>