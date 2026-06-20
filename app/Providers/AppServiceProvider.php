<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Listeners\DeductProductQuantity;
use App\Listeners\EmptyCart;
use App\Listeners\SendCreateNotification;
use App\Services\CurrencyConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Fortify\Fortify;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('currency.converter', function ($app) {
            $apiKey = config('services.currency_converter.api_key') ?? env('CURRENCY_API_KEY');
            return new CurrencyConverter($apiKey);
        });

        $this->app->bind('abilities', function () {
            return include base_path('data/abilities.php');
        });
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::ignoreRoutes();

        foreach ($this->app->make('abilities') as $code => $lable) {
            Gate::define($code, function ($user) use ($code) {
                return $user->hasAbility($code);
            });
        }

        JsonResource::withoutWrapping();

        validator::extend('fillter', function ($attribute, $value, $params) {
            return ! in_array(strtolower($value), $params);
        }, 'the value is prohipted');

        Paginator::useBootstrapFive();
    }
}
