<?php
// src/controllers/OperationController.php

class OperationController {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // public function getUnion() diubah menjadi:
    public function getUnion($id_kategori = 1, $nama_kategori = 'Novel', $stok_minimal = 4) {
        // Gunakan parameter '?' atau ':nama' (PDO Placeholder) sebagai pengganti angka/teks mati
        $sql = "SELECT id_buku, judul, :teks_kategori AS alasan FROM buku WHERE id_kategori = :id_kategori
                UNION
                SELECT id_buku, judul, :teks_stok AS alasan FROM buku WHERE stok > :stok_minimal";
        
        $stmt = $this->db->prepare($sql);
        
        // Memasukkan data dinamis ke dalam cetakan query
        $stmt->execute([
            ':teks_kategori' => "Kategori " . $nama_kategori,
            ':id_kategori'   => $id_kategori,
            ':teks_stok'     => "Stok > " . $stok_minimal,
            ':stok_minimal'  => $stok_minimal
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getUnionAll() diubah menjadi:
    public function getUnionAll($id_kategori = 1, $nama_kategori = 'Novel', $stok_minimal = 4) {
        $sql = "SELECT id_buku, judul, :teks_kategori AS alasan FROM buku WHERE id_kategori = :id_kategori
                UNION ALL
                SELECT id_buku, judul, :teks_stok AS alasan FROM buku WHERE stok > :stok_minimal";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute([
            ':teks_kategori' => "Kategori " . $nama_kategori,
            ':id_kategori'   => $id_kategori,
            ':teks_stok'     => "Stok > " . $stok_minimal,
            ':stok_minimal'  => $stok_minimal
        ]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBuiltInFunction(){
        // Perhatikan bagian 'AS nama_anggota', 'AS total_transaksi', dll. 
        // Ini adalah kunci agar tidak terjadi "Undefined array key" di HTML
        $sql = "SELECT 
                    UPPER(a.nama) AS nama_anggota, 
                    COUNT(p.id_pinjam) AS total_transaksi,
                    IFNULL(DATE_FORMAT(MAX(p.tanggal), '%d %M %Y'), 'Belum pernah pinjam') AS transaksi_terakhir
                FROM anggota a 
                LEFT JOIN peminjaman p ON a.id_anggota = p.id_anggota
                GROUP BY a.id_anggota";
        
        $stmt = $this->db->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    // B. Custom Function
    public function getCustomFunction() {
        // Perhatikan bagian 'AS status_ketersediaan'. Ini harus ada!
        $sql = "SELECT 
                    judul, 
                    stok, 
                    cek_stok(stok) AS status_ketersediaan 
                FROM buku";
                
        $stmt = $this->db->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
?>