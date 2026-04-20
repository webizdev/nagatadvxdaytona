
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['motorcyclesByBrand', 'dark' => false, 'horizontal' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['motorcyclesByBrand', 'dark' => false, 'horizontal' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $allModelsJson = json_encode(
        $motorcyclesByBrand->map(fn($items) => $items->pluck('model_name')->values()->all())->all()
    );
    $currentBrand = request('brand', '');
    $currentModel = request('model', '');
?>

<div x-data="{
        brand: '<?php echo e($currentBrand); ?>',
        model: '<?php echo e($currentModel); ?>',
        models: [],
        allModels: <?php echo e($allModelsJson); ?>,
        init() {
            if (this.brand && this.allModels[this.brand]) {
                this.models = this.allModels[this.brand];
            }
        },
        onBrandChange() {
            this.models = this.brand ? (this.allModels[this.brand] ?? []) : [];
            this.model = '';
        }
     }">

    <form action="<?php echo e(route('products.index')); ?>" method="GET">

        <?php if($horizontal): ?>
        
        <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-end w-full">

            
            <div class="w-full sm:flex-1 min-w-0">
                <label class="text-slate-400 text-left text-[9px] font-black uppercase tracking-[0.2em] block mb-2 px-1">
                    Merk Motor
                </label>
                <div class="relative w-full">
                    <select
                        name="brand"
                        x-model="brand"
                        @change="onBrandChange()"
                        class="block w-full h-14 bg-white/10 border border-white/20 text-white text-sm font-semibold
                               px-6 rounded-full focus:outline-none focus:border-white/50
                               focus:bg-white/15 transition-all cursor-pointer"
                    >
                        <option value="" class="text-slate-800 bg-white">-- Pilih Merk --</option>
                        <?php $__currentLoopData = $motorcyclesByBrand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandName => $_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brandName); ?>" class="text-slate-800 bg-white"
                                <?php echo e($currentBrand === $brandName ? 'selected' : ''); ?>>
                                <?php echo e($brandName); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="w-full sm:flex-1 min-w-0">
                <label class="text-slate-400 text-left text-[9px] font-black uppercase tracking-[0.2em] block mb-2 px-1">
                    Model Motor
                </label>
                <div class="relative w-full">
                    <select
                        name="model"
                        x-model="model"
                        :disabled="models.length === 0"
                        class="block w-full h-14 bg-white/10 border border-white/20 text-white text-sm font-semibold
                               px-6 rounded-full focus:outline-none focus:border-white/50
                               focus:bg-white/15 transition-all cursor-pointer
                               disabled:text-white/30 disabled:border-white/5 disabled:bg-white/5 disabled:cursor-not-allowed"
                    >
                        <option value="" class="text-slate-800 bg-white">-- Pilih Model --</option>
                        <?php $__currentLoopData = $motorcyclesByBrand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandName => $brandModels): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <optgroup label="<?php echo e($brandName); ?>" class="text-slate-800 bg-white"
                                      x-show="brand === '<?php echo e($brandName); ?>'">
                                <?php $__currentLoopData = $brandModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($moto->model_name); ?>" class="text-slate-800 bg-white"
                                        <?php echo e($currentModel === $moto->model_name && $currentBrand === $brandName ? 'selected' : ''); ?>>
                                        <?php echo e($moto->model_name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="w-full sm:w-auto shrink-0 mt-2 sm:mt-0 flex flex-col justify-end">
                <label class="invisible hidden sm:block text-[9px] font-black uppercase tracking-[0.2em] mb-2 px-1">
                    Spacer
                </label>
                <button
                    type="submit"
                    :disabled="!brand"
                    class="w-full sm:w-auto h-14 bg-daytona-orange text-white px-12 rounded-full
                           font-black uppercase text-[11px] tracking-widest
                           hover:bg-white hover:text-daytona-orange
                           transition-all duration-300 flex items-center justify-center gap-2
                           disabled:bg-white/5 disabled:text-white/30 disabled:cursor-not-allowed disabled:hover:bg-white/5 disabled:hover:text-white/30
                           border border-transparent disabled:border-white/5
                           whitespace-nowrap"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari Part
                </button>
            </div>

        </div>

        <?php else: ?>
        
        <div class="space-y-4">

            
            <div class="w-full">
                <label class="<?php echo e($dark ? 'text-slate-400' : 'text-slate-500'); ?> text-left text-[10px] font-black uppercase tracking-widest block mb-1.5 px-1">
                    Merk Motor
                </label>
                <div class="relative w-full">
                    <select
                        name="brand"
                        x-model="brand"
                        @change="onBrandChange()"
                        class="<?php echo e($dark
                            ? 'bg-white/10 border-white/20 text-white focus:border-white/50 focus:bg-white/15'
                            : 'bg-white border-slate-200 text-slate-700 focus:border-daytona-orange'); ?>

                               block w-full h-14 border text-sm font-semibold px-6
                               rounded-full focus:outline-none transition-all cursor-pointer"
                    >
                        <option value="">-- Pilih Merk --</option>
                        <?php $__currentLoopData = $motorcyclesByBrand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandName => $_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brandName); ?>"
                                <?php echo e($currentBrand === $brandName ? 'selected' : ''); ?>>
                                <?php echo e($brandName); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="w-full">
                <label class="<?php echo e($dark ? 'text-slate-400' : 'text-slate-500'); ?> text-left text-[10px] font-black uppercase tracking-widest block mb-1.5 px-1">
                    Model Motor
                </label>
                <div class="relative w-full">
                    <select
                        name="model"
                        x-model="model"
                        :disabled="models.length === 0"
                        class="<?php echo e($dark
                            ? 'bg-white/10 border-white/20 text-white focus:border-white/50 focus:bg-white/15'
                            : 'bg-white border-slate-200 text-slate-700 focus:border-daytona-orange'); ?>

                               block w-full h-14 border text-sm font-semibold px-6
                               rounded-full focus:outline-none transition-all cursor-pointer
                               disabled:text-white/30 disabled:border-white/5 disabled:bg-white/5 disabled:cursor-not-allowed"
                    >
                        <option value="">-- Pilih Model --</option>
                        <?php $__currentLoopData = $motorcyclesByBrand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandName => $brandModels): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $brandModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($moto->model_name); ?>"
                                    x-show="brand === '<?php echo e($brandName); ?>'"
                                    <?php echo e($currentModel === $moto->model_name && $currentBrand === $brandName ? 'selected' : ''); ?>>
                                    <?php echo e($moto->model_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <button
                type="submit"
                :disabled="!brand"
                class="w-full h-14 <?php echo e($dark ? 'bg-daytona-orange hover:bg-white hover:text-daytona-orange' : 'bg-daytona-navy hover:bg-daytona-orange'); ?>

                       text-white px-8 rounded-full font-black uppercase text-[11px] tracking-widest
                       transition-all duration-300 flex items-center justify-center gap-2
                       disabled:bg-white/5 disabled:text-white/30 disabled:cursor-not-allowed disabled:hover:bg-white/5 disabled:hover:text-white/30
                       border border-transparent disabled:border-white/5"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari Suku Cadang
            </button>

        </div>
        <?php endif; ?>

    </form>
</div>
<?php /**PATH /var/www/resources/views/components/find-my-part.blade.php ENDPATH**/ ?>