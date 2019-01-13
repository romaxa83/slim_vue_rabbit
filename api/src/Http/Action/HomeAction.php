<?php
declare(strict_types=1);

namespace Api\\Http\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

Class HomeAction implements RequestHandlerInterface
{
	public function handle(ServerRequestInterface $request) : ResponseInterface
	{
		var_dump($request);die();
		return new JsonResponse([
			'name' => 'App API',
			'version' => '1.0',
		]);
	}
}