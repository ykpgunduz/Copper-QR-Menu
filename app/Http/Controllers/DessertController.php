<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DessertController extends Controller
{
    public function create()
    {
        $products = Product::whereHas('category', function($query) {
            $query->where('name', 'Kiloluk Tatlılar');
        })->get();

        return view('add-dessert', compact('products'));
    }

    public function store(Request $request)
    {
        $orderItems = json_decode($request->input('order_items'), true);
        $tableNumber = $request->input('table_number');
        $paymentMethod = $request->input('payment_method');
        $receivedAmount = floatval($request->input('received_amount')) ?? 0;

        if (!$orderItems) {
            return redirect()->back()->with('error', 'Sepet boş.');
        }

        $totalAmount = array_sum(array_map(function ($item) {
            return floatval($item['price']);
        }, $orderItems));

        $ikramAmount = $totalAmount - $receivedAmount;

        $cashMoney = $paymentMethod === 'nakit' ? $receivedAmount : 0;
        $creditCard = $paymentMethod === 'kart' ? $receivedAmount : 0;
        $iban = $paymentMethod === 'iban' ? $receivedAmount : 0;

        $formattedProducts = array_map(function ($item) {
            return sprintf(
                "%s (%.0f gr) - %.2f₺",
                $item['name'],
                $item['weight'],
                floatval($item['price'])
            );
        }, $orderItems);

        $orderNumber = 'KT-' . strtoupper(uniqid());

        DB::table('past_orders')->insert([
            'session_id' => $request->session()->getId(),
            'table_number' => $tableNumber,
            'total_amount' => $totalAmount - $ikramAmount,
            'net_amount' => $receivedAmount,
            'products' => implode("\n", $formattedProducts),
            'quantity' => count($orderItems),
            'order_number' => $orderNumber,
            'cash_money' => $cashMoney,
            'credit_card' => $creditCard,
            'iban' => $iban,
            'device_info' => $request->header('User-Agent'),
            'note' => '-',
            'ikram' => $ikramAmount,
            'selfikram' => 0,
            'customer' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return view('receipt-dessert', [
            'orderNumber' => $orderNumber,
            'tableNumber' => $tableNumber,
            'products' => implode("\n", $formattedProducts),
            'totalAmount' => $totalAmount,
            'netAmount' => $receivedAmount,
            'ikram' => $ikramAmount,
            'cashMoney' => $cashMoney,
            'creditCard' => $creditCard,
            'iban' => $iban
        ]);
    }

    public function dessert()
    {
        $products = Product::where('active', true)
            ->whereHas('category', function($query) {
                $query->where('name', 'Kiloluk Tatlılar');
            })
            ->get();

        $cafe = Cafe::find(1);

        return view('kiloluk-tatlilar', compact('products', 'cafe'));
    }
}
