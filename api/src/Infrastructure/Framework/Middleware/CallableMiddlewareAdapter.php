<?php

declare(strict_types=1);

namespace Api\Infrastructure\Framework\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

/*
 * адаптер для PSR-15 так как slim не подерживает этот стандарт
 * зарегистрирован в api/config/routes.php
 */
class CallableMiddlewareAdapter
{
    private $container;
    private $middleware;

    public function __construct(ContainerInterface $container, string $middleware)
    {
        $this->container = $container;
        $this->middleware = $middleware;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        /** @var MiddlewareInterface $middleware */
        $middleware = $this->container->get($this->middleware);
        return $middleware->process(
            $request,
            new CallableRequestHandler($next, $response)
        );
    }
}