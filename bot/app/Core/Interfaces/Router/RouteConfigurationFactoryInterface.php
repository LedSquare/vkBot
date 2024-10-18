<?php

namespace App\Core\Interfaces\Router;

interface RouteConfigurationFactoryInterface
{
    public static function build(string $route, string $controller, string $action): RouteConfigurationInterface;
}
