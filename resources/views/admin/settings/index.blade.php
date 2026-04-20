@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div x-data="{ activeTab: 'identity' }" class="space-y-6">
    
    <!-- Tab Navigation -->
    <div class="flex items-center space-x-1 bg-slate-800 p-1 rounded-xl border border-slate-700 w-fit">
        <button @click="activeTab = 'identity'" :class="activeTab === 'identity' ? 'bg-red-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'" class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Identitas Web
        </button>
        <button @click="activeTab = 'branches'" :class="activeTab === 'branches' ? 'bg-red-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'" class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Daftar Cabang
        </button>
        <button @click="activeTab = 'social'" :class="activeTab === 'social' ? 'bg-red-500 text-white shadow-lg' : 'text-slate-400 hover:text-white'" class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            Media Sosial
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/50 text-green-500 p-4 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tab Contents -->
    <div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden shadow-xl">
        
        <!-- IDENTITY TAB -->
        <div x-show="activeTab === 'identity'" class="p-8 space-y-8">
            <form action="{{ route('admin.settings.update-identity') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Column 1 -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Website / Text Logo</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" class="w-full bg-slate-900 border-slate-700 rounded-xl text-white focus:ring-red-500 focus:border-red-500 transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Logo Website</label>
                            <div class="flex items-center gap-6 p-4 bg-slate-900 rounded-xl border border-dashed border-slate-700">
                                <div class="w-20 h-20 bg-slate-800 rounded-lg flex items-center justify-center overflow-hidden border border-slate-700">
                                    @if(isset($settings['site_logo']))
                                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" class="max-w-full max-h-full object-contain">
                                    @else
                                        <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <input type="file" name="site_logo" class="text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-500/10 file:text-red-500 hover:file:bg-red-500 hover:file:text-white transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">WhatsApp CS</label>
                                <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="0812..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white focus:ring-red-500 focus:border-red-500 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Email</label>
                                <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" placeholder="info@..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white focus:ring-red-500 focus:border-red-500 transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Alamat Utama</label>
                            <textarea name="address" rows="3" class="w-full bg-slate-900 border-slate-700 rounded-xl text-white focus:ring-red-500 focus:border-red-500 transition-all">{{ $settings['address'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- Column 2 (Maps) -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Google Maps Embed Link (<iframe>)</label>
                            <textarea name="maps_iframe" rows="6" placeholder="Paste kode <iframe> di sini..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white font-mono text-xs focus:ring-red-500 focus:border-red-500 transition-all">{{ $settings['maps_iframe'] ?? '' }}</textarea>
                        </div>
                        <div class="p-4 bg-slate-900 rounded-xl border border-slate-700">
                            <p class="text-xs text-slate-500 mb-4 uppercase tracking-widest font-bold">Preview Maps Utama</p>
                            <div class="aspect-video rounded-lg overflow-hidden bg-slate-800 flex items-center justify-center border border-slate-700">
                                @if(isset($settings['maps_iframe']))
                                    {!! $settings['maps_iframe'] !!}
                                @else
                                    <span class="text-slate-600 italic">Belum ada maps</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-red-500/20 transition-all transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Identitas Website
                    </button>
                </div>
            </form>
        </div>

        <!-- BRANCHES TAB -->
        <div x-show="activeTab === 'branches'" class="p-8 space-y-8">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-lg">Daftar Cabang Nagata</h3>
                <button @click="$dispatch('open-modal', 'add-branch')" class="bg-slate-700 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Cabang
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($branches as $branch)
                <div class="bg-slate-900 border border-slate-700 rounded-2xl p-6 space-y-4 hover:border-slate-500 transition-all group relative">
                    <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-all">
                        <form action="{{ route('admin.settings.destroy-branch', $branch) }}" method="POST" onsubmit="return confirm('Hapus cabang ini?')">
                            @csrf @method('DELETE')
                            <button class="p-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    <h4 class="font-bold text-red-500 uppercase tracking-wider text-sm">{{ $branch->name }}</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">{{ $branch->address }}</p>
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-300">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        {{ $branch->phone }}
                    </div>
                    @if($branch->maps_iframe)
                        <div class="h-32 bg-slate-800 rounded-xl overflow-hidden grayscale contrast-125 border border-slate-700">
                           {!! $branch->maps_iframe !!}
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- SOCIAL MEDIA TAB -->
        <div x-show="activeTab === 'social'" class="p-8 space-y-8">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-lg">Tautan Media Sosial</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Add Form -->
                <div class="bg-slate-900 border border-slate-700 rounded-2xl p-6 h-fit sticky top-24">
                    <h4 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-6">Tambah Link Baru</h4>
                    <form action="{{ route('admin.settings.store-social') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2">Nama Platform</label>
                            <input type="text" name="platform" placeholder="Contoh: Instagram" class="w-full bg-slate-800 border-slate-700 rounded-xl text-white text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2">URL Profil</label>
                            <input type="url" name="url" placeholder="https://instagram.com/..." class="w-full bg-slate-800 border-slate-700 rounded-xl text-white text-sm">
                        </div>
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition-all shadow-lg shadow-red-500/20">
                            Tambahkan Link
                        </button>
                    </form>
                </div>

                <!-- Social List -->
                <div class="lg:col-span-2 space-y-4">
                    @forelse($socials as $social)
                    <div class="bg-slate-900 border border-slate-700 rounded-2xl p-4 flex items-center justify-between group hover:border-slate-500 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-red-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </div>
                            <div>
                                <h5 class="font-bold text-sm">{{ $social->platform }}</h5>
                                <p class="text-xs text-slate-500 truncate max-w-xs">{{ $social->url }}</p>
                            </div>
                        </div>
                        <form action="{{ route('admin.settings.destroy-social', $social) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="p-2 text-slate-500 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="text-center p-12 bg-slate-900/50 border border-dashed border-slate-700 rounded-2xl text-slate-500">
                        Belum ada media sosial yang ditambahkan.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Tambah Cabang (Simplified for demo, usually use a separate component or Blade include) -->
<div x-data="{ open: false }" @open-modal.window="if($event.detail === 'add-branch') open = true" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm" style="display: none;">
    <div @click.away="open = false" class="bg-slate-800 border border-slate-700 rounded-3xl w-full max-w-2xl shadow-2xl overflow-hidden">
        <div class="p-6 border-b border-slate-700 flex justify-between items-center bg-slate-800/50">
            <h3 class="font-bold">Tambah Cabang Baru</h3>
            <button @click="open = false" class="text-slate-500 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <form action="{{ route('admin.settings.store-branch') }}" method="POST" class="p-8 space-y-5">
            @csrf
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Cabang</label>
                <input type="text" name="name" required class="w-full bg-slate-900 border-slate-700 rounded-xl text-white">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">WhatsApp Cabang</label>
                    <input type="text" name="phone" class="w-full bg-slate-900 border-slate-700 rounded-xl text-white">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                    <input type="text" name="address" required class="w-full bg-slate-900 border-slate-700 rounded-xl text-white">
                </div>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Google Maps Embed (<iframe>)</label>
                <textarea name="maps_iframe" rows="4" class="w-full bg-slate-900 border-slate-700 rounded-xl text-white font-mono text-xs"></textarea>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" @click="open = false" class="px-6 py-2 rounded-lg text-slate-400 hover:text-white font-bold">Batal</button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-8 py-2 rounded-lg font-bold shadow-lg shadow-red-500/20 transition-all">Simpan Cabang</button>
            </div>
        </form>
    </div>
</div>

@endsection
