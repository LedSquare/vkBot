<?php

namespace App\Core\Interfaces\Router;

interface RouteConfigurationInterface
{
    public function name(string $name): self;

    public function middleware(string $middleware): self;

}
