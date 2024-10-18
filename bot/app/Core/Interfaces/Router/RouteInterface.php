<?php

namespace App\Core\Interfaces\Router;

interface RouteInterface
{
    /**
     * @param string $route
     * @param class-string $controller
     * @param string $action
     * @return \App\Core\Interfaces\Router\RouteConfigurationInterface
     */
    public static function get(string $route, string $controller, string $action): RouteConfigurationInterface;
    public static function post(string $route, string $controller, string $action): RouteConfigurationInterface;

    public static function getRoutes(): array;
}
