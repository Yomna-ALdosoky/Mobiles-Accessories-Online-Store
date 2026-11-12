<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SalesChart extends ChartWidget
{
    protected static ?int $sort = 2;

    public function getHeading(): ?string
    {
        return 'Sales Overview';
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last 7 Days',
            'month' => 'This Month',
            'year' => 'This Year (Months)',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? 'week';
        $salesData = collect();
        $labels = collect();

        if ($activeFilter === 'today') {
            for ($i = 0; $i < 24; $i++) {
                $hourKey = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                $labels->push($hourKey);
                $salesData->put($hourKey, 0);
            }

            $orders = Order::select(
                DB::raw('SUM(total) as aggregate'),
                DB::raw("DATE_FORMAT(created_at, '%H:00') as date")
            )
                ->whereDate('created_at', today())
                ->groupBy('date')
                ->get();

            foreach ($orders as $order) {
                if ($salesData->has($order->date)) {
                    $salesData->put($order->date, $order->aggregate);
                }
            }
        } elseif ($activeFilter === 'week') {
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $labels->push($date);
                $salesData->put($date, 0);
            }

            $orders = Order::select(
                DB::raw('SUM(total) as aggregate'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date")
            )
                ->where('created_at', '>=', now()->subDays(6)->startOfDay())
                ->groupBy('date')
                ->get();

            foreach ($orders as $order) {
                if ($salesData->has($order->date)) {
                    $salesData->put($order->date, $order->aggregate);
                }
            }
        } elseif ($activeFilter === 'month') {
            $daysInMonth = now()->daysInMonth;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = now()->format('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT);
                $labels->push($date);
                $salesData->put($date, 0);
            }

            $orders = Order::select(
                DB::raw('SUM(total) as aggregate'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date")
            )
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->groupBy('date')
                ->get();

            foreach ($orders as $order) {
                if ($salesData->has($order->date)) {
                    $salesData->put($order->date, $order->aggregate);
                }
            }
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $monthKey = now()->format('Y') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $labels->push($monthKey);
                $salesData->put($monthKey, 0);
            }

            $orders = Order::select(
                DB::raw('SUM(total) as aggregate'),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as date")
            )
                ->whereYear('created_at', date('Y'))
                ->groupBy('date')
                ->get();

            foreach ($orders as $order) {
                if ($salesData->has($order->date)) {
                    $salesData->put($order->date, $order->aggregate);
                }
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Sales ($)',
                    'data' => $salesData->values()->toArray(),
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#10b981',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
