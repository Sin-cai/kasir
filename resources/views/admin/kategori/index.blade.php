<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cashier Dashboard - Category</title>
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
                    <a class="flex items-center py-2 px-8 bg-green-700 text-white" href="{{ route('kategori.index') }}">
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
                    <a class="flex items-center py-2 px-8 text-green-200 hover:bg-green-700 hover:text-white" href="{{ route('users.index') }}">
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
                <h1 class="text-3xl font-bold">Category</h1>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <i class="fas fa-user-circle text-gray-600 text-xl"></i>
                </div>
            </div>
            <!-- Content -->
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <input class="border border-gray-300 rounded px-4 py-2 w-1/3" placeholder="Search a category" type="text"/>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <button id="delete-selected" class="bg-red-500 text-white px-4 py-2 rounded">Delete selected</button>
                    <div class="flex space-x-2">
                        <button class="bg-green-500 text-white px-4 py-2 rounded">
                            <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>
                        </button>
                    </div>
                </div>
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-600">
                            <th><input type="checkbox" id="select-all">all</th>
                            <th class="pb-2">Category Name</th>
                            <th class="pb-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $kategori)
                        <tr>
                            <td><input type="checkbox" class="select-item" value="{{ $kategori->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td class="py-2 flex space-x-2">
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded fas fa-edit",>Edit</a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded fas fa-trash" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.category-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
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
                    fetch("{{ route('pelanggan.bulk_delete') }}", {
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