<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('store_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('number')
                    ->required(),
                TextInput::make('payment_method')
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'delivering' => 'Delivering',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ])
                    ->default('pending')
                    ->required(),
                Select::make('payment_status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed'])
                    ->default('pending')
                    ->required(),
                TextInput::make('shipping')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('tax')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
