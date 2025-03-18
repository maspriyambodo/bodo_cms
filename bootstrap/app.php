<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\CorsMiddleware;
use App\Http\Middleware\ForceHttps;
use App\Http\Middleware\ActivityLogger;
use App\Http\Middleware\PreventBackAfterLogout;
use App\Http\Middleware\RateLimitMiddleware;

return Application::configure(basePath: dirname(__DIR__))
                ->withRouting(
                        web: __DIR__ . '/../routes/web.php',
                        commands: __DIR__ . '/../routes/console.php',
                        health: '/up',
                )
                ->withMiddleware(function (Middleware $middleware) {
                    $middleware->append(SecurityHeaders::class);
                    $middleware->append(CorsMiddleware::class);
                    $middleware->append(ForceHttps::class);
                    $middleware->append(ActivityLogger::class);
                    $middleware->append(PreventBackAfterLogout::class);
                    $middleware->append(RateLimitMiddleware::class);
                })
                ->withExceptions(function (Exceptions $exceptions) {
                    //
                })->create();
