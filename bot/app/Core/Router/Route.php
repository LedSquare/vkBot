<?php

namespace App\Core\Router;
use App\Core\Interfaces\Router\RouteConfigurationInterface;
use App\Core\Interfaces\Router\RouteInterface;

final class Route implements RouteInterface
{
    /**
     * @var RouteConfigurationInterface[]
     */
    private static array $routesGet = [];

    /**
     * @var RouteConfigurationInterface[]
     */
    private static array $routesPost = [];

    public static function get(string $route, string $controller, string $action): RouteConfigurationInterface
    {
        $configuration = RouteConfigurationFactory::build($route, $controller, $action);
        self::$routesGet[] = $configuration;

        return $configuration;
    }

    public static function post(string $route, string $controller, string $action): RouteConfigurationInterface
    {
        $configuration = RouteConfigurationFactory::build($route, $controller, $action);
        self::$routesPost[] = $configuration;

        return $configuration;
    }

    /**
     * @return RouteConfigurationInterface[]
     */
    public static function getRoutes(): array
    {
        return match (true) {
            $_SERVER['REQUEST_METHOD'] === 'GET' => self::$routesGet,
            $_SERVER['REQUEST_METHOD'] === 'POST' => self::$routesPost,
        };
    }




}
