<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Order;

class UserStats extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->descriptionIcon('heroicon-o-user-group')
                ->description('All registered users')
                ->color('primary'),

            Stat::make('New Users (This Month)', $this->getNewCustomersCount())
                ->description($this->getCustomerGrowth() . ' % ' . ($this->isCustomerGrowthPositive() ? 'increase' : 'decrease'))
                ->descriptionIcon($this->isCustomerGrowthPositive() ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($this->isCustomerGrowthPositive() ? 'success' : 'danger')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('New Orders', $this->getNewOrdersCount())
                ->description($this->getOrderGrowth() . ' % ' . ($this->isOrderGrowthPositive() ? 'increase' : 'decrease'))
                ->descriptionIcon($this->isOrderGrowthPositive() ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($this->isOrderGrowthPositive() ? 'success' : 'danger')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
        ];
    }

    private function getNewCustomersCount(): int
    {
        return User::whereMonth('created_at', now()->month)->count();
    }

    private function getCustomerGrowth(): int
    {
        $current = User::whereMonth('created_at', now()->month)->count();
        $last = User::whereMonth('created_at', now()->subMonth()->month)->count();
        return $last > 0 ? round((($current - $last) / $last) * 100) : 0;
    }

    private function isCustomerGrowthPositive(): bool
    {
        return $this->getCustomerGrowth() >= 0;
    }

    private function getNewOrdersCount(): int
    {
        return Order::whereMonth('created_at', now()->month)->count();
    }

    private function getOrderGrowth(): int
    {
        $current = Order::whereMonth('created_at', now()->month)->count();
        $last = Order::whereMonth('created_at', now()->subMonth()->month)->count();
        return $last > 0 ? round((($current - $last) / $last) * 100) : 0;
    }

    private function isOrderGrowthPositive(): bool
    {
        return $this->getOrderGrowth() >= 0;
    }
}
