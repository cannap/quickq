<?php


use Framework\Core\Http\Request;
use Framework\Core\Router\Router;


$router = new Router();

$router->get('/info', function () {
    if ($_ENV["ENV"] === 'development') {
        phpinfo();
    }
});


$router->group('/api/', function () use ($router) {

    $router->get('/user/{userID}', function (Request $request) {

        $params = $request->params(['userID']);

        return response($params, 200);
    });


    $router->get('/json', function (Request $request) {
        $data = array("a" => "Apple", "b" => "Ball", "c" => "Cat");
        return response($data);
    });

    $router->get('/register', function (Request $request) {
        $email = "beispiel@email.com";
        $username = "BeispielBenutzer";

        $stmt = db()->pdo->prepare('INSERT INTO users(email,username) VALUES (?,?)');
        $data = $stmt->execute(['hello@world.com', 'oghgo']);
        echo $data;
    });
});
$router->group('/admin/', function () use ($router) {
    $router->get('/hi/', function (Request $request) {
        echo "Hello World";
    });
});


$router->dispatch();