<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');

        $products = [
            [
                'category_slug' => 'wall-clock',
                'name' => 'Chrome Bubble Wall Clock',
                'slug' => 'chrome-bubble-wall-clock',
                'description' => 'Jam dinding dengan bingkai chrome mengilap (metallic finish) dan kaca cembung ala bubble retro modern. Memberikan aksen futuristik pada dinding kamar Anda.',
                'price' => 289000,
                'stock' => 15,
                'image' => 'images/products/chrome-bubble-wall-clock.svg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'mirror',
                'name' => 'Wave Mirror Neon Lilac',
                'slug' => 'wave-mirror-neon-lilac',
                'description' => 'Cermin dinding ikonik dengan lekukan gelombang bergradasi pastel lilac dan baby blue. Sangat fotogenik untuk OOTD dan mirror selfie estetik.',
                'price' => 349000,
                'stock' => 12,
                'image' => 'images/products/y2k-wave-mirror.svg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'lighting',
                'name' => 'Cloud Bedside Lamp Soft Glow',
                'slug' => 'cloud-bedside-lamp-soft-glow',
                'description' => 'Lampu meja berbentuk awan lembut dengan pencahayaan warm glow yang menenangkan. Dilengkapi tombol sentuh glossy dan kaki silver kokoh.',
                'price' => 219000,
                'stock' => 20,
                'image' => 'images/products/cloud-bedside-lamp.svg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'storage',
                'name' => 'Mini Acrylic Floating Shelf',
                'slug' => 'mini-acrylic-floating-shelf',
                'description' => 'Rak dinding transparan berbahan akrilik premium dengan efek semburan warna lavender lembut. Kuat untuk memajang parfum, figurin, dan dekorasi mini kesayangan.',
                'price' => 165000,
                'stock' => 18,
                'image' => 'images/products/mini-acrylic-shelf.svg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'lighting',
                'name' => 'Silver Star Metallic Table Lamp',
                'slug' => 'silver-star-metallic-table-lamp',
                'description' => 'Lampu meja berdesain bintang futuristik dengan lapisan perak berkilau. Menghasilkan pencahayaan ambient yang hangat sekaligus menjadi statement piece.',
                'price' => 385000,
                'stock' => 8,
                'image' => 'images/products/silver-star-table-lamp.svg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'storage',
                'name' => 'Pastel Translucent Storage Box',
                'slug' => 'pastel-translucent-storage-box',
                'description' => 'Kotak penyimpanan plastik transparan berwarna pastel dengan tutup warna pink permen karet. Stackable, awet, dan membuat kamar selalu tertata rapi.',
                'price' => 129000,
                'stock' => 25,
                'image' => 'images/products/pastel-translucent-storage-box.svg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'furniture',
                'name' => 'Bubble Accent Side Table',
                'slug' => 'bubble-accent-side-table',
                'description' => 'Meja samping estetik dengan kaki silinder bertumpuk gelembung (bubble silhouette). Dibuat dari resin finishing glossy tahan gores.',
                'price' => 890000,
                'stock' => 6,
                'image' => 'images/products/bubble-accent-side-table.svg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'mirror',
                'name' => 'Heart Glow Neon Wall Mirror',
                'slug' => 'heart-glow-neon-wall-mirror',
                'description' => 'Cermin bentuk hati dengan border lampu neon fleksibel berwarna pink magenta. Memberikan pantulan jernih dan suasana dreamy di dalam kamar.',
                'price' => 425000,
                'stock' => 10,
                'image' => 'images/products/heart-glow-neon-wall-mirror.svg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'wall-clock',
                'name' => 'Cyber Metallic Desk Clock',
                'slug' => 'cyber-metallic-desk-clock',
                'description' => 'Jam meja digital dengan bodi metalik retrofuturistik dan display LED font khas era cyber digital. Memiliki fitur alarm dan pengingat waktu.',
                'price' => 245000,
                'stock' => 14,
                'image' => 'images/products/cyber-metallic-desk-clock.svg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'decoration',
                'name' => 'Holographic Acrylic Vase',
                'slug' => 'holographic-acrylic-vase',
                'description' => 'Vas bunga akrilik bergradasi warna pelangi hologram yang memancarkan kilau warna-warni saat terkena sinar matahari.',
                'price' => 179000,
                'stock' => 22,
                'image' => 'images/products/holographic-acrylic-vase.svg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'decoration',
                'name' => 'Retro Futuristic Velvet Cushion',
                'slug' => 'retro-futuristic-velvet-cushion',
                'description' => 'Bantal sofa bundar berbahan beludru (velvet) mewah dengan kancing perak di tengahnya. Sangat empuk dan nyaman untuk bersantai.',
                'price' => 149000,
                'stock' => 30,
                'image' => 'images/products/retro-futuristic-velvet-cushion.svg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'furniture',
                'name' => 'Glossy Pod Swivel Chair',
                'slug' => 'glossy-pod-swivel-chair',
                'description' => 'Kursi putar model cangkang pod retro dengan bantalan empuk warna baby pink dan kaki cakar chrome putar 360 derajat.',
                'price' => 1450000,
                'stock' => 5,
                'image' => 'images/products/glossy-pod-swivel-chair.svg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'decoration',
                'name' => 'Chrome Starburst Wall Decor',
                'slug' => 'chrome-starburst-wall-decor',
                'description' => 'Hiasan dinding bintang pecah (starburst) dari kawat metalik berlapis chrome dengan bola-bola cermin kecil di setiap ujungnya.',
                'price' => 195000,
                'stock' => 16,
                'image' => 'images/products/chrome-starburst-wall-decor.svg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'storage',
                'name' => 'Pastel Arch Display Bookshelf',
                'slug' => 'pastel-arch-display-bookshelf',
                'description' => 'Rak buku dengan lengkungan kubah arsitektur pastel. Memiliki 4 tingkat ambalan kokoh untuk memajang buku, majalah fesyen, dan lilin aromaterapi.',
                'price' => 1150000,
                'stock' => 4,
                'image' => 'images/products/pastel-arch-display-bookshelf.svg',
                'is_featured' => true,
            ],
        ];

        foreach ($products as $item) {
            $cat = $categories->get($item['category_slug']);
            if ($cat) {
                Product::updateOrCreate(
                    ['slug' => $item['slug']],
                    [
                        'category_id' => $cat->id,
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'stock' => $item['stock'],
                        'image' => $item['image'],
                        'is_active' => true,
                        'is_featured' => $item['is_featured'],
                    ]
                );
            }
        }
    }
}
