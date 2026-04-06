<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Deadlock - PDT Lib</title>
    <link href="assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-sky-100 p-8 h-screen flex gap-8 font-sans text-gray-800">

    <?php require_once 'layouts/sidebar.php'; ?>

    <main class="flex-1 overflow-y-auto pr-3 flex flex-col">

        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Simulasi Deadlock</h1>
            <p class="text-gray-500 mt-1">Materi Uji Coba Tabrakan Transaksi (Kelompok 4)</p>
        </div>

        <div class="flex-1">
            <div class="bg-white/60 backdrop-blur-xl p-8 rounded-[30px] shadow-sm border border-white/40 max-w-2xl">
                
                <h2 class="text-xl font-bold mb-4 text-gray-800">Instruksi Uji Coba:</h2>
                <ol class="list-decimal list-inside text-gray-600 mb-8 space-y-2">
                    <li>Klik tombol <strong>"Jalankan Proses A"</strong> terlebih dahulu. Tab baru akan terbuka.</li>
                    <li>Sambil Proses A menunggu 5 detik, segera kembali ke sini dan klik <strong>"Jalankan Proses B"</strong>.</li>
                    <li>Lihat apa yang terjadi pada kedua tab tersebut! Salah satu pasti akan dikorbankan oleh MySQL.</li>
                </ol>

                <div class="flex flex-wrap gap-4">
                    <a href="index.php?page=deadlock&proses=A" target="_blank" 
                       class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700 hover:shadow-lg transition text-center flex-1">
                        Jalankan Proses A
                    </a>
                    
                    <a href="index.php?page=deadlock&proses=B" target="_blank" 
                       class="bg-red-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-600 hover:shadow-lg transition text-center flex-1">
                        Jalankan Proses B
                    </a>
                </div>

            </div>
        </div>

        <?php require_once 'layouts/footer.php'; ?>

    </main>

</body>
</html>