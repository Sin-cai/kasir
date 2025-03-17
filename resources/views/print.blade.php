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
     $('#member_list').hide();
     $('#search_member').val('');
     
     updateTotal(); // Update total setelah memilih member
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
                window.location.href = response.redirect_url; // Arahkan ke halaman cetak nota
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