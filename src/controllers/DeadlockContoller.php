<?php
// src/controllers/DeadlockContoller.php
// (nama file sengaja dibiarkan sama agar tidak perlu ubah require di index.php)

class DeadlockController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function prosesA() {
        echo "<h2 style='font-family:monospace; padding:20px'>";
        echo "⚙️ <strong>[Proses A] Mulai...</strong><br><br>";
        
        try {
            $this->pdo->beginTransaction();

            // Langkah 1: Kunci tabel BUKU
            $this->pdo->exec("UPDATE buku SET stok = stok WHERE id_buku = 1");
            echo "🔒 [Proses A] Berhasil mengunci <strong>Buku id=1</strong><br>";
            echo "⏳ [Proses A] Menunggu 5 detik sebelum mencoba kunci Anggota...<br>";
            ob_flush(); flush();
            sleep(5);

            // Langkah 2: Coba kunci tabel ANGGOTA (yang sudah dikunci Proses B)
            echo "➡️  [Proses A] Mencoba mengunci <strong>Anggota id=1</strong>...<br>";
            ob_flush(); flush();
            $this->pdo->exec("UPDATE anggota SET nama = nama WHERE id_anggota = 1");

            $this->pdo->commit();
            echo "<br>✅ <strong style='color:green'>[Proses A] COMMIT berhasil! Tidak terkena deadlock.</strong>";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "<br>❌ <strong style='color:red'>[Proses A] ROLLBACK! Deadlock terdeteksi oleh MySQL.</strong><br>";
            echo "<small style='color:#666'>Detail: " . $e->getMessage() . "</small>";
        }
        echo "</h2>";
    }

    public function prosesB() {
        echo "<h2 style='font-family:monospace; padding:20px'>";
        echo "⚙️ <strong>[Proses B] Mulai...</strong><br><br>";

        try {
            $this->pdo->beginTransaction();

            // Langkah 1: Kunci tabel ANGGOTA (berlawanan dengan Proses A)
            $this->pdo->exec("UPDATE anggota SET nama = nama WHERE id_anggota = 1");
            echo "🔒 [Proses B] Berhasil mengunci <strong>Anggota id=1</strong><br>";
            echo "➡️  [Proses B] Langsung mencoba mengunci <strong>Buku id=1</strong>...<br>";
            ob_flush(); flush();

            // Langkah 2: Coba kunci tabel BUKU (yang sudah dikunci Proses A)
            $this->pdo->exec("UPDATE buku SET stok = stok WHERE id_buku = 1");

            $this->pdo->commit();
            echo "<br>✅ <strong style='color:green'>[Proses B] COMMIT berhasil! Tidak terkena deadlock.</strong>";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo "<br>❌ <strong style='color:red'>[Proses B] ROLLBACK! Deadlock terdeteksi oleh MySQL.</strong><br>";
            echo "<small style='color:#666'>Detail: " . $e->getMessage() . "</small>";
        }
        echo "</h2>";
    }
}
?>