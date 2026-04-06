<?php
// src/controllers/DeadlockController.php

class DeadlockController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function prosesA() {
        try {
            $this->pdo->beginTransaction();
            
            // Kunci Buku 1
            $this->pdo->exec("UPDATE buku SET stok = 99 WHERE id_buku = 1");
            echo "<h3>[Proses A] Berhasil mengunci Buku 1. Menunggu 5 detik...</h3>";
            
            // Paksa PHP berhenti 5 detik agar Proses B punya waktu untuk jalan
            ob_flush(); flush(); 
            sleep(5); 
            
            // Coba Kunci Buku 2
            echo "<h3>[Proses A] Mencoba mengakses Buku 2...</h3>";
            $this->pdo->exec("UPDATE buku SET stok = 99 WHERE id_buku = 2");
            
            $this->pdo->commit();
            echo "<h3 style='color:green'>[Proses A] Selesai! Tidak ada Deadlock.</h3>";
            
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "<h3 style='color:red'>[Proses A] GAGAL (Deadlock Terdeteksi): " . $e->getMessage() . "</h3>";
        }
    }

    public function prosesB() {
        try {
            $this->pdo->beginTransaction();
            
            // Kunci Buku 2
            $this->pdo->exec("UPDATE buku SET stok = 88 WHERE id_buku = 2");
            echo "<h3>[Proses B] Berhasil mengunci Buku 2. Mencoba mengakses Buku 1...</h3>";
            
            // Langsung coba kunci Buku 1
            $this->pdo->exec("UPDATE buku SET stok = 88 WHERE id_buku = 1");
            
            $this->pdo->commit();
            echo "<h3 style='color:green'>[Proses B] Selesai! Tidak ada Deadlock.</h3>";
            
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "<h3 style='color:red'>[Proses B] GAGAL (Deadlock Terdeteksi): " . $e->getMessage() . "</h3>";
        }
    }
}
?>