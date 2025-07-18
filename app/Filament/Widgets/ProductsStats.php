<?php

namespace App\Filament\Widgets;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductsStats extends BaseWidget
{
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        return [
           Stat::make('Total Products', Product::count())
            ->descriptionIcon('heroicon-o-cube')
            ->description('All products in database')
            ->color('primary'),
        ];
    }
}
