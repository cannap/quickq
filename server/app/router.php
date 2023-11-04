<?php


use Framework\Core\Http\Request;
use Framework\Core\Router\Router;


$router = new Router();

$router->get('/info', function () {
    if ($_ENV["ENV"] === 'development') {
        phpinfo();
    }
});


$router->group('/admin/', function () use ($router) {
    $router->get('/hi/', function (Request $request) {
        return 'hi';
    });

});


$router->dispatch();
