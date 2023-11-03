<?php


use Framework\Core\Http\Request;
use Framework\Core\Http\Response;
use Framework\Core\Contract\MiddlewareInterface;
use Framework\Core\Router\Router;


class Auth implements MiddlewareInterface
{
    public function handle(Request $request, callable $next): Response
    {
        /* @var Response $response */
        $response = $next($request);

        $response->header('wtf', 'fewrf');
        return $response;
    }
}

$router = new Router();

$router->get('/info', function () {
    if ($_ENV["ENV"] === 'development') {
        phpinfo();
    }
});


$router->group('/admin/', function () use ($router) {
    $router->get('/hi/', function (Request $request) {
    })->addMiddleware(new Auth());

});


$router->dispatch();
