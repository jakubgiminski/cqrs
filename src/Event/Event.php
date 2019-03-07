<?php declare(strict_types=1);

namespace CQRS\Event;

use CQRS\Event\Store\DeserializableEvent;
use CQRS\Event\Store\Serializable;
use CQRS\NamedResource;
use DateTimeImmutable;

abstract class Event implements Serializable, DeserializableEvent, NamedResource
{
    private $occurredOn;

    public function __construct(DateTimeImmutable $occurredOn = null)
    {
        $this->occurredOn = $occurredOn ?: new DateTimeImmutable();
    }

    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function __toString(): string
    {
        return $this::getName();
    }
}