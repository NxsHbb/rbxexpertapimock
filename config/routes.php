<?php

use App\Controller\AuthController;
use App\Middleware\AuthMiddleware;
use App\Middleware\AuthTokenMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    $app->post('/api/v1/login', function ($request, $response) {
        return (new AuthController())->user_login($request, $response);
    })->add(AuthMiddleware::class);
    $app
        ->post('/api/v1/signup', function ($request, $response) {
            return (new AuthController())->user_signup($request, $response);
        })
        ->add(AuthMiddleware::class)
        ->add(AuthTokenMiddleware::class);
    // $app->post('/api/v1/forgot-password', function ($request, $response) {
    //     return (new AuthController())->forgot_pass($request, $response);
    // })->add(\App\Middleware\AuthMiddleware::class);
};
