<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <h1 class="text-white text-2xl sidebar-item-text">Cashier Dashboard</h1>
                <button id="toggleSidebar" class="text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="flex-grow">
                <nav class="mt-10">
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="#">
                        <i class="fas fa-home mr-3"></i>
                        <span class="sidebar-item-text">Home</span>
                    </a>
                    <a class="flex items-center py-2 px-8 bg-green-700 text-white" href="#"> 
                        <i class="fas fa-cash-register mr-3"></i>
                        <span class="sidebar-item-text">Transactions</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="#">
                        <i class="fas fa-box-open mr-3"></i>
                        <span class="sidebar-item-text">Products</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="#">
                        <i class="fas fa-tags mr-3"></i>
                        <span class="sidebar-item-text">Category</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="#">
                        <i class="fas fa-id-card mr-3"></i>
                        <span class="sidebar-item-text">Membership</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="#">
                        <i class="fas fa-chart-line mr-3"></i>
                        <span class="sidebar-item-text">Reports</span>
                    </a>
                </nav>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex items-center justify-center h-screen bg-gray-100">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-2xl font-bold mb-4">Transaksi Berhasil!</h2>
                <p class="text-lg">Silakan cetak nota atau kembali ke halaman penjualan.</p>
                <div class="mt-4">
                    <a href="{{ route('nota', $penjualan->id) }}" target="_blank" class="px-4 py-2 bg-blue-500 text-white rounded shadow">Print Nota</a>
                    <a href="{{ route('penjualan.create') }}" class="px-4 py-2 bg-gray-500 text-white rounded shadow">Kembali</a>
                </div>
            </div>





          


        </div>
            
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>



</body>
</html>