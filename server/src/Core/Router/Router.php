<?php

namespace Framework\Core\Router;


use Framework\Core\Http\Request;

final class Router
{
    /** @var Route[] */
    private array $routesCollection = [];
    private string $prefix = '';

    // protected  $methods = array();

    public function __construct()
    {
    }

    public function post(string $route, $callback): Route
    {
        return $this->addRoute(Methods::POST, $route, $callback);
    }

    public function delete(string $route, $callback): Route
    {
        return $this->addRoute(Methods::DELETE, $route, $callback);
    }

    public function patch(string $route, $callback): Route
    {
        return $this->addRoute(Methods::PATCH, $route, $callback);
    }

    public function put(string $route, $callback): Route
    {
        return $this->addRoute(Methods::PUT, $route, $callback);
    }

    public function get(string $route, $callback): Route
    {
        return $this->addRoute(Methods::GET, $route, $callback);
    }

    public function addRoute($method, string $route, $callback): Route
    {
        if ($this->prefix) {
            $route = $this->prefix . $route;
        }

        $route = $this->sanitizeRoute($route);

        return $this->routesCollection[$route] = new Route($route, $method, $callback);
    }


    /**
     * @param $route
     * @return string
     */
    private function sanitizeRoute($route): string
    {
        $route = preg_replace('/(\/+)/', '/', $route);
        return rtrim($route, '/');
    }

    public function getCurrentUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (str_contains($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        return '/' . trim($uri, '/');
    }


    public function dispatch(): void
    {
        $currentURI = $this->getCurrentUri();
        $matched = false;

        foreach ($this->routesCollection as $route) {
            if ($route->getRoute() === $currentURI && !$route->hasParams()) {
                $matched = true;
                $this->executeRoute($route);
                break;
            }

            $pattern = $route->getPattern();
            if (preg_match($pattern, $currentURI, $matches)) {
                array_shift($matches);
                if ($_SERVER['REQUEST_METHOD'] === $route->getMethod()) {
                    $this->executeRoute($route, $matches);
                    return;
                } else {
                    http_response_code(405);
                    return;
                }
            }
        }

        if (!$matched) {
            http_response_code(404);
        }
    }

    public function group($prefix, $callback): void

    {
        $this->prefix = $prefix;
        $callback();
        $this->prefix = '';
    }


    private function executeRoute(Route $route, $params = []): void
    {
        $method = $route->getMethod();
        if ($_SERVER['REQUEST_METHOD'] === $method) {
            $request = new Request($route, $method, $params,);
            $route->run($request);
        } else {
            echo "Unknown method";
        }
    }


    public function listRoutes(): array
    {
        return $this->routesCollection;
    }
}
