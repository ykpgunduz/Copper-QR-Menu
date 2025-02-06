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
                'thumbnail' => 'espresso-con-panna.webp',
                'title' => 'Espresso Con Panna',
                'price' => 115.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'espresso-ristretto.webp',
                'title' => 'Espresso Ristretto',
                'price' => 90.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'espresso-single.webp',
                'title' => 'Single Espresso',
                'price' => 90.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'espresso-doppio.webp',
                'title' => 'Double Espresso',
                'price' => 110.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'espresso-lungo.webp',
                'title' => 'Espresso Lungo',
                'price' => 100.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'espresso-macchiato.webp',
                'title' => 'Espresso Macchiato',
                'price' => 110.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'americano.webp',
                'title' => 'Americano',
                'price' => 115.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'mocha.webp',
                'title' => 'Mocha',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'filtre-kahve.webp',
                'title' => 'Filtre Kahve',
                'price' => 120.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'mocha-cesitleri.webp',
                'title' => 'White Mocha',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'cappucino.webp',
                'title' => 'Cappucino',
                'price' => 135.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'cortado.webp',
                'title' => 'Cortado',
                'price' => 145.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'flat-white.webp',
                'title' => 'Flat White',
                'price' => 145.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'latte-macchiato.webp',
                'title' => 'Latte Macchiato',
                'price' => 150.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'cafe-latte.webp',
                'title' => 'Cafe Latte',
                'price' => 135.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'latte-cesitleri.webp',
                'title' => 'Caramel Latte',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'latte-cesitleri.webp',
                'title' => 'Hazelnut Latte',
                'price' => 160.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'latte-cesitleri.webp',
                'title' => 'Extra Shot Espresso',
                'price' => 45.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'latte-cesitleri.webp',
                'title' => 'Yulaf & Badem Sütü',
                'price' => 25.00,
                'category' => 'Espresso Kahveler'
            ],
            [
                'thumbnail' => 'ice-americano.webp',
                'title' => 'Ice Americano',
                'price' => 140.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-filter.webp',
                'title' => 'Ice Filter',
                'price' => 140.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'ice-latte.webp',
                'title' => 'Ice Latte',
                'price' => 160.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Ice Caramel Latte',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Ice Hazelnut Latte',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Ice Caramel Macchiato',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Ice Mocha',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Ice White Mocha',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Caramel Frabuccino',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Vanilia Frabuccino',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Framboazlı Frabuccino',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
             [
                'thumbnail' => 'aromali-ice-latte.webp',
                'title' => 'Double İce Shaked Espresso',
                'price' => 175.00,
                'category' => 'Soğuk Kahveler'
            ],
            [
                'thumbnail' => 'sicak-cikolata.webp',
                'title' => 'Sıcak Çikolata',
                'price' => 175.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'salep.webp',
                'title' => 'Salep',
                'price' => 160.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'salep.webp',
                'title' => 'Fındık Parçacıklı Salep',
                'price' => 155.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'salep.webp',
                'title' => 'Çilekli Salep',
                'price' => 155.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'turk-kahvesi.webp',
                'title' => 'Türk Kahvesi',
                'price' => 100.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'double-turk-kahvesi.webp',
                'title' => 'Double Türk Kahvesi',
                'price' => 150.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'menengiç-kahvesi.webp',
                'title' => 'Menengiç Kahvesi',
                'price' => 110.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'double-menengiç-kahvesi.webp',
                'title' => 'Double Menengiç Kahvesi',
                'price' => 160.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'menengiç-kahvesi.webp',
                'title' => 'Dibek Kahvesi',
                'price' => 110.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'double-menengiç-kahvesi.webp',
                'title' => 'Double Dibek Kahvesi',
                'price' => 160.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Ihlamur',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Ada Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Yeşil Çay',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Papatya Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Melisa Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Copper Natural Tea',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'organic-cay.webp',
                'title' => 'Hibisküs Çayı',
                'price' => 115.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'fincan-cay.webp',
                'title' => 'Çay',
                'price' => 60.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'fincan-cay.webp',
                'title' => 'Fincan Çay',
                'price' => 60.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'take-away-cay.webp',
                'title' => 'Take Away Çay',
                'price' => 80.00,
                'category' => 'Yöremizden Gelenler'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Çilekli Milkshake',
                'price' => 160.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Muzlu Milkshake',
                'price' => 155.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Çikolatalı Milkshake',
                'price' => 165.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Vanilyalı Milkshake',
                'price' => 165.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Caramel Milkshake',
                'price' => 165.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Atom Milkshake',
                'price' => 185.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Oreo Milkshake',
                'price' => 175.00,
                'category' => 'Milkshakes'
            ],
            [
                'thumbnail' => 'frozen.webp',
                'title' => 'Çilekli Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'frozen.webp',
                'title' => 'Limonlu Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'frozen.webp',
                'title' => 'Mango Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'frozen.webp',
                'title' => 'Yeşil Elma Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'frozen.webp',
                'title' => 'Kırmızı Orman Meyveli Frozen',
                'price' => 180.00,
                'category' => 'Frozens'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Mojito',
                'price' => 170.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Çilekli Mojito',
                'price' => 180.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Redbull Mojito',
                'price' => 180.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'limonata.webp',
                'title' => 'Strawberry Sunrice',
                'price' => 170.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'milkshake.webp',
                'title' => 'Aloha',
                'price' => 170.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'portakal.webp',
                'title' => 'Portakal Suyu',
                'price' => 150.00,
                'category' => 'Mocktails'
            ],
            [
                'thumbnail' => 'coca-cola.png',
                'title' => 'Coca Cola',
                'price' => 90.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'cola-zero.webp',
                'title' => 'Coca Cola Zero',
                'price' => 90.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'su.webp',
                'title' => 'Su',
                'price' => 40.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'maden-suyu.webp',
                'title' => 'Maden Suyu',
                'price' => 75.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'churchil.webp',
                'title' => 'Churchill',
                'price' => 100.00,
                'category' => 'Meşrubatlar'
            ],
            [
                'thumbnail' => 'san-sebastian.webp',
                'title' => 'San Sebastian',
                'price' => 180.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'magnolya-meyveli.webp',
                'title' => 'Magnolya',
                'price' => 85.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'brownie.webp',
                'title' => 'Brownie',
                'price' => 160.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'lotus-cheesecake.webp',
                'title' => 'Lotus Cheesecake',
                'price' => 195.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'frambuazli-cheesecake.webp',
                'title' => 'Frambuazlı Cheesecake',
                'price' => 140.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'tralice.webp',
                'title' => 'Tralice',
                'price' => 75.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'cookie.webp',
                'title' => 'Cookie',
                'price' => 60.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'damla-sakizli-muhallebi.webp',
                'title' => 'Damla Sakızlı Muhallebi',
                'price' => 85.00,
                'category' => 'Tatlılar'
            ],
            [
                'thumbnail' => 'dubai-tatlisi.webp',
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
