<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            // HOME - HERO
            ['welcome', 'hero', 'home_hero_subtitle', 'Ultimate Performance Division', 'Ultimate Performance Division', 'text'],
            ['welcome', 'hero', 'home_hero_title', 'PUSH THE <span class="text-daytona-orange">LIMITS</span> <br>OF SPEED', 'PUSH THE LIMITS OF SPEED', 'text'],
            ['welcome', 'hero', 'home_hero_description', 'Nagata Daytona menghadirkan komponen racing premium yang dirancang untuk performa maksimal di lintasan balap dan keandalan di jalan raya.', 'Hero Description', 'textarea'],
            ['welcome', 'hero', 'home_hero_cta_products', 'Cek Produk', 'Button Text: Cek Produk', 'text'],
            ['welcome', 'hero', 'home_hero_cta_about', 'Tentang Kami', 'Button Text: Tentang Kami', 'text'],
            ['welcome', 'hero', 'home_hero_image', 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&q=80&w=2000', 'Hero Background Image', 'image'],

            // HOME - FEATURES
            ['welcome', 'features', 'home_features_power_title', 'Maximum Power', 'Feature: Power Title', 'text'],
            ['welcome', 'features', 'home_features_power_desc', 'Dirancang untuk meningkatkan output daya mesin Anda secara signifikan dengan presisi yang tinggi melalui teknologi aliran udara optimal.', 'Feature: Power Desc', 'textarea'],
            ['welcome', 'features', 'home_features_durability_title', 'Durability', 'Feature: Durability Title', 'text'],
            ['welcome', 'features', 'home_features_durability_desc', 'Material kualitas industri penerbangan memberikan ketahanan luar biasa bahkan dalam kondisi balapan paling ekstrem sekalipun.', 'Feature: Durability Desc', 'textarea'],
            ['welcome', 'features', 'home_features_track_title', 'Track Tested', 'Feature: Track Title', 'text'],
            ['welcome', 'features', 'home_features_track_desc', 'Setiap komponen telah diuji coba secara ketat di berbagai sirkuit internasional untuk memastikan standar balap tertinggi.', 'Feature: Track Desc', 'textarea'],

            // HOME - LATEST
            ['welcome', 'latest', 'home_latest_subtitle', 'Our Collection', 'Latest Products: Subtitle', 'text'],
            ['welcome', 'latest', 'home_latest_title', 'Latest <span class="text-daytona-orange">Products</span>', 'Latest Products: Title', 'text'],
            ['welcome', 'latest', 'home_latest_view_all', 'View All Collection', 'View All Button Text', 'text'],

            // ABOUT - HEADER
            ['about', 'header', 'about_header_subtitle', 'Quality & Precision', 'About Header: Subtitle', 'text'],
            ['about', 'header', 'about_header_title', 'About <span class="text-daytona-orange">Us</span>', 'About Header: Title', 'text'],
            ['about', 'header', 'about_header_desc', 'Lebih dari sekadar komponen. Kami menghadirkan teknologi lintasan balap ke genggaman setiap pengendara yang menginginkan kesempurnaan.', 'About Header Desc', 'textarea'],

            // ABOUT - STORY
            ['about', 'story', 'about_story_title', 'Pushing the Limits of Performance', 'Story Title', 'text'],
            ['about', 'story', 'about_story_p1', 'Nagata Daytona didirikan dengan satu visi sederhana: menghadirkan teknologi suku cadang mesin berperforma tinggi tingkat lintasan balap ke tangan setiap pengendara yang menginginkan kesempurnaan.', 'Story Paragraph 1', 'textarea'],
            ['about', 'story', 'about_story_p2', 'Berawal dari kecintaan pada dunia otomotif dan teknobiologi mesin, kami menggabungkan keahlian teknik tingkat lanjut dengan material kelas industri penerbangan untuk menciptakan produk yang tidak hanya meningkatkan tenaga, tetapi juga ketahanan mesin dalam kondisi paling ekstrem sekalipun.', 'Story Paragraph 2', 'textarea'],
            ['about', 'story', 'about_story_image', 'https://images.unsplash.com/photo-1486006151703-9993309a4d8b?auto=format&fit=crop&q=80&w=1200', 'Story Image', 'image'],

            // ABOUT - VISION/MISSION
            ['about', 'vision', 'about_vision_title', '01. Our Vision', 'Vision Title', 'text'],
            ['about', 'vision', 'about_vision_desc', 'Menjadi pemimpin global dalam inovasi suku cadang racing yang menginspirasi standar baru di dunia otomotif.', 'Vision Desc', 'textarea'],
            ['about', 'mission', 'about_mission_title', '02. Our Mission', 'Mission Title', 'text'],
            ['about', 'mission', 'about_mission_list', "Mengembangkan teknologi mesin dengan riset berkelanjutan.\nMenyediakan produk dengan standar keamanan dan daya tahan tertinggi.", 'Mission List (One per line)', 'textarea'],
            ['about', 'values', 'about_values_title', '03. Our Values', 'Values Title', 'text'],
            ['about', 'values', 'about_values_list', "Precision, Innovation, Reliability", 'Values List (Comma separated)', 'text'],

            // ABOUT - STATS
            ['about', 'stats', 'about_stats_exp_num', '15+', 'Stats: Years Num', 'text'],
            ['about', 'stats', 'about_stats_exp_label', 'Tahun Pengalaman', 'Stats: Years Label', 'text'],
            ['about', 'stats', 'about_stats_parts_num', '250+', 'Stats: Parts Num', 'text'],
            ['about', 'stats', 'about_stats_parts_label', 'Komponen Racing', 'Stats: Parts Label', 'text'],
            ['about', 'stats', 'about_stats_users_num', '12k+', 'Stats: Users Num', 'text'],
            ['about', 'stats', 'about_stats_users_label', 'Pengguna Aktif', 'Stats: Users Label', 'text'],
            ['about', 'stats', 'about_stats_track_num', '100%', 'Stats: Track Num', 'text'],
            ['about', 'stats', 'about_stats_track_label', 'Track Tested', 'Stats: Track Label', 'text'],

            // CONTACT
            ['contact', 'header', 'contact_header_subtitle', 'Get In Touch', 'Contact Header: Subtitle', 'text'],
            ['contact', 'header', 'contact_header_title', 'Contact <span class="text-daytona-orange">Us</span>', 'Contact Header: Title', 'text'],
            ['contact', 'header', 'contact_header_desc', 'Ada pertanyaan mengenai produk atau kemitraan bisnis? Tim ahli kami yang berdedikasi siap memberikan solusi otomotif untuk Anda.', 'Contact Header Desc', 'textarea'],
            ['contact', 'sidebar', 'contact_sidebar_title', 'General Inquiries', 'Contact Sidebar Title', 'text'],
            ['contact', 'sidebar', 'contact_sidebar_desc', 'Ada pertanyaan mengenai produk atau kemitraan? Jangan ragu untuk menghubungi tim ahli kami.', 'Contact Sidebar Desc', 'textarea'],

            // DEALERS
            ['dealers', 'header', 'dealers_header_subtitle', 'Offline Store', 'Dealers Header: Subtitle', 'text'],
            ['dealers', 'header', 'dealers_header_title', 'Lokasi <span class="text-daytona-orange">Dealer</span>', 'Dealers Header: Title', 'text'],
            ['dealers', 'header', 'dealers_header_desc', 'Temukan suku cadang resmi Nagata Daytona dan performa maksimal untuk motor Anda di bengkel atau toko sparepart terdekat.', 'Dealers Header Desc', 'textarea'],

            // HOME - QUICK FILTER
            ['welcome', 'filter', 'home_filter_subtitle', 'Quick Filter', 'Filter Subtitle', 'text'],
            ['welcome', 'filter', 'home_filter_title', 'Cari Part untuk <br><span class="text-slate-400">Motor Anda</span>', 'Filter Title', 'text'],
            ['welcome', 'filter', 'home_filter_desc', 'Pilih merk & model, temukan semua suku cadang yang kompatibel.', 'Filter Description', 'textarea'],
        ];

        foreach ($contents as $c) {
            \App\Models\WebContent::updateOrCreate(
                ['slug' => $c[2]],
                [
                    'page' => $c[0],
                    'section' => $c[1],
                    'title' => $c[4],
                    'value' => $c[3],
                    'type' => $c[5],
                ]
            );
        }
    }
}
