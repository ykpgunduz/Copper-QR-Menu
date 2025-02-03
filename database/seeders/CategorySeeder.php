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
                'name' => 'Soğuk İçecekler',
                'icon' => 'fa-regular fa-snowflake',
                'color' => '#005AC8',
            ],
            [
                'name' => 'Sıcak İçecekler',
                'icon' => 'fa-solid fa-fire-flame-curved',
                'color' => '#B40000',
            ],
            [
                'name' => 'Tuzlular',
                'icon' => 'fa-solid fa-burger',
                'color' => '#A35200',
            ],
            [
                'name' => 'Tatlılar',
                'icon' => "fa-solid fa-candy-cane",
                'color' => '#A35200',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
