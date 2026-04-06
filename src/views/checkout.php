<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Peminjaman - PDT Lib</title>
    <link href="assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-sky-100 p-8 h-screen flex gap-8 font-sans text-gray-800">

    <?php require_once 'layouts/sidebar.php'; ?>

    <main class="flex-1 overflow-y-auto pr-3 flex flex-col">

        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Kasir Peminjaman</h1>
            <p class="text-gray-500 mt-1">Sistem Peminjaman Buku dengan Transaction & Rollback</p>
        </div>

        <div class="flex-1">

            <?php if (isset($pesan_transaksi) && $pesan_transaksi): ?>
                <div class="p-4 mb-6 rounded-2xl font-semibold shadow-sm border <?php echo $pesan_transaksi['status'] == 'success' ? 'bg-green-100 border-green-200 text-green-700' : 'bg-red-100 border-red-200 text-red-700'; ?>">
                    <?= $pesan_transaksi['pesan'] ?>
                </div>
            <?php endif; ?>

            <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-white/40">
                <h2 class="text-xl font-bold mb-6 text-gray-800">Simulasi Pinjam Buku</h2>

                <form action="index.php?page=checkout" method="POST" class="flex flex-wrap gap-4 items-end">

                    <div class="flex-1 min-w-[200px] max-w-sm">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">ID Buku yang dipinjam:</label>
                        <input type="number" name="id_buku" required class="w-full bg-white/80 border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition">
                    </div>

                    <div class="flex-1 min-w-[200px] max-w-sm">
                        <label class="block text-sm font-semibold text-gray-600 mb-2">ID Anggota peminjam:</label>
                        <input type="number" name="id_anggota" required class="w-full bg-white/80 border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 hover:shadow-lg transition">
                        Pinjam Buku
                    </button>

                </form>
            </div>

        </div>

        <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-red-200 mt-8">
            <h2 class="text-xl font-bold mb-6 text-red-700 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus Buku
            </h2>

            <form action="index.php?page=checkout" method="POST" class="flex flex-wrap gap-4 items-end">

                <input type="hidden" name="aksi" value="hapus_buku">

                <div class="flex-1 min-w-[200px] max-w-sm">
                    <label class="block text-sm font-semibold text-gray-600 mb-2">ID Buku yang akan dihapus:</label>
                    <input type="number" name="id_buku" required class="w-full bg-white/80 border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 transition">
                </div>

                <button type="submit" onclick="return confirm('Peringatan: Apakah Anda yakin ingin menghapus buku ini secara permanen?');" class="bg-red-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-600 hover:shadow-lg transition">
                    Hapus Permanen
                </button>

            </form>
        </div>

        <?php require_once 'layouts/footer.php'; ?>

    </main>

</body>

</html>