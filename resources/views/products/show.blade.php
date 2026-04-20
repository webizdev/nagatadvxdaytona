@extends('layouts.app')

@section('meta_title', $product->name . ' | Suku Cadang Original Nagata Daytona')
@section('meta_description', Str::limit(strip_tags($product->description ?? 'Beli ' . $product->name . ' original hanya dari Nagata Daytona. Produk berkualitas tinggi dirancang untuk performa maksimal di setiap lintasan balapan.'), 150))
@if($product->image_path)
    @section('meta_image', asset('storage/' . $product->image_path))
@endif

@section('title', $product->name)

@section('content')

{{-- ===== HERO BANNER ===== --}}
<section class="bg-daytona-navy py-14 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex mb-6 text-[10px] font-black uppercase tracking-[0.2em] text-white/50">
            <a href="{{ route('home') }}" class="hover:text-daytona-orange transition-colors">Catalog</a>
            <span class="mx-2">/</span>
            <span class="text-daytona-orange">{{ $product->category->name ?? 'Racing Part' }}</span>
        </nav>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
            <h1 class="text-white text-3xl md:text-5xl font-black italic tracking-tighter uppercase leading-tight max-w-4xl">
                {{ $product->name }}
            </h1>
            <div class="flex items-center gap-4 shrink-0">
                <span class="text-[10px] font-black text-white/50 uppercase tracking-widest">Share</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                   class="w-11 h-11 rounded-full bg-[#1877F2] flex items-center justify-center text-white hover:scale-110 transition-all shadow-lg border-2 border-white/20 text-base" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->name) }}" target="_blank"
                   class="w-11 h-11 rounded-full bg-black flex items-center justify-center text-white hover:scale-110 transition-all shadow-lg border-2 border-white/20 text-base" title="X / Twitter">
                    <i class="fab fa-x-twitter"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name . ' - ' . url()->current()) }}" target="_blank"
                   class="w-11 h-11 rounded-full bg-[#25D366] flex items-center justify-center text-white hover:scale-110 transition-all shadow-lg border-2 border-white/20 text-lg" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="mailto:?subject={{ urlencode($product->name) }}&body={{ urlencode('Check out: ' . url()->current()) }}"
                   class="w-11 h-11 rounded-full bg-daytona-orange flex items-center justify-center text-white hover:scale-110 transition-all shadow-lg border-2 border-white/20 text-base" title="Email">
                    <i class="far fa-envelope"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="absolute right-0 top-0 h-full w-1/3 bg-white/5 skew-x-12 translate-x-20"></div>
</section>

{{-- ===== MAIN CONTENT: IMAGE + PRODUCT INFO ===== --}}
<section class="py-16 bg-white" x-data="{ 
    activeImage: '{{ $product->image_path ? asset('storage/'.$product->image_path) : '' }}',
    gallery: [
        @if($product->image_path) '{{ asset('storage/'.$product->image_path) }}', @endif
        @foreach($product->gallery ?? [] as $img) '{{ asset('storage/'.$img) }}', @endforeach
    ],
    showFull: false
}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">

            {{-- LEFT: Interactive Product Gallery --}}
            <div class="w-full space-y-6">
                <!-- Main Large Image -->
                <div class="bg-slate-50 border border-slate-100 rounded-3xl overflow-hidden flex items-center justify-center aspect-square relative group cursor-zoom-in"
                     @click="showFull = true">
                    <template x-if="activeImage">
                        <img :src="activeImage"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain p-4 transition-all duration-700 hover:scale-105"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100">
                    </template>
                    <template x-if="!activeImage">
                        <div class="flex flex-col items-center justify-center text-slate-300 gap-3">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs uppercase tracking-widest font-bold">No Image</span>
                        </div>
                    </template>
                    
                    <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="bg-black/60 text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full backdrop-blur-sm">Lihat Detail</span>
                    </div>
                </div>

                <!-- Thumbnails Strip -->
                <div class="flex flex-wrap gap-4" x-show="gallery.length > 1">
                    <template x-for="(img, index) in gallery" :key="index">
                        <button @click="activeImage = img"
                                :class="activeImage === img ? 'border-daytona-orange ring-2 ring-daytona-orange/20 shadow-lg' : 'border-slate-100 hover:border-slate-300'"
                                class="w-20 h-20 bg-slate-50 border-2 rounded-xl overflow-hidden flex-shrink-0 transition-all p-1">
                            <img :src="img" class="w-full h-full object-contain">
                        </button>
                    </template>
                </div>
            </div>

            {{-- RIGHT: Product Info --}}
            <div class="space-y-8 pt-2">
                {{-- Category + SKU Row --}}
                <div class="flex flex-wrap items-center gap-3">
                    <span class="bg-daytona-orange text-white text-[11px] font-black uppercase px-4 py-1.5 tracking-wider">
                        {{ $product->category->name ?? 'Racing Part' }}
                    </span>
                    <span class="text-slate-400 text-[11px] font-semibold uppercase tracking-widest border border-slate-200 px-3 py-1.5 rounded-sm">
                        SKU: {{ $product->sku ?? 'N/A' }}
                    </span>
                </div>

                {{-- Product Name --}}
                <h2 class="text-daytona-navy text-2xl lg:text-4xl font-black uppercase leading-tight tracking-tight">
                    {{ $product->name }}
                </h2>

                {{-- Short Description --}}
                @if($product->description)
                <p class="text-slate-600 text-base lg:text-lg font-semibold leading-relaxed border-l-4 border-daytona-orange pl-5">
                    {{ $product->description }}
                </p>
                @endif

                {{-- Features Block --}}
                @if($product->features)
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-6">
                    <p class="text-[11px] font-black uppercase tracking-[0.2em] text-daytona-orange mb-4">Product Highlights</p>
                    <p class="text-slate-700 text-sm font-medium leading-relaxed whitespace-pre-line">{{ $product->features }}</p>
                </div>
                @endif

                {{-- CTA: Contact --}}
                <div class="pt-2 flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/628123456789?text=Halo%20Nagata%20Daytona,%20saya%20tertarik%20dengan%20produk%20{{ $product->name }}" target="_blank"
                       class="flex-1 text-center bg-daytona-orange text-white font-black uppercase tracking-widest text-sm py-4 px-8 hover:bg-orange-600 transition-colors shadow-lg shadow-daytona-orange/30 flex items-center justify-center gap-3">
                        <i class="fab fa-whatsapp text-lg"></i>
                        Tanya Stok & Harga
                    </a>
                </div>
            </div>
        </div>

        {{-- Lightbox (Overlay) --}}
        <div x-show="showFull" 
             x-transition:enter="transition opacity-0 duration-300"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity-100 duration-200"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center p-4 lg:p-4"
             @keydown.escape.window="showFull = false" x-cloak>
            
            <button @click="showFull = false" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <img :src="activeImage" class="max-w-full max-h-full object-contain">
        </div>

        {{-- ===== TABS SECTION ===== --}}
        @if($product->technical_specs || $product->specifications->count() > 0 || $product->motorcycles->count() > 0)
        <!-- ... existing tabs content ... -->
        <div class="mt-20 border-t border-slate-100 pt-14" x-data="{ activeTab: 'specs' }">
            <div class="flex border-b border-slate-200 mb-10 overflow-x-auto whitespace-nowrap scrollbar-hide">
                <button @click="activeTab = 'specs'"
                        :class="activeTab === 'specs' ? 'border-b-2 border-daytona-orange text-daytona-orange' : 'text-slate-400 hover:text-slate-600'"
                        class="px-8 py-4 text-[11px] font-black uppercase tracking-[0.25em] transition-colors -mb-px">
                    Spesifikasi Teknis
                </button>
                @if($product->motorcycles->count() > 0)
                <button @click="activeTab = 'compatibility'"
                        :class="activeTab === 'compatibility' ? 'border-b-2 border-daytona-orange text-daytona-orange' : 'text-slate-400 hover:text-slate-600'"
                        class="px-8 py-4 text-[11px] font-black uppercase tracking-[0.25em] transition-colors -mb-px">
                    Cocok untuk Motor
                </button>
                @endif
            </div>

            {{-- TAB 1: Specs --}}
            <div x-show="activeTab === 'specs'">
                @if($product->technical_specs)
                <div class="max-w-3xl">
                    @php
                        $specData = null;
                        try { $specData = json_decode($product->technical_specs, true); } catch(\Exception $e) {}
                    @endphp
                    @if($specData && isset($specData['type']) && $specData['type'] === 'grid')
                        <div class="overflow-x-auto border border-slate-200 rounded-2xl shadow-sm bg-white">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-daytona-navy">
                                        @foreach($specData['headers'] as $header)
                                            <th class="py-4 px-6 text-left text-[10px] font-black uppercase tracking-widest text-white border-r border-white/10 last:border-0">{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($specData['rows'] as $row)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            @foreach($row as $cell)
                                                <td class="py-4 px-6 text-slate-700 text-sm font-bold border-r border-slate-50 last:border-0">{{ $cell }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Existing manual text logic -->
                        <div class="border border-slate-200 rounded-2xl p-8 bg-slate-50/50">
                            <pre class="text-slate-700 text-sm font-medium leading-relaxed whitespace-pre-line">{{ $product->technical_specs }}</pre>
                        </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- TAB 2: Compatibility --}}
            @if($product->motorcycles->count() > 0)
            <div x-show="activeTab === 'compatibility'" x-cloak>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($product->motorcycles->groupBy('brand') as $brand => $models)
                    <div class="space-y-4">
                        <h4 class="text-daytona-navy font-black uppercase tracking-widest text-sm border-b-2 border-daytona-orange w-max pr-6 pb-2">{{ $brand }}</h4>
                        <div class="space-y-2">
                            @foreach($models as $moto)
                            <div class="flex items-center justify-between px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl hover:border-daytona-orange transition-all group">
                                <span class="text-slate-700 font-bold text-sm uppercase">{{ $moto->model_name }}</span>
                                <div class="flex gap-2">
                                    @if($moto->pivot->diameter) <span class="text-[9px] bg-slate-200 text-slate-600 px-2 py-0.5 rounded uppercase font-black">{{ $moto->pivot->diameter }}</span> @endif
                                    @if($moto->pivot->color) <span class="text-[9px] bg-daytona-navy text-white px-2 py-0.5 rounded uppercase font-black">{{ $moto->pivot->color }}</span> @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

    </div>
</section>

{{-- ===== RELATED PRODUCTS ===== --}}
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<section class="py-20 bg-slate-50 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4 mb-12">
            <span class="w-8 h-0.5 bg-daytona-orange"></span>
            <h2 class="text-daytona-navy text-2xl font-black uppercase tracking-tight italic">Recommended For You</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedProducts as $rel)
            <a href="{{ route('products.show', $rel->slug) }}"
               class="group bg-white border border-slate-100 p-8 text-center hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 rounded-3xl">
                <div class="aspect-square mb-6 overflow-hidden bg-slate-50 flex items-center justify-center rounded-2xl">
                    @if($rel->image_path)
                        <img src="{{ asset('storage/' . $rel->image_path) }}" class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-700">
                    @else
                        <svg class="w-12 h-12 text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                    @endif
                </div>
                <h4 class="text-daytona-navy font-black uppercase tracking-tight italic text-sm group-hover:text-daytona-orange transition-colors">
                    {{ $rel->name }}
                </h4>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
