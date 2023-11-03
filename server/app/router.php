<?php


use Framework\Core\Http\Request;
use Framework\Core\Http\Response;
use Framework\Core\Contract\MiddlewareInterface;
use Framework\Core\Router\Router;


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
