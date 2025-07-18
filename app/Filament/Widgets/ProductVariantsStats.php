<?php

namespace App\Filament\Widgets;

use App\Models\ProductVariant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductVariantsStats extends BaseWidget
{
    protected static ?int $sort = 3;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Variants', ProductVariant::count())
                ->description('All product variants')
                ->descriptionIcon('heroicon-o-square-3-stack-3d')
                ->color('primary')
        ];
    }
}
