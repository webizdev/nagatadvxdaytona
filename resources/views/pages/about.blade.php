@extends('layouts.app')

@section('title', 'Tentang Kami - Nagata Daytona')

@section('content')
<!-- Page Header -->
<section class="bg-daytona-navy py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h2 class="text-daytona-orange font-black uppercase tracking-[0.4em] text-[10px] mb-2">
                    {{ $webContents['about_header_subtitle'] ?? 'Quality & Precision' }}
                </h2>
                <h1 class="text-white text-4xl font-black italic tracking-tighter uppercase leading-none">
                    {!! $webContents['about_header_title'] ?? 'About <span class="text-daytona-orange">Us</span>' !!}
                </h1>
            </div>
            <div class="max-w-md">
                <p class="text-slate-300 text-sm font-medium border-l-4 border-daytona-orange pl-4 leading-relaxed">
                    {{ $webContents['about_header_desc'] ?? 'Lebih dari sekadar komponen. Kami menghadirkan teknologi lintasan balap ke genggaman setiap pengendara yang menginginkan kesempurnaan.' }}
                </p>
            </div>
        </div>
    </div>
    <!-- Decorative Shape -->
    <div class="absolute left-full top-0 h-full w-1/2 bg-white/5 -skew-x-12 -translate-x-32 hidden md:block"></div>
</section>

<!-- Content Sections -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Story Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center mb-32">
            <div class="space-y-8">
                <div class="inline-block border-l-4 border-daytona-orange pl-6 py-2">
                    <h3 class="text-3xl font-black italic tracking-tighter uppercase text-slate-900">
                        {{ $webContents['about_story_title'] ?? 'Pushing the Limits of Performance' }}
                    </h3>
                </div>
                <div class="space-y-6 text-slate-500 leading-relaxed text-lg">
                    <p>{{ $webContents['about_story_p1'] ?? '' }}</p>
                    <p>{{ $webContents['about_story_p2'] ?? '' }}</p>
                </div>
            </div>
            <div class="relative">
                <img src="{{ $webContents['about_story_image'] ?? 'https://images.unsplash.com/photo-1486006151703-9993309a4d8b?auto=format&fit=crop&q=80&w=1200' }}" alt="High Tech Engine" class="rounded-sm shadow-2xl grayscale hover:grayscale-0 transition-all duration-700">
                <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-daytona-orange z-[-1]"></div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-slate-100 pt-24">
            <div class="space-y-4">
                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-daytona-orange">
                    {{ $webContents['about_vision_title'] ?? '01. Our Vision' }}
                </h4>
                <p class="text-slate-800 font-bold text-xl leading-tight">
                    {{ $webContents['about_vision_desc'] ?? 'Menjadi pemimpin global dalam inovasi suku cadang racing yang menginspirasi standar baru di dunia otomotif.' }}
                </p>
            </div>
            <div class="space-y-4">
                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-daytona-orange">
                    {{ $webContents['about_mission_title'] ?? '02. Our Mission' }}
                </h4>
                <ul class="space-y-3 text-slate-500 font-medium">
                    @foreach(explode("\n", $webContents['about_mission_list'] ?? "Mengembangkan teknologi mesin dengan riset berkelanjutan.\nMenyediakan produk dengan standar keamanan dan daya tahan tertinggi.") as $mission)
                    @if(trim($mission))
                    <li class="flex items-start">
                        <span class="text-daytona-orange mr-2">•</span>
                        {{ trim($mission) }}
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="space-y-4">
                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-daytona-orange">
                    {{ $webContents['about_values_title'] ?? '03. Our Values' }}
                </h4>
                <div class="flex flex-wrap gap-2 pt-2">
                    @foreach(explode(",", $webContents['about_values_list'] ?? "Precision, Innovation, Reliability") as $value)
                    <span class="px-3 py-1 bg-slate-100 text-[10px] font-black uppercase tracking-widest text-slate-600">{{ trim($value) }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Tracker -->
<section class="py-24 bg-slate-50 border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div class="space-y-2">
                <p class="text-4xl font-black italic text-daytona-navy">
                    {{ $webContents['about_stats_exp_num'] ?? '15+' }}
                </p>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                    {{ $webContents['about_stats_exp_label'] ?? 'Tahun Pengalaman' }}
                </p>
            </div>
            <div class="space-y-2">
                <p class="text-4xl font-black italic text-daytona-orange">
                    {{ $webContents['about_stats_parts_num'] ?? '250+' }}
                </p>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                    {{ $webContents['about_stats_parts_label'] ?? 'Komponen Racing' }}
                </p>
            </div>
            <div class="space-y-2">
                <p class="text-4xl font-black italic text-daytona-navy">
                    {{ $webContents['about_stats_users_num'] ?? '12k+' }}
                </p>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                    {{ $webContents['about_stats_users_label'] ?? 'Pengguna Aktif' }}
                </p>
            </div>
            <div class="space-y-2">
                <p class="text-4xl font-black italic text-daytona-orange">
                    {{ $webContents['about_stats_track_num'] ?? '100%' }}
                </p>
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400">
                    {{ $webContents['about_stats_track_label'] ?? 'Track Tested' }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
