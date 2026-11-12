<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Models\ContactMessage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('is_read')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(bool $state): string => $state ? 'Read' : 'Unread')
                    ->color(fn(bool $state): string => $state ? 'gray' : 'danger')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Received At')
                    ->dateTime('d M Y - h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                ViewAction::make()
                    ->beforeFormFilled(function (ContactMessage $record, $livewire) {
                        if (! $record->is_read) {
                            $record->update(['is_read' => true]);
                            $livewire->redirect(ContactMessageResource::getUrl(), navigate: true);
                        }
                    }),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
