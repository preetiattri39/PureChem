<?php

namespace App\Filament\Widgets;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersStats extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
            ->descriptionIcon('heroicon-o-user-group')
            ->description('All registered users')
            ->color('primary'),
        ];
    }
}
