<?php

namespace App\Controller;

use App\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PaymentController extends BaseController
{
    use ApiResponse;

    public function getPaymentMethods(Request $request, Response $response): Response
    {
        global $auth_user_id;
        if ($auth_user_id !== 1) {
            return $this->sendError('Invalid Auth User!');
        }
        $methodsData = [
            [
                'card_id' => 123,
                'last_four_digits' => 4455,
                'card_expiry_year' => 2024,
                'card_expiry_month' => 04,
            ],
            [
                'card_id' => 234,
                'last_four_digits' => 4675,
                'card_expiry_year' => 2028,
                'card_expiry_month' => 02,
            ]
        ];
        return $this->sendResponse($methodsData);
    }

    public function savePaymentMethod(Request $request, Response $response): Response
    {
        global $auth_user_id;
        if ($auth_user_id !== 1) {
            return $this->sendError('Invalid Auth User!');
        }
        $params = (array)$request->getParsedBody();
        $methodsData = [
            [
                'card_id' => 123,
                'last_four_digits' => 4455,
                'card_expiry_year' => 2024,
                'card_expiry_month' => 04,
            ],
            [
                'card_id' => 234,
                'last_four_digits' => 4675,
                'card_expiry_year' => 2028,
                'card_expiry_month' => 02,
            ],
            [
                'card_id' => 345,
                'last_four_digits' => json_decode($params['last_four_digits']),
                'card_expiry_year' => json_decode($params['card_expiry_year']),
                'card_expiry_month' => json_decode($params['card_expiry_month']),
            ]
        ];
        return $this->sendResponse($methodsData);
    }

    public function removePaymentMethod(Request $request, Response $response): Response
    {
        global $auth_user_id;
        if ($auth_user_id !== 1) {
            return $this->sendError('Invalid Auth User!');
        }
        $params = (array)$request->getParsedBody();
        $methodsData = [
            [
                'card_id' => 123,
                'last_four_digits' => 4455,
                'card_expiry_year' => 2024,
                'card_expiry_month' => 04,
            ],
            [
                'card_id' => 234,
                'last_four_digits' => 4675,
                'card_expiry_year' => 2028,
                'card_expiry_month' => 02,
            ]
        ];
        return $this->sendResponse($methodsData, "Payment method has been successfully removed.");
    }
}