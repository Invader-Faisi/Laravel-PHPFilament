<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        $data = $this->getProductPerMonth();
        return [
            'datasets' => [
                [
                    'label' => 'Blog Post Created',
                    'data' => $data['productsPerMonth']
                ]
            ],
            'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getProductPerMonth(): array
    {
        $now = Carbon::now();

        $productsPermonth = [];
        $month = collect(range(1, 12))->map(function ($month) use ($now, $productsPermonth) {
            $count = Product::whereMonth('created_at', Carbon::parse($now->month($month)->format('Y-m')))->count();
            $productsPermonth[] = $count;

            return $now->month($month)->format('M');
        })->toArray();

        return [
            'productsPerMonth' => $productsPermonth,
            'months' => $month
        ];
    }
}
