<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PDT Lib</title>
    <link href="assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-sky-100 p-8 h-screen flex gap-8 font-sans text-gray-800">

    <?php require_once 'layouts/sidebar.php'; ?>

    <main class="flex-1 overflow-y-auto pr-3 flex flex-col">

        <div class="max-w-6xl w-full">

            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Dashboard Overview</h1>
                <p class="text-gray-500 mt-1">Sistem Manajemen Perpustakaan Terpadu</p>
            </div>

            <div class="flex-1 space-y-6">

                <?php if (isset($pesan_tambah) && $pesan_tambah): ?>
                    <div class="p-4 rounded-xl shadow-sm border <?php echo $pesan_tambah['status'] == 'success' ? 'bg-green-100 border-green-200 text-green-700' : 'bg-red-100 border-red-200 text-red-700'; ?>">
                        <?= $pesan_tambah['pesan'] ?>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <div class="bg-white/60 backdrop-blur-xl p-6 rounded-2xl shadow-sm border border-white/40 h-fit">
                        <h2 class="text-lg font-bold mb-5 text-gray-800 border-b border-gray-200/50 pb-3">
                            Tambah Buku Baru
                        </h2>

                        <form action="index.php?page=dashboard" method="POST" class="space-y-4">

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1.5">Judul Buku</label>
                                <input type="text" name="judul_buku" required placeholder="Contoh: Belajar PHP Modern" class="w-full bg-white/80 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Stok Awal</label>
                                    <input type="number" name="stok_buku" required min="1" value="1" class="w-full bg-white/80 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1.5">Kategori</label>
                                    <select name="id_kategori" required class="w-full bg-white/80 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition">
                                        <option value="1">Novel</option>
                                        <option value="2">Pendidikan</option>
                                        <option value="3">Sejarah</option>
                                        <option value="4">Komik</option>
                                        <option value="5">Teknologi</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="w-full mt-2 bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-700 hover:shadow-lg transition">
                                Simpan ke Database
                            </button>
                        </form>
                    </div>

                    <div class="bg-white/60 backdrop-blur-xl p-6 rounded-2xl shadow-sm border border-white/40 flex flex-col h-fit">
                        <h2 class="text-lg font-bold mb-5 text-gray-800 border-b border-gray-200/50 pb-3">
                            Peminjaman Terbaru
                        </h2>

                        <div class="overflow-x-auto rounded-lg shadow-sm border border-white/50 flex-1">
                            <table class="w-full text-left border-collapse text-sm bg-white/50 h-full">
                                <thead class="bg-indigo-600 text-white">
                                    <tr>
                                        <th class="px-4 py-2.5 border-b border-indigo-700 font-medium">Peminjam</th>
                                        <th class="px-4 py-2.5 border-b border-indigo-700 font-medium">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($data_peminjaman)): ?>
                                        <tr>
                                            <td colspan="2" class="p-4 text-center text-gray-500">Belum ada data.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($data_peminjaman as $row): ?>
                                            <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                                <td class="px-4 py-3">
                                                    <div class="font-medium text-gray-800"><?= $row['nama'] ?></div>
                                                </td>
                                                <td>
                                                    <div class="text-xs text-gray-500 mt-0.5"><?= date('d M Y', strtotime($row['tanggal'])) ?></div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="flex-1"></div>

        <?php require_once 'layouts/footer.php'; ?>

    </main>
</body>

</html>