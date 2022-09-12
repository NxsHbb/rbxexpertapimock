<?php

namespace App\Controller;

use App\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController extends BaseController
{
    use ApiResponse;

    public function getUser(Request $request, Response $response): Response
    {
        global $auth_user_id;
        if ($auth_user_id !== 1) {
            return $this->sendError('Invalid Auth User!');
        }
        $userData = [
            'user_id' => 1234,
            'email' => 'example@email.com',
            'first_name' => "FirstName",
            'last_name' => "lastName",
            'personal_balance' => "US$500",
            'avatar_url' => "https://gravatar.com/avatar/2558164808aff3ea95bf17000794bdca?s=400&d=robohash&r=x",
        ];
        return $this->sendResponse($userData);
    }
}