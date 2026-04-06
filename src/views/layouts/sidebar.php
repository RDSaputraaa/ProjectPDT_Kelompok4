<?php
// Deteksi halaman saat ini dari URL (misal: index.php?page=operations)
// Jika tidak ada parameter 'page', anggap sedang di 'dashboard'
$current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Daftar menu dalam bentuk Array agar rapi
$menus = [
    'dashboard' => [
        'title' => 'Dashboard',
        'url' => 'index.php?page=dashboard',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>'
    ],
    'operations' => [
        'title' => 'Operation',
        'url' => 'index.php?page=operations',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8 4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>'
    ],
    'reports' => [
        'title' => 'Reports',
        'url' => 'index.php?page=reports',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>'
    ],
    'checkout' => [
        'title' => 'Checkout',
        'url' => 'index.php?page=checkout',
        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>'
    ]
];
?>

<nav class="w-72 h-full bg-white/40 backdrop-blur-xl border border-white/50 rounded-[35px] flex flex-col p-7 space-y-12 shadow-2xl">
    
    <div class="space-y-5">
        <div class="flex gap-1.5 p-1">
            <span class="w-3 h-3 bg-red-500 rounded-full shadow-inner"></span>
            <span class="w-3 h-3 bg-yellow-400 rounded-full shadow-inner"></span>
            <span class="w-3 h-3 bg-green-500 rounded-full shadow-inner"></span>
        </div>
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tighter pl-2">PERPUS</h1>
    </div>

    <div class="flex-1 space-y-5">
        <span class="text-[11px] font-bold text-gray-600 tracking-[0.15em] pl-3 uppercase">MENU</span>
        
        <div class="space-y-2">
            
            <?php foreach ($menus as $key => $menu): ?>
                <?php
                $isActive = ($current_page === $key);
                
                $link_class = $isActive 
                    ? 'flex items-center gap-3.5 px-4 py-3 rounded-xl text-white bg-emerald-600/90 shadow font-medium' 
                    : 'flex items-center gap-3.5 px-4 py-3 rounded-xl text-gray-700 hover:bg-white/10 transition group';
                
                $icon_class = $isActive 
                    ? 'w-5 h-5' 
                    : 'w-5 h-5 text-gray-500 group-hover:text-gray-800 transition';
                
                $text_class = $isActive 
                    ? '' 
                    : 'font-medium group-hover:text-gray-900 transition';
                ?>
                
                <a href="<?= $menu['url'] ?>" class="<?= $link_class ?>">
                    <svg class="<?= $icon_class ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <?= $menu['icon'] ?>
                    </svg>
                    <span class="<?= $text_class ?>"><?= $menu['title'] ?></span>
                </a>
            <?php endforeach; ?>

        </div>
    </div>
</nav>