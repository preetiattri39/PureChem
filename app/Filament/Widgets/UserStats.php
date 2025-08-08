<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class UserStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        [$userChartData, $userGrowth] = $this->getMonthlyData(User::class, 'created_at', 'role', '!=', 'admin');
        [$orderChartData, $orderGrowth] = $this->getMonthlyData(Order::class, 'created_at');

        $userChartArray = $userChartData->toArray();
        $orderChartArray = $orderChartData->toArray();

        return [
            Stat::make('Total Users', User::where('role', '!=', 'admin')->count())
                ->descriptionIcon('heroicon-o-user-group')
                ->description('All registered users')
                ->color('primary'),

            Stat::make('New Users (This Month)', end($userChartArray))
                ->description($userGrowth . ' % ' . ($userGrowth >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($userGrowth >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($userGrowth >= 0 ? 'success' : 'danger')
                ->chart(array_values($userChartArray)),

            Stat::make('New Orders (This Month)', end($orderChartArray))
                ->description($orderGrowth . ' % ' . ($orderGrowth >= 0 ? 'increase' : 'decrease'))
                ->descriptionIcon($orderGrowth >= 0 ? 'heroicon-o-arrow-trending-up' : 'heroicon-o-arrow-trending-down')
                ->color($orderGrowth >= 0 ? 'success' : 'danger')
                ->chart(array_values($orderChartArray)),
        ];
    }

    /**
     * Get chart data and growth % for last 7 months.
     */
    private function getMonthlyData(string $modelClass, string $dateField, string $filterColumn = null, string $operator = null, $value = null): array
    {
        $months = collect(range(6, 0))->map(function ($i) {
            return now()->copy()->subMonths($i);
        });

        $monthlyCounts = $months->mapWithKeys(function ($date) use ($modelClass, $dateField, $filterColumn, $operator, $value) {
            $query = $modelClass::query()
                ->whereYear($dateField, $date->year)
                ->whereMonth($dateField, $date->month);

            if ($filterColumn) {
                $query->where($filterColumn, $operator, $value);
            }

            $count = $query->count();
            $key = $date->format('M Y');
            return [$key => $count];
        });

        $counts = array_values($monthlyCounts->toArray());

        // Calculate growth %
        $lastMonth = $counts[5] ?? 0;
        $currentMonth = $counts[6] ?? 0;
        $growth = $lastMonth > 0
            ? round((($currentMonth - $lastMonth) / $lastMonth) * 100)
            : ($currentMonth > 0 ? 100 : 0);

        return [$monthlyCounts, $growth];
    }
}
