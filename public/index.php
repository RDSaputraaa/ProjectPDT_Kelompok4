<?php

// public/index.php

// 1. Panggil koneksi database
require_once '../src/config/database.php';

// 2. Ambil parameter 'page' dari URL (misal: localhost/index.php?page=operations)
// Jika tidak ada, anggap user membuka halaman 'dashboard'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// 3. Sistem Routing (Pengatur Lalu Lintas)
switch ($page) {

    // JIKA USER MEMBUKA HALAMAN OPERATIONS (Tugas Kiwi & Achi)
    case 'operations':
        require_once '../src/controllers/OperationController.php';


        $opController = new OperationController($pdo);

        // Memanggil secara dinamis (ID Kategori: 3, Nama: Sejarah, Stok Minimal: 5)
        $data_union = $opController->getUnion(3, 'Sejarah', 5);
        $data_union_all = $opController->getUnionAll(3, 'Sejarah', 5);
        $data_custom = $opController->getCustomFunction();
        $data_builtin = $opController->getBuiltInFunction();

        // Tampilkan Tampilan HTML-nya
        require_once '../src/views/operations.php';
        break;

    case 'reports':
        require_once '../src/controllers/ReportController.php';

        $reportController = new ReportController($pdo);
        
        $data_inner = $reportController->getInnerJoin();
        $data_left  = $reportController->getLeftJoin();
        $data_view  = $reportController->getView();
        
        require_once '../src/views/reports.php';
        break;

    case 'checkout':
        require_once '../src/controllers/TransactionController.php';

        $trxController = new TransactionController($pdo);

        // Proses Form Pinjam jika ada POST
        $pesan_transaksi = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_buku'])) {
            $pesan_transaksi = $trxController->prosesPinjam($_POST['id_buku']);
        }
        require_once '../src/views/checkout.php';
        break;

    // JIKA USER MEMBUKA HALAMAN DASHBOARD
    case 'dashboard':
    default:
        require_once '../src/controllers/DashboardController.php';
        $dashController = new DashboardController($pdo); 
        
        // --- TAMBAHKAN BLOK INI: Tangkap data form tambah buku ---
        $pesan_tambah = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['judul_buku'])) {
            $pesan_tambah = $dashController->tambahBuku(
                $_POST['judul_buku'], 
                $_POST['stok_buku'], 
                $_POST['id_kategori']
            );
        }
        // ---------------------------------------------------------

        $data_peminjaman = $dashController->getPeminjaman();

        require_once '../src/views/dashboard.php';
        break;

    
}
?>