@extends('layouts.admin')

@section('title', 'Kelola Konten Website')

@section('content')
<div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden shadow-2xl" x-data="{ activeTab: 'welcome' }">
    <!-- Header / Tabs -->
    <div class="flex border-b border-slate-700 bg-slate-800/50">
        @foreach($contents as $page => $sections)
        <button 
            @click="activeTab = '{{ $page }}'"
            :class="activeTab === '{{ $page }}' ? 'border-daytona-orange text-daytona-orange bg-daytona-orange/5' : 'border-transparent text-slate-400 hover:text-slate-200'"
            class="px-8 py-4 text-sm font-black uppercase tracking-widest border-b-2 transition-all"
        >
            {{ strtoupper($page) }}
        </button>
        @endforeach
    </div>

    <!-- Forms -->
    <form action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @foreach($contents as $page => $sections)
        {{-- Page Section --}}
        <div x-show="activeTab === '{{ $page }}'" class="p-8 space-y-12 animate-fade-in" x-cloak>
            
            @foreach($sections->groupBy('section') as $sectionName => $items)
            {{-- Grouped Section --}}
            <div class="space-y-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="h-6 w-1 bg-daytona-orange rounded-full"></div>
                    <h3 class="text-lg font-black uppercase tracking-wider text-slate-200">{{ strtoupper($sectionName) }}</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($items as $item)
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-daytona-orange">{{ $item->title }}</label>
                        
                        @if($item->type === 'text')
                            <input type="text" name="{{ $item->slug }}" value="{{ $item->value }}" 
                                class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-slate-100 font-bold focus:border-daytona-orange focus:ring-0 transition-all">
                        
                        @elseif($item->type === 'textarea')
                            <textarea name="{{ $item->slug }}" rows="4" 
                                class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-slate-100 font-medium focus:border-daytona-orange focus:ring-0 transition-all leading-relaxed">{{ $item->value }}</textarea>
                        
                        @elseif($item->type === 'image')
                            <div class="space-y-4">
                                @if($item->value)
                                    <div class="relative group w-full aspect-video rounded-lg overflow-hidden border border-slate-700 bg-slate-900">
                                        <img src="{{ str_starts_with($item->value, 'http') ? $item->value : asset('storage/' . $item->value) }}" 
                                             class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity">
                                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-slate-900/60">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-white">Pratinjau Saat Ini</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between bg-slate-900 border border-slate-700 rounded-lg p-4">
                                    <input type="file" name="{{ $item->slug }}" class="text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-daytona-orange file:text-white hover:file:bg-orange-600">
                                </div>
                                <p class="text-[10px] text-slate-500 italic">*Format WebP disarankan untuk performa maksimal</p>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            @if(!$loop->last)
                <div class="border-t border-slate-700/50"></div>
            @endif
            @endforeach

        </div>
        @endforeach

        <!-- Action Bar -->
        <div class="p-8 bg-slate-900/50 border-t border-slate-700 flex justify-end">
            <button type="submit" class="bg-daytona-navy text-white px-10 py-4 rounded-lg font-black uppercase tracking-widest text-sm hover:bg-daytona-orange transition-all duration-300 shadow-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<style>
[x-cloak] { display: none !important; }
.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
