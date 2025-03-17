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
                </nav>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Add Users</h1>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <i class="fas fa-user-circle text-gray-600 text-xl"></i>
                </div>
            </div>
            <!-- Content -->
            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700">Name</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" value="{{ $user->name }}" name="name" placeholder="Enter name" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">User Name</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" name="username" value="{{ $user->username }}" placeholder="Enter User Name" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" name="email" value="{{ $user->email }}" placeholder="Enter Email" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Password</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" name="password" value="{{ $user->password }}" placeholder="Enter Password" type="password"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Address</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" name="alamat" value="{{ $user->alamat }}" placeholder="Enter Address" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Phone Number</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" name="hp" value="{{ $user->hp }}" placeholder="Enter Phone Number" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label for="id_kategoris" class="block text-gray-700">Role</label>
                        <select  name="role" value="{{ $user->role }}" class="border border-gray-300 rounded px-4 py-2 w-full" required>
                            <option value="">-- Choose Role --</option>
                            <option value="petugas">Petugas</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status</label>
                        <input class="border border-gray-300 rounded px-4 py-2 w-full" name="status" value="{{ $user->status }}" placeholder="Enter Status" type="text"/>
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