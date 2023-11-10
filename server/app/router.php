<?php


use Framework\Core\Http\Request;
use Framework\Core\Http\Response;
use Framework\Core\Router\Router;
use Framework\Core\Database\QueryBuilder;

$router = new Router();

$router->get('/info', function () {
    if ($_ENV["ENV"] === 'development') {
        phpinfo();
    }
});
$router->get('/test/', function () {
});

$router->get('/surveys/', function (Request $request) {
    $survey = [
        "survey" => [
            "id" => "1",
            "title" => "Kundenzufriedenheitsumfrage",
            "questions" => [
                [
                    "id" => "1",
                    "text" => "Wie zufrieden sind Sie mit unserem Service?",
                    "answerOptions" => [
                        ["id" => "1", "text" => "Sehr zufrieden"],
                        ["id" => "2", "text" => "Zufrieden"],
                        ["id" => "3", "text" => "Neutral"],
                        ["id" => "4", "text" => "Unzufrieden"],
                        ["id" => "5", "text" => "Sehr unzufrieden"],
                    ],
                ],
                [
                    "id" => "2",
                    "text" => "Wie wahrscheinlich ist es, dass Sie unser Unternehmen weiterempfehlen?",
                    "answerOptions" => [
                        ["id" => "1", "text" => "Sehr wahrscheinlich"],
                        ["id" => "2", "text" => "Wahrscheinlich"],
                        ["id" => "3", "text" => "Unwahrscheinlich"],
                        ["id" => "4", "text" => "Sehr unwahrscheinlich"],
                        ["id" => "5", "text" => "Ich werde es definitiv nicht weiterempfehlen"],
                    ],
                ],
            ],
        ],
    ];

    /* @var  Response $response */
    return response($survey);
});


$router->dispatch();
