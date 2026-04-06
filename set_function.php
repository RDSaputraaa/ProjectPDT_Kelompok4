<?php
include 'koneksi.php';

$query_union = "
    SELECT id_buku, judul, 'Kategori Novel' AS alasan FROM buku WHERE id_kategori = 1
    UNION
    SELECT id_buku, judul, 'Stok > 4' AS alasan FROM buku WHERE stok > 4
";
$result_union = mysqli_query($conn, $query_union);

$query_union_all = "
    SELECT id_buku, judul, 'Kategori Novel' AS alasan FROM buku WHERE id_kategori = 1
    UNION ALL
    SELECT id_buku, judul, 'Stok > 4' AS alasan FROM buku WHERE stok > 4
";
$result_union_all = mysqli_query($conn, $query_union_all);

$query_builtin = "
    SELECT 
        UPPER(a.nama) AS nama_anggota,
        COUNT(p.id_pinjam) AS total_transaksi,
        IFNULL(DATE_FORMAT(MAX(p.tanggal), '%d %M %Y'), 'Belum pernah pinjam') AS transaksi_terakhir
    FROM anggota a
    LEFT JOIN peminjaman p ON a.id_anggota = p.id_anggota
    GROUP BY a.id_anggota
";
$result_builtin = mysqli_query($conn, $query_builtin);

$query_custom = "
    SELECT 
        judul, 
        stok, 
        cek_stok(stok) AS status_ketersediaan 
    FROM buku
";
$result_custom = mysqli_query($conn, $query_custom);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Set Operation & Function</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f7f6; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 30px; }
        h2 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 5px; }
        .query-box { background: #1e1e1e; color: #00ff00; padding: 12px; font-family: Consolas, monospace; border-radius: 4px; overflow-x: auto; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        .row-container { display: flex; gap: 20px; flex-wrap: wrap; }
        .col { flex: 1; min-width: 45%; }
    </style>
</head>
<body>

    <h1>Admin Dashboard - Set Operation & Function</h1>

    <div class="container">
        <h2>1. Set Operation (UNION vs UNION ALL)</h2>
        <div class="row-container">
            <div class="col">
                <h3>Hasil UNION</h3>
                <div class="query-box">SELECT id_buku, judul FROM buku WHERE id_kategori = 1<br>UNION<br>SELECT id_buku, judul FROM buku WHERE stok > 4</div>
                <table>
                    <tr><th>ID Buku</th><th>Judul</th><th>Keterangan</th></tr>
                    <?php while ($row = mysqli_fetch_assoc($result_union)): ?>
                    <tr>
                        <td><?= $row['id_buku'] ?></td>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['alasan'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <div class="col">
                <h3>Hasil UNION ALL</h3>
                <div class="query-box">SELECT id_buku, judul FROM buku WHERE id_kategori = 1<br>UNION ALL<br>SELECT id_buku, judul FROM buku WHERE stok > 4</div>
                <table>
                    <tr><th>ID Buku</th><th>Judul</th><th>Keterangan</th></tr>
                    <?php while ($row = mysqli_fetch_assoc($result_union_all)): ?>
                    <tr>
                        <td><?= $row['id_buku'] ?></td>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['alasan'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>2. Database Functions</h2>
        <div class="row-container">
            <div class="col">
                <h3>Built-in Function</h3>
                <div class="query-box">SELECT UPPER(nama), COUNT(id_pinjam) ... GROUP BY id_anggota</div>
                <table>
                    <tr><th>Nama Anggota</th><th>Total Transaksi</th><th>Transaksi Terakhir</th></tr>
                    <?php while ($row = mysqli_fetch_assoc($result_builtin)): ?>
                    <tr>
                        <td><?= $row['nama_anggota'] ?></td>
                        <td><?= $row['total_transaksi'] ?></td>
                        <td><?= $row['transaksi_terakhir'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <div class="col">
                <h3>Custom Function</h3>
                <div class="query-box">SELECT judul, stok, cek_stok(stok) AS status ... FROM buku</div>
                <table>
                    <tr><th>Judul Buku</th><th>Sisa Stok</th><th>Status</th></tr>
                    <?php while ($row = mysqli_fetch_assoc($result_custom)): ?>
                    <tr>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td>
                            <?php if($row['status_ketersediaan'] == 'Tersedia'): ?>
                                <span style="color: green; font-weight: bold;"><?= $row['status_ketersediaan'] ?></span>
                            <?php else: ?>
                                <span style="color: red; font-weight: bold;"><?= $row['status_ketersediaan'] ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
