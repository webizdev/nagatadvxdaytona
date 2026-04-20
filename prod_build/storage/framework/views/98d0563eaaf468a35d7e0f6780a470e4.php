<?php $__env->startSection('title', 'Manajemen Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden">
    <div class="p-6 border-b border-slate-700 flex justify-between items-center">
        <h3 class="font-bold text-lg text-white">Daftar Produk</h3>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-bold transition-all flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Produk</span>
        </a>
    </div>
    
    <div class="p-6">
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 text-green-500 rounded-xl">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <table class="w-full text-left">
            <thead class="text-xs uppercase text-slate-500 font-bold border-b border-slate-700">
                <tr>
                    <th class="pb-4 px-2">Produk</th>
                    <th class="pb-4 px-2">SKU</th>
                    <th class="pb-4 px-2">Kategori</th>
                    <th class="pb-4 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-slate-700/50 hover:bg-slate-700/20 transition-all">
                    <td class="py-4 px-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-lg bg-slate-900 border border-slate-700 flex-shrink-0 overflow-hidden">
                                <?php if($prod->image_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $prod->image_path)); ?>" alt="<?php echo e($prod->name); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-slate-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <p class="text-slate-100 font-medium"><?php echo e($prod->name); ?></p>
                                <p class="text-xs text-slate-500 truncate max-w-[200px]"><?php echo e($prod->slug); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-2 text-slate-400 font-mono"><?php echo e($prod->sku); ?></td>
                    <td class="py-4 px-2">
                        <span class="px-2 py-1 rounded-md bg-slate-700 text-slate-300 text-xs"><?php echo e($prod->category->name ?? 'Uncategorized'); ?></span>
                    </td>
                    <td class="py-4 px-2 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="<?php echo e(route('admin.products.edit', $prod)); ?>" class="p-2 text-blue-400 hover:bg-blue-400/10 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="<?php echo e(route('admin.products.destroy', $prod)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="py-10 text-center text-slate-500 italic">Belum ada produk yang ditambahkan.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/admin/products/index.blade.php ENDPATH**/ ?>