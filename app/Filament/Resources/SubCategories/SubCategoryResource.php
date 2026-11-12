<?php

namespace App\Filament\Resources\SubCategories;

use App\Enums\NavigationGroup;
use App\Filament\Resources\SubCategories\Pages\CreateSubCategory;
use App\Filament\Resources\SubCategories\Pages\EditSubCategory;
use App\Filament\Resources\SubCategories\Pages\ListSubCategories;
use App\Filament\Resources\SubCategories\Schemas\SubCategoryForm;
use App\Filament\Resources\SubCategories\Tables\SubCategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\BaseResource;

use UnitEnum;

class SubCategoryResource extends BaseResource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQueueList;
    protected static string | UnitEnum | null $navigationGroup = NavigationGroup::ShopManagement;
    protected static ?int $navigationSort = 1;
    protected static ?string $slug = 'sub-categories';
    protected static ?string $navigationLabel = 'Sub Categories';
    protected static ?string $modelLabel = 'Sub Category';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereNotNull('parent_id');
    }

    public static function form(Schema $schema): Schema
    {
        return SubCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubCategories::route('/'),
            'create' => CreateSubCategory::route('/create'),
            'edit' => EditSubCategory::route('/{record}/edit'),
        ];
    }
}
