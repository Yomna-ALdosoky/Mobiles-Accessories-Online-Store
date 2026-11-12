<?php

namespace App\Filament\Resources\SubCategories\Pages;

use App\Filament\Resources\SubCategories\SubCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\RestoreAction;

class EditSubCategory extends EditRecord
{
    protected static string $resource = SubCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
            // ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
