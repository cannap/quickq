<?php


namespace Framework\Core\Router;

use Framework\Core\Http\Request;
use Framework\Core\Http\Response;
use Framework\Core\Middleware\MiddlewareInterface;
use InvalidArgumentException;


class Route extends RouteParser
{

    private $route;
    private string $method;
    private $callback;
    private $middlewares = [];
    private $request;

    private ?array $params;

    private string $pattern;

    public function __construct($route, $method, $callback)
    {
        $this->method = $method;
        $this->route = $route;
        $this->callback = $callback;
        $this->params = $this->parse($route);
        //  $this->request = new Request($route);
        $this->pattern = $this->buildRoutePattern($route);
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function hasParams(): ?array
    {
        return $this->params;
    }


    public function getRoute()
    {
        return $this->route;
    }


    public function addMiddleware($middleware): self
    {
        if (!is_callable($middleware) && !($middleware instanceof MiddlewareInterface)) {
            throw new InvalidArgumentException('Middleware must be callable or an instance of MiddlewareInterface');
        }
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function run(Request $request): void
    {
        $middlewareRunner = function ($request, $middlewares, $index) use (&$middlewareRunner) {
            if ($index >= count($middlewares)) {
                return $this->createResponse($this->callback, $request);
            }

            $currentMiddleware = $middlewares[$index];

            $next = function ($request) use ($middlewareRunner, $middlewares, $index) {
                return $middlewareRunner($request, $middlewares, $index + 1);
            };

            if ($currentMiddleware instanceof MiddlewareInterface) {
                return $currentMiddleware->handle($request, $next);
            } elseif (is_callable($currentMiddleware)) {
                return call_user_func($currentMiddleware, $request, $next);
            } else {
                throw new InvalidArgumentException(sprintf(
                    'Middleware at index %d must be callable or an instance of MiddlewareInterface, %s given.',
                    $index,
                    is_object($currentMiddleware) ? 'instance of ' . get_class($currentMiddleware) : gettype($currentMiddleware)
                ));
            }
        };

        try {
            $response = $middlewareRunner($request, $this->middlewares, 0);
            $response->send();
        } catch (\Throwable $e) {
            http_response_code(500);
            echo "Internal Server Error: " . $e->getMessage();
        }
    }

    private function createResponse($callback, Request $request): Response
    {
        $result = $callback($request);
        if (!$result instanceof Response) {
            return new Response($result);
        }
        return $result;
    }
}