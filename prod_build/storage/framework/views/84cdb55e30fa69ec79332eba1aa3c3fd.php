<?php $__env->startSection('title', 'NAGATA DAYTONA - Quality Performance Parts'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="relative h-[85vh] flex items-center overflow-hidden bg-slate-900">
    <!-- Background Image / Overlay -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-daytona-navy to-transparent z-10 opacity-90"></div>
        <img src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Racing Background">
    </div>

    <!-- Hero Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 w-full">
        <div class="max-w-2xl space-y-6">
            <h2 class="text-daytona-orange font-black uppercase tracking-[0.3em] text-sm md:text-base animate-fade-in-down">
                Ultimate Performance Division
            </h2>
            <h1 class="text-white text-5xl md:text-8xl font-black italic tracking-tighter leading-[0.9] uppercase">
                PUSH THE <span class="text-daytona-orange">LIMITS</span> <br>OF SPEED
            </h1>
            <p class="text-slate-300 text-base md:text-lg font-medium max-w-lg leading-relaxed pt-2">
                Nagata Daytona menghadirkan komponen racing premium yang dirancang untuk performa maksimal di lintasan balap dan keandalan di jalan raya.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 pt-10">
                <a href="<?php echo e(route('products.index')); ?>" class="bg-daytona-orange text-white px-8 py-4 rounded-sm font-black uppercase tracking-widest hover:bg-white hover:text-daytona-orange transition-all duration-300 shadow-2xl flex items-center justify-center w-full sm:w-fit group">
                    Cek Produk
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <a href="<?php echo e(route('about')); ?>" class="border-2 border-white/30 text-white px-8 py-4 rounded-sm font-black uppercase tracking-widest hover:bg-white/10 transition-all duration-300 flex items-center justify-center w-full sm:w-fit">
                    Tentang Kami
                </a>
            </div>
        </div>
    </div>

    <!-- Decorative Element -->
    <div class="absolute right-0 bottom-0 w-1/3 h-full bg-daytona-orange italic opacity-10 blur-3xl -rotate-12 translate-x-1/2 translate-y-1/2"></div>
</section>


<section class="bg-daytona-navy py-14 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">

            
            <div class="lg:w-72 xl:w-80 shrink-0 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-6 bg-slate-500 rounded-full"></div>
                    <span class="text-slate-400 font-black uppercase tracking-[0.3em] text-[10px]">Quick Filter</span>
                </div>
                <h2 class="text-slate-200 text-2xl md:text-3xl font-black italic uppercase tracking-tighter leading-tight">
                    Cari Part untuk<br>
                    <span class="text-slate-400">Motor Anda</span>
                </h2>
                <p class="text-slate-500 text-xs mt-3 font-medium leading-relaxed">
                    Pilih merk &amp; model, temukan semua suku cadang yang kompatibel.
                </p>
            </div>

            
            <div class="flex-1 w-full">
                <?php if (isset($component)) { $__componentOriginala2cc979615fadf910cf1ab380b365f18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2cc979615fadf910cf1ab380b365f18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.find-my-part','data' => ['motorcyclesByBrand' => $motorcyclesByBrand,'dark' => true,'horizontal' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('find-my-part'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['motorcyclesByBrand' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($motorcyclesByBrand),'dark' => true,'horizontal' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2cc979615fadf910cf1ab380b365f18)): ?>
<?php $attributes = $__attributesOriginala2cc979615fadf910cf1ab380b365f18; ?>
<?php unset($__attributesOriginala2cc979615fadf910cf1ab380b365f18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2cc979615fadf910cf1ab380b365f18)): ?>
<?php $component = $__componentOriginala2cc979615fadf910cf1ab380b365f18; ?>
<?php unset($__componentOriginala2cc979615fadf910cf1ab380b365f18); ?>
<?php endif; ?>
            </div>

        </div>
    </div>
</section>


<!-- Feature/Highlight Section -->
<section class="py-32 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-6 p-10 bg-slate-50 border-b-4 border-daytona-orange group hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-2xl">
                <div class="bg-daytona-orange/10 p-4 rounded-full w-fit text-daytona-orange group-hover:bg-daytona-orange group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-black uppercase italic tracking-tighter leading-none">Maximum Power</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Dirancang untuk meningkatkan output daya mesin Anda secara signifikan dengan presisi yang tinggi melalui teknologi aliran udara optimal.
                </p>
            </div>

            <div class="space-y-6 p-10 bg-slate-50 border-b-4 border-daytona-navy group hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-2xl">
                <div class="bg-daytona-navy/10 p-4 rounded-full w-fit text-daytona-navy group-hover:bg-daytona-navy group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-2xl font-black uppercase italic tracking-tighter leading-none">Durability</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Material kualitas industri penerbangan memberikan ketahanan luar biasa bahkan dalam kondisi balapan paling ekstrem sekalipun.
                </p>
            </div>

            <div class="space-y-6 p-10 bg-slate-50 border-b-4 border-daytona-orange group hover:-translate-y-2 transition-all duration-300 shadow-sm hover:shadow-2xl">
                <div class="bg-daytona-orange/10 p-4 rounded-full w-fit text-daytona-orange group-hover:bg-daytona-orange group-hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.628.281a2 2 0 01-1.18.124l-2.404-.481a4 4 0 01-2.484-1.555 1.5 1.5 0 112.121-2.121 1.5 1.5 0 012.121 2.121z"></path></svg>
                </div>
                <h3 class="text-2xl font-black uppercase italic tracking-tighter leading-none">Track Tested</h3>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Setiap komponen telah diuji coba secara ketat di berbagai sirkuit internasional untuk memastikan standar balap tertinggi.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Latest Products Section -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div class="space-y-2">
                <h2 class="text-daytona-orange font-black uppercase tracking-widest text-sm">Our Collection</h2>
                <h3 class="text-4xl font-black italic tracking-tighter uppercase leading-none">Latest <span class="text-daytona-orange">Products</span></h3>
            </div>
            <a href="#" class="text-sm font-bold uppercase tracking-widest text-daytona-navy hover:text-daytona-orange transition-all border-b-2 border-daytona-navy hover:border-daytona-orange pb-1">
                View All Collection
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            <?php $__currentLoopData = $latestProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white group rounded-sm overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col h-full relative">
                <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="absolute inset-0 z-10"></a>
                <!-- Product Image -->
                <div class="aspect-square overflow-hidden bg-slate-100 relative">
                    <?php if($product->image_path): ?>
                        <img src="<?php echo e(asset('storage/' . $product->image_path)); ?>" 
                             alt="<?php echo e($product->name); ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Overlay / Badge (Optional) -->
                    <div class="absolute top-4 left-4">
                        <span class="bg-daytona-orange text-white text-[10px] font-black uppercase px-2 py-1 tracking-widest">New</span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-5 flex-1 flex flex-col">
                    <p class="text-[10px] font-black text-daytona-orange uppercase tracking-widest mb-1">
                        <?php echo e($product->category->name ?? 'Racing Part'); ?>

                    </p>
                    <h4 class="text-lg font-bold text-slate-900 group-hover:text-daytona-orange transition-colors duration-300 mb-2 leading-snug">
                        <?php echo e($product->name); ?>

                    </h4>
                    <div class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">SKU: <?php echo e($product->sku); ?></span>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-daytona-orange group-hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <?php if($latestProducts->isEmpty()): ?>
        <div class="text-center py-20 bg-white rounded-xl border-2 border-dashed border-slate-200">
            <p class="text-slate-400 italic">Belum ada produk yang ditampilkan.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/welcome.blade.php ENDPATH**/ ?>