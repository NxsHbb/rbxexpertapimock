<?php

namespace App\Controller;

use App\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SettingsController extends BaseController
{
    use ApiResponse;

    public function getSettings(Request $request, Response $response): Response
    {
        global $auth_user_id;
        if ($auth_user_id !== 1) {
            return $this->sendResponse([], 'Invalid Auth User.', 401);
        }
        $settingsData = [
            'mobile_push'=>true,
        ];
        return $this->sendResponse($settingsData);
    }
    public function saveSettings(Request $request, Response $response): Response
    {
        global $auth_user_id;
        if ($auth_user_id !== 1) {
            return $this->sendResponse([], 'Invalid Auth User.', 401);
        }
        $params = (array) $request->getParsedBody();
        $settingsData = [
            'mobile_push'=>$params['mobile_push'],
        ];
        return $this->sendResponse($settingsData, 'Settings updated successfully.');
    }
}