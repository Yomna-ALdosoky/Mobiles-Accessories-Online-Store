<?php

namespace App\Filament\Resources\Admins;

use App\Enums\NavigationGroup;
use App\Filament\Resources\Admins\Pages\CreateAdmin;
use App\Filament\Resources\Admins\Pages\EditAdmin;
use App\Filament\Resources\Admins\Pages\ListAdmins;
use App\Filament\Resources\Admins\Schemas\AdminForm;
use App\Filament\Resources\Admins\Tables\AdminsTable;
use App\Models\Admin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\BaseResource;

use UnitEnum;

class AdminResource extends BaseResource
{
    protected static ?string $model = Admin::class;

    protected static string | UnitEnum | null $navigationGroup = NavigationGroup::UserManagement;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|BackedEnum|null $navigationIcon = \Filament\Support\Icons\Heroicon::OutlinedUserGroup;

    protected static ?string $recordTitleAttribute = 'Admin';

    public static function form(Schema $schema): Schema
    {
        return AdminForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdminsTable::configure($table);
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
            'index' => ListAdmins::route('/'),
            'create' => CreateAdmin::route('/create'),
            'edit' => EditAdmin::route('/{record}/edit'),

        ];
    }
}
