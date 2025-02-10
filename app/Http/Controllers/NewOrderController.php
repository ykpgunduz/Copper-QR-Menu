<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Calculation;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NewOrderController extends Controller
{
    public function index()
    {
        // Eager loading ile ilişkili verileri tek sorguda çekelim
        $products = Product::with('category')
            ->where('active', true)
            ->get();

        $categories = Category::select('id', 'name')->get();

        return view('add-order', compact('products', 'categories'));
    }

    public function saveOrder(Request $request)
    {
        try {
            // İstek validasyonu ekleyelim
            $this->validateOrder($request);

            return DB::transaction(function () use ($request) {
                $tableNumber = $request->masa_no;
                $existingCalculation = $this->getExistingCalculation($tableNumber);

                if ($existingCalculation) {
                    $this->updateExistingOrder($request->urunler, $tableNumber);
                    $message = 'Ürünler mevcut masaya eklendi!';
                } else {
                    $this->createNewOrder($request->urunler, $tableNumber);
                    $message = 'Yeni masa açıldı ve siparişler eklendi!';
                }

                // Masa toplam tutarını güncelle
                $this->updateTableTotal($tableNumber);

                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            });

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasyon hatası',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    private function validateOrder(Request $request)
    {
        $request->validate([
            'masa_no' => 'required|integer|min:1',
            'urunler' => 'required|array',
            'urunler.*.urun_id' => 'required|exists:products,id',
            'urunler.*.adet' => 'required|integer|min:1',
        ]);
    }

    private function getExistingCalculation($tableNumber)
    {
        return Calculation::where('table_number', $tableNumber)
            ->where('status', 'Masa')
            ->first();
    }

    private function updateExistingOrder(array $products, $tableNumber)
    {
        $productPrices = $this->getProductPrices(array_column($products, 'urun_id'));

        foreach ($products as $product) {
            $price = $productPrices[$product['urun_id']] ?? 0;
            $totalPrice = $price * $product['adet'];

            OrderItem::updateOrCreate(
                [
                    'table_number' => $tableNumber,
                    'product_id' => $product['urun_id'],
                    'status' => 'Yeni Sipariş'
                ],
                [
                    'quantity' => DB::raw("quantity + {$product['adet']}"),
                    'price' => DB::raw("price + {$totalPrice}")
                ]
            );
        }
    }

    private function createNewOrder(array $products, $tableNumber)
    {
        $newOrderNumber = Calculation::max('order_number') + 1;

        Calculation::create([
            'table_number' => $tableNumber,
            'status' => 'Masa',
            'total_amount' => 0,
            'order_number' => $newOrderNumber
        ]);

        $productPrices = $this->getProductPrices(array_column($products, 'urun_id'));

        $orderItems = array_map(function ($product) use ($tableNumber, $productPrices) {
            $price = $productPrices[$product['urun_id']] ?? 0;
            return [
                'product_id' => $product['urun_id'],
                'quantity' => $product['adet'],
                'price' => $price * $product['adet'],
                'table_number' => $tableNumber,
                'status' => 'Yeni Sipariş',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $products);

        OrderItem::insert($orderItems);
    }

    private function getProductPrices(array $productIds)
    {
        return Product::whereIn('id', $productIds)
            ->pluck('price', 'id')
            ->toArray();
    }

    private function updateTableTotal($tableNumber)
    {
        $total = OrderItem::where('table_number', $tableNumber)
            ->where('status', 'Yeni Sipariş')
            ->sum('price');

        Calculation::where('table_number', $tableNumber)
            ->where('status', 'Masa')
            ->update(['total_amount' => $total]);
    }
}
