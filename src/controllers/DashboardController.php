<?php

class DashboardController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // 1. Fungsi bawaan yang sudah ada (mengambil data peminjaman)
    public function getPeminjaman()
    {
        try {
            // Hapus JOIN ke tabel buku karena kolom id_buku belum ada
            $sql = "SELECT p.id_pinjam, a.nama, p.tanggal 
                    FROM peminjaman p 
                    JOIN anggota a ON p.id_anggota = a.id_anggota 
                    ORDER BY p.tanggal DESC";

            $stmt = $this->db->query($sql);
            return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
            // Tampilkan pesan error di layar agar kita tahu jika ada salah syntax
            die("Error Database: " . $e->getMessage());
        }
    }

    // 2. FUNGSI BARU: Memanggil Stored Procedure (Tugas Sulthon)
    public function tambahBuku($judul, $stok, $id_kategori)
    {
        try {
            $stmt = $this->db->prepare("CALL tambah_buku(?, ?, ?)");
            $stmt->execute([$judul, $stok, $id_kategori]);
            return ['status' => 'success', 'pesan' => "Buku '<strong>$judul</strong>' berhasil ditambahkan ke database!"];
        } catch (PDOException $e) {
            return ['status' => 'error', 'pesan' => "Gagal menambah buku: " . $e->getMessage()];
        }
    }
}
