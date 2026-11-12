<?php

namespace App\Enums;

use App\Filament\Pages\ManageCompanySettings;
use App\Filament\Resources\AboutUs\AboutUsResource;
use Filament\Support\Contracts\HasLabel;
use App\Filament\Resources\Admins\AdminResource;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\Brands\BrandResource;
use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Filament\Resources\MainCategories\MainCategoryResource;
use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Stores\StoreResource;
use App\Filament\Resources\SubCategories\SubCategoryResource;
use App\Filament\Resources\Users\UserResource;


enum NavigationGroup: string implements HasLabel
{
    case ShopManagement = 'Shop Management';
    case UserManagement = 'User Management';
    case ContentManagement = 'Content Management';

    public function getLabel(): string
    {
        return match ($this) {
            self::ShopManagement => 'Shop Management',
            self::UserManagement => 'User Management',
            self::ContentManagement => 'Content Management',
        };
    }

    public function getOrderedResources(): array
    {
        return match ($this) {
            self::ShopManagement => [
                CategoryResource::class,
                SubCategoryResource::class,
                ProductResource::class,
                OrderResource::class,
                BrandResource::class,
                StoreResource::class,

            ],
            self::UserManagement => [
                AdminResource::class,
                UserResource::class,
            ],
            self::ContentManagement => [
                BlogResource::class,
                AboutUsResource::class,
                ContactMessageResource::class,
                ManageCompanySettings::class,
            ],
        };
    }
}
