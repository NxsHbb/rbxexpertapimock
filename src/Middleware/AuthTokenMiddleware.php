<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpForbiddenException;
use Slim\Psr7\Response;
use App\Traits\ApiResponse;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class AuthTokenMiddleware implements MiddlewareInterface
{
    private $session;
    use ApiResponse;

    public function __construct()
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $headers = $request->getHeaders();
        $params = $request->getQueryParams();

        $api_key = 'abc123';

        if (!isset($headers['Authorization'][0])) {
            return $this->sendError('Authentication header missing');
        }
        $bRawToken = $headers['Authorization'][0];
        $bRawTokenArr = explode(' ', $bRawToken);
        if (empty($bRawTokenArr[1])) {
            return $this->sendError('Empty Authentication Token');
        }
        $token = $bRawTokenArr[1];

        $secret_Key = '68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=';
        try {
            $tokenData = JWT::decode($token, new Key($secret_Key, 'HS256'));
        }catch (\Exception $e){
            return $this->sendError($e->getMessage(), 401);
        }

        $now = new \DateTimeImmutable();
        $serverName = "mobileapp";

        if ($tokenData->iss !== $serverName ||
            $tokenData->nbf > $now->getTimestamp() ||
            $tokenData->exp < $now->getTimestamp()) {
            return $this->sendError('Unauthorized Authentication Token', 401);
        }
//        $params = (array)$request->getParsedBody();
//        $params['authData'] = $tokenData;
//        $request->getBody()->write(json_encode($params));


        return $handler->handle($request);
    }
}
