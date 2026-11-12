<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalRevenue = Order::sum('total');

        return [

            Stat::make('Total Revenue', '$' . number_format($totalRevenue, 2))
                ->description('Total earnings from orders')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]),

            Stat::make('Total Orders', Order::count())
                ->description('All store orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary')
                ->chart([3, 5, 2, 8, 6, 9, 11]),

            Stat::make('Total Users', User::count())
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([2, 5, 4, 7, 6, 9, 12]),

            Stat::make('Total Products', Product::count())
                ->description('Products in your shop')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning')
                ->chart([4, 6, 5, 8, 7, 10, 12]),
        ];
    }
}
