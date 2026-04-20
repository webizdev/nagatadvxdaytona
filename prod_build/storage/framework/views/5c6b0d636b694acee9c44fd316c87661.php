<?php $__env->startSection('title', 'Katalog Produk - Nagata Daytona'); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="bg-daytona-navy py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-daytona-orange font-black uppercase tracking-[0.4em] text-[10px] mb-2">Performance Catalog</h2>
                <h1 class="text-white text-4xl font-black italic tracking-tighter uppercase leading-none">
                    Product <span class="text-daytona-orange">Catalog</span>
                </h1>
            </div>
            <?php if($activeCategory): ?>
                <div class="bg-white/5 border border-white/10 px-6 py-3 rounded-sm flex items-center space-x-3">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Filter:</span>
                    <span class="text-daytona-orange font-bold text-sm uppercase tracking-wider"><?php echo e($activeCategory->name); ?></span>
                    <a href="<?php echo e(route('products.index')); ?>" class="text-white/40 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- Sidebar: 3-Level Category Filter -->
            <aside class="w-full lg:w-72 shrink-0">
                <div class="sticky top-28 space-y-8">
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-[0.2em] text-slate-900 border-l-4 border-daytona-orange pl-4 mb-8 leading-none">Categories</h3>
                        
                        <div class="space-y-4">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lvl1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div x-data="{ open: <?php echo e((request('category') == $lvl1->slug || ($activeCategory && $activeCategory->parent_id == $lvl1->id)) ? 'true' : 'false'); ?> }" class="border-b border-slate-100 pb-4">
                                <!-- Level 1 -->
                                <div class="flex items-center justify-between group cursor-pointer" @click="open = !open">
                                    <a href="<?php echo e(route('products.index', ['category' => $lvl1->slug])); ?>" 
                                       @click.stop 
                                       class="text-sm font-black uppercase tracking-widest transition-colors duration-300 <?php echo e(request('category') == $lvl1->slug ? 'text-daytona-orange' : 'text-slate-700 hover:text-daytona-orange'); ?>">
                                        <?php echo e($lvl1->name); ?>

                                    </a>
                                    <?php if($lvl1->children->count() > 0): ?>
                                    <button class="text-slate-400 group-hover:text-daytona-orange transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    <?php endif; ?>
                                </div>

                                <!-- Level 2 -->
                                <?php if($lvl1->children->count() > 0): ?>
                                <div x-show="open" x-collapse x-cloak class="mt-4 ml-4 space-y-3">
                                    <?php $__currentLoopData = $lvl1->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lvl2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div x-data="{ openLvl2: <?php echo e((request('category') == $lvl2->slug) ? 'true' : 'false'); ?> }">
                                        <div class="flex items-center justify-between group cursor-pointer" @click="openLvl2 = !openLvl2">
                                            <a href="<?php echo e(route('products.index', ['category' => $lvl2->slug])); ?>" 
                                               @click.stop
                                               class="text-xs font-bold uppercase tracking-wider transition-colors duration-300 <?php echo e(request('category') == $lvl2->slug ? 'text-daytona-orange' : 'text-slate-500 hover:text-daytona-orange'); ?>">
                                                <?php echo e($lvl2->name); ?>

                                            </a>
                                            <?php if($lvl2->children->count() > 0): ?>
                                            <button class="text-slate-300 group-hover:text-daytona-orange" :class="openLvl2 ? 'rotate-180' : ''">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </button>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Level 3 -->
                                        <?php if($lvl2->children->count() > 0): ?>
                                        <div x-show="openLvl2" x-collapse x-cloak class="mt-3 ml-4 space-y-2 border-l border-slate-100 pl-4">
                                            <?php $__currentLoopData = $lvl2->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lvl3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('products.index', ['category' => $lvl3->slug])); ?>" 
                                               class="block text-[11px] font-semibold uppercase tracking-widest transition-colors duration-300 <?php echo e(request('category') == $lvl3->slug ? 'text-daytona-orange' : 'text-slate-400 hover:text-daytona-orange'); ?>">
                                                <?php echo e($lvl3->name); ?>

                                            </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-[0.2em] text-slate-900 border-l-4 border-daytona-orange pl-4 mb-6 leading-none">Find My Part</h3>
                        <?php if (isset($component)) { $__componentOriginala2cc979615fadf910cf1ab380b365f18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2cc979615fadf910cf1ab380b365f18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.find-my-part','data' => ['motorcyclesByBrand' => $motorcyclesByBrand,'dark' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('find-my-part'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['motorcyclesByBrand' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($motorcyclesByBrand),'dark' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
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
            </aside>


            <!-- Product Grid -->
            <div class="flex-1">

                
                <?php if($activeMoto): ?>
                <div class="flex items-center justify-between mb-6 bg-daytona-navy text-white rounded-sm px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-daytona-orange p-2 rounded-sm shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/50">Filter Motor Aktif</p>
                            <p class="text-sm font-black text-daytona-orange">
                                <?php echo e(request('brand')); ?> <?php echo e(request('model')); ?>

                                &mdash;
                                <span class="text-white font-semibold"><?php echo e($products->total()); ?> produk ditemukan</span>
                            </p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('products.index')); ?>"
                       class="text-[10px] font-black uppercase tracking-widest text-white/40 hover:text-daytona-orange flex items-center gap-1.5 transition-colors shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset
                    </a>
                </div>
                <?php endif; ?>

                
                <?php if($search): ?>
                <div class="flex items-center justify-between mb-8 bg-orange-50 border border-daytona-orange/20 rounded-lg px-5 py-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-daytona-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-sm font-semibold text-slate-700">
                            Menampilkan <span class="font-black text-daytona-orange"><?php echo e($products->total()); ?></span> hasil untuk
                            <span class="font-black text-daytona-navy">"<?php echo e($search); ?>"</span>
                        </p>
                    </div>
                    <a href="<?php echo e(route('products.index')); ?>"
                       class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-daytona-orange flex items-center gap-1.5 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Hapus Pencarian
                    </a>
                </div>
                <?php endif; ?>

                <?php if($products->count() > 0): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white group rounded-sm overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col h-full relative">
                            <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="absolute inset-0 z-10"></a>
                            <!-- Image -->
                            <div class="aspect-square bg-slate-100 overflow-hidden relative">
                                <?php if($product->image_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image_path)); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Details -->
                            <div class="p-6 flex-1 flex flex-col">
                                <span class="bg-daytona-navy/5 text-daytona-navy text-[9px] font-black uppercase px-2 py-1 tracking-widest w-fit mb-3">
                                    <?php echo e($product->category->name ?? 'Racing Part'); ?>

                                </span>
                                <h4 class="text-xl font-bold text-slate-900 group-hover:text-daytona-orange transition-colors duration-300 mb-2 leading-tight">
                                    <?php echo e($product->name); ?>

                                </h4>
                                <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">SKU: <?php echo e($product->sku); ?></span>
                                    <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="relative z-20 bg-daytona-orange/10 text-daytona-orange px-4 py-2 rounded-sm text-[10px] font-black uppercase tracking-widest hover:bg-daytona-orange hover:text-white transition-all">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-16 border-t border-slate-100 pt-10">
                        <?php echo e($products->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="bg-slate-50 py-24 px-8 rounded-sm border-2 border-dashed border-slate-200 text-center">
                        <svg class="w-16 h-16 mx-auto text-slate-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <?php if($search): ?>
                            <h4 class="text-xl font-bold text-slate-900 uppercase tracking-tight mb-2">Produk Tidak Ditemukan</h4>
                            <p class="text-slate-500 max-w-sm mx-auto">Tidak ada produk yang cocok dengan "<span class="font-bold"><?php echo e($search); ?></span>". Coba kata kunci lain.</p>
                            <a href="<?php echo e(route('products.index')); ?>" class="inline-block mt-8 bg-daytona-navy text-white px-8 py-3 rounded-sm font-black uppercase text-xs tracking-widest hover:bg-daytona-orange transition-all">
                                Lihat Semua Produk
                            </a>
                        <?php else: ?>
                            <h4 class="text-xl font-bold text-slate-900 uppercase tracking-tight mb-2">No Products Found</h4>
                            <p class="text-slate-500 max-w-sm mx-auto">Kami tidak dapat menemukan produk di kategori ini.</p>
                            <a href="<?php echo e(route('products.index')); ?>" class="inline-block mt-8 bg-daytona-navy text-white px-8 py-3 rounded-sm font-black uppercase text-xs tracking-widest hover:bg-daytona-orange transition-all">
                                View All Products
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<style>
    [x-cloak] { display: none !important; }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/products/index.blade.php ENDPATH**/ ?>