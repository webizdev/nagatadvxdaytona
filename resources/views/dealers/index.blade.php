@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-daytona-navy py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h2 class="text-daytona-orange font-black uppercase tracking-[0.4em] text-[10px] mb-2">
                        {{ $webContents['dealers_header_subtitle'] ?? 'Offline Store' }}
                    </h2>
                    <h1 class="text-white text-4xl font-black italic tracking-tighter uppercase leading-none">
                        {!! $webContents['dealers_header_title'] ?? 'Lokasi <span class="text-daytona-orange">Dealer</span>' !!}
                    </h1>
                </div>
                <div class="max-w-md">
                    <p class="text-slate-300 text-sm font-medium border-l-4 border-daytona-orange pl-4 leading-relaxed">
                        {{ $webContents['dealers_header_desc'] ?? 'Temukan suku cadang resmi Nagata Daytona dan performa maksimal untuk motor Anda di bengkel atau toko sparepart terdekat.' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="absolute left-full top-0 h-full w-1/2 bg-white/5 -skew-x-12 -translate-x-32 hidden md:block"></div>
    </section>

    {{-- Content Section --}}
    <div class="bg-slate-50 py-16 px-4 sm:px-6 lg:px-8 min-h-screen">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php $hasDealers = false; @endphp
                @foreach($dealersByCity as $city => $branches)
                    @foreach($branches as $branch)
                        @php $hasDealers = true; @endphp
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 hover:shadow-xl hover:border-daytona-orange/50 transition-all duration-500 flex flex-col relative group h-full">
                            <!-- City Badge -->
                            <div class="mb-4">
                                <span class="bg-daytona-orange/10 text-daytona-orange text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest border border-daytona-orange/20">
                                    {{ $city }}
                                </span>
                            </div>

                            <div class="flex items-start justify-between mb-5 gap-3">
                                <!-- Store Icon + Title -->
                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-slate-50 rounded-xl group-hover:bg-daytona-orange group-hover:text-white transition-all duration-300 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-800 leading-tight group-hover:text-daytona-orange transition-colors">
                                        Nagata Daytona
                                    </h3>
                                </div>
                                <!-- Map Link -->
                                @php
                                    $mapLink = $branch->maps_url;
                                    if (!$mapLink && $branch->maps_iframe && (str_contains($branch->maps_iframe, 'http') && !str_contains($branch->maps_iframe, '<iframe'))) {
                                        $mapLink = trim($branch->maps_iframe);
                                    }
                                    if (!$mapLink) {
                                        $mapLink = "https://maps.google.com/?q=" . urlencode("Nagata Daytona " . $branch->address . " " . $city);
                                    }
                                @endphp
                                <a href="{{ $mapLink }}" target="_blank" title="Buka di Peta"
                                   class="shrink-0 w-11 h-11 bg-daytona-orange text-white rounded-full shadow-lg flex items-center justify-center hover:bg-daytona-navy hover:scale-110 -translate-y-1 transition-all duration-300">
                                    <i class="fa-solid fa-map-location-dot text-lg"></i>
                                </a>
                            </div>
                            
                            <div class="flex-1">
                                <p class="text-slate-500 text-sm leading-relaxed mb-6 font-medium">
                                    {{ $branch->address }}
                                </p>
                            </div>

                            @if($branch->phone)
                                @php
                                    $waNumber = preg_replace('/[^0-9]/', '', $branch->phone);
                                    if (str_starts_with($waNumber, '0')) {
                                        $waNumber = '62' . substr($waNumber, 1);
                                    } elseif (!str_starts_with($waNumber, '62')) {
                                        $waNumber = '62' . $waNumber;
                                    }
                                @endphp
                                <div class="pt-5 border-t border-slate-100 mt-auto">
                                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" 
                                       class="w-full flex items-center justify-center gap-2 py-3 bg-slate-50 rounded-xl text-[13px] font-bold tracking-wider uppercase text-slate-600 group-hover:bg-daytona-orange group-hover:text-white hover:bg-daytona-navy! transition-all duration-300">
                                        <i class="fa-brands fa-whatsapp text-lg"></i>
                                        Chat WhatsApp
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endforeach

                @if(!$hasDealers)
                    <div class="col-span-full text-center py-20">
                        <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Belum ada data dealer</h3>
                        <p class="text-slate-500">Saat ini data lokasi dealer belum tersedia di sistem kami.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
