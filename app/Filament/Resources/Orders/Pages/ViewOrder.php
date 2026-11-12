<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Group;
use Filament\Forms\Form;
use Filament\Schemas\Schema;
use Filament\Infolists\Infolist;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         EditAction::make(),
    //     ];
    // }
    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    Section::make('Order Overview')
                        ->icon('heroicon-o-shopping-bag')
                        ->schema([
                            Group::make([
                                TextEntry::make('number')
                                    ->label('Order #')
                                    ->weight('bold')
                                    ->copyable()
                                    ->color('primary'),

                                TextEntry::make('created_at')
                                    ->label('Date')
                                    ->dateTime('M d, Y - h:i A')
                                    ->weight('medium'),

                                TextEntry::make('status')
                                    ->label('Order Status')
                                    ->badge(),

                                TextEntry::make('payment_status')
                                    ->label('Payment Status')
                                    ->badge(),

                                TextEntry::make('payment_method')
                                    ->label('Payment Method')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('store.name')
                                    ->label('Store')
                                    ->weight('bold')
                                    ->color('info'),
                            ])
                                ->columns(3),

                            RepeatableEntry::make('items')
                                ->hiddenLabel()
                                ->schema([
                                    ImageEntry::make('product_image')
                                        ->hiddenLabel()
                                        ->circular()
                                        ->height(40)
                                        ->width(40)
                                        ->state(fn($record) => $record->product?->image_url)
                                        ->columnSpan(1),

                                    TextEntry::make('product_name')
                                        ->label('Product')
                                        ->weight('bold')
                                        ->columnSpan(2),

                                    TextEntry::make('price')
                                        ->label('Unit Price')
                                        ->money('EGP')
                                        ->weight('medium')
                                        ->columnSpan(1),

                                    TextEntry::make('quantity')
                                        ->label('Qty')
                                        ->weight('bold')
                                        ->badge()
                                        ->color('warning')
                                        ->columnSpan(1),

                                    TextEntry::make('subtotal')
                                        ->label('Subtotal')
                                        ->money('EGP')
                                        ->weight('bold')
                                        ->color('success')
                                        ->state(fn($record) => ($record->price ?? 0) * ($record->quantity ?? 1))
                                        ->columnSpan(1),
                                ])
                                ->columns(6),
                        ]),

                    Section::make('Shipping & Billing Addresses')
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            Section::make('Billing Address')
                                ->schema([
                                    TextEntry::make('billingAddress.first_name')
                                        ->label('Name')
                                        ->weight('bold')
                                        ->color('warning')
                                        ->formatStateUsing(fn($record) => $record->billingAddress?->name ?? 'N/A'),

                                    TextEntry::make('billingAddress.street_address')
                                        ->label('Street')
                                        ->weight('medium'),

                                    TextEntry::make('billingAddress.city')
                                        ->label('City')
                                        ->weight('medium'),

                                    TextEntry::make('billingAddress.country')
                                        ->label('Country')
                                        ->weight('medium')
                                        ->formatStateUsing(fn($record) => $record->billingAddress?->country_name ?? 'N/A'),
                                ])
                                ->columnSpan(1),

                            Section::make('Shipping Address')
                                ->schema([
                                    TextEntry::make('shippingAddress.first_name')
                                        ->label('Name')
                                        ->weight('bold')
                                        ->color('warning')
                                        ->formatStateUsing(fn($record) => $record->shippingAddress?->name ?? 'N/A'),

                                    TextEntry::make('shippingAddress.street_address')
                                        ->label('Street')
                                        ->weight('medium'),

                                    TextEntry::make('shippingAddress.city')
                                        ->label('City')
                                        ->weight('medium'),

                                    TextEntry::make('shippingAddress.country')
                                        ->label('Country')
                                        ->weight('medium')
                                        ->formatStateUsing(fn($record) => $record->shippingAddress?->country_name ?? 'N/A'),
                                ])
                                ->columnSpan(1),
                        ])
                        ->columns(2),
                ])
                    ->columnSpan(2),

                Group::make([
                    Section::make('Customer Information')
                        ->icon('heroicon-o-user')
                        ->schema([
                            TextEntry::make('user.name')
                                ->label('Name')
                                ->weight('bold')
                                ->color('warning'),

                            TextEntry::make('user.email')
                                ->label('Email')
                                ->icon('heroicon-m-envelope')
                                ->weight('medium'),

                            TextEntry::make('user.phone')
                                ->label('Phone')
                                ->icon('heroicon-m-phone')
                                ->placeholder('N/A')
                                ->weight('medium'),
                        ]),

                    Section::make('Payment Summary')
                        ->icon('heroicon-o-banknotes')
                        ->schema([
                            TextEntry::make('discount')
                                ->label('Discount')
                                ->money('EGP')
                                ->weight('medium'),

                            TextEntry::make('shipping')
                                ->label('Shipping Cost')
                                ->money('EGP')
                                ->weight('medium'),

                            TextEntry::make('tax')
                                ->label('Tax')
                                ->money('EGP')
                                ->weight('medium'),

                            TextEntry::make('total')
                                ->label('Total Amount')
                                ->money('EGP')
                                ->size('lg')
                                ->weight('bold')
                                ->color('success'),
                        ]),
                ])
                    ->columnSpan(1)
                    ->extraAttributes(['class' => 'sticky top-6']),
            ])
            ->columns(3);
    }
}
