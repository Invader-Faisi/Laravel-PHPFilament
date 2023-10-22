<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatusEnum;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '15s';
    protected static ?int $sort = 2;
    protected static bool $isLazy = true;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customer', Customer::count())
                ->description('Increase in Customers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor('success')
                ->chart([7, 4, 5, 6, 8, 9, 6]),
            Stat::make('Total Product', Product::count())
                ->description('Total products in Application')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->descriptionColor('danger')
                ->chart([7, 4, 5, 6, 8, 9, 6]),
            Stat::make('Pending Orders', Order::where('status', OrderStatusEnum::PENDING->value)->count())
                ->description('Pending orders in Application')
                ->descriptionIcon('heroicon-o-archive-box')
                ->descriptionColor('info')
                ->chart([7, 4, 5, 6, 8, 9, 6]),
        ];
    }
}
