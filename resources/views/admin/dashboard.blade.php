@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Stat Card 1 -->
    <div class="bg-slate-800 p-6 rounded-2xl border border-slate-700 hover:border-red-500/50 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 rounded-lg bg-red-500/10 text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <span class="text-xs font-bold text-green-500">+12%</span>
        </div>
        <p class="text-slate-400 text-sm font-medium">Total Kategori</p>
        <h3 class="text-3xl font-bold mt-1">24</h3>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-slate-800 p-6 rounded-2xl border border-slate-700 hover:border-red-500/50 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 rounded-lg bg-red-500/10 text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <span class="text-xs font-bold text-green-500">+5%</span>
        </div>
        <p class="text-slate-400 text-sm font-medium">Total Produk</p>
        <h3 class="text-3xl font-bold mt-1">128</h3>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-slate-800 p-6 rounded-2xl border border-slate-700 hover:border-red-500/50 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 rounded-lg bg-red-500/10 text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-xs font-bold text-slate-500">Static</span>
        </div>
        <p class="text-slate-400 text-sm font-medium">Total Suku Cadang</p>
        <h3 class="text-3xl font-bold mt-1">1,024</h3>
    </div>
</div>

<div class="mt-8 bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden">
    <div class="p-6 border-b border-slate-700 flex justify-between items-center">
        <h3 class="font-bold">Aktivitas Terakhir</h3>
        <button class="text-sm text-red-500 hover:underline">Lihat Semua</button>
    </div>
    <div class="p-6 text-slate-400 text-sm italic">
        Belum ada aktivitas baru. Setup sistem berhasil!
    </div>
</div>
@endsection
