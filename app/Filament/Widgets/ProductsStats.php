<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\ProductVariant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductsStats extends BaseWidget
{
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->descriptionIcon('heroicon-o-squares-2x2')
                ->description('All products in database')
                ->color('primary'), 

            Stat::make('Total Variants', ProductVariant::count())
                ->description('All product variants')
                ->descriptionIcon('heroicon-o-cube')
                ->color('primary')
        ];
    }
}
