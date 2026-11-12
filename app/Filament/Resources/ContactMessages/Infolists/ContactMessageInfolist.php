<?php

namespace App\Filament\Resources\ContactMessages\Infolists;


use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1) // يجبر الـ Sections إنها تفرد بعرض المودال بالكامل
            ->components([
                // كارت بيانات الراسل
                Section::make('Sender Details')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Sender Name')
                            ->icon('heroicon-m-user')
                            ->weight('bold')
                            ->color('primary'),

                        TextEntry::make('email')
                            ->label('Email Address')
                            ->icon('heroicon-m-envelope')
                            ->copyable(),

                        TextEntry::make('phone')
                            ->label('Phone Number')
                            ->icon('heroicon-m-phone'),

                        TextEntry::make('created_at')
                            ->label('Received At')
                            ->icon('heroicon-m-clock')
                            ->dateTime('d M Y - h:i A'),
                    ])
                    ->columns(2), // تقسيم بيانات الراسل لسطرين كل سطر فيه 2

                // كارت محتوى الرسالة
                Section::make('Message Content')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->schema([
                        TextEntry::make('subject')
                            ->label('Subject')
                            ->weight('bold'),

                        TextEntry::make('message')
                            ->label('Message'),
                    ]),
            ]);
    }
}
