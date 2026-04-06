<?php
// src/controllers/TransactionController.php

class TransactionController {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function prosesPinjam($id_buku, $id_anggota = 1) {
        try {
            // 1. Mulai Transaksi
            $this->db->beginTransaction();

            // 2. Cek Stok (Gunakan prepared statement & FOR UPDATE)
            $stmtCek = $this->db->prepare("SELECT stok FROM buku WHERE id_buku = :id_buku FOR UPDATE");
            $stmtCek->execute([':id_buku' => $id_buku]);
            $data = $stmtCek->fetch(PDO::FETCH_ASSOC);

            if (!$data || $data['stok'] <= 0) {
                $this->db->rollBack();
                return ['status' => 'error', 'pesan' => 'Transaksi gagal, stok buku habis atau buku tidak ditemukan.'];
            }

            // 3. Kurangi Stok
            $stmtUpdate = $this->db->prepare("UPDATE buku SET stok = stok - 1 WHERE id_buku = :id_buku");
            $stmtUpdate->execute([':id_buku' => $id_buku]);

            // 4. Catat Peminjaman
            $stmtPinjam = $this->db->prepare("INSERT INTO peminjaman (id_anggota, tanggal) VALUES (:id_anggota, CURDATE())");
            $stmtPinjam->execute([':id_anggota' => $id_anggota]);
            
            // Ambil ID pinjam yang baru saja dibuat
            $id_pinjam = $this->db->lastInsertId();

            // 5. Catat Detail Peminjaman
            $stmtDetail = $this->db->prepare("INSERT INTO detail_pinjam (id_pinjam, id_buku) VALUES (:id_pinjam, :id_buku)");
            $stmtDetail->execute([':id_pinjam' => $id_pinjam, ':id_buku' => $id_buku]);

            // 6. Commit Transaksi
            $this->db->commit();
            return ['status' => 'success', 'pesan' => 'Transaksi berhasil! Buku telah dipinjam.'];

        } catch (Exception $e) {
            // 7. Rollback jika ada error MySQL
            $this->db->rollBack();
            return ['status' => 'error', 'pesan' => 'Error, transaksi dibatalkan: ' . $e->getMessage()];
        }
    }
}
?>