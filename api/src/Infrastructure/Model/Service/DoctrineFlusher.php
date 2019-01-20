<?php

declare(strict_types=1);

namespace Api\Infrastructure\Model\Service;

use Api\Model\Flusher;
use Doctrine\ORM\EntityManagerInterface;

/*
 * обетка над EntiyManager,для того чтоб
 * из него вызывалсь только один метод flush (сохранение данных)
 */
class DoctrineFlusher implements Flusher
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function flush(AggregateRoot ...$roots): void
    {
        $this->em->flush();
    }
}