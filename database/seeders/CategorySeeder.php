<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Wall Clock',
                'slug' => 'wall-clock',
                'description' => 'Jam dinding estetik dengan nuansa chrome futuristik dan bubble design.',
                'icon' => 'clock',
            ],
            [
                'name' => 'Lighting',
                'slug' => 'lighting',
                'description' => 'Lampu meja, lampu dekorasi, dan neon glow lembut untuk atmosfer kamar yang dreamy.',
                'icon' => 'lamp',
            ],
            [
                'name' => 'Mirror',
                'slug' => 'mirror',
                'description' => 'Cermin bentuk bergelombang (wave) dan neon frame yang ikonik untuk mirror selfie.',
                'icon' => 'mirror',
            ],
            [
                'name' => 'Furniture',
                'slug' => 'furniture',
                'description' => 'Meja aksen bubble, pod chair mengilap, dan furniture berkarakter futuristik retro.',
                'icon' => 'chair',
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'description' => 'Rak akrilik transparan dan storage box pastel untuk merapikan koleksi kamu.',
                'icon' => 'box',
            ],
            [
                'name' => 'Decoration',
                'slug' => 'decoration',
                'description' => 'Vase hologram, bantal velvet tufted, dan ornamen starburst pelengkap estetika ruangan.',
                'icon' => 'sparkles',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
