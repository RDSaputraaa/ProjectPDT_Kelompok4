<?php

require_once '../src/config/database.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {

    case 'operations':
        require_once '../src/controllers/OperationController.php';

        $opController = new OperationController($pdo);

        $data_union = $opController->getUnion(3, 'Sejarah', 5);
        $data_union_all = $opController->getUnionAll(3, 'Sejarah', 5);
        $data_custom = $opController->getCustomFunction();
        $data_builtin = $opController->getBuiltInFunction();

        require_once '../src/views/operations.php';
        break;

    case 'dashboard':
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

        $pesan_transaksi = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pesan_transaksi = $trxController->prosesPinjam(
                $_POST['id_buku'],
                $_POST['id_anggota']
            );
        }

        require_once '../src/views/checkout.php';
        break;

    default:
        echo "<h2>Halaman tidak ditemukan</h2>";
        break;
}
?>