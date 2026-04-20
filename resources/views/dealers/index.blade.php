@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
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

    {{-- Content Section --}}
    <div class="bg-slate-50 py-16 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="max-w-7xl mx-auto">
            
            @forelse($dealersByCity as $city => $branches)
                <div class="mb-16 last:mb-0">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-2 h-8 bg-daytona-orange rounded-full"></div>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-800 uppercase tracking-tight">
                            {{ $city }}
                        </h2>
                        <div class="h-px bg-slate-200 flex-1 ml-4 hidden sm:block"></div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        @foreach($branches as $branch)
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
                                            Nagata Daytona - {{ $city }}
                                        </h3>
                                    </div>
                                    <!-- Prominent Map Link -->
                                    @php
                                        // Cek apakah maps_url diisi, jika tidak cek apakah maps_iframe berisi link (bukan tag <iframe>)
                                        $mapLink = $branch->maps_url;
                                        if (!$mapLink && $branch->maps_iframe && (str_contains($branch->maps_iframe, 'http') && !str_contains($branch->maps_iframe, '<iframe'))) {
                                            $mapLink = trim($branch->maps_iframe);
                                        }
                                        
                                        // Fallback terakhir: search query berdasarkan nama & alamat
                                        if (!$mapLink) {
                                            $mapLink = "https://maps.google.com/?q=" . urlencode("Nagata Daytona " . $branch->address . " " . $city);
                                        }
                                    @endphp
                                    <a href="{{ $mapLink }}" target="_blank" title="Buka di Peta"
                                       class="shrink-0 p-2.5 bg-daytona-orange text-white rounded-full shadow-md hover:bg-daytona-navy hover:scale-110 hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </a>
                                </div>
                                
                                <p class="text-slate-500 text-[13px] leading-relaxed mb-4 flex-1">
                                    {{ $branch->address }}
                                </p>

                                @if($branch->phone)
                                    <div class="pt-3 border-t border-slate-100 mt-auto flex justify-between items-center">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->phone) }}" target="_blank" class="inline-flex items-center gap-2 text-[12px] font-bold tracking-wide uppercase text-slate-500 hover:text-daytona-orange transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                            Chat WhatsApp
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Belum ada data dealer</h3>
                    <p class="text-slate-500">Saat ini data lokasi dealer belum tersedia di sistem kami.</p>
                </div>
            @endforelse

        </div>
    </div>
@endsection
