

<?php $__env->startSection('title', 'Data Badan Publik'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Daftar Badan Publik</h2>
        <p class="text-sm text-gray-500">Kelola data responden dan status verifikasi kuesioner.</p>
    </div>
</div>

<!-- SEARCH BOX (Opsional) -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
    <form action="" method="GET" class="flex gap-4">
        <input type="text" name="search" placeholder="Cari nama BP..." class="flex-1 border border-gray-300 rounded-md px-4 py-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
            <i class="ph ph-magnifying-glass"></i> Cari
        </button>
    </form>
</div>

<!-- TABEL UTAMA -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-64">Nama Badan Publik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if(isset($data) && count($data) > 0): ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900"><?php echo e($bp->name); ?></div>
                            <!-- Progress bar sederhana -->
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                <div class="bg-blue-600 h-1.5 rounded-full" style="width: <?php echo e($bp->jawaban_count > 0 ? '75%' : '0%'); ?>"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <?php echo e($bp->kelas->nama_kelas ?? 'Umum'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo e($bp->email); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <!-- BADGE STATUS BERWARNA -->
                            <?php if($bp->status === 'Terverifikasi'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Terverifikasi</span>
                            <?php elseif($bp->status === 'Dikembalikan'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dikembalikan</span>
                            <?php elseif($bp->status === 'Telah Diperbaiki'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Telah Diperbaiki</span>
                            <?php elseif($bp->status === 'Menunggu Verifikasi'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                            <?php else: ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"><?php echo e($bp->status ?? 'Belum Aktif'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href="<?php echo e(route('admin.evaluasi.show', $bp->id)); ?>" class="text-blue-600 hover:text-blue-900 font-bold mr-3">
                                <i class="ph ph-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <i class="ph ph-folder-open text-4xl text-gray-300 mb-2"></i>
                                <p class="text-gray-500">Tidak ada data Badan Publik ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination (Placeholder) -->
    <?php if(isset($data) && $data->count() > 10): ?>
    <div class="bg-white px-4 py-3 border-t border-gray-200 flex items-center justify-between">
        <div class="text-sm text-gray-500">Menampilkan 1-10 dari 50 data</div>
        <div class="flex gap-2">
            <button class="px-3 py-1 border rounded text-gray-600">Prev</button>
            <button class="px-3 py-1 border rounded bg-blue-600 text-white">1</button>
            <button class="px-3 py-1 border rounded text-gray-600">Next</button>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\emonev-2026\resources\views/admin/bp_list.blade.php ENDPATH**/ ?>