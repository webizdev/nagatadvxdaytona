@extends('layouts.app')

@section('title', 'Katalog Produk - Nagata Daytona')

@section('content')
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
            @if($activeCategory)
                <div class="bg-white/5 border border-white/10 px-6 py-3 rounded-sm flex items-center space-x-3">
                    <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Filter:</span>
                    <span class="text-daytona-orange font-bold text-sm uppercase tracking-wider">{{ $activeCategory->name }}</span>
                    <a href="{{ route('products.index') }}" class="text-white/40 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </a>
                </div>
            @endif
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
                            @foreach($categories as $lvl1)
                            <div x-data="{ open: {{ (request('category') == $lvl1->slug || ($activeCategory && $activeCategory->parent_id == $lvl1->id)) ? 'true' : 'false' }} }" class="border-b border-slate-100 pb-4">
                                <!-- Level 1 -->
                                <div class="flex items-center justify-between group cursor-pointer" @click="open = !open">
                                    <a href="{{ route('products.index', ['category' => $lvl1->slug]) }}" 
                                       @click.stop 
                                       class="text-sm font-black uppercase tracking-widest transition-colors duration-300 {{ request('category') == $lvl1->slug ? 'text-daytona-orange' : 'text-slate-700 hover:text-daytona-orange' }}">
                                        {{ $lvl1->name }}
                                    </a>
                                    @if($lvl1->children->count() > 0)
                                    <button class="text-slate-400 group-hover:text-daytona-orange transition-transform duration-300" :class="open ? 'rotate-180' : ''">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    @endif
                                </div>

                                <!-- Level 2 -->
                                @if($lvl1->children->count() > 0)
                                <div x-show="open" x-collapse x-cloak class="mt-4 ml-4 space-y-3">
                                    @foreach($lvl1->children as $lvl2)
                                    <div x-data="{ openLvl2: {{ (request('category') == $lvl2->slug) ? 'true' : 'false' }} }">
                                        <div class="flex items-center justify-between group cursor-pointer" @click="openLvl2 = !openLvl2">
                                            <a href="{{ route('products.index', ['category' => $lvl2->slug]) }}" 
                                               @click.stop
                                               class="text-xs font-bold uppercase tracking-wider transition-colors duration-300 {{ request('category') == $lvl2->slug ? 'text-daytona-orange' : 'text-slate-500 hover:text-daytona-orange' }}">
                                                {{ $lvl2->name }}
                                            </a>
                                            @if($lvl2->children->count() > 0)
                                            <button class="text-slate-300 group-hover:text-daytona-orange" :class="openLvl2 ? 'rotate-180' : ''">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </button>
                                            @endif
                                        </div>

                                        <!-- Level 3 -->
                                        @if($lvl2->children->count() > 0)
                                        <div x-show="openLvl2" x-collapse x-cloak class="mt-3 ml-4 space-y-2 border-l border-slate-100 pl-4">
                                            @foreach($lvl2->children as $lvl3)
                                            <a href="{{ route('products.index', ['category' => $lvl3->slug]) }}" 
                                               class="block text-[11px] font-semibold uppercase tracking-widest transition-colors duration-300 {{ request('category') == $lvl3->slug ? 'text-daytona-orange' : 'text-slate-400 hover:text-daytona-orange' }}">
                                                {{ $lvl3->name }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Find My Part Widget --}}
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-[0.2em] text-slate-900 border-l-4 border-daytona-orange pl-4 mb-6 leading-none">Find My Part</h3>
                        <x-find-my-part :motorcyclesByBrand="$motorcyclesByBrand" :dark="false" />
                    </div>

                </div>
            </aside>


            <!-- Product Grid -->
            <div class="flex-1">

                {{-- Active Motorcycle Filter Banner --}}
                @if($activeMoto)
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
                                {{ request('brand') }} {{ request('model') }}
                                &mdash;
                                <span class="text-white font-semibold">{{ $products->total() }} produk ditemukan</span>
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('products.index') }}"
                       class="text-[10px] font-black uppercase tracking-widest text-white/40 hover:text-daytona-orange flex items-center gap-1.5 transition-colors shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Reset
                    </a>
                </div>
                @endif

                {{-- Search Result Banner --}}
                @if($search)
                <div class="flex items-center justify-between mb-8 bg-orange-50 border border-daytona-orange/20 rounded-lg px-5 py-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-daytona-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <p class="text-sm font-semibold text-slate-700">
                            Menampilkan <span class="font-black text-daytona-orange">{{ $products->total() }}</span> hasil untuk
                            <span class="font-black text-daytona-navy">"{{ $search }}"</span>
                        </p>
                    </div>
                    <a href="{{ route('products.index') }}"
                       class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-daytona-orange flex items-center gap-1.5 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Hapus Pencarian
                    </a>
                </div>
                @endif

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach($products as $product)
                        <div class="bg-white group rounded-sm overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col h-full relative">
                            <a href="{{ route('products.show', $product->slug) }}" class="absolute inset-0 z-10"></a>
                            <!-- Image -->
                            <div class="aspect-square bg-slate-100 overflow-hidden relative">
                                @if($product->image_path)
                                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <!-- Details -->
                            <div class="p-6 flex-1 flex flex-col">
                                <span class="bg-daytona-navy/5 text-daytona-navy text-[9px] font-black uppercase px-2 py-1 tracking-widest w-fit mb-3">
                                    {{ $product->category->name ?? 'Racing Part' }}
                                </span>
                                <h4 class="text-xl font-bold text-slate-900 group-hover:text-daytona-orange transition-colors duration-300 mb-2 leading-tight">
                                    {{ $product->name }}
                                </h4>
                                <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">SKU: {{ $product->sku }}</span>
                                    <a href="{{ route('products.show', $product->slug) }}" class="relative z-20 bg-daytona-orange/10 text-daytona-orange px-4 py-2 rounded-sm text-[10px] font-black uppercase tracking-widest hover:bg-daytona-orange hover:text-white transition-all">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-16 border-t border-slate-100 pt-10">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="bg-slate-50 py-24 px-8 rounded-sm border-2 border-dashed border-slate-200 text-center">
                        <svg class="w-16 h-16 mx-auto text-slate-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        @if($search)
                            <h4 class="text-xl font-bold text-slate-900 uppercase tracking-tight mb-2">Produk Tidak Ditemukan</h4>
                            <p class="text-slate-500 max-w-sm mx-auto">Tidak ada produk yang cocok dengan "<span class="font-bold">{{ $search }}</span>". Coba kata kunci lain.</p>
                            <a href="{{ route('products.index') }}" class="inline-block mt-8 bg-daytona-navy text-white px-8 py-3 rounded-sm font-black uppercase text-xs tracking-widest hover:bg-daytona-orange transition-all">
                                Lihat Semua Produk
                            </a>
                        @else
                            <h4 class="text-xl font-bold text-slate-900 uppercase tracking-tight mb-2">No Products Found</h4>
                            <p class="text-slate-500 max-w-sm mx-auto">Kami tidak dapat menemukan produk di kategori ini.</p>
                            <a href="{{ route('products.index') }}" class="inline-block mt-8 bg-daytona-navy text-white px-8 py-3 rounded-sm font-black uppercase text-xs tracking-widest hover:bg-daytona-orange transition-all">
                                View All Products
                            </a>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush
