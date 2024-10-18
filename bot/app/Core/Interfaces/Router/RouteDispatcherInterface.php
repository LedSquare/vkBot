<?php

namespace App\Core\Interfaces\Router;

interface RouteDispatcherInterface
{
    public function process(): void;
}
