<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class ProductBubbleChart extends ChartWidget
{
    protected static ?int $sort = 3;

    public function getHeading(): ?string
    {
        return 'Top Products Performance';
    }

    protected function getData(): array
    {
        $products = Product::take(6)->get();

        return [
            'datasets' => [
                [
                    'label' => 'Product Price ($)',
                    'data' => $products->pluck('price')->toArray(),
                    'backgroundColor' => '#f59e0b', // لون برتقالي دافئ وفخم متناسق مع ألوان الكروت اللي فوق
                    'borderColor' => '#d97706',
                    'borderWidth' => 1,
                    'borderRadius' => 8,
                    'barPercentage' => 0.6,
                    'categoryPercentage' => 0.7,
                ],
            ],
            'labels' => $products->pluck('name')->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'color' => '#9ca3af',
                        'maxRotation' => 15,
                        'minRotation' => 15,
                    ],
                ],
                'y' => [
                    'grid' => [
                        'color' => 'rgba(255, 255, 255, 0.04)',
                    ],
                    'ticks' => [
                        'color' => '#9ca3af',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
