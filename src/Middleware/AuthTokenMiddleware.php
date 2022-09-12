<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Traits\ApiResponse;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\App;

final class AuthTokenMiddleware implements MiddlewareInterface {
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

		if ( ! isset( $headers['Authorization'][0] ) ) {
			return $this->sendError( 'Authentication header missing' );
		}
		$bRawToken = $headers['Authorization'][0];
		list( $bearer, $token ) = explode( 'Bearer ', $bRawToken );
		if ( empty( $token ) ) {
			return $this->sendError( 'Empty Authentication Token' );
		}

		try {
			$tokenData = JWT::decode( $token, new Key( $settings['jwt']['secret'], $settings['jwt']['alg'] ) );
		} catch ( \Exception $e ) {
			return $this->sendError( $e->getMessage(), 401 );
		}

		$now        = new \DateTimeImmutable();
		$serverName = "mobileapp";

		if ( $tokenData->iss !== $serverName ||
		     $tokenData->nbf > $now->getTimestamp() ||
		     $tokenData->exp < $now->getTimestamp() ) {
			return $this->sendError( 'Unauthorized Authentication Token', 401 );
		}
		if ( !$tokenData->userId ) {
			return $this->sendError( 'Invalid Authentication user', 401 );
		}

		global $auth_user_id;
		$auth_user_id = (int)$tokenData->userId;

		return $handler->handle( $request );
	}
}
