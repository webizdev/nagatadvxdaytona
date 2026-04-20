@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-slate-400 hover:text-white flex items-center space-x-2 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    <div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden">
        <div class="p-6 border-b border-slate-700">
            <h3 class="font-bold text-lg text-white">Buat Kategori Baru</h3>
        </div>
        
        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-medium text-slate-400 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-all @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama kategori">
                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-slate-400 mb-2">Slug (Opsional)</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-all"
                    placeholder="biarkan kosong untuk generate otomatis">
                @error('slug') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="parent_id" class="block text-sm font-medium text-slate-400 mb-2">Parent Category</label>
                <select name="parent_id" id="parent_id" 
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-all appearance-none cursor-pointer">
                    <option value="">-- Tanpa Parent (Root) --</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" {{ old('parent_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
                @error('parent_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-bold text-lg transition-all shadow-lg shadow-red-500/20">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
