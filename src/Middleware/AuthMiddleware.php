<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Exception\HttpForbiddenException;
use Slim\Psr7\Response;
use App\Traits\ApiResponse;

final class AuthMiddleware implements MiddlewareInterface {
	/**
	 * @var App
	 */
	private $app;
	use ApiResponse;

	public function __construct( $app ) {
		$this->app = $app;
	}

	public function process( ServerRequestInterface $request, RequestHandlerInterface $handler ): ResponseInterface {
		$headers  = $request->getHeaders();
		$settings = $this->app->getContainer()->get( 'settings' );

		if ( ! isset( $headers['x-api-key'][0] ) || $headers['x-api-key'][0] != $settings['api_key'] ) {
			return $this->sendError( 'Api key is missing' );
		}

		return $handler->handle( $request );
	}
}
