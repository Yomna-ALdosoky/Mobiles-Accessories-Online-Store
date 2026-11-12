<?php

namespace App\Filament\Resources\SubCategories\Pages;

use App\Filament\Resources\SubCategories\SubCategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;


class CreateSubCategory extends CreateRecord
{
    protected static string $resource = SubCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->hidden();
    }
}
