<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
// use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Forms\Get;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Form')
                    ->tabs([

                        Tab::make('General & Category')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Grid::make(3)->schema([

                                    Group::make([
                                        Section::make('Product Information')
                                            ->schema([
                                                Tabs::make('Product Languages')
                                                    ->tabs([
                                                        Tab::make('English (en)')
                                                            ->icon('heroicon-o-language')
                                                            ->schema([
                                                                TextInput::make('name.en')
                                                                    ->label('Product Name (EN)')
                                                                    ->required()
                                                                    ->maxLength(255),

                                                                Textarea::make('description.en')
                                                                    ->label('Description (EN)')
                                                                    ->rows(4),
                                                            ]),

                                                        Tab::make('العربية (ar)')
                                                            ->icon('heroicon-o-language')
                                                            ->schema([
                                                                TextInput::make('name.ar')
                                                                    ->label('اسم المنتج (AR)')
                                                                    ->maxLength(255),

                                                                Textarea::make('description.ar')
                                                                    ->label('وصف المنتج (AR)')
                                                                    ->rows(4),
                                                            ]),

                                                        Tab::make('Türkçe (tr)')
                                                            ->icon('heroicon-o-language')
                                                            ->schema([
                                                                TextInput::make('name.tr')
                                                                    ->label('Ürün Adı (TR)')
                                                                    ->maxLength(255),

                                                                Textarea::make('description.tr')
                                                                    ->label('Açıklama (TR)')
                                                                    ->rows(4),
                                                            ]),

                                                        Tab::make('한국어 (ko)')
                                                            ->icon('heroicon-o-language')
                                                            ->schema([
                                                                TextInput::make('name.ko')
                                                                    ->label('상품명 (KO)')
                                                                    ->maxLength(255),

                                                                Textarea::make('description.ko')
                                                                    ->label('설명 (KO)')
                                                                    ->rows(4),
                                                            ]),

                                                        Tab::make('Français (fr)')
                                                            ->icon('heroicon-o-language')
                                                            ->schema([
                                                                TextInput::make('name.fr')
                                                                    ->label('Nom du produit (FR)')
                                                                    ->maxLength(255),

                                                                Textarea::make('description.fr')
                                                                    ->label('La description (FR)')
                                                                    ->rows(4),
                                                            ]),
                                                    ])
                                                    ->columnSpanFull(),
                                            ]),
                                    ])->columnSpan(2),

                                    Group::make([
                                        Section::make('Organization')
                                            ->schema([
                                                Select::make('status')
                                                    ->label('Status')
                                                    ->options([
                                                        'active'   => 'Active',
                                                        'draft'    => 'Draft',
                                                        'archived' => 'Archived',
                                                    ])
                                                    ->default('active')
                                                    ->required(),

                                                Select::make('store_id')
                                                    ->label('Store')
                                                    ->relationship('store', 'name')
                                                    ->searchable()
                                                    ->preload()
                                                    ->required(),

                                                Select::make('category_id')
                                                    ->label('Category')
                                                    ->relationship('category', 'name')
                                                    ->searchable()
                                                    ->preload(),

                                                Select::make('brand_id')
                                                    ->label('Brand')
                                                    ->relationship('brand', 'name')
                                                    ->searchable()
                                                    ->preload(),

                                                Select::make('tags')
                                                    ->label('Tags')
                                                    ->relationship('tags', 'name')
                                                    ->multiple()
                                                    ->preload()
                                                    ->searchable(),
                                            ]),
                                    ])->columnSpan(1),
                                ]),
                            ]),

                        Tab::make('Pricing & Inventory')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Section::make('Pricing Setup')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextInput::make('price')
                                                ->label('Main Price')
                                                ->required()
                                                ->numeric()
                                                ->prefix('$'),

                                            TextInput::make('compare_price')
                                                ->label('Compare at Price (Original Price)')
                                                ->numeric()
                                                ->prefix('$'),
                                        ]),
                                    ]),

                                Section::make('Inventory & Visibility')
                                    ->schema([
                                        Grid::make(3)->schema([
                                            TextInput::make('quantity')
                                                ->label('Stock Quantity')
                                                ->required()
                                                ->numeric(),

                                            TextInput::make('rating')
                                                ->label('Initial Rating')
                                                ->numeric()
                                                ->minValue(0)
                                                ->maxValue(5)
                                                ->step(0.1)
                                                ->prefix('★'),

                                            Toggle::make('featured')
                                                ->label('Featured Product')
                                                ->inline(false),
                                        ]),
                                    ]),
                            ]),

                        Tab::make('Product Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Section::make('Images Gallery')
                                    ->description('Upload main cover and additional product images.')
                                    ->schema([
                                        Repeater::make('images')
                                            ->relationship('images')
                                            ->schema([
                                                // FileUpload::make('image')
                                                //     ->label('Image File')
                                                //     ->image()
                                                //     ->disk('public')
                                                //     ->directory('uploads/products')
                                                //     ->acceptedFileTypes(['image/*'])
                                                //     ->required(),

                                                FileUpload::make('image')
                                                    ->label('Image File')
                                                    ->image()
                                                    ->disk('public')
                                                    ->directory('uploads/products')
                                                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/avif'])
                                                    ->maxSize(5120)
                                                    ->required(),

                                                Toggle::make('is_primary')
                                                    ->label('Set as Main Cover')
                                                    ->default(false),
                                            ])
                                            ->grid(3)
                                            ->defaultItems(1)
                                            ->collapsible()
                                            ->addActionLabel('Add New Image'),
                                    ]),
                            ]),

                        Tab::make('Variants & Specs')
                            ->icon('heroicon-o-adjustments-horizontal')
                            ->schema([
                                Grid::make(12)->schema([

                                    Section::make('Attributes & Highlights')
                                        ->description('Select color, capacity and core bullet points.')
                                        ->columnSpan(5)
                                        ->schema([
                                            Select::make('options.color')
                                                ->label('Colors')
                                                ->multiple()
                                                ->options([
                                                    'black' => 'Black',
                                                    'white' => 'White',
                                                    'red'   => 'Red',
                                                    'blue'  => 'Blue',
                                                ])
                                                ->formatStateUsing(fn($record) => self::getOptionVal($record, 'color'))
                                                ->dehydrateStateUsing(fn($state) => self::setOptionVal('color', $state)),

                                            Select::make('options.capacity')
                                                ->label('Capacity')
                                                ->multiple()
                                                ->options([
                                                    '128GB' => '128 GB',
                                                    '256GB' => '256 GB',
                                                    '512GB' => '512 GB',
                                                ])
                                                ->formatStateUsing(fn($record) => self::getOptionVal($record, 'capacity'))
                                                ->dehydrateStateUsing(fn($state) => self::setOptionVal('capacity', $state)),

                                            TagsInput::make('options.features')
                                                ->label('Product Highlights')
                                                ->placeholder('Add key points...')
                                                ->formatStateUsing(fn($record) => self::getOptionVal($record, 'features'))
                                                ->dehydrateStateUsing(fn($state) => self::setOptionVal('features', $state)),
                                        ]),

                                    Group::make()
                                        ->columnSpan(7)
                                        ->schema([
                                            Section::make('Technical Specifications')
                                                ->compact()
                                                ->schema([
                                                    KeyValue::make('options.specifications.option_values')
                                                        ->hiddenLabel()
                                                        ->keyLabel('Spec Name')
                                                        ->valueLabel('Value')
                                                        ->keyPlaceholder('e.g. RAM')
                                                        ->valuePlaceholder('e.g. 16GB')
                                                        ->addActionLabel('+ Add Specification'),
                                                ]),

                                            Section::make('Shipping Options')
                                                ->compact()
                                                ->schema([
                                                    KeyValue::make('options.shipping.option_values')
                                                        ->hiddenLabel()
                                                        ->keyLabel('Method')
                                                        ->valueLabel('Cost / Time')
                                                        ->keyPlaceholder('e.g. Express')
                                                        ->valuePlaceholder('e.g. $15 / 2 Days')
                                                        ->addActionLabel('+ Add Shipping Option'),
                                                ]),
                                        ]),
                                ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }


    private static function getOptionVal($record, string $name)
    {
        if (!$record || !$record->options) return [];
        $opt = collect($record->options)->first(fn($i) => strtolower($i['option_name'] ?? '') === strtolower($name));
        return $opt['option_values'] ?? [];
    }

    private static function setOptionVal(string $name, $state): array
    {
        return [
            'option_name' => $name,
            'option_values' => array_values($state ?? []),
        ];
    }
}
