<?php

namespace App;

use App\Controller;
use App\Response;
use Dotenv\Dotenv;

final class App
{
    public static function run(): void
    {
        self::initEnv();
        self::mode();

        $controller = new Controller();
        $response = $controller->index();

        self::printJson($response);
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

    private static function printJson(Response $response): void
    {
        header('Content-Type: application/json');
        echo $response->toJson()->response();
    }
}