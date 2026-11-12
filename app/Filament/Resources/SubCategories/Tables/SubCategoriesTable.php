<?php

namespace App\Filament\Resources\SubCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Thumbnail')
                    ->circular()
                    ->size(45)
                    ->disk('public')
                    // ->placeholder('—')
                    ->extraImgAttributes(['style' => 'object-fit: cover; background-color: #27272a;'])
                    ->defaultImageUrl('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="%239ca3af"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>'),
                TextColumn::make('name')
                    ->label('Category Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('parent.name')
                    ->label('Main Category')
                    ->sortable()
                    ->searchable()
                    ->placeholder('—')
                    ->url(null)
                    ->color('gray'),
                TextColumn::make('products_count')
                    ->label('Products')
                    ->counts('products')
                    ->badge()
                    ->color(fn(int $state): string => match (true) {
                        $state > 10 => 'success',
                        $state > 0 => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'archived' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('parent_id')
                    ->label('Main Category')
                    ->relationship('parent', 'name', fn($query) => $query->whereNull('parent_id'))
                    ->searchable()
                    ->preload(),
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'archived' => 'Archived',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
