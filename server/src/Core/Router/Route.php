<?php


namespace Framework\Core\Router;

use Framework\Core\Http\Request;
use Framework\Core\Http\Response;

class Route extends RouteParser
{

    private $route;
    private string $method;
    private $callback;
    private $middleware = [];
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


    public function run(Request $request): void
    {

        header("Access-Control-Allow-Origin: *");

        $callback = $this->callback;
        $output = $callback($request);
        if ($output) {
            if ($output instanceof Response) {
                $output->send();
                return;
            }
            echo $output;
        }

    }
}
