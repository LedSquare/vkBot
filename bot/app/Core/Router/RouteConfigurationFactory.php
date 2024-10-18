<?php

namespace App\Core\Router;

use App\Core\Interfaces\Router\RouteConfigurationFactoryInterface;
use App\Core\Interfaces\Router\RouteConfigurationInterface;

final readonly class RouteConfigurationFactory implements RouteConfigurationFactoryInterface
{
    public static function build(string $route, string $controller, string $action): RouteConfigurationInterface
    {
        return new RouteConfiguration(
            route: $route,
            controller: $controller,
            action: $action
        );
    }
}
