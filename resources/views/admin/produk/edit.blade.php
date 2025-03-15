<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <nav class="bg-white sidebar shadow" id="sidebar">
            <div class="sidebar-header text-center py-3">
                <h4 class="fw-bold text-primary">Tech<span class="text-black"></span></h4>
            </div>
            <p class="text-muted px-3">Menu</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('produk.index') }}">
                        <i class="bi bi-box-seam me-2"></i> Product
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('kategori.index') }}">
                        <i class="bi bi-tags me-2"></i> Category
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('users.index') }}">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('pelanggan.index') }}">
                        <i class="bi bi-person-vcard me-2"></i> Membership
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('penjualan.index') }}">
                        <i class="bi bi-credit-card me-2"></i> Transaction
                    </a>
                </li>
            </ul>
            
            <p class="text-muted px-3 mt-3">Other</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="#">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-danger" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div id="page-content">
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <button class="btn btn-primary" id="sidebarToggle">☰</button>
                <div class="ms-auto d-flex align-items-center">
                    <span class="me-3">Hello, {{ Auth::user()->name }}</span>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container mt-4">
                <h3>Edit Produk</h3>
                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="id_kategoris" class="form-control">
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $produk->id_kategoris == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" value="{{ $produk->harga_beli }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" value="{{ $produk->harga_jual }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
