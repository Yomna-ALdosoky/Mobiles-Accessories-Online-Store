<?php

namespace App\Filament\Resources\Stores\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class StoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Translations')
                    ->tabs([
                        Tab::make('English (en)')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Store Name (EN)')
                                    ->required()
                                    ->maxLength(255),
                                RichEditor::make('description.en')
                                    ->label('Description (EN)')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('العربية (ar)')
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('اسم المتجر (AR)')
                                    ->maxLength(255),
                                RichEditor::make('description.ar')
                                    ->label('الوصف (AR)')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Türkçe (tr)')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->label('Mağaza Adı (TR)')
                                    ->maxLength(255),
                                RichEditor::make('description.tr')
                                    ->label('Açıklama (TR)')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('한국어 (ko)')
                            ->schema([
                                TextInput::make('name.ko')
                                    ->label('상점 이름 (KO)')
                                    ->maxLength(255),
                                RichEditor::make('description.ko')
                                    ->label('설명 (KO)')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Français (fr)')
                            ->schema([
                                TextInput::make('name.fr')
                                    ->label('Nom du magasin (FR)')
                                    ->maxLength(255),
                                RichEditor::make('description.fr')
                                    ->label('Description (FR)')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('logo_image')
                    ->label('Logo Image')
                    ->image()
                    ->directory('stores/logos'),

                FileUpload::make('caver_image')
                    ->label('Cover Image')
                    ->image()
                    ->directory('stores/covers'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }
}
