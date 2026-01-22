<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - e-Monev 2026</title>
    
    <!-- Load Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Load Tailwind (CDN Karena kita pakai cara darurat) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        kiBlue: {
                            900: '#1e3a8a',
                        },
                        kiGold: {
                            500: '#d97706',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 h-screen flex justify-center items-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden p-8">
        
        <!-- Header Login -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-900 text-white mb-4">
                <i class="ph ph-scales text-3xl text-yellow-500"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">e-Monev KI Sumbar</h2>
            <p class="text-sm text-gray-500 mt-2">Silakan login untuk mengakses Dashboard</p>
        </div>

        <!-- Form Login -->
        <form method="POST" action="<?php echo e(route('login.submit')); ?>">
            <?php echo csrf_field(); ?>

            <!-- Error Message (Jika Gagal) -->
            <?php if($errors->any()): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Error</p>
                    <p><?php echo e($errors->first('email')); ?></p>
                </div>
            <?php endif; ?>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" 
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition" placeholder="admin@sumbar.go.id" required>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" 
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition" placeholder="••••••••" required>
            </div>

            <!-- Tombol Login -->
            <button type="submit" 
                    class="w-full bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-lg transform active:scale-95 transition duration-200">
                Masuk Dashboard
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-6 text-center text-xs text-gray-400">
            &copy; 2026 Komisi Informasi Sumatera Barat. All rights reserved.
        </div>
    </div>

    <!-- Icons Load -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\emonev-2026\resources\views/auth/login.blade.php ENDPATH**/ ?>