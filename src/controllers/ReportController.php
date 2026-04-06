<?php
// src/controllers/ReportController.php

class ReportController {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    // 1. Fungsi untuk INNER JOIN (Hanya menampilkan anggota yang MEMINJAM buku)
    public function getInnerJoin() {
        $sql = "SELECT anggota.nama, peminjaman.tanggal
                FROM peminjaman
                INNER JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 2. Fungsi untuk LEFT JOIN (Menampilkan SEMUA anggota, walau belum pernah pinjam)
    public function getLeftJoin() {
        $sql = "SELECT anggota.nama, buku.judul
                FROM anggota
                LEFT JOIN peminjaman ON anggota.id_anggota = peminjaman.id_anggota
                LEFT JOIN detail_pinjam ON peminjaman.id_pinjam = detail_pinjam.id_pinjam
                LEFT JOIN buku ON detail_pinjam.id_buku = buku.id_buku";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Fungsi untuk VIEW (Memanggil View yang ada di Database)
    public function getView() {
        $sql = "SELECT * FROM view_peminjaman";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>