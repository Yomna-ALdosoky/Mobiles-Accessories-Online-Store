<?php

namespace App\Filament\Resources\AboutUs\Pages;

use App\Filament\Resources\AboutUs\AboutUsResource;
use App\Models\AboutUs;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAboutUs extends EditRecord
{
    protected static string $resource = AboutUsResource::class;

    public function mount(int|string $record = null): void
    {
        $aboutUs = AboutUs::firstOrCreate(['id' => 1]);

        parent::mount($aboutUs->id);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
