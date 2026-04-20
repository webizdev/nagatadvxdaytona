<?php $__env->startSection('content'); ?>
    
    <section class="bg-daytona-navy py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h2 class="text-daytona-orange font-black uppercase tracking-[0.4em] text-[10px] mb-2">Offline Store</h2>
                    <h1 class="text-white text-4xl font-black italic tracking-tighter uppercase leading-none">
                        Lokasi <span class="text-daytona-orange">Dealer</span>
                    </h1>
                </div>
                <div class="max-w-md">
                    <p class="text-slate-300 text-sm font-medium border-l-4 border-daytona-orange pl-4 leading-relaxed">
                        Temukan suku cadang resmi Nagata Daytona dan performa maksimal untuk motor Anda di bengkel atau toko sparepart terdekat.
                    </p>
                </div>
            </div>
        </div>
        <div class="absolute left-full top-0 h-full w-1/2 bg-white/5 -skew-x-12 -translate-x-32 hidden md:block"></div>
    </section>

    
    <div class="bg-slate-50 py-16 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="max-w-7xl mx-auto">
            
            <?php $__empty_1 = true; $__currentLoopData = $dealersByCity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city => $dealers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="mb-16 last:mb-0">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-2 h-8 bg-daytona-orange rounded-full"></div>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-800 uppercase tracking-tight">
                            <?php echo e($city); ?>

                        </h2>
                        <div class="h-px bg-slate-200 flex-1 ml-4 hidden sm:block"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $dealers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dealer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200 hover:shadow-lg hover:border-daytona-orange/50 transition-all duration-300 flex flex-col relative group">
                                <div class="flex items-start justify-between mb-3 gap-2">
                                    <!-- Store Icon + Title -->
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-slate-50 rounded-lg group-hover:bg-daytona-orange/10 transition-colors shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-slate-400 group-hover:text-daytona-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <h3 class="text-base font-bold text-slate-800 leading-tight group-hover:text-daytona-orange transition-colors">
                                            <?php echo e($dealer->nama_toko); ?>

                                        </h3>
                                    </div>
                                    <!-- Prominent Map Link -->
                                    <a href="https://maps.google.com/?q=<?php echo e(urlencode($dealer->nama_toko . ' ' . $dealer->alamat . ' ' . $city)); ?>" target="_blank" title="Buka di Peta"
                                       class="shrink-0 p-2.5 bg-daytona-orange text-white rounded-full shadow-md hover:bg-daytona-navy hover:scale-110 hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </a>
                                </div>
                                
                                <p class="text-slate-500 text-[13px] leading-relaxed mb-4 flex-1">
                                    <?php echo e($dealer->alamat); ?>

                                </p>

                                <?php if($dealer->no_telp): ?>
                                    <div class="pt-3 border-t border-slate-100 mt-auto">
                                        <a href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $dealer->no_telp)); ?>" class="inline-flex items-center gap-2 text-[12px] font-bold tracking-wide uppercase text-slate-500 hover:text-daytona-orange transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            <?php echo e($dealer->no_telp); ?>

                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-20">
                    <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Belum ada data dealer</h3>
                    <p class="text-slate-500">Saat ini data lokasi dealer belum tersedia di sistem kami.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/dealers/index.blade.php ENDPATH**/ ?>