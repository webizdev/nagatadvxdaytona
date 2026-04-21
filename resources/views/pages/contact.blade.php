@extends('layouts.app')

@section('title', 'Hubungi Kami - Nagata Daytona')

@section('content')
<!-- Page Header -->
<section class="bg-daytona-navy py-12 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div>
                <h2 class="text-daytona-orange font-black uppercase tracking-[0.4em] text-[10px] mb-2">
                    {{ $webContents['contact_header_subtitle'] ?? 'Get In Touch' }}
                </h2>
                <h1 class="text-white text-4xl font-black italic tracking-tighter uppercase leading-none">
                    {!! $webContents['contact_header_title'] ?? 'Contact <span class="text-daytona-orange">Us</span>' !!}
                </h1>
            </div>
            <div class="max-w-md">
                <p class="text-slate-300 text-sm font-medium border-l-4 border-daytona-orange pl-4 leading-relaxed">
                    {{ $webContents['contact_header_desc'] ?? 'Ada pertanyaan mengenai produk atau kemitraan bisnis? Tim ahli kami yang berdedikasi siap memberikan solusi otomotif untuk Anda.' }}
                </p>
            </div>
        </div>
    </div>
    <!-- Decorative Shape -->
    <div class="absolute left-full top-0 h-full w-1/2 bg-white/5 -skew-x-12 -translate-x-32 hidden md:block"></div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Contact Info Sidebar -->
            <div class="lg:col-span-4 space-y-12">
                <div class="space-y-6">
                    <h3 class="text-2xl font-black italic tracking-tighter uppercase text-slate-900 border-l-4 border-daytona-orange pl-6">
                        {{ $webContents['contact_sidebar_title'] ?? 'General Inquiries' }}
                    </h3>
                    <p class="text-slate-500 leading-relaxed font-medium">
                        {{ $webContents['contact_sidebar_desc'] ?? 'Ada pertanyaan mengenai produk atau kemitraan? Jangan ragu untuk menghubungi tim ahli kami.' }}
                    </p>
                </div>

                <div class="space-y-8">
                    <!-- Address -->
                    <div class="flex items-start space-x-5">
                        <div class="w-12 h-12 rounded-sm bg-slate-50 border border-slate-100 flex items-center justify-center text-daytona-orange shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1">Our Office</h4>
                            <p class="text-slate-900 font-bold leading-tight">{!! nl2br(e($webSettings['address'] ?? 'Jakarta Selatan, Indonesia')) !!}</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-5">
                        <div class="w-12 h-12 rounded-sm bg-slate-50 border border-slate-100 flex items-center justify-center text-daytona-orange shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1">Direct Line</h4>
                            <p class="text-slate-900 font-bold text-xl leading-tight">{{ $webSettings['whatsapp'] ?? '+62 21 1234 5678' }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start space-x-5">
                        <div class="w-12 h-12 rounded-sm bg-slate-50 border border-slate-100 flex items-center justify-center text-daytona-orange shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-1">Email Support</h4>
                            <p class="text-slate-900 font-bold leading-tight">{{ $webSettings['email'] ?? 'info@nagatadaytona.com' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-8 bg-slate-50 p-8 md:p-12 rounded-sm shadow-sm">
                <form action="#" method="POST" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full bg-white border border-slate-200 px-4 py-4 focus:border-daytona-orange focus:ring-0 transition-all outline-none font-bold" placeholder="Contoh: Budi Santoso">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Alamat Email</label>
                            <input type="email" name="email" class="w-full bg-white border border-slate-200 px-4 py-4 focus:border-daytona-orange focus:ring-0 transition-all outline-none font-bold" placeholder="email@contoh.com">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Subjek Pesan</label>
                        <select name="subject" class="w-full bg-white border border-slate-200 px-4 py-4 focus:border-daytona-orange focus:ring-0 transition-all outline-none font-bold appearance-none">
                            <option value="Product Inquiry">Pertanyaan Produk</option>
                            <option value="Partnership">Kemitraan / Reseller</option>
                            <option value="Other">Lainnya</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Pesan Anda</label>
                        <textarea name="message" rows="5" class="w-full bg-white border border-slate-200 px-4 py-4 focus:border-daytona-orange focus:ring-0 transition-all outline-none font-bold" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="bg-daytona-navy text-white px-12 py-5 rounded-sm font-black uppercase tracking-[0.2em] text-xs hover:bg-daytona-orange transition-all duration-300 shadow-xl group">
                        Send Message
                        <svg class="w-5 h-5 ml-3 inline-block group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Interactive Map (Full Width Fix) -->
<div class="relative w-full h-[500px] border-t border-slate-200 mt-12">
    <style>
        .aggressive-map-container iframe {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            border: 0 !important;
        }
    </style>
    <div class="aggressive-map-container w-full h-full">
        @if(!empty($webSettings['maps_iframe']))
            {!! $webSettings['maps_iframe'] !!}
        @else
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.667056952686!2d106.8271106!3d-6.175308299999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sNational%20Monument!5e1!3m2!1sen!2sid!4v1776611068769!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        @endif
    </div>
</div>
@endsection
