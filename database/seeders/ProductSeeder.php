<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'thumbnail' => 'espresso-con-panna.jpg',
                'title' => 'Espresso Con Panna',
                'price' => 115.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'ristretto.jpg',
                'title' => 'Espresso Ristretto',
                'price' => 90.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'espresso.jpg',
                'title' => 'Single Espresso',
                'price' => 90.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'double-espresso.jpg',
                'title' => 'Double Espresso',
                'price' => 110.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'lungo-espresso.jpg',
                'title' => 'Espresso Lungo',
                'price' => 100.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'espresso-macchiato.jpg',
                'title' => 'Espresso Macchiato',
                'price' => 110.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'americano.jpg',
                'title' => 'Americano',
                'price' => 115.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'mocha.jpg',
                'title' => 'Mocha',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'filtre-kahve.jpg',
                'title' => 'Filtre Kahve',
                'price' => 120.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'white-mocha.jpg',
                'title' => 'White Mocha',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'cappuccino.jpg',
                'title' => 'Cappucino',
                'price' => 135.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'cortado.jpg',
                'title' => 'Cortado',
                'price' => 145.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'flate-white.jpg',
                'title' => 'Flat White',
                'price' => 145.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'cafe-latte.jpg',
                'title' => 'Cafe Latte',
                'price' => 135.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'caramel-latte.jpg',
                'title' => 'Caramel Latte',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'hazelnut-latte.jpg',
                'title' => 'Hazelnut Latte',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'extra-shot-espresso.jpg',
                'title' => 'Extra Shot Espresso',
                'price' => 45.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'badem-yulaf-sutu.jpg',
                'title' => 'Yulaf & Badem Sütü',
                'price' => 25.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'ice-americano.jpg',
                'title' => 'Ice Americano',
                'price' => 140.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-latte.jpg',
                'title' => 'Ice Latte',
                'price' => 160.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-caramel-latte.jpg',
                'title' => 'Ice Caramel Latte',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-hazelnut-latte.jpg',
                'title' => 'Ice Hazelnut Latte',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-caramel-macchiato.jpg',
                'title' => 'Ice Caramel Macchiato',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-mocha.jpg',
                'title' => 'Ice Mocha',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-white-mocha.jpg',
                'title' => 'Ice White Mocha',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'caramelli-frappucino.jpg',
                'title' => 'Caramel Frabuccino',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'vanilla-frappucino.jpg',
                'title' => 'Vanilia Frabuccino',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'frambuazli-frappucino.jpg',
                'title' => 'Framboazlı Frabuccino',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'double-ice-espresso.jpg',
                'title' => 'Double İce Shaked Espresso',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'sicak-cikolata.jpg',
                'title' => 'Sıcak Çikolata',
                'price' => 175.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'salep.jpg',
                'title' => 'Salep',
                'price' => 160.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'findik-parcacikli-salep.jpg',
                'title' => 'Fındık Parçacıklı Salep',
                'price' => 155.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'cilekli-salep.jpg',
                'title' => 'Çilekli Salep',
                'price' => 155.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'turk-kahvesi.jpg',
                'title' => 'Türk Kahvesi',
                'price' => 100.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'double-turk-kahvesi.jpg',
                'title' => 'Double Türk Kahvesi',
                'price' => 150.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'menengic-kahvesi.jpg',
                'title' => 'Menengiç Kahvesi',
                'price' => 110.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'menengic-kahvesi.jpg',
                'title' => 'Double Menengiç Kahvesi',
                'price' => 160.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'dibek-kahvesi.jpg',
                'title' => 'Dibek Kahvesi',
                'price' => 110.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'dibek-kahvesi.jpg',
                'title' => 'Double Dibek Kahvesi',
                'price' => 160.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'ihlamur.jpg',
                'title' => 'Ihlamur',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'ada-cayi.jpg',
                'title' => 'Ada Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'yesil-cay.jpg',
                'title' => 'Yeşil Çay',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'papatya-cayi.jpg',
                'title' => 'Papatya Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'kis-cayi.jpg',
                'title' => 'Kış Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'melisa-cayi.jpg',
                'title' => 'Melisa Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'copper-natural-tea.jpg',
                'title' => 'Copper Natural Tea',
                'price' => 175.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'hibiskus.jpg',
                'title' => 'Hibisküs Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'çay.jpg',
                'title' => 'Çay',
                'price' => 45.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'fincan-cay.jpg',
                'title' => 'Fincan Çay',
                'price' => 60.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'cilekli-milkshake.jpg',
                'title' => 'Çilekli Milkshake',
                'price' => 160.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'muzlu-milkshake.jpg',
                'title' => 'Muzlu Milkshake',
                'price' => 155.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'cikolatali-milkshake.jpg',
                'title' => 'Çikolatalı Milkshake',
                'price' => 165.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'vanilia-milkshake.jpg',
                'title' => 'Vanilyalı Milkshake',
                'price' => 165.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'caramelli-milkshake.jpg',
                'title' => 'Caramel Milkshake',
                'price' => 165.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'atom-milkshake.jpg',
                'title' => 'Atom Milkshake',
                'price' => 185.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'oreo-milkshake.jpg',
                'title' => 'Oreo Milkshake',
                'price' => 175.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'cilekli-frozen.jpg',
                'title' => 'Çilekli Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'limonlu-frozen.jpg',
                'title' => 'Limonlu Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'mangolu-frozen.jpg',
                'title' => 'Mango Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'yesil-elmali-frozen.jpg',
                'title' => 'Yeşil Elma Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'orman-meyveli-frozen.jpg',
                'title' => 'Kırmızı Orman Meyveli Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'mojito.jpg',
                'title' => 'Mojito',
                'price' => 170.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'cilekli-mojito.jpg',
                'title' => 'Çilekli Mojito',
                'price' => 180.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'redbull-mojito.jpg',
                'title' => 'Redbull Mojito',
                'price' => 180.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'strawberry-sunrise.jpg',
                'title' => 'Strawberry Sunrice',
                'price' => 170.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'aloha.jpg',
                'title' => 'Aloha',
                'price' => 170.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'portakal-suyu.jpg',
                'title' => 'Portakal Suyu',
                'price' => 150.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'coca-cola.webp',
                'title' => 'Coca Cola',
                'price' => 80.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'fanta.webp',
                'title' => 'Fanta',
                'price' => 80.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'sprite.webp',
                'title' => 'Sprite',
                'price' => 80.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'limonlu-soda.jpg',
                'title' => 'Limonlu Soda',
                'price' => 70.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'elmali-soda.jpg',
                'title' => 'Elmalı Soda',
                'price' => 70.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'ice-tea-seftali.webp',
                'title' => 'İce Tea Seftali',
                'price' => 70.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'ice-tea-limon.jpg',
                'title' => 'İce Tea Limon',
                'price' => 70.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'fusetea-mango.jpg',
                'title' => 'Fusetea Mango',
                'price' => 70.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'redbull.webp',
                'title' => 'Redbull',
                'price' => 90.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'su.jpg',
                'title' => 'Su',
                'price' => 30.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'maden-suyu.jpg',
                'title' => 'Maden Suyu',
                'price' => 50.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'churchill.jpg',
                'title' => 'Churchill',
                'price' => 60.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'san-sebastian.jpg',
                'title' => 'San Sebastian',
                'price' => 180.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'magnolya.jpg',
                'title' => 'Magnolya',
                'price' => 85.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'brownie.jpg',
                'title' => 'Brownie',
                'price' => 160.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'lotus-cheescake.jpg',
                'title' => 'Lotus Cheesecake',
                'price' => 195.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'frambuazlı-chessecake.jpg',
                'title' => 'Frambuazlı Cheesecake',
                'price' => 140.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'trilece.avif',
                'title' => 'Trileçe',
                'price' => 75.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'cookie.jpg',
                'title' => 'Cookie',
                'price' => 60.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'damla-sakizli-muhallebi.png',
                'title' => 'Damla Sakızlı Muhallebi',
                'price' => 85.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'dubai-tatlisi.jpg',
                'title' => 'Dubai Tatlısı',
                'price' => 240.00,
                'category' => 'Tatlılar'
            ]
        ];

        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product['category']]);

            Product::create([
                'thumbnail' => $product['thumbnail'],
                'title' => $product['title'],
                'price' => $product['price'],
                'category_id' => $category->id,
            ]);
        }
    }
}
