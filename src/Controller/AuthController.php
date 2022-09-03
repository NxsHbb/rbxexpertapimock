<?php

namespace App\Controller;

use App\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends BaseController {
	use ApiResponse;

	public function user_login( Request $request, Response $response ) {
		$params = (array) $request->getParsedBody();
		if ( ! isset( $params['email'] ) || ! isset( $params['password'] ) ) {
			return $this->sendError( 'Email or password missing' );
		}
		$settings = $this->app->getContainer()->get( 'settings' );
		if ( $params['email'] !== $settings['user']['email'] || $params['password'] !== $settings['user']['password'] ) {
			return $this->sendError( 'Invalid credential!' );
		}
		$date         = new \DateTimeImmutable();
		$expire_at    = $date->modify( '+20 minutes' )->getTimestamp();      // Add 60 seconds
		$domainName   = "mobileapp";
		$userId       = 1;                                           // Retrieved from filtered POST data
		$request_data = [
			'iat'    => $date->getTimestamp(),         // Issued at: time when the token was generated
			'iss'    => $domainName,                       // Issuer
			'nbf'    => $date->getTimestamp(),         // Not before
			'exp'    => $expire_at,                           // Expire
			'userId' => $userId,                     // User name
		];

		$user = [
			'email'                    => 'info@example.com',
			'user_id'                  => $settings['user']['id'],
			'auth_token'               => JWT::encode( $request_data, $settings['jwt']['secret'], $settings['jwt']['alg'] ),
			'auth_token_expires_on'    => "1661856434",
			'refresh_token'            => "e456gergsr4ef54g5y56br5etge6ryrhy",
			'refresh_token_expires_on' => "1661856876",
			'first_name'               => "FirstName",
			'last_name'                => "lastName",
			'personal_balance'         => 500,
			'avatar_url'               => "https://gravatar.com/avatar/2558164808aff3ea95bf17000794bdca?s=400&d=robohash&r=x"
		];

		return $this->sendResponse( $user );
	}

	public function user_signup( Request $request, Response $response ) {
		$params = (array) $request->getParsedBody();

		if ( ! isset( $params['email'] ) || ! isset( $params['password'] ) ) {
			return $this->sendError( 'Email or password is missing.' );
		}

		if ( $params['email'] === 'info@example.com' ) {
			return $this->sendError( 'An existing user is registered with this email.' );
		}

		$user = [
			'user_id'    => 1234,
			'email'      => $params['email'],
			'first_name' => "FirstName",
			'last_name'  => "LastName",
		];

		return $this->sendResponse( $user, 'Signup was successful.' );
	}

	public function forgot_pass( Request $request, Response $response ) {
		$params = (array) $request->getParsedBody();
		if ( ! isset( $params['email'] ) ) {
			return $this->sendError( 'Email is missing.' );
		}

		if ( $params['email'] === 'info@example.com' ) {
			$user = [
				'user_id'    => 1234,
				'email'      => $params['email'],
				'first_name' => "FirstName",
				'last_name'  => "LastName",
			];

			return $this->sendResponse( $user, 'Signup was successful.' );
		} else {
			return $this->sendError( 'Email address not found.' );
		}
	}
}
