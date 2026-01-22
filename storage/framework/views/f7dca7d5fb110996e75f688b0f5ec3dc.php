<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Responden Portal'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    <!-- Navbar Sederhana -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <i class="ph ph-scales text-2xl text-blue-900"></i>
                    <span class="font-bold text-lg text-blue-900">e-Monev Responden</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Halo, <?php echo e(Auth::user()->name); ?></span>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button class="text-sm text-red-500 font-medium hover:text-red-700">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html><?php /**PATH C:\xampp\htdocs\emonev-2026\resources\views/layouts/bp.blade.php ENDPATH**/ ?>