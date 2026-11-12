<?php

namespace App\Filament\Resources\ContactMessages;

use App\Filament\Resources\ContactMessages\Pages\ListContactMessages;
use App\Filament\Resources\ContactMessages\Schemas\ContactMessageForm;
use App\Filament\Resources\ContactMessages\Tables\ContactMessagesTable;
use App\Filament\Resources\ContactMessages\Infolists\ContactMessageInfolist;
use App\Models\ContactMessage;
use BackedEnum;
use App\Enums\NavigationGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use App\Filament\Resources\BaseResource;
use Filament\Tables\Table;
use UnitEnum;

class ContactMessageResource extends BaseResource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static string| UnitEnum |null $navigationGroup = NavigationGroup::ContentManagement;
    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'ContactMessage';

    public static function canCreate(): bool
    {
        return false;
    }
    public static function getNavigationBadge(): ?string
    {
        $unreadCount = static::getModel()::where('is_read', false)->count();
        return $unreadCount > 0 ? (string) $unreadCount : null;
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactMessageInfolist::configure($schema);
    }

    public static function form(Schema $schema): Schema
    {
        return ContactMessageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactMessagesTable::configure($table);
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
            'index' => ListContactMessages::route('/'),
            // 'create' => CreateContactMessage::route('/create'),
            // 'edit' => EditContactMessage::route('/{record}/edit'),
        ];
    }
}
