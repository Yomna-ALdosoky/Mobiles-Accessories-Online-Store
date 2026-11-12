<?php

namespace App\Filament\Resources\SubCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class SubCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Category Details')
                    ->description('Specify the name, status, and parent structure of the category.')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        Tabs::make('Name Translations')
                            ->tabs([
                                Tab::make('English (en)')
                                    ->schema([
                                        TextInput::make('name.en')
                                            ->label('Category Name (EN)')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                                Tab::make('العربية (ar)')
                                    ->schema([
                                        TextInput::make('name.ar')
                                            ->label('اسم التصنيف (AR)')
                                            ->maxLength(255),
                                    ]),
                                Tab::make('Türkçe (tr)')
                                    ->schema([
                                        TextInput::make('name.tr')
                                            ->label('Kategori Adı (TR)')
                                            ->maxLength(255),
                                    ]),
                                Tab::make('한국어 (ko)')
                                    ->schema([
                                        TextInput::make('name.ko')
                                            ->label('카테고리 이름 (KO)')
                                            ->maxLength(255),
                                    ]),
                                Tab::make('Français (fr)')
                                    ->schema([
                                        TextInput::make('name.fr')
                                            ->label('Nom de catégorie (FR)')
                                            ->maxLength(255),
                                    ]),
                            ])
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'active' => 'Active',
                                        'archived' => 'Archived',
                                    ])
                                    ->default('active')
                                    ->required(),
                            ]),

                        Select::make('parent_id')
                            ->label('Parent Category')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('None (Make it a Main Category)')
                            ->columnSpanFull(),
                    ]),

                Section::make('Content & Description')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        Tabs::make('Description Translations')
                            ->tabs([
                                Tab::make('English (en)')
                                    ->schema([
                                        Textarea::make('description.en')
                                            ->label('Description (EN)')
                                            ->rows(4),
                                    ]),
                                Tab::make('العربية (ar)')
                                    ->schema([
                                        Textarea::make('description.ar')
                                            ->label('الوصف (AR)')
                                            ->rows(4),
                                    ]),
                                Tab::make('Türkçe (tr)')
                                    ->schema([
                                        Textarea::make('description.tr')
                                            ->label('Açıklama (TR)')
                                            ->rows(4),
                                    ]),
                                Tab::make('한국어 (ko)')
                                    ->schema([
                                        Textarea::make('description.ko')
                                            ->label('설명 (KO)')
                                            ->rows(4),
                                    ]),
                                Tab::make('Français (fr)')
                                    ->schema([
                                        Textarea::make('description.fr')
                                            ->label('Description (FR)')
                                            ->rows(4),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ]),

                Section::make('Category Media')
                    ->collapsible()
                    ->columnSpanFull()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Category Image')
                            ->image()
                            ->disk('public')
                            ->directory('uploads/categories')
                            ->visibility('public')
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
