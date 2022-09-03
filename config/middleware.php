<?php

use App\Middleware\SessionMiddleware;
use Slim\App;

return function (App $app) {

//	$app->add(SessionMiddleware::class);
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Handle exceptions
    $app->addErrorMiddleware(true, true, true);
};
