<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();
        $now = Carbon::now();

        $monthlyOrders = collect(range(0, 6))
            ->mapWithKeys(function ($i) use ($now, $userId) {
                $date = $now->copy()->subMonths($i);
                $monthKey = $date->format('M Y');

                $count = Order::where('user_id', $userId)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();

                return [$monthKey => $count];
            })->reverse();

        return [
            Stat::make('Welcome back!', Auth::user()->name)
                ->description('We\'re glad to see you again. Let\'s make today productive.')
                ->color('primary'),

            Stat::make('All time orders', $monthlyOrders->sum())
                ->chart($monthlyOrders->values()->toArray())
                ->color('success'),
        ];
    }
}
