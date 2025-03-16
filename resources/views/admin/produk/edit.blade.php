<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cashier Dashboard - Add Product</title>
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
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="#">
                        <i class="fas fa-cash-register mr-3"></i>
                        <span class="sidebar-item-text">Transactions</span>
                    </a>
                    <a class="flex items-center py-2 px-8 bg-green-700 text-white" href="#">
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
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Add Product</h1>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <i class="fas fa-user-circle text-gray-600 text-xl"></i>
                </div>
            </div>
            <!-- Content -->
            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700">Product Name</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" value="{{ $produk->nama_produk }}" name="nama_produk"  type="text"/>
                    </div>
                    <div class="mb-4">
                        <label for="id_kategoris" class="block text-gray-700">Category</label>
                        <select name="id_kategoris" id="id_kategoris" class="border border-gray-300 rounded px-4 py-2 w-full" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">purchase price</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" value="{{ $produk->harga_beli }}" name="harga_beli"  type="number"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Selling price</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" value="{{ $produk->harga_jual }}" name="harga_jual"  type="number"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Stock</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" value="{{ $produk->stok }}" name="stok"  type="number"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Barcode</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" value="{{ $produk->barcode }}" name="barcode" type="number"/>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Submit</button>
                    </div>
                </form>
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