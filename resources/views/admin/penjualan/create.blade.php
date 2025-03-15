<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        #wrapper {
            display: flex;
        }
        
        .sidebar {
            width: 250px;
            transition: width 0.3s;
            overflow: hidden;
        }
        
        .sidebar.collapsed {
            width: 60px;
        }
        
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        
        .sidebar .nav-link i {
            font-size: 1.5rem;
        }
    </style>
    
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <nav class="bg-white sidebar shadow" id="sidebar">
            <div class="sidebar-header text-center py-3">
                <h4 class="fw-bold text-primary" id="sidebar-title">Tech</h4>
            </div>
            <p class="text-muted px-3">Menu</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="#">
                        <i class="bi bi-box-seam me-2"></i> <span>Product</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="#">
                        <i class="bi bi-tags me-2"></i> <span>Category</span>
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
                <h2>Kasir</h2>
                
                <!-- Input Pencarian Produk -->
                <div class="input-group mb-3">
                    <input type="text" id="search_product" class="form-control" placeholder="Cari Produk...">
                    <button class="btn btn-primary" id="btn-search">Cari</button>
                </div>
                
                
                <ul id="product_list" class="list-group"></ul>
                <!-- Tabel Produk dalam Transaksi -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <!-- Data akan ditambahkan lewat JavaScript -->
                    </tbody>
                </table>
                
                <!-- Total Bayar -->
                <h3 class="bg-primary text-white p-3">Total: Rp. <span id="total-harga">0</span></h3>
                
                <!-- Form Pembayaran -->
                <div class="row">
                    <div class="input-group mb-3">
                        <input type="text" id="search_member" class="form-control" placeholder="Cari Member (Masukkan No HP)...">
                        <button class="btn btn-primary" id="btn-search-member">Cari</button>
                    </div>
                    <ul id="member_list" class="list-group"></ul>
                    
                    <!-- Menampilkan Member yang Dipilih -->
                    <input type="hidden" id="id_pelanggan" name="id_pelanggan">
                    <p><strong>Member:</strong> <span id="selected_member">Tidak ada</span></p>

                    <div class="col-md-4">
                        <label>Diskon</label>
                        <input type="text" class="form-control" id="diskon" name="diskon" readonly>
                    </div>

                    <div class="col-md-4">
                        <label>Diterima</label>
                        <input type="number" class="form-control" id="diterima">
                    </div>
                    <div class="col-md-4">
                        <label>Kembalian</label>
                        <input type="text" class="form-control" id="kembalian" readonly>
                    </div>
                </div>
                
                <!-- Tombol Simpan -->
                <button class="btn btn-success mt-3" id="simpan-transaksi">Simpan Transaksi</button>
                <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            let sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        });
    </script>
    


    <script>
       $(document).ready(function () {
    $('#search_product').on('keyup', function () {
        let query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: '/search-product',
                method: 'GET',
                data: { query: query },
                success: function (response) {
                    let list = '';
                    response.forEach(function (product) {
                        list += `<li class="list-group-item product-item" 
                                    data-id="${product.id}" 
                                    data-name="${product.nama_produk}" 
                                    data-price="${product.harga_jual}">
                                    ${product.nama_produk} - Rp. ${product.harga_jual}
                                 </li>`;
                    });
                    $('#product_list').html(list).show();
                }
            });
        } else {
            $('#product_list').hide();
        }
    });


    $(document).on('click', '.product-item', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let price = parseFloat($(this).data('price'));

        let row = `<tr>
            <td>${id}</td>
            <td>${name}</td>
            <td class="harga">${price}</td>
            <td><input type="number" value="1" min="1" class="form-control qty"></td>
            <td class="subtotal">${price}</td>
            <td><button class="btn btn-danger btn-sm remove-item">Hapus</button></td>
        </tr>`;

        $('#cart-body').append(row);
        $('#product_list').hide();
        $('#search_product').val('');
        updateTotal();
    });

    // Hapus item dari daftar transaksi
    $(document).on('click', '.remove-item', function () {
        $(this).closest('tr').remove();
        updateTotal();
    });

    // Update subtotal ketika jumlah berubah
    $(document).on('input', '.qty', function () {
        let qty = $(this).val();
        let price = parseFloat($(this).closest('tr').find('.harga').text());
        let subtotal = qty * price;
        $(this).closest('tr').find('.subtotal').text(subtotal);
        updateTotal();
    });

    
    $('#search_member').on('keyup', function () {
        let query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: '/search-member',
                method: 'GET',
                data: { query: query },
                success: function (response) {
                    let list = '';
                    response.forEach(function (member) {
                        list += `<li class="list-group-item member-item" 
                                    data-id="${member.id}" 
                                    data-name="${member.nama}">
                                    ${member.nama} (${member.no_hp})
                                 </li>`;
                    });
                    $('#member_list').html(list).show();
                }
            });
        } else {
            $('#member_list').hide();
        }
    });

    
    $(document).on('click', '.member-item', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#id_pelanggan').val(id);
        $('#selected_member').text(name);
        $('#diskon').val('15%'); // Tampilkan diskon
        $('#member_list').hide();
        $('#search_member').val('');
        
        updateTotal(); 
    });

    // Menghitung total harga
    function updateTotal() {
        let total = 0;
        $('.subtotal').each(function () {
            total += parseFloat($(this).text());
        });

        let isMember = $('#id_pelanggan').val() !== ''; // Cek apakah ada member
        let diskon = isMember ? total * 0.15 : 0;
        let totalBayar = total - diskon;

        $('#total-harga').text(totalBayar.toFixed(2)); // Total setelah diskon
        updateKembalian();
    }

    // Menghitung kembalian saat uang diterima diinputkan
    $('#diterima').on('input', function () {
        updateKembalian();
    });

    function updateKembalian() {
        let totalBayar = parseFloat($('#total-harga').text()) || 0;
        let diterima = parseFloat($('#diterima').val()) || 0;
        let kembalian = diterima - totalBayar;
        $('#kembalian').val(kembalian >= 0 ? kembalian.toFixed(2) : 0);
    }
});

$(document).ready(function () {
    $('#simpan-transaksi').on('click', function () {
        let items = [];
        $('#cart-body tr').each(function () {
            let id = $(this).find('td:first').text();
            let harga = $(this).find('.harga').text();
            let qty = $(this).find('.qty').val();
            items.push({ id: id, harga: harga, qty: qty });
        });

        let data = {
            id_pelanggan: $('#id_pelanggan').val(),
            total_harga: $('#total-harga').text(),
            items: items
        };

        $.ajax({
            url: '/store-transaction',
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                if (response.success) {
                    alert('Transaksi berhasil!');
                    location.reload();
                } else {
                    alert('Gagal menyimpan transaksi: ' + response.message);
                }
            }
        });
    });
});
        </script>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
