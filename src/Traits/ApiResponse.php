<?php

namespace App\Traits;

use Slim\Psr7\Response;

trait ApiResponse
{
    /**
     * @param       $message
     * @param array $data
     *
     * @return Response
     */
    protected function sendResponse(array $data, $message = null, $code = 200)
    {
        $responseData = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
        $response = new Response();
        $response->getBody()->write(json_encode($responseData));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }

    /**
     * @param       $error
     * @param int $code
     * @param array $errorData
     * @return Response
     */
    protected function sendError($error, int $code = 200, array $errorData = [])
    {
        $responseData = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorData)) {
            $responseData['data'] = $errorData;
        }
        $response = new Response();
        $response->getBody()->write(json_encode($responseData));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}
