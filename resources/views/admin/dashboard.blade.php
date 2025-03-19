<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cashier Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
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
                    <a class="flex items-center py-2 px-8 bg-green-700 text-white" href="{{ route('admin.index') }}">
                        <i class="fas fa-home mr-3"></i>
                        <span class="sidebar-item-text">Dashboard</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('penjualan.index') }}">
                        <i class="fas fa-cash-register mr-3"></i>
                        <span class="sidebar-item-text">Transactions</span>
                    </a>
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('produk.index') }}">
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
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('laporan.index') }}">
                        <i class="fas fa-chart-line mr-3"></i>
                        <span class="sidebar-item-text">Reports</span>
                    </a>
                    <a class="flex items-center py-2 px-8 bg-green-700 text-white" href="{{ route('users.index') }}">
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
                <h1 class="text-3xl font-bold">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <i class="fas fa-user-circle text-gray-600 text-xl"></i>
                </div>
            </div>
            <!-- Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="bg-green-500 p-3 rounded-full">
                            <i class="fas fa-dollar-sign text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold">Total Sales</h2>
                            <p class="text-2xl font-bold">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="bg-green-500 p-3 rounded-full">
                            <i class="fas fa-shopping-cart text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold">Transactions</h2>
                            <p class="text-2xl font-bold">{{ number_format($totalTransactions) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="bg-green-500 p-3 rounded-full">
                            <i class="fas fa-box text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold">Products</h2>
                            <p class="text-2xl font-bold">{{ number_format($totalProducts) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="bg-green-500 p-3 rounded-full">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold">Customers</h2>
                            <p class="text-2xl font-bold">{{ number_format($totalCustomers) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
</body>
</html>
