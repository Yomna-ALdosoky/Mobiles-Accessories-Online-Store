<?php

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            // \App\Http\Middleware\SetAppLocale::class,
            \App\Http\Middleware\UpdateUserLastActiveAt::class,
            \App\Http\Middleware\MarkNotificationAsRead::class,


        ]);
        $middleware->alias([
            'auth.type' => \App\Http\Middleware\checkUserType::class,
            'check.api.token' => \App\Http\Middleware\CheckApiToken::class,

            /**** OTHER MIDDLEWARE ALIASES ****/
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,


        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->report(function (QueryException $e) {
            if ($e->getCode() == 23000) {
                Log::channel('sql')->warning($e->getMessage());
            }
            return true;
        });

        $exceptions->render(
            function (QueryException $e, Request $request) {
                if ($e->getCode() == 23000) {
                    $message = 'Foreign key constraint failed';
                } else {
                    $message = $e->getMessage();
                }

                if ($request->expectsJson()) {
                    return response()->json([
                        'message' =>  $message,
                    ], 404);
                }

                return redirect()->back()->withInput()->withErrors([
                    'message' => $e->getMessage()
                ])->with('info', $message);
            }
        );
    })->create();
