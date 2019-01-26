<?php

declare(strict_types=1);

use Slim\App;
use Api\Http\Action;
use Api\Http\Middleware;
use Psr\Container\ContainerInterface;
use Api\Infrastructure\Framework\Middleware\CallableMiddlewareAdapter as CM;

return function (App $app, ContainerInterface $container)
{
//     $app->add(new CM($container, Middleware\BodyParamsMiddleware::class));
     $app->add(new CM($container, Middleware\DomainExceptionMiddleware::class));
     $app->add(new CM($container, Middleware\ValidationExceptionMiddleware::class));

	$app->get('/',Action\HomeAction::class . ':handle');

	$app->post('/auth/signup',Action\Auth\SignUp\RequestAction::class . ':handle');
};