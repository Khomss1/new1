

<?php $__env->startSection('title', 'Dashboard Badan Publik'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Halo, <?php echo e(Auth::user()->name); ?></h3>
        <div class="mt-2 max-w-xl text-sm text-gray-500">
            Silakan lengkapi data kuesioner Monitoring dan Evaluasi KI Sumbar.
        </div>
        
        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-blue-50 p-4 rounded border border-blue-100">
                <span class="text-sm font-semibold text-blue-800">Status Pengisian</span>
                <div class="text-2xl font-bold text-blue-900 mt-2">
                    <?php echo e($answeredCount ?? 0); ?> / <?php echo e($questionCount ?? 0); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- BAGIAN STATUS & TOMBOL AKSI (Disatukan) -->
<div class="mt-8 space-y-6">

    
    <?php if(auth()->user()->status === 'Terverifikasi'): ?>
        <div class="bg-green-50 border border-green-200 rounded-lg p-5 shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="ph ph-check-circle text-4xl text-green-600"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg font-bold text-green-900">Kuesioner Terverifikasi</h4>
                    <p class="text-sm text-green-700 mt-1">
                        Selamat! Data kuesioner Anda telah diverifikasi. Nilai akhir telah ditetapkan oleh Verifikator.
                    </p>
                    <p class="text-xs text-green-600 mt-2 font-semibold italic">
                        Formulir dikunci dan tidak dapat diubah atau direvisi kembali.
                    </p>
                </div>
            </div>
            <!-- TOMBOL EDIT HILANG -->
        </div>


    
    <?php elseif(auth()->user()->status === 'Dikembalikan'): ?>
        <div class="bg-orange-50 border-l-4 border-orange-500 rounded-lg p-4 shadow-sm">
            <h4 class="font-bold text-orange-800 flex items-center">
                <i class="ph ph-arrow-u-up-left mr-2"></i> Dikembalikan untuk Revisi
            </h4>
            <div class="mt-2 p-3 bg-white border border-orange-200 rounded text-sm text-gray-700">
                <span class="font-bold text-orange-600 block mb-1">Catatan Admin:</span>
                "<?php echo e(Auth::user()->catatan_pengembalian ?? '-'); ?>"
            </div>
        </div>
        
        <div class="mt-4">
            <a href="<?php echo e(route('bp.kuesioner')); ?>" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 shadow-sm transition">
                <i class="ph ph-pencil-simple mr-2 text-lg"></i> Revisi Kuesioner
            </a>
        </div>


    
    <?php elseif(in_array(auth()->user()->status, ['Menunggu Verifikasi', 'Telah Diperbaiki'])): ?>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5 shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="ph ph-hourglass text-4xl text-yellow-600 animate-spin-slow"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg font-bold text-yellow-900">Sedang Diproses</h4>
                    <p class="text-sm text-yellow-700 mt-1">
                        Kuesioner Anda sedang ditinjau dan diverifikasi oleh Admin. Form dikunci sementara.
                    </p>
                    <p class="text-xs text-yellow-600 mt-2 font-semibold">
                        Silakan tunggu hasil verifikasi di Dashboard ini.
                    </p>
                </div>
            </div>
        </div>


    
    <?php elseif(auth()->user()->status === 'Masa Sanggah'): ?>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="ph ph-files text-4xl text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg font-bold text-blue-900">Masa Sanggah</h4>
                    <p class="text-sm text-blue-700 mt-1">
                        Status kuesioner Anda saat ini adalah Masa Sanggah. Tidak ada perubahan yang dapat dilakukan.
                    </p>
                </div>
            </div>
        </div>


    
    <?php else: ?>
        <div class="text-sm text-gray-600 mb-4">
            Anda belum mengisi kuesioner. Silakan lengkapi data di bawah ini.
        </div>
        <a href="<?php echo e(route('bp.kuesioner')); ?>" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-800 shadow-sm transition">
            <i class="ph ph-pencil-simple mr-2 text-lg"></i> Isi Kuesioner
        </a>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.bp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\emonev-2026\resources\views/bp/dashboard.blade.php ENDPATH**/ ?>