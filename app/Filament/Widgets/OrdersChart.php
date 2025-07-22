<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersChart extends ChartWidget
{
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Orders per month';

    protected function getData(): array
    {
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => array_values($orders),
                ],
            ],
            'labels' => array_map(fn($m) => date('F', mktime(0, 0, 0, $m, 10)), array_keys($orders)),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
