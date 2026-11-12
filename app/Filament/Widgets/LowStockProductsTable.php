<?php

namespace App\Filament\Widgets;

use Filament\Actions\BulkActionGroup;
use App\Models\Product;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;

use App\Filament\Resources\Products\ProductResource;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockProductsTable extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'half';

    public function getHeading(): ?string
    {
        return '⚠️ Low Stock Products Alert';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()->where('quantity', '<=', 5)->latest()
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Product Name')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Stock')
                    ->badge()
                    ->color('danger')
                    ->sortable(),
            ])
            ->actions([
                Action::make('edit')
                    ->label('Restock')
                    ->url(fn(Product $record): string => ProductResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning')
                    ->size('sm'),
            ])
            ->paginated(false);
    }
}
