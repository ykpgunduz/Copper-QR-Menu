<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Calculation;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewOrderController extends Controller
{
    public function index()
    {
        $products = Product::where('active', true)->get();
        $categories = Category::all();

        return view('add-order', compact('products', 'categories'));
    }

    public function saveOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            $existingCalculation = Calculation::where('table_number', $request->masa_no)
                ->where('status', 'Masa')
                ->first();

            if ($existingCalculation) {
                foreach ($request->urunler as $urun) {
                    $product = Product::find($urun['urun_id']);
                    $price = $product->price;

                    $existingItem = OrderItem::where('table_number', $request->masa_no)
                        ->where('product_id', $urun['urun_id'])
                        ->where('status', 'Yeni Sipariş')
                        ->first();

                    if ($existingItem) {
                        $existingItem->quantity += $urun['adet'];
                        $existingItem->price = $price * $existingItem->quantity;
                        $existingItem->save();
                    } else {
                        OrderItem::create([
                            'product_id' => $urun['urun_id'],
                            'quantity' => $urun['adet'],
                            'price' => $price * $urun['adet'],
                            'table_number' => $request->masa_no,
                            'status' => 'Yeni Sipariş'
                        ]);
                    }
                }

                $message = 'Ürünler mevcut masaya eklendi!';
            } else {
                $lastOrderNumber = Calculation::max('order_number') ?? 0;
                $newOrderNumber = $lastOrderNumber + 1;

                $newCalculation = Calculation::create([
                    'table_number' => $request->masa_no,
                    'status' => 'Masa',
                    'total_amount' => 0,
                    'order_number' => $newOrderNumber
                ]);

                foreach ($request->urunler as $urun) {
                    $product = Product::find($urun['urun_id']);
                    $price = $product->price;

                    OrderItem::create([
                        'product_id' => $urun['urun_id'],
                        'quantity' => $urun['adet'],
                        'price' => $price * $urun['adet'],
                        'table_number' => $request->masa_no,
                        'status' => 'Yeni Sipariş'
                    ]);
                }

                $message = 'Yeni masa açıldı ve siparişler eklendi!';
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => $message]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }
}
