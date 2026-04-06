<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Operation & Transaction - PDT Lib</title>
    <link href="assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-sky-100 p-8 h-screen flex gap-8 font-sans text-gray-800">

    <?php require_once 'layouts/sidebar.php'; ?>

    <main class="flex-1 overflow-y-auto pr-3 flex flex-col">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Database Operations</h1>
            <p class="text-gray-500 mt-1">Simulasi Set Operation (UNION) dan Database Functions</p>
        </div>

        <div class="flex-1 space-y-8">

            <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-white/40">
                <h2 class="text-xl font-bold mb-6 text-gray-800">1. Set Operation (UNION vs UNION ALL)</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <div>
                        <h3 class="font-semibold text-lg mb-3 text-gray-700">Hasil UNION</h3>
                        <div class="overflow-x-auto rounded-xl shadow-sm border border-white/50">
                            <table class="w-full text-left border-collapse text-sm bg-white/50">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="p-3 border-b border-blue-700">ID</th>
                                        <th class="p-3 border-b border-blue-700">Judul</th>
                                        <th class="p-3 border-b border-blue-700">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data_union as $row): ?>
                                    <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                        <td class="p-3"><?= $row['id_buku'] ?></td>
                                        <td class="p-3 font-medium"><?= $row['judul'] ?></td>
                                        <td class="p-3 text-gray-600"><?= $row['alasan'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-3 text-gray-700">Hasil UNION ALL</h3>
                        <div class="overflow-x-auto rounded-xl shadow-sm border border-white/50">
                            <table class="w-full text-left border-collapse text-sm bg-white/50">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="p-3 border-b border-blue-700">ID</th>
                                        <th class="p-3 border-b border-blue-700">Judul</th>
                                        <th class="p-3 border-b border-blue-700">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data_union_all as $row): ?>
                                    <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                        <td class="p-3"><?= $row['id_buku'] ?></td>
                                        <td class="p-3 font-medium"><?= $row['judul'] ?></td>
                                        <td class="p-3 text-gray-600"><?= $row['alasan'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-white/40">
                <h2 class="text-xl font-bold mb-6 text-gray-800">2. Database Functions</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    <div>
                        <h3 class="font-semibold text-lg mb-3 text-gray-700">Custom Function (cek_stok)</h3>
                        <div class="overflow-x-auto rounded-xl shadow-sm border border-white/50">
                            <table class="w-full text-left border-collapse text-sm bg-white/50">
                                <thead class="bg-purple-600 text-white">
                                    <tr>
                                        <th class="p-3 border-b border-purple-700">Judul Buku</th>
                                        <th class="p-3 border-b border-purple-700 text-center">Sisa Stok</th>
                                        <th class="p-3 border-b border-purple-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data_custom as $row): ?>
                                    <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                        <td class="p-3 font-medium"><?= $row['judul'] ?></td>
                                        <td class="p-3 text-center"><?= $row['stok'] ?></td>
                                        <td class="p-3 font-bold <?= $row['status_ketersediaan'] == 'Tersedia' ? 'text-green-600' : 'text-red-600' ?>">
                                            <?= $row['status_ketersediaan'] ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg mb-3 text-gray-700">Built-in Function (UPPER & COUNT)</h3>
                        <div class="overflow-x-auto rounded-xl shadow-sm border border-white/50">
                            <table class="w-full text-left border-collapse text-sm bg-white/50">
                                <thead class="bg-indigo-600 text-white">
                                    <tr>
                                        <th class="p-3 border-b border-indigo-700">Nama Anggota</th>
                                        <th class="p-3 border-b border-indigo-700 text-center">Total Pinjam</th>
                                        <th class="p-3 border-b border-indigo-700">Transaksi Terakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data_builtin as $row): ?>
                                    <tr class="hover:bg-white/80 border-b border-gray-200/60 transition">
                                        <td class="p-3 font-medium"><?= $row['nama_anggota'] ?></td>
                                        <td class="p-3 text-center">
                                            <span class="bg-white/80 px-2 py-1 rounded text-indigo-700 font-bold"><?= $row['total_transaksi'] ?>x</span>
                                        </td>
                                        <td class="p-3 text-gray-500 text-xs"><?= $row['transaksi_terakhir'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <?php require_once 'layouts/footer.php'; ?>

    </main>

</body>
</html>