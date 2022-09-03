<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpForbiddenException;
use Slim\Psr7\Response;
use App\Traits\ApiResponse;

final class AuthMiddleware implements MiddlewareInterface
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

    if (!isset($headers['x-api-key'][0]) || $headers['x-api-key'][0] != $api_key) {
      return $this->sendError('Api key is missing');
    }

    $response = $handler->handle($request);
    return $response;
  }
}
