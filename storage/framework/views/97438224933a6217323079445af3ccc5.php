<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'e-Monev 2026'); ?></title>
    
    <!-- Menggunakan Tailwind CSS agar tampilan bagus -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome / Phosphor Icons (Sesuaikan dengan library Anda) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- WRAPPER UTAMA -->
    <div class="flex flex-col md:flex-row">

        <!-- SIDEBAR (KIRI) -->
        <aside class="w-full md:w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col h-screen sticky top-0">
            <!-- Logo -->
            <div class="h-16 flex items-center justify-center border-b border-slate-800 bg-blue-900">
                <div class="flex items-center gap-2">
                    <i class="ph ph-scales text-2xl text-yellow-500"></i>
                    <span class="text-lg font-bold tracking-wide">e-Monev 2026</span>
                </div>
            </div>

            <!-- Menu Sidebar -->
            <nav class="flex-1 overflow-y-auto py-4">
                <div class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Utama</div>
                
                <!-- Dashboard -->
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors hover:bg-slate-800 <?php echo e(request()->is('admin/dashboard') ? 'bg-blue-900 border-r-4 border-yellow-500' : 'text-gray-300'); ?>">
                    <i class="ph ph-squares-four text-xl"></i> Dashboard
                </a>

                <!-- Data BP -->
                <a href="<?php echo e(route('admin.bp.index')); ?>" class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors hover:bg-slate-800 <?php echo e(request()->is('admin/bp*') ? 'bg-blue-900 border-r-4 border-yellow-500' : 'text-gray-300'); ?>">
                    <i class="ph ph-users-three text-xl"></i> Data Badan Publik
                </a>

                <!-- Hasil Kuesioner -->
                <a href="<?php echo e(route('admin.evaluasi.index')); ?>" class="flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors hover:bg-slate-800 <?php echo e(request()->is('admin/evaluasi*') ? 'bg-blue-900 border-r-4 border-yellow-500' : 'text-gray-300'); ?>">
                    <i class="ph ph-clipboard-text text-xl"></i> Hasil Kuesioner
                </a>
            </nav>

            <!-- Profil & Logout (Bawah Sidebar) -->
            <div class="p-4 border-t border-slate-800 bg-slate-900">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center font-bold">
                        <?php echo e(substr(Auth::user()->name, 0, 1) ?? 'A'); ?>

                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-200"><?php echo e(Auth::user()->name); ?></p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full text-left text-xs font-semibold text-red-400 hover:text-red-300 flex items-center gap-2 transition-colors">
                        <i class="ph ph-sign-out text-lg"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA (KANAN) -->
        <main class="flex-1 bg-gray-100 w-full relative">
            
            <!-- Header Mobile / Top Bar -->
            <div class="bg-white shadow h-16 flex justify-between items-center px-6 sticky top-0 z-10">
                <h2 class="text-xl font-bold text-gray-800"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h2>
                <!-- Tambahkan menu notifikasi atau lainnya jika perlu -->
            </div>

            <!-- Area Isi -->
            <div class="p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            
        </main>

    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\emonev-2026\resources\views/layouts/app.blade.php ENDPATH**/ ?>