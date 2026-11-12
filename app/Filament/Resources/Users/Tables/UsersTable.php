<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('two_factor_confirmed_at')
                    ->label('2FA')
                    ->boolean()
                    ->state(fn($record): bool => filled($record->two_factor_confirmed_at))
                    ->sortable(),

                TextColumn::make('phone_number')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'vendor' => 'warning',
                        'customer' => 'success',
                        default => 'gray',
                    }),

                // TextColumn::make('store.name')
                //     ->label('Store')
                //     ->sortable()
                //     ->placeholder('No Store'),

                TextColumn::make('last_active_at')
                    ->label('Last Active')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('email_verified_at')
                    ->label('Verified At')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
                SelectFilter::make('type')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
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
