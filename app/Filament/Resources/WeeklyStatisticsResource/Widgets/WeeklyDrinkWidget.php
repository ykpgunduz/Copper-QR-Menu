<?php

namespace App\Filament\Resources\WeeklyStatisticsResource\Widgets;

use App\Models\PastOrder;
use Filament\Widgets\ChartWidget;

class WeeklyDrinkWidget extends ChartWidget
{
    protected static ?string $heading = 'Haftalık İçilen İçecekler';

    protected function getData(): array
    {
        $weeklyOrders = PastOrder::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->get();

        $parsedData = [];

        foreach ($weeklyOrders as $order) {
            if (empty($order->products)) {
                continue;
            }

            $lines = explode(',', $order->products);
            foreach ($lines as $line) {
                $line = trim($line);
                if (preg_match('/(\d+)\s*x\s*([^-]+?)\s*-\s*(\d+)₺/', $line, $matches)) {
                    $quantity = (int) $matches[1];
                    $productName = trim($matches[2]);

                    if (!isset($parsedData[$productName])) {
                        $parsedData[$productName] = 0;
                    }
                    $parsedData[$productName] += $quantity;
                }
            }
        }

        if (empty($parsedData)) {
            return [
                'datasets' => [
                    [
                        'label' => 'İçecek Miktarı',
                        'data' => [1],
                        'backgroundColor' => ['#cccccc'],
                    ],
                ],
                'labels' => ['Veri Bulunamadı'],
            ];
        }

        // İçecek isimleri ve miktarlarını ayırıyoruz
        $beverageLabels = array_keys($parsedData);
        $beverageQuantities = array_values($parsedData);

        // Koyu ve canlı renkler paleti
        $colors = [
            '#1a237e', '#880e4f', '#1b5e20', '#3e2723', '#263238', // Çok koyu tonlar
            '#0d47a1', '#b71c1c', '#004d40', '#311b92', '#4a148c',
            '#006064', '#e65100', '#33691e', '#827717', '#bf360c', // Koyu canlı tonlar
            '#01579b', '#880e4f', '#1b5e20', '#4a148c', '#3e2723',
            '#1a237e', '#b71c1c', '#004d40', '#ff6f00', '#4e342e', // Karışık koyu tonlar
            '#0d47a1', '#6a1b9a', '#2e7d32', '#4e342e', '#37474f',
            '#283593', '#ad1457', '#1565c0', '#6a1b9a', '#4527a0', // Zengin koyu tonlar
            '#00838f', '#c62828', '#2e7d32', '#4a148c', '#3e2723'
        ];

        // Renkler listesine veri kümesi için renkleri atıyoruz
        $backgroundColor = array_slice($colors, 0, count($beverageLabels));

        return [
            'datasets' => [
                [
                    'label' => 'İçecek Miktarı',
                    'data' => $beverageQuantities,
                    'backgroundColor' => $backgroundColor,
                ],
            ],
            'labels' => $beverageLabels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
