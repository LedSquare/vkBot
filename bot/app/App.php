<?php

namespace App;

use App\Core\Router\Route;
use App\Core\Router\RouteDispatcher;
use App\Http\Response;
use Dotenv\Dotenv;

final class App
{
    public static function run(): void
    {
        self::initEnv();
        self::mode();

        foreach (Route::getRoutes() as $routeConfiguration) {
            $dispatcher = new RouteDispatcher($routeConfiguration);
            $dispatcher->process();
        }
    }

    private static function initEnv(): void
    {
        $env = Dotenv::createUnsafeImmutable('../');
        $env->load();
    }

    private static function mode(): void
    {
        if (env('ENV') === 'dev') {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        }
    }

}