<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'Nagata Daytona Admin')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-800 flex-shrink-0 border-r border-slate-700 hidden md:flex flex-col">
            <div class="p-6">
                <h1 class="text-xl font-bold bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent">NAGATA DAYTONA</h1>
                <p class="text-xs text-slate-400 mt-1 uppercase tracking-widest font-semibold">Admin Panel</p>
            </div>
            
            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition-all <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : 'text-slate-400'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Dashboard</span>
                </a>
                
                <div class="pt-4 pb-2">
                    <p class="text-xs text-slate-500 uppercase px-3 tracking-widest font-bold">Menu</p>
                </div>

                <a href="<?php echo e(route('admin.categories.index')); ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition-all <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-slate-700 text-white' : 'text-slate-400'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span>Kategori</span>
                </a>

                <a href="<?php echo e(route('admin.products.index')); ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-700 transition-all <?php echo e(request()->routeIs('admin.products.*') ? 'bg-slate-700 text-white' : 'text-slate-400'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Produk</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center font-bold text-white">AD</div>
                    <div>
                        <p class="text-sm font-semibold">Admin User</p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                </div>
                <!-- Logout placeholder -->
                <button class="w-full flex items-center justify-center space-x-2 p-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="text-sm font-bold">Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-slate-800/50 backdrop-blur-md border-b border-slate-700 p-4 sticky top-0 z-10 flex justify-between items-center">
                <h2 class="text-xl font-bold"><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?></h2>
                <div class="flex items-center space-x-4">
                    <span class="text-xs bg-slate-700 px-2 py-1 rounded text-slate-400"><?php echo e(date('l, d F Y')); ?></span>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-6">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/resources/views/layouts/admin.blade.php ENDPATH**/ ?>