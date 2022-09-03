<?php

namespace App\Controller;

use App\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends BaseController {
	use ApiResponse;

	public function getUser( Request $request, Response $response ): Response {
		global $auth_user_id;
		return $this->sendResponse( [$auth_user_id] );
	}
}