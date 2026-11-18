<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $ropa = \App\Models\Category::create([
            'name' => 'Ropa',
            'description' => 'Polos y camisetas',
        ]);
        $acc = \App\Models\Category::create([
            'name' => 'Accesorios',
            'description' => 'Gorras y mas',
        ]);
        \App\Models\Product::create([
            'name' => 'Polo Overskull',
            'description' => 'Camiseta negra edicion limitada',
            'price' => 89.90,
            'category_id' => $ropa->id,
            'stock' => 50,
        ]);
        \App\Models\Product::create([
            'name' => 'Gorra Overskull',
            'description' => 'Gorra bordada',
            'price' => 49.90,
            'category_id' => $acc->id,
            'stock' => 30,
        ]);
    }
}
