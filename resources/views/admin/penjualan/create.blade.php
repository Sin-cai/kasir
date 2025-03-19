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
                <h1 class="text-3xl font-bold">Transactions</h1>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <i class="fas fa-user-circle text-gray-600 text-xl"></i>
                </div>
            </div>
            <!-- Content -->
            <div class="bg-white p-6 rounded-lg shadow">
                <!-- Input Barang -->
                <div class="mb-4">
                    <label class="block text-gray-700">Input Barang</label>
                    <input class="border border-gray-300 rounded px-4 py-2 w-full" id="search_product" placeholder="Scan or enter product code" type="text"/>
                </div>

                
                <ul id="product_list" class="list-group"></ul>
                <!-- Tabel Barang -->
                <table class="w-full text-left mb-4">
                    <thead>
                        <tr class="text-gray-600">
                            <th class="pb-2">No</th>
                            <th class="pb-2">Product Name</th>
                            <th class="pb-2">Price</th>
                            <th class="pb-2">Quantity</th>
                            <th class="pb-2">Diskon Produk</th>
                            <th class="pb-2">Subtotal</th>
                            <th class="pb-2">Actions</th>
                        </tr>
                    </thead>
                      <tbody id="cart-body">
                        <!-- Data akan ditambahkan lewat JavaScript -->
                    </tbody>
                </table>
                <!-- Subtotal -->
                <div class="flex justify-end mb-4">
                    <div class="w-1/3">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Discount:</span>
                            <input class="border border-gray-300 rounded px-2 py-1 w-16" type="text"  id="diskon" name="diskon"/>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Total:</span>
                            <span id="total-harga"  class="text-gray-700"></span>
                           
                        </div>
                    </div>
                </div>
                <!-- Input Member -->
                <div>
                    <input type="text" id="search_member" class="form-control" placeholder="Cari Member (No HP)">
                    <ul id="member_list" class="list-group" style="display: none;"></ul>
                    <input type="hidden" id="id_pelanggan">
                    <p>Member: <span id="selected_member"></span></p>
                    <button id="hapus_member" class="btn btn-warning btn-sm" style="display: none;">Hapus Member</button>
                </div>
                <ul id="member_list" class="list-group"></ul>

                <input type="hidden" id="id_pelanggan" name="id_pelanggan">
                    <p><strong></strong> <span id="selected_member"></span></p>
                <!-- Input Pembayaran -->
                <div class="mb-4">
                    <label class="block text-gray-700">Bayar</label>
                    <input class="border border-gray-300 rounded px-4 py-2 w-full" id="bayar" placeholder="Enter payment amount" type="number"/>
                </div>
                
                <!-- Kembali -->
                <div class="flex justify-end">
                    <div class="w-1/3">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Kembali:</span>
                            <input type="text" class="form-control" id="kembali" readonly>
                        </div>
                    </div>
                </div>
                <!-- Button Submit -->
                <div class="flex justify-end">
                    <button class="bg-green-500 text-white px-4 py-2 rounded"  id="simpan-transaksi">Submit</button>
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

    

<script>
 $(document).ready(function () {
    // Mencari produk
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

    // Tambahkan produk ke daftar transaksi
    $(document).on('click', '.product-item', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let price = parseFloat($(this).data('price'));

        let row = `<tr>
            <td>${id}</td>
            <td>${name}</td>
            <td class="harga">${price}</td>
            <td><input type="number" value="1" min="1" class="form-control qty"></td>
            <td><input type="number" value="0" min="0" max="100" class="form-control diskon-produk" placeholder="%"></td>
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

    // Update subtotal ketika jumlah berubah atau diskon produk diinputkan
    $(document).on('input', '.qty, .diskon-produk', function () {
        let row = $(this).closest('tr');
        let qty = row.find('.qty').val();
        let price = parseFloat(row.find('.harga').text());
        let diskon_produk = parseFloat(row.find('.diskon-produk').val()) || 0;

        let harga_setelah_diskon = price - (price * diskon_produk / 100);
        let subtotal = qty * harga_setelah_diskon;

        row.find('.subtotal').text(subtotal.toFixed(2));
        updateTotal();
    });

    // Mencari member
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

    // Pilih member
    $(document).on('click', '.member-item', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#id_pelanggan').val(id);
        $('#selected_member').text(name);
        $('#diskon').val('15%'); // Tampilkan diskon
        $('#hapus_member').show(); // Tampilkan tombol hapus
        $('#member_list').hide();
        $('#search_member').val('');

        updateTotal();
    });

    // Hapus Member
    $('#hapus_member').on('click', function () {
        $('#id_pelanggan').val('');
        $('#selected_member').text(''); // Hapus teks member
        $('#diskon').val('0%'); // Reset diskon
        $('#hapus_member').hide(); // Sembunyikan tombol hapus
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

        $('#total-harga').text(totalBayar.toFixed(2));
        updateKembalian();
    }

    // Menghitung kembalian saat uang diterima diinputkan
    $('#bayar').on('input', function () {
        updateKembalian();
    });

    function updateKembalian() {
        let totalBayar = parseFloat($('#total-harga').text()) || 0;
        let bayar = parseFloat($('#bayar').val()) || 0;
        let kembali = bayar - totalBayar;
        $('#kembali').val(kembali >= 0 ? kembali.toFixed(2) : 0);
    }

    // Simpan transaksi
    $('#simpan-transaksi').on('click', function () {
        let items = [];
        $('#cart-body tr').each(function () {
            let id = $(this).find('td:first').text();
            let harga = $(this).find('.harga').text();
            let qty = $(this).find('.qty').val();
            let diskon_produk = $(this).find('.diskon-produk').val() || 0;

            items.push({ id: id, harga: harga, qty: qty, diskon_produk: diskon_produk });
        });

        let data = {
            id_pelanggan: $('#id_pelanggan').val() || null, // Boleh kosong
            total_harga: $('#total-harga').text(),
            diskon: $('#diskon').val().replace('%', ''), 
            bayar: $('#bayar').val(),
            kembali: $('#kembali').val(),
            items: items
        };

        $.ajax({
            url: '/penjualan',
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect_url;
                } else {
                    alert('Gagal menyimpan transaksi: ' + response.message);
                }
            }
        });
    });
});

     </script>
</body>
</html>