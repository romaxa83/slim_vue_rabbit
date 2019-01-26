<?php

declare(strict_types=1);

namespace Api\Model;

trait EventTrait
{
    //храним события
    private $recordedEvents = [];

    //записываем события
    public function recordEvent($event): void
    {
        $this->recordedEvents[] = $event;
    }
    //возвращаем все события и очищаем их
    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }
}