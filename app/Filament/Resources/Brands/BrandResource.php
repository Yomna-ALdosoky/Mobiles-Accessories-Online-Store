<?php

namespace App\Filament\Resources\Brands;

use App\Filament\Resources\Brands\Pages\ManageBrands;
use App\Models\Brand;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use App\Enums\NavigationGroup;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use UnitEnum;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::ShopManagement;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Brand Name Translations')
                    ->vertical()
                    ->tabs([
                        Tab::make('English (en)')
                            ->schema([
                                TextInput::make('name.en')
                                    ->label('Brand Name (EN)')
                                    ->placeholder('e.g. Apple, Samsung')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Tab::make('العربية (ar)')
                            ->schema([
                                TextInput::make('name.ar')
                                    ->label('اسم الماركة (AR)')
                                    ->maxLength(255),
                            ]),
                        Tab::make('Türkçe (tr)')
                            ->schema([
                                TextInput::make('name.tr')
                                    ->label('Marka Adı (TR)')
                                    ->maxLength(255),
                            ]),
                        Tab::make('한국어 (ko)')
                            ->schema([
                                TextInput::make('name.ko')
                                    ->label('브랜드 이름 (KO)')
                                    ->maxLength(255),
                            ]),
                        Tab::make('Français (fr)')
                            ->schema([
                                TextInput::make('name.fr')
                                    ->label('Nom de marque (FR)')
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columnSpanFull(),

                Toggle::make('status')
                    ->label('Active Status')
                    ->default(true)
                    ->formatStateUsing(fn($state) => $state === 'active' || $state === true)
                    ->dehydrateStateUsing(fn($state) => $state ? 'active' : 'inactive'),

                FileUpload::make('image')
                    ->label('Brand Logo')
                    ->image()
                    ->disk('public')
                    ->directory('uploads/brands')
                    ->visibility('public')
                    ->columnSpanFull()
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->modalWidth('2xl'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBrands::route('/'),
        ];
    }
}
