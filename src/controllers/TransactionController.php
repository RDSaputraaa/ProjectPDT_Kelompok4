<?php
// src/controllers/TransactionController.php

class TransactionController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function prosesPinjam($id_buku, $id_anggota) {
        try {
            // Mulai transaksi
            $this->pdo->beginTransaction();

            // Ambil stok + kunci data (Pencegahan bentrok jika dipinjam bersamaan)
            $stmt = $this->pdo->prepare("SELECT stok FROM buku WHERE id_buku = ? FOR UPDATE");
            $stmt->execute([$id_buku]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // Jika buku tidak ditemukan di database
            if (!$data) {
                $this->pdo->rollBack();
                return [
                    'status' => 'error',
                    'pesan' => 'Buku tidak ditemukan'
                ];
            }

            // Jika stok masih ada
            if ($data['stok'] > 0) {

                // Kurangi stok
                $stmt = $this->pdo->prepare("UPDATE buku SET stok = stok - 1 WHERE id_buku = ?");
                $stmt->execute([$id_buku]);

                // Simpan ke tabel peminjaman utama
                $stmt = $this->pdo->prepare("INSERT INTO peminjaman (id_anggota, tanggal) VALUES (?, CURDATE())");
                $stmt->execute([$id_anggota]);

                // Ambil ID peminjaman yang baru saja terbuat
                $id_pinjam = $this->pdo->lastInsertId();

                // Simpan ke tabel relasi detail_pinjam
                $stmt = $this->pdo->prepare("INSERT INTO detail_pinjam (id_pinjam, id_buku) VALUES (?, ?)");
                $stmt->execute([$id_pinjam, $id_buku]);

                // Commit transaksi (Simpan permanen semua perubahan di atas)
                $this->pdo->commit();

                return [
                    'status' => 'success',
                    'pesan' => 'Transaksi berhasil, buku berhasil dipinjam'
                ];

            } else {
                // Jika stok = 0
                $this->pdo->rollBack();
                return [
                    'status' => 'error',
                    'pesan' => 'Transaksi gagal, stok buku habis'
                ];
            }

        } catch (Exception $e) {
            // Jika terjadi error MySQL (misal database mati atau salah query)
            $this->pdo->rollBack();
            return [
                'status' => 'error',
                'pesan' => 'Terjadi error: ' . $e->getMessage()
            ];
        }
    }
}
?>