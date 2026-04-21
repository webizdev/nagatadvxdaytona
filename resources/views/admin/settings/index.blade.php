@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@push('styles')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
<div x-data="{ 
    activeTab: 'identity',
    showAddBranch: false,
    showEditBranch: false,
    editingBranch: {},
    showAddSocial: false,
    showEditSocial: false,
    editingSocial: {},
    
    openEditBranch(branch) {
        this.editingBranch = JSON.parse(JSON.stringify(branch));
        this.showEditBranch = true;
    },
    openEditSocial(social) {
        this.editingSocial = JSON.parse(JSON.stringify(social));
        this.showEditSocial = true;
    }
}" class="space-y-6">
    
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
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            Media Sosial
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/50 text-green-500 p-4 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- TAB CONTENTS -->
    <div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden shadow-xl min-h-[500px]">
        
        <!-- IDENTITY TAB -->
        <div x-show="activeTab === 'identity'" class="p-10 lg:p-12 space-y-12" x-cloak>
            <form action="{{ route('admin.settings.update-identity') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                    <!-- Column 1 -->
                    <div class="space-y-10">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Nama Website / Text Logo</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" class="w-full bg-slate-900 border-slate-700 rounded-2xl text-white focus:ring-red-500 focus:border-red-500 transition-all p-4 shadow-inner">
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Logo Website</label>
                            <div class="flex flex-col md:flex-row items-center gap-8 p-8 bg-slate-900 rounded-2xl border border-dashed border-slate-700">
                                <div class="w-32 h-32 bg-slate-800 rounded-xl flex items-center justify-center overflow-hidden border border-slate-700 p-4 shadow-inner relative group">
                                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                                        <img src="{{ asset('storage/' . $settings['site_logo']) }}" class="max-w-full max-h-full object-contain">
                                        
                                        <!-- Trigger Delete Logo (Fix nested form) -->
                                        <button type="button" 
                                                onclick="if(confirm('Hapus logo website?')) document.getElementById('delete-logo-form').submit();"
                                                class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-lg" 
                                                title="Hapus Logo">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    @else
                                        <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <div class="flex-1 space-y-4 text-center md:text-left">
                                    <input type="file" name="site_logo" class="text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-black file:bg-red-500/10 file:text-red-500 hover:file:bg-red-500 hover:file:text-white transition-all cursor-pointer">
                                    <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest">Rekomendasi: PNG transparan, Maks 2MB.</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">WhatsApp CS</label>
                                <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="0812..." class="w-full bg-slate-900 border-slate-700 rounded-2xl text-white focus:ring-red-500 focus:border-red-500 transition-all p-4 shadow-inner">
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Email</label>
                                <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" placeholder="info@..." class="w-full bg-slate-900 border-slate-700 rounded-2xl text-white focus:ring-red-500 focus:border-red-500 transition-all p-4 shadow-inner">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Alamat Utama</label>
                            <textarea name="address" rows="5" class="w-full bg-slate-900 border-slate-700 rounded-2xl text-white focus:ring-red-500 focus:border-red-500 transition-all p-4 shadow-inner leading-relaxed">{{ $settings['address'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="space-y-10">
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-3">Google Maps Embed link</label>
                            <textarea name="maps_iframe" rows="8" placeholder="Paste kode <iframe> di sini..." class="w-full bg-slate-900 border-slate-700 rounded-2xl text-white font-mono text-xs focus:ring-red-500 focus:border-red-500 transition-all p-4 whitespace-pre shadow-inner">{{ $settings['maps_iframe'] ?? '' }}</textarea>
                        </div>
                        <div class="p-8 bg-slate-900 rounded-2xl border border-slate-700">
                            <p class="text-xs text-slate-500 mb-6 uppercase tracking-widest font-black">Main Map Preview</p>
                            <div class="aspect-video rounded-2xl overflow-hidden bg-slate-800 flex items-center justify-center border border-slate-700 shadow-2xl">
                                @if(isset($settings['maps_iframe']) && $settings['maps_iframe'])
                                    <div class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full border-0">
                                        {!! $settings['maps_iframe'] !!}
                                    </div>
                                @else
                                    <span class="text-slate-600 text-sm font-medium italic">Belum ada peta utama yang disematkan</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-700/50 flex justify-end">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-black py-4 px-12 rounded-2xl shadow-[0_10px_20px_-10px_rgba(239,68,68,0.5)] transition-all flex items-center gap-3 uppercase text-sm tracking-widest">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Identitas Website
                    </button>
                </div>
            </form>
        </div>

        <!-- Hidden Delete Logo Form (Outside main form to avoid nesting) -->
        <form id="delete-logo-form" action="{{ route('admin.settings.delete-logo') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <!-- BRANCHES TAB -->
        <div x-show="activeTab === 'branches'" class="p-8 space-y-8" x-cloak>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="font-black text-xl text-white">Daftar Cabang</h3>
                    <p class="text-sm text-slate-500">Kelola lokasi dealer atau kantor cabang Nagata.</p>
                </div>
                <button @click="showAddBranch = true" class="bg-slate-700 hover:bg-red-500 text-white px-6 py-3 rounded-xl text-sm font-black transition-all flex items-center gap-2 shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Cabang Baru
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-left text-xs font-black text-slate-500 uppercase tracking-widest border-b border-slate-700/50">
                            <th class="px-4 py-4">Nama Cabang</th>
                            <th class="px-4 py-4">Alamat & Nomor Kontak</th>
                            <th class="px-4 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @foreach($branches as $branch)
                        <tr class="hover:bg-slate-700/20 transition-all group">
                            <td class="px-4 py-6 font-bold text-white text-sm">{{ $branch->name }}</td>
                            <td class="px-4 py-6">
                                <p class="text-slate-400 text-xs mb-1 max-w-md">{{ $branch->address }}</p>
                                <span class="text-[10px] bg-slate-900 border border-slate-700 px-2 py-1 rounded-md text-slate-500 font-mono">{{ $branch->phone ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-6">
                                <div class="flex items-center justify-center gap-2">
                                    <button @click="openEditBranch({{ json_encode($branch) }})" class="p-2 text-slate-400 hover:text-white hover:bg-slate-700 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <form action="{{ route('admin.settings.destroy-branch', $branch) }}" method="POST" onsubmit="return confirm('Hapus cabang ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SOCIAL MEDIA TAB -->
        <div x-show="activeTab === 'social'" class="p-8 space-y-8" x-cloak>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="font-black text-xl text-white">Media Sosial</h3>
                    <p class="text-sm text-slate-500">Tampilkan link profil sosial media Anda di website.</p>
                </div>
                <button @click="showAddSocial = true" class="bg-slate-700 hover:bg-red-500 text-white px-6 py-3 rounded-xl text-sm font-black transition-all flex items-center gap-2 shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Link Sosial
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($socials as $social)
                <div class="bg-slate-900 border border-slate-700 rounded-2xl p-6 group relative hover:border-slate-500 transition-all">
                    <div class="flex items-start justify-between">
                        <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center text-red-500 shadow-lg border border-slate-700">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>
                        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-all">
                             <button @click="openEditSocial({{ json_encode($social) }})" class="p-2 text-slate-500 hover:text-white transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                             <form action="{{ route('admin.settings.destroy-social', $social) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="p-2 text-slate-500 hover:text-red-500 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                             </form>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h4 class="font-black text-xs text-slate-500 uppercase tracking-widest mb-1">{{ $social->platform }}</h4>
                        <p class="text-xs text-white truncate font-medium">{{ $social->url }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center bg-slate-900 border border-dashed border-slate-700 rounded-3xl">
                    <p class="text-slate-500 font-medium italic">Belum ada media sosial ditambahkan.</p>
                </div>
                @endforelse
            </div>
        </div>

    </div>

<!-- ================= MODALS ================= -->

<!-- ADD BRANCH MODAL -->
<div x-show="showAddBranch" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm">
    <div @click.away="showAddBranch = false" class="bg-slate-800 border border-slate-700 rounded-3xl w-full max-w-xl shadow-2xl overflow-hidden transform transition-all" x-transition>
        <div class="p-6 border-b border-slate-700 flex justify-between items-center">
            <h3 class="font-black text-white uppercase tracking-widest text-sm">Tambah Cabang Baru</h3>
            <button @click="showAddBranch = false" class="text-slate-500 hover:text-white transition-colors"><svg class="w-6 h-6 border-2 border-slate-700 rounded-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <form action="{{ route('admin.settings.store-branch') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Nama Kota</label>
                <input type="text" name="name" required placeholder="Contoh: Yogyakarta" class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 focus:ring-red-500 focus:border-red-500 transition-all shadow-inner">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Nomor WhatsApp Cabang</label>
                    <input type="text" name="phone" placeholder="0812..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 focus:ring-red-500 focus:border-red-500 transition-all shadow-inner">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Alamat Cabang</label>
                    <input type="text" name="address" required placeholder="Jl. Raya No. 123..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 focus:ring-red-500 focus:border-red-500 transition-all shadow-inner">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Link Google Maps (URL Direct)</label>
                <input type="url" name="maps_url" placeholder="https://maps.google.com/..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 focus:ring-red-500 focus:border-red-500 transition-all shadow-inner">
                <p class="text-[9px] text-slate-500 mt-1 italic">* Contoh: https://maps.app.goo.gl/...</p>
            </div>
            <div class="flex justify-end gap-4 mt-8">
                <button type="button" @click="showAddBranch = false" class="px-6 py-3 rounded-xl text-slate-400 hover:text-white font-black uppercase text-xs">Batal</button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-xl font-black uppercase text-xs shadow-lg shadow-red-500/20">Simpan Cabang</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT BRANCH MODAL -->
<div x-show="showEditBranch" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm">
    <div @click.away="showEditBranch = false" class="bg-slate-800 border border-slate-700 rounded-3xl w-full max-w-xl shadow-2xl overflow-hidden transform transition-all" x-transition>
        <div class="p-6 border-b border-slate-700 flex justify-between items-center">
            <h3 class="font-black text-white uppercase tracking-widest text-sm">Edit Data Cabang</h3>
            <button @click="showEditBranch = false" class="text-slate-500 hover:text-white transition-colors"><svg class="w-6 h-6 border-2 border-slate-700 rounded-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <template x-if="editingBranch.id">
            <form :action="'/admin/settings/branches/' + editingBranch.id" method="POST" class="p-8 space-y-6">
                @csrf @method('PUT')
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Nama Kota</label>
                    <input type="text" name="name" x-model="editingBranch.name" required class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Nomor WhatsApp Cabang</label>
                        <input type="text" name="phone" x-model="editingBranch.phone" class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Alamat</label>
                        <input type="text" name="address" x-model="editingBranch.address" required class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Link Google Maps (URL Direct)</label>
                    <input type="url" name="maps_url" x-model="editingBranch.maps_url" placeholder="https://maps.google.com/..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner focus:ring-red-500 focus:border-red-500 transition-all">
                </div>
                <div class="flex justify-end gap-4 mt-8">
                    <button type="button" @click="showEditBranch = false" class="px-6 py-3 rounded-xl text-slate-400 hover:text-white font-black uppercase text-xs">Batal</button>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-10 py-3 rounded-xl font-black uppercase text-xs shadow-lg shadow-red-500/20">Update Cabang</button>
                </div>
            </form>
        </template>
    </div>
</div>

<!-- ADD SOCIAL MODAL -->
<div x-show="showAddSocial" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm">
    <div @click.away="showAddSocial = false" class="bg-slate-800 border border-slate-700 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden transform transition-all" x-transition>
        <div class="p-6 border-b border-slate-700 flex justify-between items-center">
            <h3 class="font-black text-white uppercase tracking-widest text-sm text-center">Tambah Media Sosial</h3>
            <button @click="showAddSocial = false" class="text-slate-500 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <form action="{{ route('admin.settings.store-social') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Platform (Instagram, Facebook, etc)</label>
                <input type="text" name="platform" required placeholder="Contoh: Instagram" class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">URL Profil Lengkap</label>
                <input type="url" name="url" required placeholder="https://..." class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner">
            </div>
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-xl uppercase text-xs shadow-lg transition-all mt-4 tracking-widest">Tambahkan Link</button>
        </form>
    </div>
</div>

<!-- EDIT SOCIAL MODAL -->
<div x-show="showEditSocial" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-slate-950/80 backdrop-blur-sm">
    <div @click.away="showEditSocial = false" class="bg-slate-800 border border-slate-700 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden transform transition-all" x-transition>
        <div class="p-6 border-b border-slate-700 flex justify-between items-center">
            <h3 class="font-black text-white uppercase tracking-widest text-sm">Edit Media Sosial</h3>
            <button @click="showEditSocial = false" class="text-slate-500 hover:text-white"><svg class="w-6 h-6 border-2 border-slate-700 rounded-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        <template x-if="editingSocial.id">
            <form :action="'/admin/settings/social/' + editingSocial.id" method="POST" class="p-8 space-y-6">
                @csrf @method('PUT')
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">Platform</label>
                    <input type="text" name="platform" x-model="editingSocial.platform" required class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[.2em] mb-2">URL Profil</label>
                    <input type="url" name="url" x-model="editingSocial.url" required class="w-full bg-slate-900 border-slate-700 rounded-xl text-white p-3 shadow-inner">
                </div>
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-xl uppercase text-xs shadow-lg transition-all tracking-widest">Update Link</button>
            </form>
        </template>
    </div>
</div>

    </div>
@endsection
