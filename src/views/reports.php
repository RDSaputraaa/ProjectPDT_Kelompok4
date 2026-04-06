<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data - PDT Lib</title>
    <link href="assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-sky-100 p-8 h-screen flex gap-8 font-sans text-gray-800">

    <?php require_once 'layouts/sidebar.php'; ?>

    <main class="flex-1 overflow-y-auto pr-3 flex flex-col">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Laporan Data</h1>
            <p class="text-gray-500 mt-1">Materi Views & Join Database</p>
        </div>

        <div class="flex-1 space-y-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-white/40 flex flex-col">
                    <h2 class="text-xl font-bold mb-2 text-gray-800">1. INNER JOIN</h2>
                    <p class="text-sm text-gray-600 mb-6 font-medium">Hanya menampilkan anggota yang melakukan peminjaman.</p>
                    
                    <div class="overflow-x-auto rounded-xl shadow-sm border border-white/50 flex-1">
                        <table class="w-full text-left border-collapse text-sm bg-white/50 h-full">
                            <thead class="bg-emerald-600 text-white">
                                <tr>
                                    <th class="p-3 border-b border-emerald-700">Nama Anggota</th>
                                    <th class="p-3 border-b border-emerald-700">Tanggal Pinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data_inner as $row): ?>
                                <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                    <td class="p-3 font-medium"><?= $row['nama'] ?></td>
                                    <td class="p-3 text-gray-600"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-white/40 flex flex-col">
                    <h2 class="text-xl font-bold mb-2 text-gray-800">2. LEFT JOIN</h2>
                    <p class="text-sm text-gray-600 mb-6 font-medium">Menampilkan semua anggota, termasuk yang tidak meminjam.</p>
                    
                    <div class="overflow-x-auto rounded-xl shadow-sm border border-white/50 flex-1">
                        <table class="w-full text-left border-collapse text-sm bg-white/50 h-full">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="p-3 border-b border-blue-700">Nama Anggota</th>
                                    <th class="p-3 border-b border-blue-700">Judul Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data_left as $row): ?>
                                <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                    <td class="p-3 font-medium"><?= $row['nama'] ?></td>
                                    <td class="p-3 text-gray-600">
                                        <?= $row['judul'] ? $row['judul'] : '<span class="bg-white/80 px-2 py-1 rounded shadow-sm text-gray-500 font-bold text-xs border border-white">Belum meminjam</span>' ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-white/40">
                <h2 class="text-xl font-bold mb-2 text-gray-800">3. Data dari VIEW Database</h2>
                <p class="text-sm text-gray-600 mb-6 font-medium">Hasil query kompleks (gabungan 4 tabel) yang sudah dibungkus rapi oleh MySQL.</p>
                
                <div class="overflow-x-auto rounded-xl shadow-sm border border-white/50">
                    <table class="w-full text-left border-collapse text-sm bg-white/50">
                        <thead class="bg-slate-800 text-white">
                            <tr>
                                <th class="p-3 border-b border-slate-900">Nama Anggota</th>
                                <th class="p-3 border-b border-slate-900">Judul Buku</th>
                                <th class="p-3 border-b border-slate-900">Tanggal Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data_view as $row): ?>
                            <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                <td class="p-3 font-medium"><?= $row['nama_anggota'] ?></td>
                                <td class="p-3 text-gray-700"><?= $row['judul'] ?></td>
                                <td class="p-3 text-gray-500 text-xs"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <?php require_once 'layouts/footer.php'; ?>

    </main>

</body>
</html>