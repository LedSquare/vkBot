<?php

namespace App\Core\Router;
use App\Core\Interfaces\Router\RouteDispatcherInterface;

class RouteDispatcher implements RouteDispatcherInterface
{
    private array $parameterMap = [];
    private array $parameterRequestMap = [];
    private string $requestUri = '/';

    public function __construct(
        private RouteConfiguration $routeConfiguration,
    ) {
    }

    public function process(): void
    {
        $this->setRequestUri();

        $this->setParameterMap();

        $this->makeRegexRequest();

        $this->match();
    }

    private function setRequestUri(): void
    {
        if ($_SERVER['REQUEST_URI'] !== '/') {
            $this->requestUri = $this->cleanUri($_SERVER['REQUEST_URI']);
            $this->routeConfiguration->route = $this->cleanUri($this->routeConfiguration->route);
        }
    }

    private function cleanUri(string $uri): string
    {
        return preg_replace('/(^\/)|(\/$)/', '', $uri);
    }

    private function setParameterMap(): void
    {
        $routeArray = explode('/', $this->routeConfiguration->route);

        foreach ($routeArray as $key => $value) {
            if (preg_match('/{.*}/', $value)) {
                $this->parameterMap[$key] = preg_replace('/(^{)|(}$)/', '', $value);
            }
        }
    }

    private function makeRegexRequest(): void
    {
        $requestUriArray = explode('/', $this->requestUri);

        foreach ($this->parameterMap as $paramKey => $param) {
            if (!isset($requestUriArray[$paramKey])) {
                return;
            }

            $this->parameterRequestMap[$param] = $requestUriArray[$paramKey];
            $requestUriArray[$paramKey] = '{.*}';

        }
        $this->requestUri = implode('/', $requestUriArray);
        $this->prepareRegex();
    }

    private function prepareRegex(): void
    {
        $this->requestUri = str_replace('/', '\/', $this->requestUri);
    }

    private function match(): void
    {
        if (preg_match("/{$this->requestUri}/", $this->routeConfiguration->route)) {
            $this->runClass();
        }
    }

    private function runClass(): void
    {
        $ClassName = $this->routeConfiguration->controller;
        $action = $this->routeConfiguration->action;

        if (!class_exists($ClassName)) {
            throw new \Exception("ClassName controller $ClassName is not exists");
        }

        $class = new $ClassName();
        $class->$action(...$this->parameterRequestMap);
    }

}
