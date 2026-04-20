@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('content')
<div class="w-full" x-data="{ 
    mainPreview: '',
    newGalleryPreviews: [],
    
    handleNewGallery(event) {
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.newGalleryPreviews.push(e.target.result);
            };
            reader.readAsDataURL(files[i]);
        }
    },

    handleMainImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.mainPreview = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
}">
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-slate-400 hover:text-white flex items-center space-x-2 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- SECTION 1: INFORMASI DASAR (Full Width) -->
        <div class="bg-slate-800 rounded-2xl border border-slate-700 p-8 space-y-6">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-1 h-6 bg-red-500 rounded-full"></div>
                <h3 class="font-black text-xl text-white uppercase tracking-wider">Informasi Dasar</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Nama Produk</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all @error('name') border-red-500 @enderror"
                            placeholder="Contoh: T-Floating Disc Rotor 300mm">
                        @error('name') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="sku" class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">SKU / Kode Produk</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all @error('sku') border-red-500 @enderror"
                            placeholder="NGT-PL-001">
                        @error('sku') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Kategori Produk</label>
                        <div class="relative">
                            <select name="category_id" id="category_id" required
                                class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 appearance-none cursor-pointer">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="description" class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Deskripsi Singkat</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all"
                            placeholder="Penjelasan singkat mengenai keunggulan produk...">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="features" class="block text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Product Highlights (Deskripsi Fitur)</label>
                        <textarea name="features" id="features" rows="5"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all text-sm"
                            placeholder="• A7075 Aerospace Technology&#10;• T-Floating design&#10;• Tapered tornado-holes">{{ old('features') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: GALLERY & MEDIA (Full Width) -->
        {{-- SECTION 2: GALLERY & MEDIA (COMPACT) --}}
        <div class="bg-slate-800 rounded-2xl border border-slate-700 p-6 space-y-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-1 h-5 bg-red-500 rounded-full"></div>
                    <h3 class="font-black text-lg text-white uppercase tracking-wider">Media & Gambar Produk</h3>
                </div>
                <div class="hidden lg:block text-[8px] font-black text-slate-500 uppercase tracking-widest bg-slate-900/50 px-3 py-1 rounded-full border border-slate-700">
                    Sistem Antrean: Auto WebP Conversion
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- LEFT: Main Showcase (Ultra-Slim) -->
                <div class="bg-slate-950 rounded-2xl border border-slate-700 p-3 shadow-2xl flex flex-col justify-center">
                    {{-- Hero Preview (Ultra-Slim) --}}
                    <div class="relative group aspect-video lg:aspect-[16/10] xl:aspect-[16/9] lg:h-[220px] bg-black rounded-xl border border-slate-800 overflow-hidden flex items-center justify-center p-2">
                        <template x-if="mainPreview">
                            <img :src="mainPreview" class="w-full h-full object-contain transition-all duration-700 group-hover:scale-105 drop-shadow-[0_10px_30px_rgba(0,0,0,0.8)]">
                        </template>
                        <template x-if="!mainPreview">
                            <div class="text-center">
                                <svg class="w-10 h-10 text-slate-900 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-slate-800 text-[9px] font-black uppercase tracking-widest italic">Hero Preview</p>
                            </div>
                        </template>
                        
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all backdrop-blur-sm">
                            <label for="image" class="cursor-pointer bg-red-500 hover:bg-black text-white px-4 py-2 rounded-lg font-black text-[9px] uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-110">Pilih Foto</label>
                            <input type="file" name="image" id="image" class="hidden" accept="image/*" @change="handleMainImage">
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Controls & Gallery Manager -->
                <div class="bg-slate-900 rounded-2xl border border-slate-700 shadow-2xl flex flex-col overflow-hidden min-h-[220px]">
                    {{-- Part 1: Thumbnails Strip --}}
                    <div class="p-3 border-b border-slate-800 space-y-2 bg-slate-950/30">
                        <div class="flex items-center justify-between">
                            <label class="text-[8px] font-black text-slate-500 uppercase tracking-widest italic tracking-[0.15em]">Gallery Manager</label>
                            <span class="text-[7px] text-slate-700 font-black uppercase" x-text="newGalleryPreviews.length + ' FOTO'"></span>
                        </div>
                        
                        <div class="flex flex-wrap gap-4 max-h-[220px] overflow-y-auto pr-1 custom-scrollbar">
                            <!-- New Gallery Previews -->
                            <template x-for="(data, index) in newGalleryPreviews" :key="index">
                                <div class="relative w-28 h-24 rounded-lg overflow-hidden group border-2 border-red-500/30 bg-slate-950 p-1 animate-pulse-once flex-shrink-0 cursor-pointer" @click="mainPreview = data">
                                    <img :src="data" class="w-full h-full object-contain">
                                    <button type="button" @click.stop="newGalleryPreviews.splice(index, 1)" 
                                        class="absolute top-0 right-0 bg-slate-800 text-white p-1.5 rounded-bl-md hover:bg-red-500 transition-all shadow-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                    <div class="absolute bottom-0 left-0 right-0 bg-red-500 text-[9px] text-white py-0.5 text-center font-black uppercase tracking-widest">NEW IMAGE</div>
                                </div>
                            </template>

                            <template x-if="newGalleryPreviews.length === 0">
                                <div class="w-full py-6 flex flex-col items-center justify-center border border-dashed border-slate-950 rounded-lg text-slate-800">
                                    <p class="text-[9px] font-black uppercase tracking-widest italic opacity-30 text-center">Belum ada foto.</p>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Part 2: Upload Area --}}
                    <div class="p-3 flex-1 space-y-2">
                        <label for="gallery_images" class="block w-full cursor-pointer py-3 bg-slate-800/50 border border-dashed border-slate-700 rounded-lg text-center hover:border-red-500 hover:bg-slate-700/50 transition-all group active:scale-95">
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-slate-600 transition-all group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span class="text-[8px] font-black uppercase tracking-widest text-slate-500 group-hover:text-white transition-colors">Upload To Gallery</span>
                            </div>
                            <input type="file" name="gallery_images[]" id="gallery_images" multiple class="hidden" accept="image/*" @change="handleNewGallery">
                        </label>
                        @error('gallery_images.*') <p class="text-[8px] text-red-500 text-center font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

        </div>



        <!-- SECTION 3: SPESIFIKASI TEKNIS -->
        <div class="bg-slate-800 rounded-2xl border border-slate-700 p-8 space-y-6" 
             x-data="{ 
                mode: 'grid',
                headers: ['Property', 'Value'],
                rows: [['', '']],
                rawText: '',
                init() {
                    const val = document.getElementById('technical_specs_hidden').value;
                    if(val) {
                        try {
                            const data = JSON.parse(val);
                            if(data.type === 'grid') {
                                this.headers = data.headers;
                                this.rows = data.rows;
                                this.mode = 'grid';
                            }
                        } catch(e) {}
                    }
                },
                addCol() { 
                    this.headers.push('New Column'); 
                    this.rows.forEach(r => r.push(''));
                },
                removeCol(index) {
                    if(this.headers.length > 1) {
                        this.headers.splice(index, 1);
                        this.rows.forEach(r => r.splice(index, 1));
                    }
                },
                addRow() { 
                    this.rows.push(new Array(this.headers.length).fill('')); 
                },
                removeRow(index) {
                    if(this.rows.length > 1) this.rows.splice(index, 1);
                },
                get jsonValue() {
                    if(this.mode === 'text') return this.rawText;
                    return JSON.stringify({ type: 'grid', headers: this.headers, rows: this.rows });
                }
             }">
             <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-1 h-6 bg-red-500 rounded-full"></div>
                    <h3 class="font-black text-xl text-white uppercase tracking-wider">Spesifikasi Teknis</h3>
                </div>
                <div class="flex bg-slate-900 p-1 rounded-xl border border-slate-700">
                    <button type="button" @click="mode = 'grid'" :class="mode === 'grid' ? 'bg-red-500 text-white shadow-lg' : 'text-slate-500 hover:text-slate-300'" class="px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Table Mode</button>
                    <button type="button" @click="mode = 'text'" :class="mode === 'text' ? 'bg-red-500 text-white shadow-lg' : 'text-slate-500 hover:text-slate-300'" class="px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all ml-1">Manual Text</button>
                </div>
            </div>

            <div x-show="mode === 'grid'" class="space-y-4">
                <div class="overflow-x-auto border border-slate-700 rounded-2xl bg-slate-950">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-900 border-b border-slate-800">
                                <template x-for="(header, hIdx) in headers" :key="'h-'+hIdx">
                                    <th class="p-4 border-r border-slate-800 last:border-0">
                                        <div class="flex items-center gap-3">
                                            <input type="text" x-model="headers[hIdx]" class="w-full bg-slate-800 border border-slate-700 rounded-lg px-3 py-2 text-[10px] font-black text-white">
                                            <button type="button" @click="removeCol(hIdx)" x-show="headers.length > 1" class="text-slate-600 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                                        </div>
                                    </th>
                                </template>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(row, rIdx) in rows" :key="'r-'+rIdx">
                                <tr class="hover:bg-slate-900/40">
                                    <template x-for="(cell, cIdx) in row" :key="'c-'+rIdx+'-'+cIdx">
                                        <td class="p-2 border-r border-slate-800/50 last:border-0">
                                            <input type="text" x-model="rows[rIdx][cIdx]" class="w-full bg-transparent border-0 focus:ring-0 text-sm py-2 text-slate-400">
                                        </td>
                                    </template>
                                    <td class="p-2 w-10">
                                        <button type="button" @click="removeRow(rIdx)" class="text-slate-700 hover:text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button type="button" @click="addRow()" class="w-full py-4 bg-slate-900 border border-slate-700 rounded-xl text-[10px] font-black text-slate-500 uppercase tracking-widest flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Baris Spesifikasi
                    </button>
                    <button type="button" @click="addCol()" class="w-full py-4 bg-slate-900 border border-slate-700 rounded-xl text-[10px] font-black text-slate-500 uppercase tracking-widest flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Kolom Spesifikasi
                    </button>
                </div>
            </div>
            
            <div x-show="mode === 'text'">
                <textarea x-model="rawText" rows="6" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-5 py-4 text-white font-mono text-sm"></textarea>
            </div>
            
            <input type="hidden" name="technical_specs" id="technical_specs_hidden" value="{{ old('technical_specs') }}" :value="jsonValue">
        </div>

        <!-- SECTION 4: KOMPATIBILITAS -->
        <div class="bg-slate-800 rounded-2xl border border-slate-700 p-8 space-y-8" x-data="{ compatibility: {{ old('compatibility') ? json_encode(old('compatibility')) : '[]' }} }">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-1 h-6 bg-red-500 rounded-full"></div>
                    <h3 class="font-black text-xl text-white uppercase tracking-wider">Kompatibilitas Motor</h3>
                </div>
                <button type="button" @click="compatibility.push({ motorcycle_id: '', diameter: '', color: '', part_number: '' })" 
                    class="bg-red-500 text-white px-5 py-2.5 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-red-600 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Motor
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <template x-for="(item, index) in compatibility" :key="index">
                    <div class="bg-slate-950 p-6 rounded-2xl border border-slate-800 space-y-4 relative">
                        <button type="button" @click="compatibility.splice(index, 1)" class="absolute top-4 right-4 text-slate-700 hover:text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        
                        <div>
                            <label class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Model Motor</label>
                            <select :name="'compatibility['+index+'][motorcycle_id]'" x-model="item.motorcycle_id" required
                                class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-xs text-white appearance-none">
                                <option value="">-- Pilih Motor --</option>
                                @foreach($motorcycles->groupBy('brand') as $brand => $models)
                                    <optgroup label="{{ strtoupper($brand) }}">
                                        @foreach($models as $motor)
                                            <option value="{{ $motor->id }}">{{ $motor->model_name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-3 gap-3">
                            <input type="text" :name="'compatibility['+index+'][diameter]'" x-model="item.diameter" placeholder="Size" class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-[10px] text-white">
                            <input type="text" :name="'compatibility['+index+'][color]'" x-model="item.color" placeholder="Color" class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-[10px] text-white">
                            <input type="text" :name="'compatibility['+index+'][part_number]'" x-model="item.part_number" placeholder="P/N" class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-2 text-[10px] text-white">
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="pt-10 flex items-center justify-between border-t border-slate-700">
            <button type="submit" class="w-full py-5 bg-red-500 hover:bg-black text-white rounded-2xl font-black uppercase tracking-[0.3em] text-sm transition-all shadow-2xl shadow-red-500/20 group">
                <span class="flex items-center justify-center gap-4">
                    Simpan Produk Baru
                    <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
            </button>
        </div>
    </form>
</div>
@endsection
