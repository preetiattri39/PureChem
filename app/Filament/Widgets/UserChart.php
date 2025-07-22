<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Users per month';

    protected function getData(): array
    {
        $monthlyUsers = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $cumulative = 0;
        $labels = [];
        $values = [];

        foreach ($monthlyUsers as $month => $count) {
            $cumulative += $count;
            $labels[] = date('F Y', strtotime($month));
            $values[] = $cumulative;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Users',
                    'data' => $values,
                    'fill' => false,
                    'borderColor' => '#3b82f6',
                    'tension' => 0.4
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
