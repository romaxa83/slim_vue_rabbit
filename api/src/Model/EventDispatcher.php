<?php

declare(strict_types=1);

namespace Api\Model;

interface EventDispatcher
{
	//метод принимает массив событий
    public function dispatch(...$events): void;
}