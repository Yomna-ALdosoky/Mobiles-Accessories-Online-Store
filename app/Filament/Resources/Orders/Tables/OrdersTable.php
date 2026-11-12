<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\SelectColumn;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->label('Order #')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('store.name')
                    ->label('Store')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable()
                    ->default('Guest Customer'),

                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'delivering' => 'Delivering',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])->sortable(),

                SelectColumn::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ]),

                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('shipping')
                    ->label('Shipping')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('tax')
                    ->label('Tax')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('discount')
                    ->label('Discount')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('total')
                    ->label('Total Amount')
                    ->money('USD')
                    ->sortable()
                    ->weight('bold'),


                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'delivering' => 'Delivering',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ]),

                SelectFilter::make('payment_status')
                    ->options([
                        'paid' => 'Paid',
                        'unpaid' => 'Unpaid',
                        'failed' => 'Failed',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
