<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->circular()
                    ->size(40),

                TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('store.name')
                    ->label('Store')
                    ->sortable()
                    ->searchable()
                    ->placeholder('No Store'),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Uncategorized'),

                TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable()
                    ->searchable()
                    ->placeholder('No Brand')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('compare_price')
                    ->money('USD')
                    ->color('gray')
                    ->sortable()
                    ->toggleable(),


                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-s-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'archived' => 'warning',
                        'draft' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'archived' => 'Archived',
                    ]),

                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
