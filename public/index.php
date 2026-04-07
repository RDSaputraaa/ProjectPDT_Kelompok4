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

    // JIKA USER MEMBUKA HALAMAN REPORTS (Tugas Kirana)
    case 'reports':
        require_once '../src/controllers/ReportController.php';

        $reportController = new ReportController($pdo);

        $data_inner = $reportController->getInnerJoin();
        $data_left  = $reportController->getLeftJoin();
        $data_view  = $reportController->getView();

        require_once '../src/views/reports.php';
        break;

    // JIKA USER MEMBUKA HALAMAN CHECKOUT
    case 'checkout':
        require_once '../src/controllers/TransactionController.php';

        $trxController = new TransactionController($pdo);
        $pesan_transaksi = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // CEK 1: Apakah user menekan tombol "Hapus Permanen"?
            if (isset($_POST['aksi']) && $_POST['aksi'] === 'hapus_buku') {
                $pesan_transaksi = $trxController->hapusBuku($_POST['id_buku']);
            }

            // CEK 2: Apakah user menekan tombol "Pinjam Buku"?
            elseif (isset($_POST['id_buku']) && isset($_POST['id_anggota'])) {
                $pesan_transaksi = $trxController->prosesPinjam(
                    $_POST['id_buku'],
                    $_POST['id_anggota']
                );
            }

            // Tambahkan ini di dalam case 'checkout', setelah cek hapus_buku
            elseif (isset($_POST['aksi']) && $_POST['aksi'] === 'update_stok') {
                $pesan_transaksi = $trxController->updateStok(
                    $_POST['id_buku'],
                    $_POST['stok_baru']
                );
            }
        }
        
        require_once '../src/views/checkout.php';
        break;

    // JIKA USER MEMBUKA HALAMAN MATERI DEADLOCK
    case 'deadlock':
        require_once '../src/controllers/DeadlockContoller.php';

        $deadlockCtrl = new DeadlockController($pdo);

        // Jika user mengeklik tombol Proses A atau B (Buka di tab baru)
        if (isset($_GET['proses'])) {
            if ($_GET['proses'] === 'A') {
                $deadlockCtrl->prosesA();
                exit; // Hentikan script agar tidak me-load UI Glassmorphism
            } elseif ($_GET['proses'] === 'B') {
                $deadlockCtrl->prosesB();
                exit;
            }
        }

        // Jika tidak menekan tombol, tampilkan UI Halaman Deadlock
        require_once '../src/views/deadlock.php';
        break;

    // JIKA USER MEMBUKA HALAMAN DASHBOARD (ATAU URL TIDAK DIKENAL)
    case 'dashboard':
    default:
        require_once '../src/controllers/DashboardController.php';
        $dashController = new DashboardController($pdo);

        // --- Tangkap data form tambah buku (Dari UI Dashboard) ---
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
