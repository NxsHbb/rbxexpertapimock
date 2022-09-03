<?php

use App\Controller\AuthController;
use App\Controller\UserController;
use App\Middleware\AuthMiddleware;
use App\Middleware\AuthTokenMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function ( App $app ) {
	$app->get( '/', function ( Request $request, Response $response ) use ( $app ) {
		$response->getBody()->write( 'Hello world' );

		return $response->withHeader( 'Content-Type', 'application/json' );
	} );
	$app->setBasePath( '/api/v1' );
	$app
		->group( '/api/v1', function () use ( $app ) {
			$authController = new AuthController( $app );
			$app->post( '/login', function ( $request, $response ) use ( $app, $authController ) {
				return $authController->user_login( $request, $response );
			} );
			$app->post( '/signup', function ( $request, $response ) use ( $app, $authController ) {
				return ( new AuthController( $app ) )->user_signup( $request, $response );
			} );
			$app
				->get( '/get-user', function ( $request, $response ) use ( $app ) {
					return ( new UserController( $app ) )->getUser( $request, $response );
				} )
				->add( AuthTokenMiddleware::class );
		} )
		->add( AuthMiddleware::class );
};
