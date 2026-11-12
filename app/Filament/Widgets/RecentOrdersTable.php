<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use App\Models\Order;
use App\Filament\Resources\Orders\OrderResource;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentOrdersTable extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'half';

    public function getHeading(): ?string
    {
        return '🛒 Recent Orders';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()->take(5)
            )
            ->columns([
                TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('total_price')
                    ->label('Total')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'danger' => 'cancelled',
                        'warning' => 'pending',
                        'success' => 'completed',
                        'info' => 'processing',
                    ]),
            ])
            ->actions([
                Action::make('view')
                    ->label('View')
                    ->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->size('sm'),
            ])
            ->paginated(false);
    }
}
