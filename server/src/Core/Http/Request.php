<?php

namespace Framework\Core\Http;

//Todo: Error handling

class Request
{

    private string $method;
    private array $params;
    private ?string $parsedRoute = null;

    /**
     * @param $route
     * @param $method
     * @param array $params
     */
    public function __construct($route, $method, array $params = [])
    {
        $this->method = $method;
        $this->params = $params;
        $this->parsedRoute = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function extractParams($params, $keys): array|null
    {
        $extractedValues = [];
        //TODO: Nicht sicher ob ich das so machen s
        foreach ($keys as $key) {
            $extractedValues[$key] = $params[$key] ?? null;
        }

        return $extractedValues;
    }

    public function params($params = null): array
    {
        if ($params) {
            return $this->extractParams($this->params, $params);
        }
        return $this->params;
    }

    public function input($param)
    {
        return $this->params[$param];
    }


    public function validate()
    {

    }

}
