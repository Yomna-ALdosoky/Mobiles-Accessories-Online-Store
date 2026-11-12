<?php

namespace App\Filament\Resources;

use App\Enums\NavigationGroup;
use Filament\Resources\Resource;

abstract class BaseResource extends Resource
{
    public static function getNavigationSort(): ?int
    {
        $group = static::getNavigationGroup();

        if ($group instanceof NavigationGroup) {
            $orderedList = $group->getOrderedResources();

            $position = array_search(static::class, $orderedList);

            if ($position !== false) {
                return $position + 1;
            }
        }

        return parent::getNavigationSort();
    }
}
