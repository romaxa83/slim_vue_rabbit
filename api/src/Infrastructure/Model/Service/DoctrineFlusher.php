<?php

declare(strict_types=1);

namespace Api\Infrastructure\Model\Service;

use Api\Model\AggregateRoot;
use Api\Model\EventDispatcher;
use Api\Model\Flusher;
use Doctrine\ORM\EntityManagerInterface;

/*
 * обетка над EntiyManager,для того чтоб
 * из него вызывалсь только один метод flush (сохранение данных)
 */
class DoctrineFlusher implements Flusher
{
    private $em;
    private $dispatcher;

    public function __construct(EntityManagerInterface $em, EventDispatcher $dispatcher)
    {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
    }

    public function flush(AggregateRoot ...$roots): void
    {
        $this->em->flush();

        //склеиваем все события
        $events = array_reduce($roots, function (array $events, AggregateRoot $root) {
            return array_merge($events, $root->releaseEvents());
        }, []);
        //передаем все события диспетчеру
        $this->dispatcher->dispatch(...$events);
    }
}