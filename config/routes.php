<?php

use App\Controller\AuthController;
use App\Middleware\AuthMiddleware;
use App\Controller\UserController;
use App\Controller\OrderController;
use App\Controller\SettingsController;
use App\Controller\MiscController;
use App\Controller\PaymentController;
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
			$app->post( '/login', function ( $request, $response ) use ( $app ) {
				return ( new AuthController( $app ) )->user_login( $request, $response );
			} );
			$app->post( '/signup', function ( $request, $response ) use ( $app ) {
				return ( new AuthController( $app ) )->user_signup( $request, $response );
			} );
            $app->post( '/forgot-password', function ( $request, $response ) use ( $app ) {
                return ( new AuthController( $app ) )->forgot_password( $request, $response );
            } );
            $app->post( '/log-out', function ( $request, $response ) use ( $app ) {
                return ( new AuthController( $app ) )->user_logout( $request, $response );
            } )
                ->add( new AuthTokenMiddleware($app) );
			$app
				->get( '/my-profile', function ( $request, $response ) use ( $app ) {
					return ( new UserController( $app ) )->getUser( $request, $response );
				} )
				->add( new AuthTokenMiddleware($app) );
            $app
                ->get( '/order-counts', function ( $request, $response ) use ( $app ) {
                    return ( new OrderController( $app ) )->getOrderCounts( $request, $response );
                } )
                ->add( new AuthTokenMiddleware($app) );
            $app
                ->get( '/orders', function ( $request, $response ) use ( $app ) {
                    return ( new OrderController( $app ) )->getOrders( $request, $response );
                } )
                ->add( new AuthTokenMiddleware($app) );
            $app
                ->get( '/settings', function ( $request, $response ) use ( $app ) {
                    return ( new SettingsController( $app ) )->getSettings( $request, $response );
                } )
                ->add( new AuthTokenMiddleware($app) );
            $app
                ->post( '/settings', function ( $request, $response ) use ( $app ) {
                    return ( new SettingsController( $app ) )->saveSettings( $request, $response );
                } )
                ->add( new AuthTokenMiddleware($app) );
            $app
                ->get( '/payment-methods', function ( $request, $response ) use ( $app ) {
                    return ( new PaymentController( $app ) )->getPaymentMethods( $request, $response );
                } )
                ->add( new AuthTokenMiddleware($app) );
            $app
                ->post( '/payment-methods', function ( $request, $response ) use ( $app ) {
                    return ( new PaymentController( $app ) )->savePaymentMethod( $request, $response );
                } )
                ->add( new AuthTokenMiddleware($app) );
            $app
                ->delete( '/payment-methods', function ( $request, $response ) use ( $app ) {
                    return ( new PaymentController( $app ) )->removePaymentMethod( $request, $response );
                } )
                ->add( new AuthTokenMiddleware($app) );
            $app
                ->get( '/page', function ( $request, $response ) use ( $app ) {
                    return ( new MiscController( $app ) )->getToSPolicy( $request, $response );
                } );
		} )
		->add( new AuthMiddleware($app) );
};
