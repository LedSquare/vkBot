<?php

namespace App\Core\Router;
use App\Core\Interfaces\Router\RouteConfigurationInterface;

class RouteConfiguration implements RouteConfigurationInterface
{
    private string $name;
    private string $middleware;

    public function __construct(
        public string $route,
        public string $controller,
        public string $action,
    ) {
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function middleware(string $middleware): self
    {
        $this->middleware = $middleware;
        return $this;
    }
}
