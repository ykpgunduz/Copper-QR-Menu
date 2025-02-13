<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Calculation;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;

class NewOrderController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('active', true)
            ->get();

        $categories = Category::select('id', 'name')->get();

        $aktifMasalar = Calculation::where('status', 'Masa')
            ->get(['table_number', 'total_amount'])
            ->mapWithKeys(function ($masa) {
                return [$masa->table_number => $masa->total_amount];
            })
            ->toArray();

        return view('add-order', compact('products', 'categories', 'aktifMasalar'));
    }

    public function siparisEkle(Request $request)
    {
        $request->validate([
            'masa_no' => 'required|integer',
            'urunler' => 'required|array'
        ]);

        $tableNumber = $request->masa_no;
        $toplamTutar = 0;

        $existingOrder = Calculation::where('table_number', $tableNumber)->first();

        foreach ($request->urunler as $urunId => $urun) {
            if ($urun['adet'] > 0) {
                $toplamTutar += $urun['adet'] * $urun['fiyat'];
            }
        }

        if ($existingOrder) {
            $existingOrder->total_amount += $toplamTutar;
            $existingOrder->status = 'Masa';
            $existingOrder->save();
            $orderId = $existingOrder->id;
        } else {
            $calculation = Calculation::create([
                'table_number' => $tableNumber,
                'total_amount' => $toplamTutar,
                'status' => 'Masa',
                'order_number' => 'ORD-' . strtoupper(uniqid()),
            ]);
            $orderId = $calculation->id;
        }

        foreach ($request->urunler as $urunId => $urun) {
            if ($urun['adet'] > 0) {
                OrderItem::create([
                    'table_number' => $tableNumber,
                    'product_id' => $urunId,
                    'quantity' => $urun['adet'],
                    'price' => $urun['fiyat']
                ]);
            }
        }

        $notification = $tableNumber . ". Masa Sipariş Verdi!";
        Notification::make()
            ->title($notification)
            ->success()
            ->duration(5000)
            ->sendToDatabase(User::all());

        return redirect()->back()->with('success', 'Sipariş başarıyla eklendi');
    }
}
