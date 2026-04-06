<?php

class DashboardController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getPeminjaman() {
        try {
            // Kita cukup memanggil nama prosedurnya saja!
            $sql = "CALL TampilPeminjaman()";
            
            $stmt = $this->db->query($sql);
            return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
        } catch (PDOException $e) {
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
