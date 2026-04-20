@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden">
    <div class="p-6 border-b border-slate-700 flex justify-between items-center">
        <h3 class="font-bold text-lg text-white">Daftar Kategori</h3>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-bold transition-all flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span>Tambah Kategori</span>
        </a>
    </div>
    
    <div class="p-6">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/50 text-green-500 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-left">
            <thead class="text-xs uppercase text-slate-500 font-bold border-b border-slate-700">
                <tr>
                    <th class="pb-4 px-2">Nama Kategori</th>
                    <th class="pb-4 px-2">Slug</th>
                    <th class="pb-4 px-2">Parent</th>
                    <th class="pb-4 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($categories as $cat)
                <tr class="border-b border-slate-700/50 hover:bg-slate-700/20 transition-all">
                    <td class="py-4 px-2 text-slate-100 font-medium whitespace-nowrap">{{ $cat->name }}</td>
                    <td class="py-4 px-2 text-slate-400">{{ $cat->slug }}</td>
                    <td class="py-4 px-2 text-slate-400">{{ $cat->parent->name ?? '-' }}</td>
                    <td class="py-4 px-2 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="p-2 text-blue-400 hover:bg-blue-400/10 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua sub-kategori juga akan terhapus.')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-10 text-center text-slate-500 italic">Belum ada kategori yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
