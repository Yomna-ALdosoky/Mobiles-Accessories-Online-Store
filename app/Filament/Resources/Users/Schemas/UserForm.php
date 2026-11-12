<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Account Credentials')
                    ->description('The core profile details and authentication credentials.')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->label('Email Address')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                TextInput::make('phone_number')
                                    ->label('Phone Number')
                                    ->tel()
                                    ->placeholder('+20xxxxxxxxxx')
                                    ->default(null),

                                TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->revealable()
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->dehydrated(fn($state) => filled($state))
                                    ->maxLength(255),
                            ]),
                    ]),

                Section::make('System Assignment & Permissions')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('type')
                                    ->label('Account Type / Role')
                                    ->options([
                                        'user' => 'User (Client)',
                                        'admin' => 'Admin',
                                        'super-admin' => 'Super Admin',
                                    ])
                                    ->default('user')
                                    ->required(),

                                Select::make('store_id')
                                    ->label('Assigned Store')
                                    ->relationship('store', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('No specific store assigned')
                                    ->default(null),
                            ]),
                    ]),

                Section::make('Security & Activity Indicators')
                    ->description('System-generated timestamps for security and tracking.')
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                DateTimePicker::make('email_verified_at')
                                    ->label('Email Verified At')
                                    ->disabled(),

                                DateTimePicker::make('two_factor_confirmed_at')
                                    ->label('2FA Activated At')
                                    ->disabled(),

                                DateTimePicker::make('last_active_at')
                                    ->label('Last Active At')
                                    ->disabled(),
                            ]),
                    ]),
            ]);
    }
}
