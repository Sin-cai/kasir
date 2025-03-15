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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
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

            <div class="container">
                <h2 class="mb-4">Laporan Penjualan</h2>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="alert alert-primary">Total Penjualan: <strong>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</strong></div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success">Total Keuntungan: <strong>Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</strong></div>
                    </div>
                </div>
            
                <!-- Filter Tanggal -->
                <form id="filter-form">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Tanggal Mulai:</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal Selesai:</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                        </div>
                        <div class="col-md-4">
                            <label>&nbsp;</label><br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            
                <!-- Daftar Transaksi -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Pelanggan</th>
                            <th>Diskon</th>
                            <th>Total Harga</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $penjualan)
                        <tr>
                            <td>{{ $penjualan->id }}</td>
                            <td>{{ $penjualan->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $penjualan->user->name }}</td>
                            <td>{{ $penjualan->pelanggan->nama ?? 'Umum' }}</td>
                            <td>{{ $penjualan->diskon }}%</td>
                            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm lihat-detail" data-id="{{ $penjualan->id }}">Lihat</button>
                            </td>
                        </tr>
                        <tr id="detail-{{ $penjualan->id }}" class="detail-row" style="display: none;">
                            <td colspan="7">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penjualan->detailPenjualan as $detail)
                                        <tr>
                                            <td>{{ $detail->produk->nama_produk }}</td>
                                            <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/admin.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.lihat-detail').forEach(button => {
                button.addEventListener('click', function () {
                    let id = this.getAttribute('data-id');
                    let detailRow = document.getElementById('detail-' + id);
                    if (detailRow.style.display === "none") {
                        detailRow.style.display = "table-row";
                    } else {
                        detailRow.style.display = "none";
                    }
                });
            });
        });
        </script>
</body>
</html>
