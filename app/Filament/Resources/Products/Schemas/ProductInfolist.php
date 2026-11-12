<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('store_id')
                    ->numeric(),
                TextEntry::make('category_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('brand_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('image')
                    ->placeholder('-'),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('compare_price')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('options')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('rating')
                    ->numeric(),
                IconEntry::make('featured')
                    ->boolean(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Product $record): bool => $record->trashed()),
            ]);
    }
}
