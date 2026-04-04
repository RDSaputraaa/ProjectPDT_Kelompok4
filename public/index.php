<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Dashboard</title>
    
    <link href="assets/css/output.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white flex flex-col">
        <div class="h-16 flex items-center justify-center border-b border-slate-700">
            <h1 class="text-xl font-bold tracking-wider">📚 E-PERPUS</h1>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="#" class="block px-4 py-2.5 bg-blue-600 rounded-lg font-medium transition hover:bg-blue-700">📊 Dashboard</a>
            <a href="#" class="block px-4 py-2.5 rounded-lg font-medium transition hover:bg-slate-800">📖 Katalog Buku</a>
            <a href="#" class="block px-4 py-2.5 rounded-lg font-medium transition hover:bg-slate-800">🔄 Transaksi Pinjam</a>
            <a href="#" class="block px-4 py-2.5 rounded-lg font-medium transition hover:bg-slate-800">👥 Data Anggota</a>
            <a href="#" class="block px-4 py-2.5 rounded-lg font-medium transition hover:bg-slate-800">📑 Laporan</a>
        </nav>
        <div class="p-4 border-t border-slate-700">
            <button class="w-full px-4 py-2 text-sm text-red-400 border border-red-400 rounded-lg hover:bg-red-500 hover:text-white transition">
                Logout
            </button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8">
            <h2 class="text-2xl font-semibold text-gray-700">Dashboard Overview</h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-500">Halo, Admin Nafis!</span>
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                    N
                </div>
            </div>
        </header>

        <div class="p-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                    <span class="text-gray-500 text-sm font-semibold uppercase">Total Buku</span>
                    <span class="text-3xl font-bold text-slate-800 mt-2">1,240</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                    <span class="text-gray-500 text-sm font-semibold uppercase">Total Anggota</span>
                    <span class="text-3xl font-bold text-blue-600 mt-2">350</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                    <span class="text-gray-500 text-sm font-semibold uppercase">Sedang Dipinjam</span>
                    <span class="text-3xl font-bold text-amber-500 mt-2">45</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col">
                    <span class="text-gray-500 text-sm font-semibold uppercase">Pendapatan Denda</span>
                    <span class="text-3xl font-bold text-red-500 mt-2">Rp 125K</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700">Peminjaman Terbaru</h3>
                    <button class="text-sm text-blue-600 hover:underline">Lihat Semua</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                                <th class="px-6 py-3 font-medium">Peminjam</th>
                                <th class="px-6 py-3 font-medium">Judul Buku</th>
                                <th class="px-6 py-3 font-medium">Tgl Pinjam</th>
                                <th class="px-6 py-3 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">Ahmad Budi</td>
                                <td class="px-6 py-4">Bumi Manusia</td>
                                <td class="px-6 py-4">04 Apr 2026</td>
                                <td class="px-6 py-4"><span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-semibold">Dipinjam</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">Siti Aminah</td>
                                <td class="px-6 py-4">Laskar Pelangi</td>
                                <td class="px-6 py-4">01 Apr 2026</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Dikembalikan</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>