<?php

namespace App\Filament\Resources\Blogs\Tables;

use Illuminate\Support\Str;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Actions\DeleteAction;

use Filament\Tables\Table;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn($record) => Str::limit($record->excerpt, 40)),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('primary')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('is_published')
                    ->label('Published'),
                ToggleColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),

                TernaryFilter::make('is_published')
                    ->label('Published Status')
                    ->boolean()
                    ->trueLabel('Published Only')
                    ->falseLabel('Drafts Only'),
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
