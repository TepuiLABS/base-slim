<?php

namespace App\Helper;

use Psr\Http\Message\ResponseInterface as Response;

final class JsonResponse
{
    public static function withJson(Response $response, $data, $status = 200 )
	{
        $response->getBody()->write(json_encode($data));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}