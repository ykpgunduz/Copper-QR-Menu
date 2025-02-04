<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Espresso Kahveler',
                'icon' => 'fa-solid fa-fire-flame-curved',
                'color' => '#B40000',
            ],
            [
                'name' => 'Soğuk Kahveler',
                'icon' => 'fa-regular fa-snowflake',
                'color' => '#005AC8',
            ],
            [
                'name' => 'Tatlılar',
                'icon' => 'fa-solid fa-candy-cane',
                'color' => '#B40000',
            ],
            [
                'name' => 'Tuzlular',
                'icon' => 'fa-solid fa-cookie-bite',
                'color' => '#A35200',
            ],
            [
                'name' => 'Yöremizden Gelenler',
                'icon' => 'fa-solid fa-mug-saucer',
                'color' => '#005AC8',
            ],
            [
                'name' => 'Mocktails',
                'icon' => 'fa-solid fa-wine-glass-empty',
                'color' => '#B40000',
            ],
            [
                'name' => 'Frozens',
                'icon' => 'fa-solid fa-snowflake',
                'color' => '#005AC8',
            ],
            [
                'name' => 'Milkshakes',
                'icon' => 'fa-solid fa-snowflake',
                'color' => '#005AC8',
            ],
            [
                'name' => 'Meşrubatlar',
                'icon' => 'fa-solid fa-fire-flame-curved',
                'color' => '#B40000',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
