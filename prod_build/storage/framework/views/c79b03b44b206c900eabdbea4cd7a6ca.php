<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php
        $pageTitle = View::hasSection('meta_title') ? View::getSection('meta_title') : (View::hasSection('title') ? View::getSection('title') . ' - ' . config('app.name', 'Nagata Daytona') : config('app.name', 'Nagata Daytona') . ' - Racing Performance Parts');
        $metaDesc = View::hasSection('meta_description') ? View::getSection('meta_description') : 'Penyedia komponen racing performa tinggi kelas dunia. Kami menghadirkan teknologi lintasan balap ke genggaman Anda untuk performa mesin yang tak tertandingi.';
        $metaImage = View::hasSection('meta_image') ? View::getSection('meta_image') : asset('logo.png');
        $metaUrl = View::hasSection('meta_url') ? View::getSection('meta_url') : request()->url();
    ?>

    <title><?php echo e($pageTitle); ?></title>
    <meta name="description" content="<?php echo e($metaDesc); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e($metaUrl); ?>">
    <meta property="og:title" content="<?php echo e($pageTitle); ?>">
    <meta property="og:description" content="<?php echo e($metaDesc); ?>">
    <meta property="og:image" content="<?php echo e($metaImage); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e($metaUrl); ?>">
    <meta property="twitter:title" content="<?php echo e($pageTitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metaDesc); ?>">
    <meta property="twitter:image" content="<?php echo e($metaImage); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts & Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .bg-daytona-orange { background-color: #EC6624; }
        .text-daytona-orange { color: #EC6624; }
        .border-daytona-orange { border-color: #EC6624; }
        .bg-daytona-navy { background-color: #2D2A4A; }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased overflow-x-hidden">
    <!-- Header -->
    <header class="bg-daytona-orange sticky top-0 z-50 shadow-lg" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <span class="text-2xl font-extrabold text-white tracking-tighter uppercase italic">NAGATA <span class="text-daytona-navy">DAYTONA</span></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-10">
                    <a href="/" class="text-white font-bold text-xs uppercase tracking-[0.2em] hover:text-daytona-navy transition-all py-2 border-b-2 border-transparent hover:border-white <?php echo e(request()->is('/') ? 'border-white' : ''); ?>">Home</a>
                    <a href="<?php echo e(route('products.index')); ?>" class="text-white font-bold text-xs uppercase tracking-[0.2em] hover:text-daytona-navy transition-all py-2 border-b-2 border-transparent hover:border-white <?php echo e(request()->routeIs('products.index') ? 'border-white' : ''); ?>">Products</a>
                    <a href="<?php echo e(route('dealers.index')); ?>" class="text-white font-bold text-xs uppercase tracking-[0.2em] hover:text-daytona-navy transition-all py-2 border-b-2 border-transparent hover:border-white <?php echo e(request()->routeIs('dealers.index') ? 'border-white' : ''); ?>">Lokasi Dealer</a>
                    <a href="<?php echo e(route('about')); ?>" class="text-white font-bold text-xs uppercase tracking-[0.2em] hover:text-daytona-navy transition-all py-2 border-b-2 border-transparent hover:border-white <?php echo e(request()->routeIs('about') ? 'border-white' : ''); ?>">About Us</a>
                    <a href="<?php echo e(route('contact')); ?>" class="text-white font-bold text-xs uppercase tracking-[0.2em] hover:text-daytona-navy transition-all py-2 border-b-2 border-transparent hover:border-white <?php echo e(request()->routeIs('contact') ? 'border-white' : ''); ?>">Contact</a>
                </nav>

                <!-- Desktop Search Bar -->
                <form action="<?php echo e(route('products.index')); ?>" method="GET"
                      class="hidden md:flex items-center"
                      x-data="{ focused: false }">
                    <div class="relative flex items-stretch border-2 border-white rounded-full overflow-hidden transition-all"
                         :class="focused ? 'ring-4 ring-white/30' : ''">
                        <input type="text"
                               name="q"
                               value="<?php echo e(request('q')); ?>"
                               placeholder="Cari produk atau SKU..."
                               @focus="focused = true"
                               @blur="focused = false"
                               class="w-52 lg:w-64 bg-white/10 border-0 text-white placeholder-white text-xs font-semibold px-4 py-2 focus:outline-none focus:bg-white/20 transition-all focus:ring-0">
                        <button type="submit"
                                class="bg-daytona-navy text-white px-5 flex items-center justify-center hover:bg-white hover:text-daytona-orange transition-all border-l-2 border-white">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>



                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none p-2 rounded-lg hover:bg-white/10 transition-all">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Alpine.js) -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-white border-t border-slate-100 shadow-2xl absolute w-full"
             @click.away="mobileMenuOpen = false">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <!-- Mobile Search -->
                <form action="<?php echo e(route('products.index')); ?>" method="GET" class="mb-4">
                    <div class="flex items-center border border-slate-200 rounded-xl overflow-hidden">
                        <input type="text"
                               name="q"
                               value="<?php echo e(request('q')); ?>"
                               placeholder="Cari produk atau SKU..."
                               class="flex-1 px-4 py-3 text-sm text-slate-700 focus:outline-none bg-slate-50">
                        <button type="submit" class="px-4 py-3 bg-daytona-orange text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>
                <a href="/" class="block px-3 py-4 text-base font-bold text-daytona-orange uppercase tracking-wider border-b border-slate-50">Home</a>
                <a href="<?php echo e(route('products.index')); ?>" class="block px-3 py-4 text-base font-bold text-slate-700 uppercase tracking-wider border-b border-slate-50 <?php if(request()->routeIs('products.index')): ?> text-daytona-orange <?php endif; ?>">Products</a>
                <a href="<?php echo e(route('dealers.index')); ?>" class="block px-3 py-4 text-base font-bold text-slate-700 uppercase tracking-wider border-b border-slate-50 <?php if(request()->routeIs('dealers.index')): ?> text-daytona-orange <?php endif; ?>">Lokasi Dealer</a>
                <a href="<?php echo e(route('about')); ?>" class="block px-3 py-4 text-base font-bold text-slate-700 uppercase tracking-wider border-b border-slate-50 <?php if(request()->routeIs('about')): ?> text-daytona-orange <?php endif; ?>">About Us</a>
                <a href="<?php echo e(route('contact')); ?>" class="block px-3 py-4 text-base font-bold text-slate-700 uppercase tracking-wider border-b border-slate-50 <?php if(request()->routeIs('contact')): ?> text-daytona-orange <?php endif; ?>">Contact</a>

            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="bg-daytona-navy text-white pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-20">
                <!-- Brand & Description -->
                <div class="md:col-span-5 space-y-8">
                    <h2 class="text-4xl font-black italic tracking-tighter uppercase italic">NAGATA <span class="text-daytona-orange">DAYTONA</span></h2>
                    <p class="text-slate-400 text-base leading-relaxed max-w-md font-medium">
                        Penyedia komponen racing performa tinggi kelas dunia. Kami menghadirkan teknologi lintasan balap ke genggaman Anda untuk performa mesin yang tak tertandingi secara global.
                    </p>
                    <div class="flex space-x-3 pt-2">
                        <a href="#" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-[#1877F2] hover:border-[#1877F2] transition-all" title="Facebook">
                            <i class="fa-brands fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-tr hover:from-[#F58529] hover:via-[#DD2A7B] hover:to-[#8134AF] hover:border-transparent transition-all" title="Instagram">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-[#25D366] hover:border-[#25D366] transition-all" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </a>
                        <a href="#" class="w-11 h-11 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-black hover:border-white/30 transition-all" title="X (Twitter)">
                            <i class="fa-brands fa-x-twitter text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Footer Column 2 -->
                <div class="md:col-span-3 space-y-8">
                    <h3 class="text-xl font-bold uppercase tracking-widest border-l-4 border-daytona-orange pl-4 leading-none">Quick Links</h3>
                    <ul class="space-y-4">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-slate-400 hover:text-daytona-orange transition-all text-sm font-semibold tracking-wider uppercase">Home</a></li>
                        <li><a href="<?php echo e(route('dealers.index')); ?>" class="text-slate-400 hover:text-daytona-orange transition-all text-sm font-semibold tracking-wider uppercase">Lokasi Dealer</a></li>
                        <li><a href="<?php echo e(route('about')); ?>" class="text-slate-400 hover:text-daytona-orange transition-all text-sm font-semibold tracking-wider uppercase">About Us</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-slate-400 hover:text-daytona-orange transition-all text-sm font-semibold tracking-wider uppercase">Contact</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-daytona-orange transition-all text-sm font-semibold tracking-wider uppercase">Racing Team</a></li>
                    </ul>
                </div>

                <!-- Footer Column 3 -->
                <div class="md:col-span-4 space-y-8">
                    <h3 class="text-xl font-bold uppercase tracking-widest border-l-4 border-daytona-orange pl-4 leading-none">Contact Us</h3>
                    <ul class="space-y-6">
                        <li class="flex items-start space-x-4 text-sm text-slate-400 font-medium">
                            <span class="p-2 bg-white/5 rounded-lg text-daytona-orange border border-white/10 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </span>
                            <span class="pt-1">Jakarta Selatan, Indonesia <br>Jl. Gatot Subroto Kav. 123</span>
                        </li>
                        <li class="flex items-center space-x-4 text-sm text-slate-400 font-medium">
                            <span class="p-2 bg-white/5 rounded-lg text-daytona-orange border border-white/10 shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </span>
                            <span>+62 21 1234 5678</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-white/5 pt-10 text-center">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">
                    &copy; <?php echo e(date('Y')); ?> Nagata Daytona Performance. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>