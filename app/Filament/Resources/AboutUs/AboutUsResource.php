<?php

namespace App\Filament\Resources\AboutUs;

use App\Enums\NavigationGroup;
use App\Filament\Resources\AboutUs\Pages\EditAboutUs;
use App\Filament\Resources\AboutUs\Schemas\AboutUsForm;
use App\Models\AboutUs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\BaseResource;
use UnitEnum;

class AboutUsResource extends BaseResource
{
    protected static ?string $model = AboutUs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static string| UnitEnum |null $navigationGroup = NavigationGroup::ContentManagement;
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'AboutUs';

    public static function form(Schema $schema): Schema
    {
        return AboutUsForm::configure($schema);
    }


    public static function getPages(): array
    {
        return [

            'index' => EditAboutUs::route('/'),
        ];
    }
}
